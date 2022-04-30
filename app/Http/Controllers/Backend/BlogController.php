<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\BlogPostCategory;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    // functia pentru afisare pagina de categorii blog
    public function BlogCategory()
    {
        // $blogcategory pretine toate categoriile din tabelul blog_post_categories
        $blogcategory = BlogPostCategory::latest()->get();
        // returnam view-ul blogcategory.blade.php si trimitem ca parametru $blogcategory
        return view('backend.blog.category.category_view', compact('blogcategory'));
    }
}