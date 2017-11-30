<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;	

class BookingDetail extends Model
{
    protected $fillable = ['booking_id','sight_seen_id', 'total', 'no_of_pax', 'discount', 'cost_per_pax','booking_time'];

    public function sightseen()
    {
        return $this->belongsTo('App\Models\Sightseen','sight_seen_id');
    }

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
    		BookingDetail::where('booking_id', $bookingId)->update(['booking_id'=> $bookingId,'sight_seen_id' => $req->booking_detail['sight_seen_id'],'no_of_pax'=>$req->booking_detail['no_of_pax'],'cost_per_pax'=>$req->booking_detail['price'],'total'=> $finalTotal,'booking_time'=>$req->booking_detail['datetime'],'discount'=>$req->booking_detail['discount']]);
    	}
    	return [$totalDiscount,$totalSaleAmount];
    	
    }
    public function getCartItems($bookingId){
        $cartItems = BookingDetail::where('booking_id', $bookingId)->get();
        $data = array();
        $i = 0;    
        foreach($cartItems as $cartItem){
            $data[$i]['id'] = $cartItem->id;
            $data[$i]['sight_seen_name'] = $cartItem->sightseen->title;
            $data[$i]['no_of_pax'] = $cartItem->no_of_pax;
            $data[$i]['cost_per_person'] = $cartItem->cost_per_pax;
            $data[$i]['total'] = $cartItem->total;
            $data[$i]['booking_time'] = $cartItem->booking_time;
            $data[$i]['booking_id'] = $cartItem->booking_id;
            $i++;
        }  
        return $data;
    }

    // public function updateCartTotal($cartId)
    // {
    //     $total = BookingDetail
    // }
}

?>