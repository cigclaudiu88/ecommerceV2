<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;

class SubSubCategoryController extends Controller
{

    public function SubSubCategoryView()
    {
        // $categories salveaza toate datele din tabela categories si le ordoneaza crescator dupa category_name folosind functia orderBy si modelul Category
        $categories = Category::orderBy('category_name', 'ASC')->get();
        // $subsubcategories gets all latest data from SubSubCategory Model
        // $subsubcategories salveaza toate datele din tabela sub_subcategories folosind functia get() si modelul SubSubCategory
        $subsubcategories = SubSubCategory::latest()->get();
        // returnam datele din $categories si $subsubcategories catre view-ul resources\views\backend\category\sub_subcategory_view.blade.php
        return view('backend.category.sub_subcategory_view', compact('subsubcategories', 'categories'));
    }
}