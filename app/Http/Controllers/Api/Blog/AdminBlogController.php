<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Blog;
use App\Seller;
use App\Traits\Validate;

class AdminBlogController extends Controller
{
    use Validate;

    // fetch all Blog for admin
    public function index(){
        $user = Auth::user();
        $blog = Blog::where("blog_seller_id", $user->id);
        return response()->json( $blog, 200);
    }

    // add new blog post
    public function store(Request $request){
        $seller = $this->admin_checker();
        $id = Auth::id();
        if($seller){
            $blog = new Blog([
                'blog_seller_id' =>$id,
                'title' =>$request->title,
                'description' =>$request->description
                ]);
            if($blog->save()){
                return response()->json([
                    'message' =>"Blog added successfully"
                    ], 200);
            }else{
                return response()->json([
                    'message' =>"Blog failed to add"
                    ], 200);
            }
        }else{
            return response()->json([
                'message' =>"No access"
                ], 200);
        }
    }
    
    // Edit single blog
    public function edit(Request $request, $id){
        $seller_id = Auth::id();
        $seller = $this->admin_checker();
        if($seller){
            $blog = Blog::where("id", $id)->where("blog_seller_id", $seller_id)->first();
            $blog->title = $request->get('title');
            $blog->description = $request->get('description');
            if($blog->save()){
                return response()->json([
                    'message' => 'Blog Updated successfully',
                ], 401);
            }else{
                return response()->json([
                    'message' => 'Blog update failed',
                ], 401);
            }
        }else{
            return response()->json([
                'message' => 'user not allowed',
            ], 401);
        }
    }

    // delete blog
    public function delete($id){
        
    }
}
