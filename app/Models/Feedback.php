<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['sightseen_id', 'user_id', 'comment'];

    public function sightseen()
    {
        return $this->belongsTo('App\Models\Sightseen','sightseen_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
