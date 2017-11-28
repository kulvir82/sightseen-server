<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;	

class BookingDetail extends Model
{
    protected $fillable = ['booking_id','sight_seen_id', 'total', 'no_of_pax', 'discount', 'cost_per_pax','booking_time'];
}

?>