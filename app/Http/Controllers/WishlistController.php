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

class WishlistController extends Controller
{
    //
    public function index()
    {
        $user_id = Auth::id();
        $order = OrderItem::where("order_item_seller_id", $user_id)->get();
        $results = DB::select( DB::raw("SELECT a.*, b.* FROM products a JOIN order_items b ON a.id = b.product_id WHERE order_item_seller_id = $user_id"));
        // dd($results);

        return view('wishlist.index', ['users' => $results]);
    }

    public function create()
    {
        return view('wishlist.create');
    }

   
}
