<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;

class ContactUs extends Controller
{
  public function saveEmailData(Request $request)
  {
     $model = new Contacts;
     $data = $model->saveEmailData($request);
     return response()->json($data);
  }
}
