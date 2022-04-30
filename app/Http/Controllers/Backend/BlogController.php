<?php

namespace App\Http\Controllers\Backend;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
    // functia de adaugare categorie postare blog
    public function BlogCategoryStore(Request $request)
    {
        // validare categorii postari blog
        $request->validate([
            'blog_category_name' => 'required|min:5',
        ], [
            'blog_category_name.required' => 'Categorie postare blog este obligatorie',
            'blog_category_name.min' => 'Categorie postare blog trebuie sa contina minim 5 caractere',
        ]);
        // inseram in tabelul blog_post_categories categoria postarii blog
        BlogPostCategory::insert([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-', $request->blog_category_name)),
            'created_at' => Carbon::now(),
        ]);
        // notificare pentru inserare cu succes 
        $notification = array(
            'message' => 'Categorie postare blog adaugata cu succes!',
            'alert-type' => 'success'
        );
        // returnam view-ul blogcategory.blade.php cu notificare
        return redirect()->back()->with($notification);
    }
    // functie pentru editare categorie postare blog
    public function BlogCategoryEdit($id)
    {
        // $blogcategory preia categoria postarii blog cu id-ul $id primit ca parametru
        $blogcategory = BlogPostCategory::findOrFail($id);
        // returnam pagina blogcategory_edit.blade.php si trimitem ca parametru $blogcategory
        return view('backend.blog.category.category_edit', compact('blogcategory'));
    }
    // functie pentru actualizarea categoriei punei postari  blog
    public function BlogCategoryUpdate(Request $request, $id)
    {
        // validare categorii postari blog
        $request->validate([
            'blog_category_name' => 'required|min:5',
        ], [
            'blog_category_name.required' => 'Categorie postare blog este obligatorie',
            'blog_category_name.min' => 'Categorie postare blog trebuie sa contina minim 5 caractere',
        ]);

        // cautam in tabelul blog_post_categories categoria postarii blog cu id-ul $blogcat_id si actualizam cu datele din formular
        BlogPostCategory::findOrFail($id)->update([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-', $request->blog_category_name)),
            'created_at' => Carbon::now(),
        ]);
        // notificare pentru actualizare cu succes
        $notification = array(
            'message' => 'Categorie postare blog actualizata cu succes!',
            'alert-type' => 'info'
        );
        // returnam view-ul blogcategory.blade.php cu notificare
        return redirect()->route('blog.category')->with($notification);
    }
    // functie pentru stergere categorie postare blog
    public function BlogCategoryDelete($id)
    {
        // cautam in tabelul blog_post_categories categoria postarii blog cu id-ul = $id si stergem
        BlogPostCategory::findorFail($id)->delete();

        // Adaugat notificare Toastr
        $notification = array(
            'message' => 'Categorie postare blog stearsa cu succes!',
            'alert-type' => 'info'
        );
        // redirect spre ruta all.branduri (vizualizare branduri) cu mesajul de succes
        return redirect()->route('blog.category')->with($notification);
    }
    // functia de afisare postari blog
    public function ViewBlogPost()
    {
        // $blogpost preia toate categoriile de postari din tabelul blog_post_categories
        $blogcategory = BlogPostCategory::latest()->get();
        // $blogpost preia toate postarile din tabelul blog_post
        $blogpost = BlogPost::latest()->get();
        // returnam pagina blogpost.blade.php si trimitem ca parametrii $blogpost si $blogcategory
        return view('backend.blog.post.post_view', compact('blogpost', 'blogcategory'));
    }
}