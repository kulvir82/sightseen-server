<?php

namespace App\Models;
use App\Models\TravelerDetail;
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
    	$totalDiscount = 0;
    	$totalSaleAmount = 0;
    	foreach ($data as $req){
            if($req){
        		$costPerPax = $req['cost_per_person'];
    	        $noOfPax = $req['no_of_pax'];
    	        $total = $costPerPax * $noOfPax; // without discount
    	        $discount = ($total * $req['discount'])/100;
    	        $finalTotal = $total - $discount; // including discount
    	        $totalDiscount += $discount;
    	        $totalSaleAmount += $finalTotal;
        		
                BookingDetail::where('id', $req['id'])->update(['booking_id'=> $bookingId,'no_of_pax'=>$req['no_of_pax'],'cost_per_pax'=>$req['cost_per_person'],'total'=> $finalTotal,'booking_time'=>$req['booking_time'],'discount'=>$req['discount'], 'pickup_location' => $req['location']]);
              
                TravelerDetail::updateOrCreate(['booking_detail_id'=>$req['id']],['first_name'=>$req['traveler']['first_name'], 'last_name' => $req['traveler']['last_name']]);
    	   }
        }
    	return [$totalDiscount,$totalSaleAmount];

    }
    public function getCartItems($booking){
        $cartItems = BookingDetail::select('booking_details.*','traveler_details.first_name','traveler_details.last_name')->where('booking_id', $booking->id)->leftjoin('traveler_details', 'traveler_details.booking_detail_id','=','booking_details.id')->get();
        $data = array();
        $i = 0;
        foreach($cartItems as $cartItem){
            $data[$i]['id'] = $cartItem->id;
            $data[$i]['sight_seen_name'] = $cartItem->sightseen->title;
            $data[$i]['sightseen_id'] = $cartItem->sight_seen_id;
            $data[$i]['discount_amount'] = $cartItem->discount;
            $data[$i]['discount'] = $cartItem->sightseen->discount;
            $data[$i]['no_of_pax'] = $cartItem->no_of_pax;
            $data[$i]['cost_per_person'] = $cartItem->cost_per_pax;
            $data[$i]['total'] = $cartItem->total;
            $data[$i]['booking_date'] = date("Y-m-d",strtotime($cartItem->booking_time));
            $data[$i]['booking_time'] = $cartItem->booking_time;
            $data[$i]['booking_id'] = $cartItem->booking_id;
            $data[$i]['location'] = $cartItem->pickup_location;
            $data[$i]['is_pickup'] = $cartItem->sightseen->pickup ? true : false;
            $data[$i]['voucher'] = $cartItem->voucher; 
            $data[$i]['traveler']['first_name'] = ($cartItem->first_name ? $cartItem->first_name : ($booking->user->first_name ? $booking->user->first_name : ''));
            $data[$i]['traveler']['last_name'] = ($cartItem->last_name ? $cartItem->last_name : ($booking->user->last_name ? $booking->user->last_name : ''));
            $i++;
        }
        return $data;
    }

    public function getBookings($bookings)
    {
        $finalData = array();
        $i = 0;
        foreach($bookings as $booking)
        {
            $query = BookingDetail::select('booking_details.*','traveler_details.first_name','traveler_details.last_name')->where('booking_id', $booking->id)->leftjoin('traveler_details', 'traveler_details.booking_detail_id','=','booking_details.id')->get();
            $j = 0;
            $data = array();
            foreach($query as $row){
                $data[$j]['id'] = $row->id;
                $data[$j]['sight_seen_name'] = $row->sightseen ? $row->sightseen->title : 'Sightseen not Available';
                $data[$j]['sightseen_id'] = $row->sight_seen_id;
                $data[$j]['no_of_pax'] = $row->no_of_pax;
                $data[$j]['cost_per_person'] = $row->cost_per_pax;
                $data[$j]['total'] = $row->total;
                $data[$j]['booking_date'] = date("Y-m-d",strtotime($row->booking_time));
                $data[$j]['booking_id'] = $row->booking_id;
                $data[$j]['location'] = $row->pickup_location;
                $data[$j]['is_pickup'] = $row->sightseen ? ($row->sightseen->pickup ? true : false) : false;
                $data[$j]['voucher'] = $row->voucher;
                $data[$j]['booking_count'] = $query->count();
                $data[$j]['booking_total'] = $booking->total_sale_amount;
                $data[$j]['booking_number'] = strtoupper($booking->booking_number);
                $data[$j]['traveler']['first_name'] = ($row->first_name ? $row->first_name : ($booking->user->first_name ? $booking->user->first_name :''));
                $data[$j]['traveler']['last_name'] = ($row->last_name ? $row->last_name : ($booking->user->last_name ? $booking->user->last_name :''));
                $j++;
            }
            $finalData[$i]['booking_detail'] = $data;
            $i++;
        }
        return $finalData;
    }
}

?>
