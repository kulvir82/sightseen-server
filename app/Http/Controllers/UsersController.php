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
        $request->phonenumber,
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
          $id = $model->ExistingUser($request);
          if(!empty($id)){
            Auth::login($id);
              $client->messages->create(
                  // the number you'd like to send the message to
                  $request->phnum,
                  array(
                      // A Twilio phone number you purchased at twilio.com/console
                      'from' => $twilioNumber,
                      // the body of the text message you'd like to send
                      'body' => $pin
                  )
              );

              $data['id'] = $id;
              $data['pin'] = $pin;
              $data['user'] = "olduser";
              return response()->json($data);

        }else {
            $id = $model->createUser($request);
            $client->messages->create(
                // the number you'd like to send the message to
                $request->phnum,
                array(
                    // A Twilio phone number you purchased at twilio.com/console
                    'from' => $twilioNumber,
                    // the body of the text message you'd like to send
                    'body' => $pin
                )
            );
            $data["id"] = $id;
            $data['pin'] = $pin;
            $data["user"] = "newuser";
            return response()->json($data);
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
  public function verifyPin(Request $request)
  {
    if($pin == $request->pin){
      return redirect()->intended('/userprofile');
    }
  }
  public function updateProfile(Request $request)
  {
    $model = new UsersModel;
    $updateduser = $model->updateUser($request);
      Auth::login($updateduser);
    return response()->json($updateduser);
  }

  public function addProductToUsersCart(Request $request,CookieJar $cookieJar)
  {
      return response()->json('added to cart');
  }
  public function unique_id($l) {
    return substr(md5(uniqid(mt_rand(), true)), 0, $l);
  }
  public function checkoutCartData(Request $request)
  {
    if($request->userId){

    }
  }
}
