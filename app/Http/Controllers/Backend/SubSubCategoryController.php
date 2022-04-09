<?php

namespace App\Http\Controllers\Backend;


use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;

class SubSubCategoryController extends Controller
{
    // functia de vizualizare a subsubcategoriilor
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

    // functia care aduce subcategoria aferenta categoriei selectate in formularul de adaugare a subsubcategoriei
    public function GetSubCategory($category_id)
    {
        // $subcat uses SubCategory model and matches the $category_id from category form input with a category_id from DB
        // $subcat salveaza toate datele din tabela sub_categories, care au category_id egal cu $category_id primit ca parametru din formularul de adaugare subsubcategoriei
        //  si le ordoneaza crescator dupa subcategory_name folosind functia orderBy si modelul SubCategory
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        // returnam datele din $subcat catre view-ul resources\views\backend\category\sub_subcategory_view.blade.php encodate in json
        return json_encode($subcat);
    }
}