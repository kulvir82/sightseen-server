<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCard extends Model
{
    protected $fillable = ['user_id','stripe_customer_id', 'card_no'];
}
