<?php

namespace App\Http\Controllers\Frontend;

// adaugam modelul Product
use App\Models\Product;
// adaugam modelul Cart
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        // $cartTotal preia pretul total al produselor din mini cosul de cumparaturi
        $cartTotal = Cart::total();

        // returnam toate datele in format json
        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));
    }
}