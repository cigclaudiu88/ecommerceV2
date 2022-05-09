<?php

namespace App\Http\Controllers\User;

use App\Models\Voucher;
use Illuminate\Http\Request;
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
        }
        // $cartTax preia TVA-ul total al produselor din mini cosul de cumparaturi
        $cartTax = round(Cart::taxFloat(), 2);
        // $cartTotal preia pretul total al produselor din mini cosul de cumparaturi cu tot cu tva
        $cartTotal = round(Cart::totalFloat(), 2);

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
        // cand stergem un produs din pagina cosului de cumparaturi 
        // daca sesiunea are voucher, atunci il stergem
        // if (Session::has('voucher')) {
        //     Session::forget('voucher');
        // }
        // returnam mesajul de succes
        return response()->json(['success' => 'Produsul a fost sters cu succes din Cosul de Cumparaturi']);
    }

    // functia de crestere cantitatea produselor din pagina cosului de cumparaturi
    public function CartIncrement($rowId)
    {
        // $row preia produsul cu id-ul $rowId din cosul de cumparaturi
        $row = Cart::get($rowId);
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
    // functia de scadere cantitatea produselor din pagina cosului de cumparaturi
    public function CartDecrement($rowId)
    {
        // $row preia produsul cu id-ul $rowId din cosul de cumparaturi
        $row = Cart::get($rowId);
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