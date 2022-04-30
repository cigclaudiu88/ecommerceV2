<?php

namespace App\Http\Controllers\Frontend;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Models\BlogPostCategory;
use App\Http\Controllers\Controller;

class HomeBlogController extends Controller
{

    public function AddBlogPost()
    {
        // $blogcategory preia toate categoriile din tabelul blog_post_categories
        $blogcategory = BlogPostCategory::latest()->get();
        // $blogpost preia toate posturile din tabelul blog_post
        $blogpost = BlogPost::with('category')->latest()->get();
        return view('frontend.blog.blog_list', compact('blogpost', 'blogcategory'));
    }
}