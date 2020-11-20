<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderItem;
use App\Product;
use Illuminate\Support\Facades\Hash;
use App\Seller;
use App\ProductImage;
use Auth;
use DB;
use Illuminate\Support\Str;
class OrderController extends Controller
{
    //
    public function index()
    {
        $user_id = Auth::id();
        $order = OrderItem::where("order_item_seller_id", $user_id)->get();
        $results = DB::select( DB::raw("SELECT a.*, b.* FROM order_items a JOIN products b ON a.product_id = b.id WHERE order_item_seller_id = $user_id"));
        // dd($results);

        return view('order.index', ['users' => $results]);
    }

    public function create()
    {
        // $product_code = "QCP".Str::random(6);
        return view('order.create');
    }

   
}
