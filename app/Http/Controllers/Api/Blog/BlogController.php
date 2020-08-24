<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Blog;

class BlogController extends Controller
{
    // fetch all Blog for users
    public function index(){
        $blog = Blog::all();
        return response()->json( $blog, 200);
    }
    
    // show single blog
    public function show($id){
        $details = Blog::find($id);
        return response()->json( $details, 200);
    }
}
