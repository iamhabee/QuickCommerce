<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    // protected $casts = [
    //     'pictures' => 'array',
    //     'colors' => 'array',
    //     'size' => 'array',
    //     'tags' => 'array'
    // ];
    protected $fillable = [
        'product_name',
        'product_code',
        'product_category_id',
        'product_seller_id',
        'product_description',
        'product_tag',
        'product_status',
        'product_quantity',
        'product_color',
        'product_price',
        'product_discount_price',
        'product_category',
        'product_size_category',
        'product_bulk_price',
        'product_brand_id',
        'product_deleted',
        'product_created_at',
        
    ];


}
