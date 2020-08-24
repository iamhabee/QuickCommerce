<?php

namespace App\Http\Controllers\Api\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Brand;
use App\Seller;
use App\Traits\Validate;

class AdminBrandController extends Controller
{
    use Validate;
    
    // fetch all Brand for admin
    public function index(){
        $user = Auth::user();
        $brand = Brand::where("brand_seller_id", $user->id);
        return response()->json( $brand, 200);
    }

    // add new brand
    public function store(Request $request){
        $seller = $this->admin_checker();
        $id = Auth::id();
        $brand_code = "QCB".Str::random(6);
        if($seller){
            $brand = new Brand([
                'brand_seller_id' =>$id,
                'brand_name' =>$request->brand_name,
                'brand_code' =>$brand_code
                ]);
            if($brand->save()){
                return response()->json([
                    'message' =>"Brand added successfully"
                    ], 200);
            }else{
                return response()->json([
                    'message' =>"Brand failed to add"
                    ], 400);
            }
        }else{
            return response()->json([
                'message' =>"No access"
                ], 201);
        }
    }
    
    // Edit single brand
    public function edit(Request $request, $id){
        $seller_id = Auth::id();
        $seller = $this->admin_checker();
        if($seller){
            $brand = Brand::where("id", $id)->where("brand_seller_id", $seller_id)->first();
            $brand->brand_name = $request->get('brand_name');
            $brand->brand_code = $request->get('brand_code');
            if($brand->save()){
                return response()->json([
                    'message' => 'Brand Updated successfully',
                ], 401);
            }else{
                return response()->json([
                    'message' => 'Brand update failed',
                ], 401);
            }
        }else{
            return response()->json([
                'message' => 'user not allowed',
            ], 401);
        }
    }
}
