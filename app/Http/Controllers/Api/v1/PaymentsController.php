<?php

namespace App\Http\Controllers\Api\v1;

use App\Mail\PaymentIsDone;
use Mail;
use DB;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\User;
use App\Models\UserCard;
use App\Models\UserBooking;
use App\Models\BookingDetail;
use App\Http\Controllers\Controller;


class PaymentsController extends Controller
{
    public function charge(Request $request)
    {

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try
        {
        	$user = User::find($request->payment['user_id']);

	        if($request->payment['stripe_token'])
	        {

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

	        $booking = UserBooking::find($request->payment['booking_id']);
	        $booking->card_no = $request->payment['card_no'];
	        $booking->status = 'Confirmed';
	        $booking->payment_status = 'Success';
	        $booking->save();

	        $recipient = ['email'=>$user->email,'name'=>$user->first_name.' '.$user->last_name,'booking_id'=>$booking->booking_number];

	        $booking_detail = BookingDetail::where('booking_id', $booking->id)
	        				->select('no_of_pax',DB::raw("DATE_FORMAT(booking_time, '%Y-%m-%d') as booking_date"),'title','first_name','last_name')
	        				->leftjoin('ce_sightseen','ce_sightseen.id','=','booking_details.sight_seen_id')
	        				->leftjoin('traveler_details','traveler_details.booking_detail_id','=','booking_details.id')
	        				->get()->toArray();

	        $data = ['booking_detail'=> $booking_detail, 'booking_number'=> $booking->booking_number];

	        Mail::send('emails.booking', $data, function ($message) use($recipient) {
            $message->from('support@go4sightseeing.com', 'Go4SightSeeing')
              ->to($recipient['email'], $recipient['name'])
              ->subject('Your Booking in Processing with Booking ID : '.$recipient['booking_id']);
        	});

	        return response()->json(['message'=>"Payment Succssefully done",'success'=>true]);

        }

        catch (\Exception $ex) {

    		return response()->json(['message'=>$ex->getMessage(),'success'=>false]);

    	}

    }
}
