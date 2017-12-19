<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBooking extends Model
{
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class, 'userid');
    }


    public static function getBookings($request)
    {
    	if(!empty($request->country) && !empty($request->city))
    	{
        	$sightseenids = Sightseen::where('country_id', $request->country)->where('city_id', $request->city)->pluck('id');
        	
        	$bookingids = BookingDetail::whereIn('sight_seen_id', $sightseenids)->pluck('booking_id');
        
       		$bookings = UserBooking::with('user')->whereIn('id', $bookingids)->paginate(10);
    	}
        elseif(!empty($request->country) || !empty($request->city))
        {
        	$sightseenids = Sightseen::where('country_id', $request->country)->orWhere('city_id', $request->city)->pluck('id');

        	$bookingids = BookingDetail::whereIn('sight_seen_id', $sightseenids)->pluck('booking_id');
        
        	$bookings = UserBooking::with('user')->whereIn('id', $bookingids)->paginate(10);
    	}	
        else{
            $bookings = UserBooking::with('user')->paginate(10);
        }

        return $bookings;
    }
}

?>
