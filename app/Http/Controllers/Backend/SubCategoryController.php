<?php

namespace App\Http\Controllers\Backend;

// adaugat namespace pentru a putea folosi clasa CategoryController si SubCategoryController
use App\Models\Category;
use App\Models\SubCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    // functia de vizualizare a subcategorii
    public function SubCategoryView()
    {
        // $categories preia datele din tabelul categories folosind modelul Category si functia get() si le ordoneaza ascendent dupa id
        $categories = Category::orderBy('id', 'ASC')->get();
        // $subcategories preia ultimele date din tabelul subcategories folosind modelul SubCategory si functia get() 
        $subcategories = SubCategory::latest()->get();
        // returnam pagina subcategory_view cu datele din $categories si $subcategories 
        return view('backend.category.subcategory_view', compact('subcategories', 'categories'));
    }
}