<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Seller;
use App\Traits\Validate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use Validate;

    public function register(Request $request)
     {
        $rules = array(
            "user_first_name"=> 'required|string',
            "user_last_name"=> 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'seller_store_name' => 'required|string|unique:sellers',
            'password' => 'required|string|min:8|confirmed',
        );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                  'message' => 'Validation Error'
                ]);
        }
        $date = date("Y-m-d H:i:s");
        $user = new User([
        'user_first_name'=> $request->first_name,
        'user_last_name'=> $request->last_name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'user_created_at' => $date,
        'user_token' => Str::random(6),
        'user_code' => "QCU".Str::random(6)
        ]);
            if($user->save()){
                if($this->checkUser($request, $date)){
                    return response()->json([
                        'message' => 'User Registration Successful'
                    ], 400);
                }else{
                    return response()->json([
                        'message' =>"Seller Registration failed"
                    ], 200);
                }
                
            }else{
                return response()->json([
                    'message' =>"User Registration failed"
                ], 200);
            }
        
        }
    
    public function checkUser($user, $date){
        switch($user->acct_type){
            case "Seller":
               return $this->createSeller($user, $date);
            case "Buyer":
                return ;
        }
    }

    public function createSeller($user, $date){
        $seller = new Seller([
            'seller_bank_name'=> $user->bank_name,
            'seller_account_number'=> $user->account_number,
            'seller_account_name' => $user->account_name,
            'seller_store_name' => $user->store_name,
            'seller_created_at' => $date,
            ]);
            if($seller->save()){
                return true;
            }else{
                return false;
            }
    }
}