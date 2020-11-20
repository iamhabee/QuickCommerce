<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = [
        'variant_size','variant_color', 'variant_price', 'variant_discount_price', 'variant_bulk_price', 'variant_product_id', 'variant_image_url'
    ];
}
