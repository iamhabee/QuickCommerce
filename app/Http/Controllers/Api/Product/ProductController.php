<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Seller;
use App\ProductImage;
use App\Variant;
use App\Cart;
use Auth;
use Illuminate\Support\Str;
use App\Traits\Validate;
use DB;

class ProductController extends Controller
{
    use Validate;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //   $product = DB::select( DB::raw("SELECT a.*, b.* FROM products a JOIN product_images b ON a.id = b.product_id WHERE product_seller_id = $user_id"));
      $product = DB::table('products')
      ->join('product_images', 'products.id', '=', 'product_images.product_id')
      ->join('users', 'products.product_seller_id', '=', 'users.id')
      ->select('products.product_name', 'products.id', 'product_images.image', 'users.user_first_name', 'users.user_last_name')
      ->where('product_status !=', 'DELETED')
      ->get();
        // $product = Product::all();
        return response()->json( $product, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function single_product($id)
    {
        $details = DB::table('products')
        ->join('users', 'products.product_seller_id', '=', 'users.id')
        ->select('products.*', 'users.user_first_name', 'users.user_last_name', 'users.user_image_url')
        ->where('products.id', $id)
        ->first();
        $by_tag = DB::table('products')
        ->select('id', 'product_image', 'product_name', 'product_price')
        ->where('product_tag', 'like', '%'.$details->product_tag.'%')
        ->get();
        
        $by_seller = DB::table('products')
        ->select('id', 'product_image', 'product_name', 'product_price')
        ->where('product_seller_id', $details->product_seller_id)->get();
        
        $by_brand = DB::table('products')
        ->select('id', 'product_image', 'product_name', 'product_price')
        ->where('product_brand_id', 'like', '%'.$details->product_brand_id.'%')->get();

        $related = [$by_brand, $by_seller, $by_tag];

        $variants = Variant::where('variant_product_id', $details->id)->get();
        return response()->json( ['product_details'=>$details, 'variants'=>$variants, 'related'=>$related], 200);
    }


    public function latest_product()
    {
        $product = DB::table('products')
        ->select('products.*')
        ->whereRaw("DATEDIFF(now(), products.created_at) <= 5 AND DATEDIFF(now(), products.created_at) >= 0 AND product_deleted = 0")
        ->get();
        // $product = Product::all();
        return response()->json( $product, 200);
    }

    public function addToCart(Request $request){
        $product_id = $request->product_id;
        $product_name = $request->product_name;
        $quantity = $request->quantity;
        $price = $request->price;
        $image = $request->product_image;
        $id = Auth::id();
        $cart = Cart::where('product_id', $product_id)->first();
        if(empty($cart)){
            $addcart = new Cart([
                'product_id' => $product_id,
                'buyer_id'=> $id,
                'product_quantity'=>$quantity,
                'price'=>$price,
                'image_url'=>$image,
                'product_name'=>$product_name,
            ]);
            $cart->save();
        }else{
            $cart->quantity = $quantity;
            $cart->save();
        }
        return response()->json( $cart, 200);
    }

    public function getAddToCart(Request $request){
        $id = Auth::id();
        $cart = Cart::where('buyer_id', $id)->get();
        return response()->json( $cart, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
