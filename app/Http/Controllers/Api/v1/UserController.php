<?php
namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request ;
use Twilio\Rest\Client;
use App\Models\UsersModel;
use App\Models\DeviceToken;
class UserController extends Controller
{
  public function sendSms(Request $request)
  {
    $model = new UsersModel;
    
    $pindigits = 4;
    $data = array();
    
    $sid = env('TWILIO_ACCOUNT_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilioNumber = env('TWILIO_NUMBER');
    
    $pin = $this->generatePIN($pindigits);
    
    $client = new Client($sid, $token);
    
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
              'from' => $twilioNumber,
              // the body of the text message you'd like to send
              'body' => $pin
          )
      );
    }
    catch(\Exception $e)
    {
      return response()->json("Something went wrong, Try again");
    }
    
    $data['id'] = $id;
    $data['pin'] = $pin;
    
    return response()->json($data);
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
    DeviceToken::updateOrCreate(['user_id' => $request->user_id],['user_id' => $request->user_id, 'device_token' => $request->device_token,'platform' => $request->platform]);
    return response()->json(['success' => true],200);
  }
}
