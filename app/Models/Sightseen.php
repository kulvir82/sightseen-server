<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sightseen extends Model
{
    //
    protected $table = 'ce_sightseen';
    public $timestamps = false;

    public function bookings()
    {
        return $this->hasMany('App\Models\BookingDetail', 'sight_seen_id');
    }

    public function feedbacks()
    {
    	return $this->hasMany('App\Models\Feedback', 'sightseen_id');
    }
}
