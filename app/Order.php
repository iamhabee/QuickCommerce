<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_item_order_id',
        'order_item_product_id',
        'order_item_seller_id',
        'order_item_buyer_id',
        'order_item_order_price',
        'order_item_status'
    ];
    public function order_item()
    {
        return $this->hasMany('App\OrderItem');
    }
}
