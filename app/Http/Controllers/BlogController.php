<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    //
    public function index()
    {
        $user_id = Auth::id();
        // $results = Blog::where("blog_seller_id", $user_id);
        $blogs = DB::select( DB::raw("SELECT a.*, b.* FROM blogs a JOIN blog_images b ON a.id = b.blog_id WHERE blog_seller_id = $user_id"));
        // dd($blogs);

        return view('blog.index', ['blogs' => $blogs]);
    }

    public function create()
    {
        $product_code = "QCP".Str::random(6);
        return view('blog.create', ['product_code'=>$product_code]);
    }

    public function edit($id)
    {
        return view('blog.edit');
    }
}
