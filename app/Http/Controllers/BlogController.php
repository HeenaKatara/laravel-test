<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Auth;

class BlogController extends Controller
{
	
     public function index()
    {
    	$user_id = Auth::id();
    	$blogs = Blog::where('user_id',$user_id)->get();
    	
        return view('blog.index',compact('blogs'));
    }
}
