<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserBooking;
class UserBookingController extends Controller
{
    public function index(Request $request)
    {
    	$bookings = UserBooking::all();
    	foreach($bookings as $booking)
    	{
    		$data[$i]['username'] = $booking->user->username;
    		$data[$i]['total_amount'] = $booking->total_tax_amount;
    		$data[$i]['discount_amount'] = $booking->total_discount;
    		$data[$i]['status'] = $booking->status;
    		$data[$i]['payment_status'] = $booking->payment_status;
    		$data[$i]['tax_amount'] = $booking->tax_amount;
    		$i++;
    	}
    	return response()->json($data);
    }
}
