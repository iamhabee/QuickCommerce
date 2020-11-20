<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\SellerFollower;
use DB;

class HomeController extends Controller
{
    //fetch all seller status

    public function seller_status($id=0){
        $current_time =  date("Y-m-d");
        $status = [];
        if($id == 0){
            $status = DB::table('products')
                ->join('users', 'products.product_seller_id', '=', 'users.id')
                ->join('sellers', 'users.id', '=', 'sellers.seller_user_id')
                ->select(DB::raw('products.product_name, products.id, products.product_seller_id, products.product_image, sellers.seller_store_name, users.user_image_url'))
                ->whereRaw("DATEDIFF(now(), products.created_at) = 1 OR DATEDIFF(now(), products.created_at) = 0 AND products.product_deleted = 0")
                // ->whereTime('products.created_at', '<=', date("Y-m-d h:i:s"))
                ->get();
        }else{
            $followers = SellerFollower::where('buyer_id', $id)->get()->pluck('seller_id');
            $status = DB::table('products')
                ->join('users', 'products.product_seller_id', '=', 'users.id')
                ->join('sellers', 'users.id', '=', 'sellers.seller_user_id')
                ->select(DB::raw('products.product_name, products.id, products.product_seller_id, products.product_image, sellers.seller_store_name, users.user_image_url'))
                ->whereIn('products.product_seller_id', $followers)
                ->whereRaw("DATEDIFF(now(), products.created_at) = 1 OR DATEDIFF(now(), products.created_at) = 0 AND products.product_deleted = 0")
                ->get();
        }
        return response()->json( $status, 200);
    }
}
