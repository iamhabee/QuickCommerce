<?php

namespace App\Http\Controllers\Api\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Brand;

class BrandController extends Controller
{
    // fetch all Brand for users
    public function index(){
        $brand = Brand::all();
        return response()->json( $blog, 200);
    }
    
    // show single Brand
    public function show($id){
        $details = Brand::find($id);
        return response()->json( $details, 200);
    }
}
