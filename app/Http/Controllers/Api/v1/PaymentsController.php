<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\User;
use App\Models\UserCard;
use App\Models\UserBooking;
use App\Http\Controllers\Controller;


class PaymentsController extends Controller
{
    public function charge(Request $request)
    {

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try{

	        if($request->payment['stripe_token'])
	        {

	        	$user = User::find($request->payment['user_id']);
	        	
	        	$customer = Customer::create(array(
		            'email' => $user->email,
		            'source'  => $request->payment['stripe_token']
	        	));

	        	$customer_id = $customer->id;

	        	UserCard::updateOrCreate(['user_id'=>$request->payment['user_id']],['card_no'=>$request->payment['card_no'],'stripe_customer_id'=>$customer_id]);

	        }
	        else{

	        	$card = UserCard::where('user_id', $request->payment['user_id'])->first();

	        	$customer_id = $card->stripe_customer_id;

	        }

	        $charge = Charge::create(array(
	            'customer' => $customer_id,
	            'amount'   => (float)$request->payment['total_amount'] * 100,
	            'currency' => 'usd'
	        ));

	        UserBooking::where('id',$request->payment['booking_id'])->update(['card_no'=>$request->payment['card_no'],'status'=>'Confirmed','payment_status'=>'Success']);

	        return response()->json(['message'=>"Payment Succssefully done",'success'=>true]);

        } 

        catch (\Exception $ex) {

    		return response()->json(['message'=>$ex->getMessage(),'success'=>false]);

    	}

    }
}
