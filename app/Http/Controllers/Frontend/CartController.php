<?php

namespace App\Http\Controllers\Frontend;

// adaugam modelul Product
use App\Models\Product;
// adaugam modelul Cart
use App\Models\Voucher;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    // functia de adaugare in cosul de cumparaturi
    public function AddToCart(Request $request, $id)
    {
        // $product preia id-ul produsului din tabelul products folosind modelul Product si functia findorfail()
        $product = Product::findOrFail($id);
        if ($product->product_quantity == 0) {
            return response()->json(['error' => 'Stocul produsului este epuizat']);
        }
        // daca produsul nu are discount, atunci in cos se adauga pretul de vanzare (selling_price)
        else if ($product->discount_price == NULL) {
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
            // daca produsul nu exista in wishlist, atunci il adaugam
            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Produsul a fost adaugat cu success in Wishlist']);
                // daca produsul exista in wishlist, atunci afisam mesajul de eroare
            } else {
                return response()->json(['error' => 'Produsul exista deja in Wishlist']);
            }
            //  daca utilizatorul nu este autentificat, atunci afisam mesajul de eroare daca doreste sa adauge produsul in wishlist
        } else {

            return response()->json(['error' => 'Trebuie sa fii autentificat pentru a adauga produsul in Wishlist']);
        }
    }

    // functia de aplicare Voucher in cosul de cumparaturi
    public function VoucherApply(Request $request)
    {
        // $voucher preia din tabelul vouchers acel voucher pentru care numele din tabel = numele voucherului introduse de utilizator in campul voucher din formularul de aplicare voucher
        // pentru acele voucher-uri care au perioada de valabilitate mai mare de ziua de azi, atunci se aplica voucherul
        $voucher = Voucher::where('voucher_name', $request->voucher_name)->where('voucher_validity', '>=', Carbon::now()->format('Y-m-d'))->first();
        if ($voucher) {

            $voucherDiscount = $voucher->voucher_discount;
            $voucherName = $voucher->voucher_name;

            Session::put('voucher', [
                'voucher_name' => $voucherName,
                // pretul inainte de voucher si tva
                'subtotal' => Cart::priceTotal(),
                // setarea discountului in functie de voucher
                'voucher_discount' => Cart::setGlobalDiscount($voucherDiscount),
                // pretul dupa voucher
                'discount_amount' => Cart::discount(),
                // pretul dupa voucher cu tva
                'tax' => Cart::tax(),
                // pretul total dupa voucher cu tva
                'grandtotal' => Cart::total(),
            ]);
            return response()->json(array('success' => 'Voucherul a fost aplicat cu success',));
        } else {
            return response()->json(['error' => 'Voucherul nu este valid sau a expirat']);
        }
    }

    // functia de caulcuarea voucherului in cosul de cumparaturi
    public function VoucherCalculation()
    {
        // daca sesiunea are voucher, atunci calculam pretul total al produselor din cosul de cumparaturi cu voucher
        if (Session::has('voucher')) {
            return response()->json(array(
                'voucher_name' => session()->get('voucher')['voucher_name'],
                'subtotal' => session()->get('voucher')['subtotal'],
                'discount_amount' => session()->get('voucher')['discount_amount'],
                'tax' => session()->get('voucher')['tax'],
                'grandtotal' => session()->get('voucher')['grandtotal'],
            ));
            // daca nu avem voucher afisam pretul total al produselor din cosul de cumparaturi fara voucher
        } else {
            return response()->json(array(
                'subtotal' => Cart::subtotal(),
                'tax' => Cart::tax(),
                'total' => Cart::total(),
            ));
        }
    }
}