<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;	

class BookingDetail extends Model
{
    protected $fillable = ['booking_id','sight_seen_id', 'total', 'no_of_pax', 'discount', 'cost_per_pax','booking_time'];


    public function saveBookingDetail($data, $bookingId)
    {

    	$costPerPax = $data->booking_detail['price'];
        $noOfPax = $data->booking_detail['no_of_pax'];
        $total = $costPerPax * $noOfPax; // without discount
        $discount = ($total * $data->booking_detail['discount'])/100;
        $finalTotal = $total - $discount; // including discount

        BookingDetail::create(['booking_id'=> $bookingId,'sight_seen_id' => $data->booking_detail['sight_seen_id'],'no_of_pax'=>$data->booking_detail['no_of_pax'],'cost_per_pax'=>$data->booking_detail['price'],'total'=> $finalTotal,'booking_time'=>$data->booking_detail['datetime'],'discount'=>$discount]);

        return [$discount,$finalTotal];
    }

    public function updateBookingDetail($data, $bookingId)
    {
    	$data = [];
    	$totalDiscount = 0;
    	$totalSaleAmount = 0;
    	foreach ($data as $req){

    		$costPerPax = $req->booking_detail['price'];
	        $noOfPax = $req->booking_detail['no_of_pax'];
	        $total = $costPerPax * $noOfPax; // without discount
	        $discount = ($total * $req->booking_detail['discount'])/100;
	        $finalTotal = $total - $discount; // including discount
	        $totalDiscount += $discount;
	        $totalSaleAmount += $finalTotal;
    		BookingDetail::where('booking_id', $bookingId)->update(['booking_id'=> $bookingId,'sight_seen_id' => $req->booking_detail['sight_seen_id'],'no_of_pax'=>$req->booking_detail['no_of_pax'],'cost_per_pax'=>$req->booking_detail['price'],'total'=> $total,'booking_time'=>$req->booking_detail['datetime'],'discount'=>$req->booking_detail['discount']]);
    	}
    	return [$totalDiscount,$totalSaleAmount];
    	
    }
}

?>