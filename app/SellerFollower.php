<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerFollower extends Model
{
    protected $fillable = [
        'buyer_id','seller_id'
    ];
}
