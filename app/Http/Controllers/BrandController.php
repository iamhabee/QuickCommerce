<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Str;
use App\Traits\Validate;
    
use App\Brand;

class BrandController extends Controller
{
    use Validate;
    //
    public function index()
    {
        $user_id = Auth::id();
        $brands = Brand::where("brand_seller_id", $user_id)->get();
        // $blogs = DB::select( DB::raw("SELECT a.*, b.* FROM blogs a JOIN blog_images b ON a.id = b.blog_id WHERE blog_seller_id = $user_id"));
        // dd($blogs);

        return view('brand.index', ['brands' => $brands]);
    }

    public function create()
    {
        return view('brand.create');
    }

    public function edit($id)
    {
        return view('brand.edit');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $seller = $this->admin_checker();
        if($seller){
            $brand_code = "QCP".Str::random(6);
            $brand = new Brand([
                'brand_name' =>$request->brand_name,
                'brand_code' =>$brand_code,
                'brand_seller_id' =>$user->id,
                ]);
            if($brand->save()){
                return redirect()->route('brand.index')->withStatus(__(' brand added successfully.'));
            }else{
                return redirect()->route('brand.index')->withStatus(__(' Brand failed to add.'));
            }
        }else{
            return redirect()->route('brand.index')->withStatus(__('You are not a eligible to add a new product.'));
        }
    }
}
