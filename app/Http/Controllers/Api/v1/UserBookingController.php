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
        	$booking = UserBooking::find($request->booking_id);
        else
        	$booking = UserBooking::create(['userid'=>$request->user_id,'total_sale_amount'=>0,'card_no'=>$request->booking_detail['card_no'],'status'=>'Payment Pending','payment_status'=>'Pending','totaldiscount'=>0,'total_cost'=>0,'tax_amount' => 0]);
        
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
        $data = $request->booking_detail;
        $res = $bookingDetail->updateBookingDetail($data, $booking->id);

    	$booking->totaldiscount = $res[0];
    	$booking->total_sale_amount = $res[1];
        $booking->tax_amount = $request->tax_amount;
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

    public function getCartCount(Request $request)
    {
        $userId = $request->id;
        $booking = UserBooking::where('userid', $userId)->first();
        if(count($booking) > 0){
            $cartCount = BookingDetail::where('booking_id',$booking->id)->count();
            return response()->json(['booking_id'=>$booking->id,'cart_count'=> $cartCount],200);
        }else{
            return response()->json(['booking_id'=>0,'cart_count'=> 0],200);
        }
    }

    public function deleteCartItem(Request $request)
    {
        $cartId = $request->id;
        BookingDetail::destroy($cartId);
        return response()->json(['success'=>true],204);
    }

    public function getTax(Request $request)
    {
        return response()->json(['tax'=>10],200);
    }  

    public function getBookings(Request $request)
    {
        $bookings = UserBooking::where('userid', $request->id)->where('status','!=','Payment Pending')->get();
        $bookingDetail = new BookingDetail;
        $allBookings = $bookingDetail->getBookings($bookings);
        return response()->json($allBookings, 200);
    } 
}

	
?>