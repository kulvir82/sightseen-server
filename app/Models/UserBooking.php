<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PushNotification;
use App\Models\UserBooking;
use Illuminate\Contracts\Filesystem\Filesystem;

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
        
       		$bookings = UserBooking::with('user')->whereIn('id', $bookingids);
    	}
        elseif(!empty($request->country) || !empty($request->city))
        {
        	$sightseenids = Sightseen::where('country_id', $request->country)->orWhere('city_id', $request->city)->pluck('id');

        	$bookingids = BookingDetail::whereIn('sight_seen_id', $sightseenids)->pluck('booking_id');
        
        	$bookings = UserBooking::with('user')->whereIn('id', $bookingids);
    	}	
        else
        {
            $bookings = UserBooking::with('user');
        }
        if(!empty($request->status))
            $bookings = $bookings->where('status', $request->status);

        if(!empty($request->booking_number))
        {
            $bookings = UserBooking::with('user')->where('booking_number', $request->booking_number);
        }
        return $bookings->paginate(10);
    }


    public function addVoucher($request)
    {
        $file = $request->file;
        
        $s3 = \Storage::disk('s3');
        
        $path = "vouchers/".time()."_".$file->getClientOriginalName();
        
        try{
            $s3->put($path, file_get_contents($file), 'public');
            
            $url = $s3->url($path);
            
            $booking_detail = BookingDetail::where('id', $request->id)->first();

            $booking_detail->voucher = $url;

            $booking_detail->save();


            $exists = BookingDetail::where('booking_id', $request->booking_id)->whereNull('voucher')->exists();

            if(!$exists)
                UserBooking::where('id', $request->booking_id)->update(['status' => 'Confirmed']);

            $device = UserBooking::join('device_tokens', 'device_tokens.user_id', '=', 'user_bookings.userid')
                                    ->select('token','platform')
                                    ->where('user_bookings.id', $request->booking_id)
                                    ->first();

            if(count($device) > 0)
            {
                if($device->platform == 'ios')
                    $platform = "IOS";
                else
                    $platform = "Android";

                PushNotification::app($platform)
                ->to(strToLower($device->token))
                ->send("Your voucher for ".$booking_detail->sightseen->title." has been added");
            }    

            return ['error'=>''];
            
        }
        catch(\Exception $e)
        {
            return ['error'=>$e];
        }
    }
}

?>
