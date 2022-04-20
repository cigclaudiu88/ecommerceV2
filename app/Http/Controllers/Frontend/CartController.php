<?php

namespace App\Http\Controllers\Frontend;

// adaugam modelul Product
use App\Models\Product;
// adaugam modelul Cart
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    // functia de adaugare in cosul de cumparaturi
    public function AddToCart(Request $request, $id)
    {
        // $product preia id-ul produsului din tabelul products folosind modelul Product si functia findorfail()
        $product = Product::findOrFail($id);
        // daca produsul nu are discount, atunci in cos se adauga pretul de vanzare (selling_price)
        if ($product->discount_price == NULL) {
            // adaugam in cosul de cumparaturi produsul cu toate datele
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    // 'color' => $request->color,
                    // 'size' => $request->size,
                ],
            ]);
            // returnam mesajul de succes
            return response()->json(['success' => 'Adaugat cu success in Cosul de Cumparaturi']);
            // daca produsul are discount, atunci in cos se adauga pretul de discount (discount_price)
        } else {

            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    // 'color' => $request->color,
                    // 'size' => $request->size,
                ],
            ]);
            // returnam mesajul de succes
            return response()->json(['success' => 'Adaugat cu success in Cosul de Cumparaturi']);
        }
    }

    // functia de adaugare in mini cosul de cumparaturi
    public function AddMiniCart()
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
    // functia de stergere produse dini minicart
    public function RemoveMiniCart($rowId)
    {
        // sterge produsul cu id-ul $rowId din mini cosul de cumparaturi
        Cart::remove($rowId);
        // returnam mesajul de succes
        return response()->json(['success' => 'Produsul a fost sters cu success din Mini Cosul de Cumparaturi']);
    }

    // functia de adaugare produse in wishlist
    public function AddToWishlist(Request $request, $product_id)
    {
        // pentru a avea acces la functionalitatea de wishlist utilizatorul trebuie sa fie autentificat
        // verificam daca userul este autentificat
        if (Auth::check()) {

            // $exists preia din tabelul wishlists pentru utilizatorul autentificat produsul cu id-ul $product_id
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            // adaugam in tabelul wishlists user_id-ul utilizatorului autentificat si in product_id-ul produsului cu id-ul $product_id
            Wishlist::insert([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'created_at' => Carbon::now(),
            ]);
            return response()->json(['success' => 'Produsul a fost adaugat cu success in Wishlist']);
        } else {

            return response()->json(['error' => 'Trebuie sa fii autentificat pentru a adauga produsul in Wishlist']);
        }
    }
}