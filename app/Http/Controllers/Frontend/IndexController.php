<?php

namespace App\Http\Controllers\Frontend;

// adaugam modelul User
use App\Models\User;
use Illuminate\Http\Request;
// adaugam namespace-ul pentru clasa Auth
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        // returnam pagina principala a aplicatiei resources\views\frontend\index.blade.php
        return view('frontend.index');
    }

    // functia de logout user
    public function UserLogout()
    {
        // logout user
        Auth::logout();
        // redirect user spre pagina de login
        return Redirect()->route('login');
    }
}
