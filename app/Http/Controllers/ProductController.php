<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Hash;
use App\Seller;
use App\ProductImage;
use Auth;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    //
    public function index(Product $model)
    {
        return view('product.index', ['users' => $model->paginate(15)]);
    }

    public function create()
    {
        $product_code = "QCP".Str::random(6);
        return view('product.create', ['product_code'=>$product_code]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        // $seller = $this->admin_checker();
        // if($seller){
            dd($request->file('file'));
            $product_code = "QCP".Str::random(6);
            $date = date("Y-m-d H:i:s");
           $res = $this->addImage($request->file('file'), $product_code);
           dd($res);
            // $product = new Product([
            //     'product_name' =>$request->product_name,
            //     'product_code' =>$product_code,
            //     'product_category_id' =>$request->product_category_id,
            //     'product_seller_id' =>$user->id,
            //     'product_description' =>$request->product_description,
            //     'product_tag' =>$request->product_tag,
            //     'product_quantity' =>$request->product_quantity,
            //     'product_color' =>$request->product_color,
            //     'product_price' =>$request->product_price,
            //     'product_discount_price' =>$request->product_discount_price,
            //     'product_category' =>$request->product_category,
            //     'product_size_category' =>$request->product_size_category,
            //     'product_bulk_price' =>$request->product_bulk_price,
            //     'product_brand_id' =>$request->product_brand_id,
            //     ]);
            
            // if($product->save()){
            //     if($request->hasfile('images'))
            //     {
                    
            //         foreach($request->file('images') as $file)
            //         {
            //             $id = Str::random(6);
            //             $name = $product_code. $id. time().'.'.$file->getClientOriginalExtension();
            //             $file->move(public_path().'/products/'.$user->id. '/', $name); 
            //             $product_image = new ProductImage;
            //             $product_image->image = $name;
            //             $product_image->product_id = $product->id;
            //             $product_image->save();
            //         }
            //     }
            //     return redirect()->route('product.index')->withStatus(__(' successfully registered in your school.'));
            // }else{
            //     return redirect()->route('product.create')->withStatus(__(' successfully registered in your school.'));
            // }
    }

    public function storeImage(Request $request)
	{
		if($request->file('file')){

            $img = $request->file('file');

            //here we are geeting userid alogn with an image
            $userid = $request->userid;

            $imageName = strtotime(now()).rand(11111,99999).'.'.$img->getClientOriginalExtension();
            $user_image = new User();
            $original_name = $img->getClientOriginalName();
            $user_image->image = $imageName;

            if(!is_dir(public_path() . '/uploads/images/')){
                mkdir(public_path() . '/uploads/images/', 0777, true);
            }

        $request->file('file')->move(public_path() . '/uploads/images/', $imageName);

        // we are updating our image column with the help of user id
        $user_image->where('id', $userid)->update(['image'=>$imageName]);

        return response()->json(['status'=>"success",'imgdata'=>$original_name,'userid'=>$userid]);
        }
    }
    
    public function storeData(Request $request)
	{
		try {
			$user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $user_id = $user->id; // this give us the last inserted record id
		}
		catch (\Exception $e) {
			return response()->json(['status'=>'exception', 'msg'=>$e->getMessage()]);
		}
		return response()->json(['status'=>"success", 'user_id'=>$user_id]);
	}
    public function addImage($image, $product_code){
        $user = Auth::user();
        $products = [];
        dd($image);
        foreach($image as $file)
        {
            $id = Str::random(6);
            $name = $product_code. $id. time().'.'.$file->extension();
            $file->move(public_path().'/products/'.$user->id. '/', $name); 
            $product_image = new ProductImage;
            $product_image->image = $name;
            $product_image->product_id = $product->id;
            $product_image->save();
            $product[$name];
        }
        return $product;
    }
}
