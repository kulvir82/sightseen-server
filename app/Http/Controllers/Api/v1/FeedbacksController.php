<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feedback;	

class FeedbacksController extends Controller
{
    public function store(Request $request)
    {
    	Feedback::create(['sightseen_id'=>$request->sightseen_id, 'user_id'=>$request->user_id, 'comment' => $request->comment]);
    	return response()->json(['success'=> true, 'message'=>"Feedback added successfully"],201);
    }


    public function feedbacks(Request $request)
    {
    	$feedbacks = Feedback::select('user_id','comment','created_at')
    				->where(['sightseen_id'=>$request->sightseen_id])
    				->with(['user' => function ($query){
    					$query->select('id','username');
    				}])
    				->get();
    	return response()->json(['feedbacks' => $feedbacks, 'success'=> true],200);
    }
}
