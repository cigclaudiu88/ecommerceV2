<?php

namespace App\Http\Controllers\Backend;

// adaugat namespace pentru a putea folosi clasa CategoryController
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // functia de vizualizate categorii de produse 
    public function CategoryView()
    {
        // $categories preia ultimele datele din tabelul categories folosind modelul Category si functia get()
        $categories = Category::latest()->get();
        // returnam pagina category_view cu datele din $categories
        return view('backend.category.category_view', compact('categories'));
    }
}