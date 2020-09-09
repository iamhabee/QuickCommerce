<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Seller;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\Registeration;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'first_name' => ['required', 'string', 'max:255'],
            // 'last_name' => ['required', 'string', 'max:255'],
            // 'store_name' => ['required', 'string'],
            // 'bank_name' => ['required', 'string'],
            // 'account_name' => ['required', 'string'],
            // 'account_number' => ['required'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $date = date("Y-m-d H:i:s");
        $user = User::create([
                'user_first_name' => $data['first_name'],
                'user_last_name' => $data['last_name'],
                'email' => $data['email'],
                'user_created_at' => $date,
                'user_token' => Str::random(6),
                'user_code' => "QCU".Str::random(6),
                'password' => Hash::make($data['password']),
            ]);
        if($user){
            $seller = new Seller([
            'seller_user_id'=> $user->id,
            'seller_bank_name'=> $data['bank_name'],
            'seller_account_number'=> $data['account_number'],
            'seller_account_name' => $data['account_name'],
            'seller_store_name' => $data['store_name'],
            'seller_created_at' => $date,
            ]);
            $seller->save();
            Mail::to($data['email'])
            ->send(new Registeration());
        }
        
        return $user;
    }
}
