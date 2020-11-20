<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Seller;
use DB;
use Auth;
class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user_id = Auth::id();
        // $customers = DB::select( DB::raw("SELECT a.user_first_name, a.user_last_name, a.user_image_url, b.*, c.product_name, c.product_description FROM users a JOIN order_items b ON a.id = b.order_item_buyer_id JOIN products c ON c.id = b.product_id WHERE order_item_seller_id = $user_id LIMIT 5 "));
        $followers = DB::table('seller_followers')
        ->join('users', 'seller_followers.buyer_id', '=', 'users.id')
        ->select('seller_followers.*', 'users.user_first_name', 'users.user_last_name', 'users.email', 'users.user_image_url',)
        ->where('seller_followers.seller_id', $user_id)
        ->get();
        // dd($customers);
        return view('profile.edit', ['customers' => $followers]);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }

    public function update_category(Request $request){
        $id = Auth::id();
        $categories = collect($request->seller_categories)->implode(',');
        $profile = Seller::where('seller_user_id', $id)->first();
        $profile->seller_categories = $categories;
        $profile->save();
        // auth()->user()->update(['seller_category' => $categories]);
        return back()->withStatus(__('Category successfully updated.'));
    }

    public function update_picture(Request $request){
        $user = Auth::user();
        $name = "";
        if($request->hasfile('images'))
        {
            $id = Str::random(6);
            $file = $request->file('images');
            // $pathname = URL::to('/'). 'products/'.$product->id.'/'.$product_code. $id. time().'.'.$file->getClientOriginalExtension();
            $name = $id.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/profiles/', $name); 
        }
        $profile = User::find($user->id);
        $profile->user_image_url = $name;
        $profile->save();
        // auth()->user()->update(['user_image_url' => $name]);
        return back()->withStatus(__('Profile picture uploaded successfully.'));
    }
}
