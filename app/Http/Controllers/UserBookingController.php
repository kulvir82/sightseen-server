<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserBooking;
use App\Models\Sightseen;
use App\Models\BookingDetail;
use Illuminate\Contracts\Filesystem\Filesystem;
class UserBookingController extends Controller
{
    public function index(Request $request)
    {

        $bookings = UserBooking::getBookings($request);
    	
    	return response()->json($bookings);
    }

    public function getBookingDetail(Request $request)
    {
        $bookingDetail = new BookingDetail;
        $bookings = $bookingDetail->getCartItems($request->booking_id);
        return response()->json($bookings);
    }

    public function addVoucher(Request $request)
    {
        $file = $request->file;
        $s3 = \Storage::disk('s3');
        $path = "vouchers/".time()."_".$file->getClientOriginalName();
        try{
            $s3->put($path, file_get_contents($file), 'public');
            $url = $s3->url($path);
            BookingDetail::where('id', $request->booking_id)->update(['voucher'=> $url]);
        }
        catch(\Exception $e)
        {
            return response()->json("Error while adding voucher. Try again", 500);
        }
        
        return response()->json("Voucher added successfully.", 200);
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
