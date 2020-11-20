<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Hash;
use App\Seller;
use App\ProductImage;
use App\Brand;
use App\Variant;
use Auth;
use DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Traits\Validate;
class ProductController extends Controller
{
    use Validate;
    //
    public function index()
    {
        $user_id = Auth::id();
        $product = DB::table('products')
        ->select('products.*')
        ->whereRaw("product_seller_id= $user_id AND product_deleted = 0")->get();
        return view('product.index', ['users' => $product]);
    }

    public function create()
    {
        $user_id = Auth::id();
        $seller = Seller::where("seller_user_id", $user_id)->first();
        $category = explode(',', $seller->seller_categories);
        $brand = Brand::where("brand_seller_id", $user_id)->get();
        return view('product.create', ['brand'=> $brand, 'category'=>$category]);
    }

    public function edit($id){
        $data = Product::find($id);
        return view('product.edit', ['data'=>$data]);
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->product_status = 'DELETED';
        $product->product_deleted = 1;
        $product->save();
        return back()->withStatus(__('Product deleted successfully.'));

    }

    public function create_variant()
    {
        $id = Auth::id();
        $variant = Variant::where('variant_seller_id', $id)->get();
        return view('product.variant', ['variant'=>$variant]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $seller = $this->admin_checker();
        if($seller){
            $product_code = "QCP".Str::random(6);
            $date = date("Y-m-d H:i:s");
            $color = collect($request->product_color)->implode(',');
            $tags = collect($request->product_tag)->implode(',');
            $product_size = collect($request->product_size)->implode(',');
            
            $img =array();
            if($request->hasfile('images')){
                foreach($request->file('images') as $file)
                {
                    $id = Str::random(6);
                    // $pathname = URL::to('/'). 'products/'.$product->id.'/'.$product_code. $id. time().'.'.$file->getClientOriginalExtension();
                    $name = $product_code. $id. time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/products/'.$user->id. '/', $name); 
                    array_push($img, $name);
                }
            }
            $image = (collect($img)->implode(","));
            $product = new Product([
                'product_name' =>$request->product_name,
                'product_code' =>$product_code,
                'product_seller_id' =>$user->id,
                'product_description' =>$request->product_description,
                'product_tag' =>$tags,
                'product_quantity' =>$request->product_quantity,
                'product_color' =>$color,
                'product_price' =>$request->product_price,
                'product_discount_price' =>$request->product_discount_price,
                'product_category' =>$request->product_category,
                'product_size' =>$product_size,
                'product_bulk_price' =>$request->product_bulk_price,
                'product_brand_id' =>$request->product_brand_id,
                'product_image'=>$image,
            ]);
            if($product->save()){
                return redirect()->route('product.index')->withStatus(__(' Product added successfully.'));
            }else{
                return redirect()->route('product.index')->withStatus(__(' Product failed to add.'));
            }
            }else{
                return redirect()->route('product.index')->withStatus(__('You are not a eligible to add a new product.'));
            }
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $seller = $this->admin_checker();
        if($seller){
            $product = Product::find($id);
            $product_code = "QCP".Str::random(6);
            $date = date("Y-m-d H:i:s");
            $color = collect($request->product_color)->implode(',');
            $tags = collect($request->product_tag)->implode(',');
            $product_size = collect($request->product_size)->implode(',');
            
            $img =array();
            if($request->hasfile('images')){
                foreach($request->file('images') as $file)
                {
                    $id = Str::random(6);
                    // $pathname = URL::to('/'). 'products/'.$product->id.'/'.$product_code. $id. time().'.'.$file->getClientOriginalExtension();
                    $name = $product_code. $id. time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/products/'.$user->id. '/', $name); 
                    array_push($img, $name);
                }
                $product->product_image = collect($img)->implode(",");
            }
            $product->product_name = $request->product_name;
            $product->product_description = $request->product_description;
            $product->product_tag = $tags;
            $product->product_color = $color;
            $product->product_price = $request->product_price;
            $product->product_discount_price = $request->product_discount_price;
            $product->product_size = $product_size;
            $product->product_bulk_price = $request->product_bulk_price;
            $product->product_brand_id = $request->product_brand_id;

            if($product->save()){
                return redirect()->route('product.index')->withStatus(__(' Product added successfully.'));
            }else{
                return redirect()->route('product.index')->withStatus(__(' Product failed to add.'));
            }
        }else{
            return redirect()->route('product.index')->withStatus(__('You are not a eligible to add a new product.'));
        }
    }

    public function add_variant(Request $request){
        $user = Auth::user();
        $seller = $this->admin_checker();
        if($seller){
            $variant_code = "QCP".Str::random(6);
            $variant_size = collect($request->variant_size)->implode(',');
            $img =array();
            
            if($request->hasfile('images')){
                foreach($request->file('images') as $file)
                {
                    $id = Str::random(6);
                    // $pathname = URL::to('/'). 'products/'.$product->id.'/'.$product_code. $id. time().'.'.$file->getClientOriginalExtension();
                    $name = $variant_code. $id. time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/variants/'.$user->id. '/', $name); 
                    array_push($img, $name);
                }
            }
            $variant = new Variant([
                'variant_size' =>$variant_size,
                'variant_colour' =>$request->variant_color,
                'variant_product_id' =>$request->variant_product_id,
                'variant_seller_id' =>$user->id,
                'variant_price' =>$request->variant_price,
                'variant_discount_price' =>$request->variant_discount_price,	
                'variant_bulk_price' =>$request->variant_bulk_price,	
                'variant_image_url' =>collect($img)->implode(",")
                ]);
            if($variant->save()){
                return redirect()->route('product.index')->withStatus(__(' Variant added successfully.'));
            }else{
                return redirect()->route('product.index')->withStatus(__(' Variant failed.'));
            }
        }else{
            return redirect()->route('product.index')->withStatus(__('You are not a eligible to add a new product.'));
        }
    }
}
