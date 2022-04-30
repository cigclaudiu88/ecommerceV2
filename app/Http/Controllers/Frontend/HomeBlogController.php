<?php

namespace App\Http\Controllers\Frontend;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Models\BlogPostCategory;
use App\Http\Controllers\Controller;

class HomeBlogController extends Controller
{
    // functia de afisare pagina cu postari din blog pentru pagina principala
    public function AddBlogPost()
    {
        // $blogcategory preia toate categoriile din tabelul blog_post_categories
        $blogcategory = BlogPostCategory::latest()->get();
        // $blogpost preia toate posturile din tabelul blog_post
        $blogpost = BlogPost::with('category')->latest()->get();
        return view('frontend.blog.blog_list', compact('blogpost', 'blogcategory'));
    }
    // functia de afisare pagina cu postarea unui post din blog
    public function DetailsBlogPost($id)
    {
        // $blogcategory preia toate categoriile din tabelul blog_post_categories
        $blogcategory = BlogPostCategory::latest()->get();
        // $blogpost preia postarea din blog_posts care are id-ul = $id primit ca parametru
        $blogpost = BlogPost::findOrFail($id);
        return view('frontend.blog.blog_post_details', compact('blogpost', 'blogcategory'));
    }
    // functie pt filtrare postari blog dupa categorie in frontend
    public function HomeBlogCatPost($category_id)
    {
        // $blogcategory preia toate categoriile din tabelul blog_post_categories
        $blogcategory = BlogPostCategory::latest()->get();
        // $blogpost preia toate posturile din tabelul blog_post care au category_id-ul = $category_id primit ca parametru
        $blogpost = BlogPost::with('category')->where('category_id', $category_id)->orderBy('id', 'DESC')->get();
        // return pagina cu postari din blog pentru categoria selectata
        return view('frontend.blog.blog_cat_list', compact('blogpost', 'blogcategory'));
    }
}