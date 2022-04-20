<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // adaugat functia de vizualizare wishlist
    public function ViewWishlist()
    {
        // returnam pagina de vizualizare wishlist
        return view('frontend.wishlist.view_wishlist');
    }
}