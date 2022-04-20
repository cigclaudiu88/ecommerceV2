<?php

namespace App\Http\Controllers\User;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // adaugat functia de vizualizare wishlist
    public function ViewWishlist()
    {
        // returnam pagina de vizualizare wishlist
        return view('frontend.wishlist.view_wishlist');
    }

    // functia de preluare a produselor din wishlist
    public function GetWishlistProduct()
    {
        // $wishlist preia prin legatura data de functia product() din modelul Wishlist acele produse din wishlist care au user_id = id-ul utilizatorului autentificat
        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
        // returnam wishlist-ul in format json
        return response()->json($wishlist);
    } // end mehtod 

    // functia de stergere produse din wishlist
    public function RemoveWishlistProduct($id)
    {

        // cautam in tabelul wishlists pentru user_id al utilizatorului autentificat si product_id = id-ul produsului care trebuie sters
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        // returnam un raspuns json cu mesajul de succes
        return response()->json(['success' => 'Produsul a fost sters din wishlist']);
    }
}