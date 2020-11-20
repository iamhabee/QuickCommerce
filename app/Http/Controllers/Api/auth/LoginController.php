<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Traits\Validate;
use Auth;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
            return response()->json(['message' => 'User Not available in database', 'status'=>false], 401);
          }else {
            $user = Auth::user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();
            if($user){
                return response()->json([
                    'status'=> true,
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer', 
                    'user_data' => $user,
                    'message' => 'authorized'
                ], 200);
            }else{
                return response()->json([
                    'status'=>false,
                    'message' => 'unauthorized'
                ], 200);
            }   
        }
    }

    public function update_profile(ProfileRequest $request){
        $user = Auth::user();
        $profile = User::find($user->id);
        $profile->user_first_name = $request->user_first_name;
        $profile->user_last_name = $request->user_last_name;
        $profile->user_middle_name = $request->user_middle_name;
        $profile->email = $request->email;
        $profile->user_phone = $request->user_phone;
        if($profile->save()){
            return response()->json([
            'status'=>true,
            'message' => 'profile updated successfully',
            'data'=>$profile
        ], 200);
        }else{
            return response()->json(['status'=>false, 'message'=> 'profile update failed']);
        }
        
    }

    public function update_picture(Request $request){
        $user = Auth::user();
        $name = "";
        if($user){
            $profile = User::find($user->id);
            if($request->hasfile('images')){
                $id = Str::random(6);
                $file = $request->file('images');
                $name = $id.time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/profiles/', $name); 
                $profile->user_image_url = $name;
                if($profile->save()){
                    return response()->json([
                        'status'=>true,
                        'message' => 'profile updated successfully',
                        'data'=>$profile
                    ], 200);
                }else{
                    return response()->json(['status'=>false, 'message'=> 'profile update failed']);
                }
            }else{
                return response()->json(['status'=>false, 'message'=> 'No image to upload']);
            }
    
        }else{
            return response()->json(['status'=>false, 'message'=> 'You are not authorized']);
        }
    }

    public function change_password(Request $request){
        $user = Auth::user();
        if($user){
            // auth()->user()->update(['password' => Hash::make($request->get('password'))]);
            if(Hash::check($request->get('old_password'), $user->password)){
                $pass = User::find($user->id);
                $pass->password = bcrypt($request->password);
                return response()->json([ 'status'=>true, 'message' => 'password changed successfully'], 200);
            }else{
                return response()->json(['status'=>false, 'message' => 'You are not authorized']);
            }
        }else{
            return response()->json(['status'=>false, 'message' => 'You are not authorized']);
        }
    }
}
