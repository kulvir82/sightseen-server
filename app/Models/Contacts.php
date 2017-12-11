<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    public function saveEmailData($request)
    {
      $contacts = new Contacts;
      $contacts->name = $request->username;
      $contacts->email = $request->emailid;
      $contacts->resource = $request->resource;
      $contacts->message = $request->message;
      $contacts->save();
      return 'successful';
    }
}
