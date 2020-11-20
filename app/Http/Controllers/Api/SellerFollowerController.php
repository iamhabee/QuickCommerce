<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SellerFollower;
use DB;
use Auth;

class SellerFollowerController extends Controller
{
    public function index(){
        $uid = Auth::id();
        $following = DB::table('seller_followers')
                ->join('users', 'seller_followers.seller_id', '=', 'users.id')
                ->select('seller_followers.*', 'users.user_first_name', 'users.user_last_name', 'users.email')
                ->where('seller_followers.buyer_id', $uid)
                ->get();
        return response()->json($following);
    }

    public function followOrUnfollow(Request $request){
        $following = SellerFollower::where('seller_id', $request->seller_id)->where('buyer_id', $request->buyer_id)->first();
        if($following){
            // unfollow
            if($following->delete()){
                return response()->json(['success'=>true, 'message'=> 'You unfollow '. $request->seller_name]);
            }else{
                return response()->json(['success'=>false, 'message'=> 'unfollow not successful']);
            }
        }else{
            // follow
            $follow = new SellerFollower([
                'buyer_id'=>$request->buyer_id,
                'seller_id'=>$request->seller_id,
            ]);
            if($follow->save()){
                return response()->json(['success'=>true, 'message'=> 'You started following '. $request->seller_name]);
            }else{
                return response()->json(['success'=>false, 'message'=> 'following not successful']);
            }
        }
        
    }
}
