<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function blog(){
        $categoryPosts = CategoryPost::all();
        $posts = Post::all();

        return view('frontend.blog', compact('categoryPosts', 'posts'));
    }

    public function blogDetail($slug) {
        $categoryPosts = CategoryPost::all();
        $post = Post::where('slug', $slug)->first();
        
        return view('frontend.blogDetail', compact('post', 'categoryPosts'));
    }
}
