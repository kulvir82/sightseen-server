<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserBooking;
use App\Models\Sightseen;
use App\Models\BookingDetail;

class UserBookingController extends Controller
{
    public function index(Request $request)
    {

        $bookings = UserBooking::getBookings($request);
    	
    	return response()->json($bookings);
    }

    public function getBookingDetail(Request $request)
    {
        $booking = UserBooking::where('id', $request->id)->first();
        
        $bookingDetail = new BookingDetail;
        
        $bookings = $bookingDetail->getCartItems($booking);
        
        return response()->json($bookings);
    }

    public function addVoucher(Request $request)
    {

        $bookingModel = new UserBooking;
        
        $res = $bookingModel->addVoucher($request);

        if($res)
            return response()->json("Voucher added successfully.", 200);
        else
            return response()->json("Error while adding voucher. Try again", 500);
    }


    public function removeVoucher(Request $request)
    {
        BookingDetail::where('id', $request->booking_id)->update(['voucher'=> '']);
        
        return response()->json("Voucher removed successfully.", 200);
    }

    public function updateBooking(Request $request)
    {
        UserBooking::where('id', $request->booking_id)->update(['status'=>$request->status]);
        

        return response()->json("Successfully updated");
    }
}
