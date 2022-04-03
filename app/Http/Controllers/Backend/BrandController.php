<?php

namespace App\Http\Controllers\Backend;

// adaugam modelul Brand
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function BrandView()
    {
        // $brand preia ultimele date din tabelul brands folosind modelul Brand cu functia get()
        $brands = Brand::latest()->get();
        // returns this view resources\views\backend\brand\brand_view.blade.php with $brands data
        return view('backend.brand.brand_view', compact('brands'));
    }
}
