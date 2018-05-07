<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Sightseen;
use App\Models\CeUsers;
use App\Models\User;
use DB;
use App\Models\UserBooking;
use App\Models\BookingDetail;

class UsersModel extends Model
{

  public function createUser($request)
  {

    $newUser = new CeUsers;
    $newUser->phone_number = $request->phnum;
    $newUser->save();

    $id = CeUsers::where('phone_number','=',$request->phnum)->value('id');
    return $id;
  }

  public function updateUser($request)
  {
    $password = Hash::make('123456789');
    $updateuser = CeUsers::where('id','=',$request->id)->update(['username' => $request->username, 'email' => $request->email ,'password' => $password ]);
    $userdetails = CeUsers::where('id','=',$request->id)->first();
    return $userdetails;
  }
  public function ExistingUser($request)
  {
    $user = User::where('phone_number', $request->phnum)->first();
    if(count($user))
    {
      $user->is_deleted = 0;
      $user->save();
      return $user->id;
    }
    else
      return '';
  }

  public function checkoutCartData($request)
  {

  }

  public function getUserDetail($userId){
    $user = User::find($userId);
    $data = array();
    if(count($user) > 0){
      $data['username'] = $user->username;
      $data['first_name'] = $user->first_name;
      $data['last_name'] = $user->last_name;
      $data['email'] = $user->email;
      $data['phone_number'] = $user->phone_number;
    }
    return $data;
  }

  public function updateAppUser($request)
  {
    $updateuser = CeUsers::where('id','=',$request->id)->update(['username' => $request->username, 'email' => $request->email ,'first_name' => $request->first_name, 'last_name' => $request->last_name, 'phone_number' => $request->phone_number ]);
    $userdetails = $this->getUserDetail($request->id);
    return $userdetails;
  }
  public function getUsersDetail()
  {
    $detail = CeUsers::select('id','username','email','phone_number',DB::raw("DATE_FORMAT(created_at, '%m-%d-%Y') as registerd_on"))->paginate(10);

    foreach ($detail as $index =>$id) {
      $bookings = UserBooking::select('id')->where('userid','=',$id->id)->get();
      $detail[$index]['number_of_bookings'] = count($bookings);
    }


    return $detail;
  }

  public function searchUsersDetail($request)
  {
    
    $detail = CeUsers::select('id','username','email','phone_number',DB::raw("DATE_FORMAT(created_at, '%m-%d-%Y') as registerd_on"))->where('username','like','%'.$request->search.'%')->orWhere('email','like','%'.$request->search.'%')->paginate(10);

    foreach ($detail as $index =>$id) {
      $bookings = UserBooking::select('id')->where('userid','=',$id->id)->get();
      $detail[$index]['number_of_bookings'] = count($bookings);
    }


    return $detail;
  }
}
