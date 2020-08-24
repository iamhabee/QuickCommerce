<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // fetch all Order items for admin
    public function index(){
        $id = Auth::id();
        $order_item = OrderItem::where("order_item_seller_id", $id)->get();
        return response()->json($order_item, 200);
    }

    public function process_order(Request $request, $id){
        $seller = $this->admin_checker();
        if($seller){
            $order_item = OrderItem::find($id);
            $order_item->order_item_status = $request->status;
            $order_item-save();
            return response()->json([
                'message' => 'Order status updated',
            ], 200);
        }else{
            return response()->json([
                'message' => 'access denied',
            ], 201);
        }
    }
}
