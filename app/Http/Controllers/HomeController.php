<?php

namespace App\Http\Controllers;
use Auth;
use App\Product;
use App\OrderItem;
use App\Sale;
use App\Buyer;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user_id = Auth::id();
        $product = DB::table('products')
        ->select('products.*')
        ->whereRaw("product_seller_id= $user_id AND product_deleted = 0")->get()->count();
        $order = OrderItem::where("order_item_seller_id", $user_id)->get()->count();
        $sales = OrderItem::where("order_item_seller_id", $user_id)->where("order_item_status", "DELIVERED" )->get()->sum('order_item_order_price');
        // $customers = OrderItem::where("order_item_seller_id", $user_id)->where("order_item_status", "DELIVERED" )->distinct()->get()->count();
        $followers = DB::table('seller_followers')
                ->join('users', 'seller_followers.buyer_id', '=', 'users.id')
                ->select('seller_followers.*', 'users.user_first_name', 'users.user_last_name', 'users.email')
                ->where('seller_followers.seller_id', $user_id)
                ->get()->count();
        // $customers = DB::table('order_items')
        //     ->select(DB::raw('count(*) as order_item_buyer_id'))
        //     ->where("order_item_seller_id", $user_id)->where("order_item_status", "DELIVERED" )
        //     ->groupBy('order_item_buyer_id')
        //     ->get()->count();
        $data = array("product" => $product, "order"=>$order, "sale"=>$sales, "customer"=>$followers);
       
        return view('pages.dashboard', ["product" => $product, "order"=>$order, "sale"=>$sales, "customer"=>$followers]);
    }
}
