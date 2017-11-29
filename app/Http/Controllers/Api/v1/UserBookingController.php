<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\UserBooking;
use App\Models\BookingDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Class UserBookingController extends Controller
{
	
	// save user bookings
	public function store(Request $request)
    {
        if($request->booking_id > 0)
        	$booking = UserBooking::find(1);
        else
        	$booking = UserBooking::create(['userid'=>$request->user_id,'total_sale_amount'=>0,'card_no'=>$request->booking_detail['card_no'],'status'=>'Payment Pending','payment_status'=>'Pending','totaldiscount'=>0,'total_cost'=>0]);
        
        $bookingDetail = new BookingDetail;
        $res = $bookingDetail->saveBookingDetail($request, $booking->id);
        
        $booking->totaldiscount += $res[0];
        $booking->total_sale_amount += $res[1];
        $booking->save();

        return response()->json(['booking_id'=>$booking->id,'success'=>true], 201);
    }

    public function update(Request $request, UserBooking $booking)
    {
    	
    	$bookingDetail = new BookingDetail;
        $res = $bookingDetail->updateBookingDetail($request, $booking->id);

    	$booking->totaldiscount = $res[0];
    	$booking->total_sale_amount = $res[1];
        $booking->save();

        return response()->json(['booking_id'=>$booking->id,'success'=>true], 200);
    }
    public function getCartItems(Request $request)
    {
        $userId = $request->id;
        $booking = UserBooking::where('userid', $userId)->first();
        if(count($booking) > 0){
            $bookingDetail = new BookingDetail;
            $cartItems = $bookingDetail->getCartItems($booking->id);
            return response()->json(['cartItems'=> $cartItems,'success'=>true],200);
        }else{
            return response()->json(['success'=>false],200);
        }

    }
}

	
?>