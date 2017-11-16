<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Sightseen;
use App\Models\CeUser;

class UsersModel extends Model
{

  public function createUser($request)
  {
    $newUser = new CeUsers;
    $newUser->phone_number = $request->phonenumber;
    $newUser->save();

    $id = CeUsers::where('phone_number',$request->phonenumber)->value('id');
    return $id;
  }

  public function updateUser($request)
  {
    $updateduser = CeUsers::where('id','=',$request->id)->update(['username' => $request->username, 'email' => $request->email]);
    return 'success';
  }
  public function CheckExistinUserList($request)
  {
    $userid = CeUsers::where('phone_number','=',$request->phonenumber)->value('id');
    return $userid;
  }
}
