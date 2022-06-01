<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

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
        if (Session::has('voucher')) {
            $cartSubTotal = round(Cart::priceTotalFloat(), 2);
        } else {
            $cartSubTotal = round(Cart::subtotalFloat(), 2);
            $voucher_discount = round(Cart::setGlobalDiscount(0), 2);
        }
        // $cartTax preia TVA-ul total al produselor din mini cosul de cumparaturi
        $cartTax = round(Cart::taxFloat(), 2);
        // $cartTotal preia pretul total al produselor din mini cosul de cumparaturi cu tot cu tva
        $cartTotal = round(Cart::totalFloat(), 2);

        // $cart_produc_ids preia in array id-urile produselor din cos
        // $cart_product_ids = Cart::content()->pluck('id');
        // $products preia din produsele din tabelul products doar acele produse care au acelasi id cu id-ul produselor din cos
        // $products = Product::whereIn('id', $cart_product_ids)->select('product_quantity')->get();

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
        $cart_product_id = Cart::get($rowId)->id;
        $cart_product_quantity = Cart::get($rowId)->qty;
        Product::where('id', $cart_product_id)
            // scadem stocul produselor din tabelul products cu cantitatea produselor din comanda
            ->update(['product_quantity' => DB::raw('product_quantity+' . $cart_product_quantity)]);

        // cand adaugam un produs in pagina cosului de cumparaturi 
        // daca sesiunea are voucher, atunci il stergem
        if (Session::has('voucher')) {
            // scoatem voucherul din sesiune
            Session::forget('voucher');

            // sterge produsul cu id-ul $rowId din cosul de cumparaturi
            Cart::remove($rowId);
            // cand stergem un produs din pagina cosului de cumparaturi 
            // daca sesiunea are voucher, atunci il stergem
            // if (Session::has('voucher')) {
            //     Session::forget('voucher');
            // }
            // returnam mesajul de succes
            return response()->json(['success' => 'Produsul si voucher a fost sters cu succes din Cosul de Cumparaturi']);
        } else {
            // sterge produsul cu id-ul $rowId din cosul de cumparaturi
            Cart::remove($rowId);
            // returnam mesajul de succes
            return response()->json(['success' => 'Produsul a fost sters cu succes din Cosul de Cumparaturi']);
        }
    }

    // functia de crestere cantitatea produselor din pagina cosului de cumparaturi
    public function CartIncrement($rowId)
    {
        // $row preia produsul cu id-ul $rowId din cosul de cumparaturi
        $row = Cart::get($rowId);

        $cart_product_id = Cart::get($rowId)->id;

        $product_stock = Product::where('id', $cart_product_id)->select('product_quantity')->get();
        if ($product_stock[0]->product_quantity <= 0) {
            return response()->json(['error' => 'Stocul produsului este insuficient']);
        } else {

            Product::where('id', $cart_product_id)
                // scadem stocul produselor din tabelul products cu cantitatea produselor din comanda
                ->update(['product_quantity' => DB::raw('product_quantity-1')]);
            // actualizam cantitatea produsului cu id-ul $rowId cu 1
            Cart::update($rowId, $row->qty + 1);
            // daca sesiunea are voucherul, atunci se adauga pretul de discount la pretul total al produselor din cosul de cumparaturi
            if (Session::has('voucher')) {

                // $voucher_name preia din sesiune (voucher introdus din applyVoucher() ) numele voucherului
                $voucher_name = Session::get('voucher')['voucher_name'];
                // voucher preia din tabelul vouchers acel primul voucher care are voucher_name = $voucher_name
                $voucher = Voucher::where('voucher_name', $voucher_name)->first();
                // $voucherDiscount preia in $voucher discountul
                $voucherDiscount = $voucher->voucher_discount;
                // $voucherName preia in $voucher numele voucherului
                $voucherName = $voucher->voucher_name;

                Session::put('voucher', [
                    'voucher_name' => $voucherName,
                    // pretul inainte de voucher si tva
                    'subtotal' => round(Cart::priceTotalFloat(), 2),
                    // setarea discountului in functie de voucher
                    'voucher_discount' => Cart::setGlobalDiscount($voucherDiscount),
                    // pretul dupa voucher
                    'discount_amount' => round(Cart::discountFloat(), 2),
                    // pretul dupa voucher cu tva
                    'tax' => round(Cart::taxFloat(), 2),
                    // pretul total dupa voucher cu tva
                    'grandtotal' => round(Cart::totalFloat(), 2),
                ]);
            }
            // returnam raspunsul json increment
            return response()->json('increment');
        }
    }
    // functia de scadere cantitatea produselor din pagina cosului de cumparaturi
    public function CartDecrement($rowId)
    {
        // $row preia produsul cu id-ul $rowId din cosul de cumparaturi
        $row = Cart::get($rowId);

        $cart_product_id = Cart::get($rowId)->id;
        Product::where('id', $cart_product_id)
            // scadem stocul produselor din tabelul products cu cantitatea produselor din comanda
            ->update(['product_quantity' => DB::raw('product_quantity+1')]);


        // actualizam cantitatea produsului cu id-ul $rowId cu 1
        Cart::update($rowId, $row->qty - 1);
        // daca sesiunea are voucherul, atunci se adauga pretul de discount la pretul total al produselor din cosul de cumparaturi
        if (Session::has('voucher')) {

            // $voucher_name preia din sesiune (voucher introdus din applyVoucher() ) numele voucherului
            $voucher_name = Session::get('voucher')['voucher_name'];
            // voucher preia din tabelul vouchers acel primul voucher care are voucher_name = $voucher_name
            $voucher = Voucher::where('voucher_name', $voucher_name)->first();
            // $voucherDiscount preia in $voucher discountul
            $voucherDiscount = $voucher->voucher_discount;
            // $voucherName preia in $voucher numele voucherului
            $voucherName = $voucher->voucher_name;

            Session::put('voucher', [
                'voucher_name' => $voucherName,
                // pretul inainte de voucher si tva
                'subtotal' => round(Cart::priceTotalFloat(), 2),
                // setarea discountului in functie de voucher
                'voucher_discount' => Cart::setGlobalDiscount($voucherDiscount),
                // pretul dupa voucher
                'discount_amount' => round(Cart::discountFloat(), 2),
                // pretul dupa voucher cu tva
                'tax' => round(Cart::taxFloat(), 2),
                // pretul total dupa voucher cu tva
                'grandtotal' => round(Cart::totalFloat(), 2),
            ]);
        }
        // returnam raspunsul json increment
        return response()->json('decrement');
    }
}