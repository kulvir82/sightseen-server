<?php
namespace App\Http\Controllers\api\v1;
require '/Users/navinder/Documents/city-explorer-server/vendor/autoload.php';
use App\Http\Controllers\Controller;
use Illuminate\Http\Request ;
use Twilio\Rest\Client;
use App\Models\UsersModel;
class UserController extends Controller
{
  public function sendSms(Request $request)
  {
    $model = new UsersModel;
    $pindigits = 4;
    $sid = env('TWILIO_ACCOUNT_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilioNumber = env('TWILIO_NUMBER');
    $pin = $this->generatePIN($pindigits);
    $client = new Client($sid, $token);
    $id = $model->createUser($request);
    // Use the client to do fun stuff like send text messages!
    $client->messages->create(
        // the number you'd like to send the message to
        '+918437976838',
        array(
            // A Twilio phone number you purchased at twilio.com/console
            'from' => $twilioNumber,
            // the body of the text message you'd like to send
            'body' => $pin
        )
    );
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
    $updateduser = $model->updateUser($request);
    return response()->json($updateduser);
  }

}
