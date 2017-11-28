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
        $booking = UserBooking::create(['userid'=>$request->user_id,'total_sale_amount'=>$request->booking_detail['total_sale_amount'],'card_no'=>$request->booking_detail['card_no'],'status'=>'Pending','payment_status'=>'Pending','totaldiscount'=>0,'total_cost'=>0]);
        
        $costPerPax = $request->booking_detail['price'];
        $noOfPax = $request->booking_detail['no_of_pax'];
        $total = $costPerPax * $noOfPax; // without discount
        $discount = ($total * $request->booking_detail['discount'])/100;
        $finalTotal = $total - $discount; // including discount

        BookingDetail::create(['booking_id'=> $booking->id,'sight_seen_id' => $request->booking_detail['sight_seen_id'],'no_of_pax'=>$request->booking_detail['no_of_pax'],'cost_per_pax'=>$request->booking_detail['price'],'total'=> $finalTotal,'booking_time'=>$request->booking_detail['datetime'],'discount'=>$discount]);

        $booking->totaldiscount = $discount;
        $booking->save();

        return response()->json(['booking_id'=>$booking->id,'success'=>true], 201);
    }

    // public function update(Request $request, UserBooking $booking)
    // {
    // 	// return response()->json($booking, 201);
    // 	BookingDetail::create(['booking_id'=> $booking->id,'sight_seen_id' => $request->booking_detail['sight_seen_id'],'no_of_pax'=>$request->booking_detail['no_of_pax'],'cost_per_pax'=>$request->booking_detail['price'],'total'=> $total,'booking_time'=>$request->booking_detail['datetime'],'discount'=>$request->booking_detail['discount']]);

    // 	$booking->totaldiscount = $discount;
    //     $booking->save();
    // }
}

	
?>