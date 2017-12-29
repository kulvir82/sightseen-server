<?php
namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request ;
use Twilio\Rest\Client;
use App\Models\UsersModel;
use App\Models\User;
use App\Models\DeviceToken;
class UserController extends Controller
{

  protected $sid;
  protected $token;
  protected $twilioNumber;

  public function __construct()
  {
    $this->sid = env('TWILIO_ACCOUNT_SID');
    $this->token = env('TWILIO_AUTH_TOKEN');
    $this->twilioNumber = env('TWILIO_NUMBER');
  }

  public function sendSms(Request $request)
  {
    $model = new UsersModel;
    
    $pindigits = 4;

    $data = array();
    
    $pin = $this->generatePIN($pindigits);
    
    $client = new Client($this->sid, $this->token);
    
    $id = $model->ExistingUser($request);

    $data['new_user'] = false;
    
    if(empty($id)){
      $id = $model->createUser($request);
      $data['new_user'] = true;
    }
    // Use the client to do fun stuff like send text messages!
    try{
      $client->messages->create(
          // the number you'd like to send the message to
          '+'.$request->phnum,
          array(
              // A Twilio phone number you purchased at twilio.com/console
              'from' => $this->twilioNumber,
              // the body of the text message you'd like to send
              'body' => $pin
          )
      );
    }
    catch(\Exception $e)
    {
      return response()->json($e->getMessage());
    }
    
    $data['id'] = $id;
    $data['pin'] = $pin;
    
    return response()->json($data);
  }

  public function getCodeByCall(Request $request)
  {
    $digit = implode(" ", str_split($request->sms_code));

    $message = "Your verification code is $digit";
    
    $client = new Client($this->sid, $this->token);

    try
    {
      $client->calls->create(
            // the number you'd like to send the message to
            '+'.$request->phnum,
            
            $this->twilioNumber,
                // the body of the text message you'd like to send
            array('url' => 'http://twimlets.com/message?Message='.urlencode($message))
        );

      return response()->json(['success'=>true],200);
    }
    catch(\Exception $e)
    {
      return response()->json(['success'=>true, 'message'=>'Something went wrong, Try again', 'error'=> $e->getMessage()],200);
    }
  }

  public function generatePIN($digits)
  {
    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while($i < $digits){
        //generate a random number between 0 and 9.
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
  }
  public function updateUser(Request $request)
  {
    $model = new UsersModel;
    $updateduser = $model->updateAppUser($request);
    return response()->json($updateduser,200);
  }

  public function getUserDetail(Request $request)
  {
    $model = new UsersModel;
    $user = $model->getUserDetail($request->id);
    return response()->json($user, 200);
  }


  public function addDeviceToken(Request $request)
  {
    DeviceToken::updateOrCreate(['user_id' => $request->user_id],['user_id' => $request->user_id, 'token' => $request->device_token,'platform' => $request->platform]);
    return response()->json(['success' => true],200);
  }

  public function deleteAccount(Request $request)
  {
    try
    {
      User::where('id', $request->user_id)->update(['is_deleted' => 1]);
      DeviceToken::where('user_id', $request->user_id)->delete();
      return response()->json(['success'=>true,'message'=>'Your account has been deleted successfully'],200);
    }
    catch(\Exception $e)
    {
      return response()->json(['success'=>false,'message'=>$e->getMessage()], 500);
    }
  }
}
