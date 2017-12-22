<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feedback;	
use DB;
class FeedbacksController extends Controller
{
    public function store(Request $request)
    {
    	Feedback::create(['sightseen_id'=>$request->sightseen_id, 'user_id'=>$request->user_id, 'comment' => $request->comment]);
    	return response()->json(['success'=> true, 'message'=>"Feedback added successfully"],201);
    }


    public function feedbacks(Request $request)
    {
    	$feedbacks = Feedback::select('user_id','comment',DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date"))
    				->where(['sightseen_id'=>$request->sightseen_id])
    				->with(['user:id,username'])
    				->get();
    	return response()->json(['feedbacks' => $feedbacks, 'success'=> true],200);
    }
}
