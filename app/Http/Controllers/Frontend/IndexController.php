<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        // returnam pagina principala a aplicatiei resources\views\frontend\index.blade.php
        return view('frontend.index');
    }
}