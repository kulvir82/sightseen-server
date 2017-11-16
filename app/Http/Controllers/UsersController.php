<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Cookie\CookieJar;
use Hash;

class UsersController extends Controller
{
  var $pin = "";

  public function userLogin(Request $request)
  {
    $model = new UsersModel;
    $pindigits = 4;
    $sid = env('TWILIO_ACCOUNT_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilioNumber = env('TWILIO_NUMBER');
    $pin = $this->generatePIN($pindigits);
    $client = new Client($sid, $token);

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

    $data['pin'] = $pin;
    return response()->json($data);
    # code...
  }


  public function sendSms(Request $request)
  {
    $model = new UsersModel;
    $pindigits = 4;
    $sid = env('TWILIO_ACCOUNT_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilioNumber = env('TWILIO_NUMBER');
    $pin = $this->generatePIN($pindigits);
    $client = new Client($sid, $token);
    $userexist = $model->CheckExistinUserList($request);
    if($userexist) {
      if (Auth::attempt(['phonenumber' => $request->phonenumber])) {
            // Authentication passed...
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
            $data['id'] = $userexist;
            $data['pin'] = $pin;
            return response()->json($data);
        }

     }
     else {
       $id = $model->createUser($request);
       // Use the client to do fun stuff like send text messages!
       if (Auth::attempt(['phonenumber' => $request->phonenumber])){

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
     }
  }
  public function generatePIN($digits)
  {
    $i = 0; //counter
    //our default pin is blank.
    while($i < $digits){
        //generate a random number between 0 and 9.
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
  }
  public function verifyPin(Request $request)
  {
    if($pin == $request->pin){
      return redirect()->intended('/userprofile');
    }
  }
  public function updateUser(Request $request)
  {
    $model = new UsersModel;
    $updateduser = $model->updateUser($request);
    return response()->json($updateduser);
  }

  public function addProductToUsersCart(Request $request,CookieJar $cookieJar)
  {
      return response()->json('added to cart');
  }

  public function unique_id($l) {
    return substr(md5(uniqid(mt_rand(), true)), 0, $l);
  }

}
