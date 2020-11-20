<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'id',
        'product_id',
        'order_item_seller_id',
        'order_item_buyer_id',
        'order_item_order_price',
        'order_item_status'
    ];

    
    
}
