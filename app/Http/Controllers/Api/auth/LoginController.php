<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Validate;
use Auth;

class LoginController extends Controller
{
    use Validate;
    public function login(Request $request)
    {
        $rules = array(
            'email' => 'required|string|email',
            'password' => 'required|string',
        );
        
        $this->validator($rules,  $request);
        $credentials = request(['email', 'password']);//validating the inputed email and password field
        if(!Auth::attempt($credentials)){
            return response()->json(['message' => 'User Not available in database'], 401);
          }else {
            $user = Auth::user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();
        
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer', 
                'user_data' => $user,
                'message' => 'authorized'
            ], 200);
    }
    }
}
