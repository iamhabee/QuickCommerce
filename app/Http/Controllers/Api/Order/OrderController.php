<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\Validate;

class OrderController extends Controller
{
    use Validate;
    // fetch all Order for admin
    public function index(){
        $id = Auth::id();
        $order = Order::where("order_buyer_id", $id)->get();
        return response()->json($order, 200);
    }

    public function store(Request $request){
        $order_code = "QCO".Str::random(6);
        $id = Auth::id();
        $order = new Order([
            "order_code" => $order_code,
            "order_total_amount" => $request->total_amount,
            "order_amount" => $request->amount,
            "order_shipping_fee" => $request->shipping_fee,
            "order_buyer_id" => $id,
            "order_promo_code" => $request->promo_code,
            "order_discount"=>$request->discount,
            "order_payment_method" => $request->payment_method,
            "order_paid" => $request->paid,
            "order_address" => $request->address,
            "order_phone" => $request->phone,
        ]);
        if($order->save()){
            $objects = json_decode($request->getContent(), true);
            foreach($objects as $key => $obj){
                $order_item = new OrderItem([
                    "order_item_order_id" =>$order->id,
                    "order_item_product_id"=>$obj["product_id"],
                    "order_item_seller_id"=>$obj["seller_id"],
                    "order_item_buyer_id"=>$id,
                    "order_item_order_price"=>$obj["price"]
                ]);
                $order_item->save();
            }
            return response()->json([
                'message' =>"Order added successfully"
                ], 200);
        }else{
            return response()->json([
                'message' =>"Product added to store successfully"
                ], 200);
        }
    }
}
