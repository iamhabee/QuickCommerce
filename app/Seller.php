<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seller_bank_name','seller_account_number', 'seller_account_name', 'seller_store_name', 'seller_created_at'
    ];
}
