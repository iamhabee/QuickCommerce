<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Brand;
use App\Seller;
use App\Traits\Validate;

class AdminProductController extends Controller
{
    use Validate;
    
    // show all admin product
    public function index(){
        $id = Auth::id();
        $product = Product::where("product_seller_id", $id);
        return response()->json( $product, 200);
    }
    
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $seller = $this->admin_checker();
        if($seller){
            $product_code = "QCP".Str::random(6);
            $date = date("Y-m-d H:i:s");
            $product = new Product([
                'product_name' =>$request->product_name,
                'product_code' =>$product_code,
                'product_category_id' =>$request->product_category_id,
                'product_seller_id' =>$user->id,
                'product_description' =>$request->product_description,
                'product_tag' =>$request->product_tag,
                'product_quantity' =>$request->product_quantity,
                'product_color' =>$request->product_color,
                'product_price' =>$request->product_price,
                'product_discount_price' =>$request->product_discount_price,
                'product_category' =>$request->product_category,
                'product_size_category' =>$request->product_size_category,
                'product_bulk_price' =>$request->product_bulk_price,
                'product_brand_id' =>$request->product_brand_id,
                ]);
            
            if($product->save()){
                if($request->hasfile('images'))
                {
                    
                    foreach($request->file('images') as $file)
                    {
                        $id = Str::random(6);
                        $name = $product_code. $id. time().'.'.$file->getClientOriginalExtension();
                        $file->move(public_path().'/products/'.$user->id. '/', $name); 
                        $product_image = new ProductImage;
                        $product_image->image = $name;
                        $product_image->product_id = $product->id;
                        $product_image->save();
                    }
                }
                return response()->json([
                'message' =>"Product added to store successfully"
                ], 200);
            }else{
                return response()->json([
                    'message' =>"Product failed to add"
                ], 200);
            }
        }else{
            return response()->json([
                'message' =>"User not allowed"
            ], 200);
        }
        
    }
}
