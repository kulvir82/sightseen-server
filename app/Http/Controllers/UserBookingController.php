<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserBooking;
class UserBookingController extends Controller
{
    public function index(Request $request)
    {
    	$bookings = UserBooking::all();
        $data =array();
        $i = 0;
    	foreach($bookings as $booking)
    	{
    		$data[$i]['username'] = $booking->user->username;
    		$data[$i]['total_amount'] = $booking->total_sale_amount;
    		$data[$i]['discount_amount'] = $booking->totaldiscount;
    		$data[$i]['status'] = $booking->status;
    		$data[$i]['payment_status'] = $booking->payment_status;
    		$data[$i]['tax_amount'] = $booking->tax_amount;
    		$i++;
    	}
    	return response()->json($data);
    }
}
