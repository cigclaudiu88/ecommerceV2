<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartPageController extends Controller
{
    // functia care returneaza pagina cu cosul de cumparaturi
    public function MyCart()
    {
        return view('frontend.cart.view_mycart');
    }

    public function GetCartProduct()
    {
        // $carts preia toate produsele din mini cosul de cumparaturi
        $carts = Cart::content();
        // $carQty preia numarul total de produse din mini cosul de cumparaturi
        $cartQty = Cart::count();
        // $cartSubtotal preia pretul total al produselor din mini cosul de cumparaturi fara TVA
        $cartSubTotal = Cart::subtotal();
        // $cartTax preia TVA-ul total al produselor din mini cosul de cumparaturi
        $cartTax = Cart::tax();
        // $cartTotal preia pretul total al produselor din mini cosul de cumparaturi cu tot cu tva
        $cartTotal = Cart::total();

        // returnam toate datele in format json
        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartSubTotal' => $cartSubTotal,
            'cartTax' => $cartTax,
            'cartTotal' => $cartTotal,
        ));
    }

    // functia de stergere produse din pagina cosului de cumparaturi
    public function RemoveCartProduct($rowId)
    {
        // sterge produsul cu id-ul $rowId din cosul de cumparaturi
        Cart::remove($rowId);
        // returnam mesajul de succes
        return response()->json(['success' => 'Produsul a fost sters cu succes din Cosul de Cumparaturi']);
    }

    // functia de actualizare cantitatea produselor din pagina cosului de cumparaturi
    public function CartIncrement($rowId)
    {
        // $row preia produsul cu id-ul $rowId din cosul de cumparaturi
        $row = Cart::get($rowId);
        // actualizam cantitatea produsului cu id-ul $rowId cu 1
        Cart::update($rowId, $row->qty + 1);
        // returnam raspunsul json increment
        return response()->json('increment');
    }
}