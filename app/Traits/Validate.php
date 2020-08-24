<?php

namespace App\Traits;
use Auth;
use Illuminate\Support\Facades\Validator;

trait Validate {
    public function validator($rules, $request){
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                  'message' => 'All fields are required'
                ]);
        }
    }

    // check seller admin
    public function admin_checker(){
        $id = Auth::id();
        $seller = Seller::where("seller_user_id", $id)->first();
        return $seller;
    }
}