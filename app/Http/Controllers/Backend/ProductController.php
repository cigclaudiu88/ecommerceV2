<?php

namespace App\Http\Controllers\Backend;

// adaugat namespace pentru a putea folosi clasa (modelele) Brand si Category
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    // functia de afisare a tuturor produselor
    public function AddProduct()
    {
        // $brands preiau toate brandurile din tabela brands
        $brands = Brand::latest()->get();
        // $categories preiau toate categoriile din tabela categories
        $categories = Category::latest()->get();
        // returnam pagina de adaugare a unui produs cu datele din tabelele brands si categories
        return view('backend.product.product_add', compact('brands', 'categories'));
    }
}