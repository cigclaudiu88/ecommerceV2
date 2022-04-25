<?php

namespace App\Http\Controllers\User;

use App\Models\ShipDistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    // functia pentru a returna pe pagina de checkout -> Adresa livreare - localitatea functie de alegerea judetului
    public function DistrictGetAjax($division_id)
    {
        // $ship preia din tabelul shipdistricts toate localitatile care apartin judetului unde division_id =$division_id primit ca parametru din script
        $ship = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        // returnam toate datele in format json
        return response()->json($ship);
    }
    // functia de preluare a datelor din formularul de casa -> adresa de livrare
    public function CheckoutStore(Request $request)
    {
        // dd($request->all());
        // cream in variabila $data ca array() care va contine toate datele din formular
        $data = array();
        $data['shipping_first_name'] = $request->shipping_first_name;
        $data['shipping_last_name'] = $request->shipping_last_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['shipping_street'] = $request->shipping_street;
        $data['shipping_street_number'] = $request->shipping_street_number;
        $data['shipping_building'] = $request->shipping_building;
        $data['shipping_apartment'] = $request->shipping_apartment;
        $data['notes'] = $request->notes;

        if (Session::has('voucher')) {
            // $carts preia toate produsele din cosul de cumparaturi
            $carts = Cart::content();
            // $cartQty preia numarul de produse din cosul de cumparaturi
            $cartQty = Cart::count();
            // $cartTotal preia pretul subtotal al produselor din cosul de cumparaturi inainte de voucher si tva
            $cartSubTotal = Cart::priceTotal();
            // $cartTax preia TVA al produselor din cosul de cumparaturi dupa voucher
            $cartTax = Cart::tax();
            // $cartTotal preia pretul total al produselor din cosul de cumparaturi dupa voucher si tva
            $cartTotal = Cart::total();
            // toate campurile input radio din formular au numele payment_method
            // functie de valoarea atributului value al inputului selectat (stripe,card,cash)
            // trimitem valorile din $data (datele din formular - adresa de livrare) catre pagina de plata corespunzatoare
            if ($request->payment_method == 'stripe') {
                return view('frontend.payment.stripe', compact('data', 'carts', 'cartQty', 'cartSubTotal', 'cartTax', 'cartTotal'));
            } elseif ($request->payment_method == 'card') {
                return 'card';
            } else {
                return view('frontend.payment.cash', compact('data', 'carts', 'cartQty', 'cartSubTotal', 'cartTax', 'cartTotal'));
            }
        }
        // daca sesiunea nu voucher afisam totalurile fara voucher
        else {
            // $carts preia toate produsele din cosul de cumparaturi
            $carts = Cart::content();
            // $cartQty preia numarul de produse din cosul de cumparaturi
            $cartQty = Cart::count();
            // $cartTotal preia  subtotal al produselor din cosul de cumparaturi
            $cartSubTotal = Cart::subtotal();
            // $cartTax preia TVA al produselor din cosul de cumparaturi
            $cartTax = Cart::tax();
            // $cartTotal preia totalul produselor din cosul de cumparaturi cu TVA
            $cartTotal = Cart::total();
            // toate campurile input radio din formular au numele payment_method
            // functie de valoarea atributului value al inputului selectat (stripe,card,cash)
            // trimitem valorile din $data (datele din formular - adresa de livrare) catre pagina de plata corespunzatoare
            if ($request->payment_method == 'stripe') {
                return view('frontend.payment.stripe', compact('data', 'carts', 'cartQty', 'cartSubTotal', 'cartTax', 'cartTotal'));
            } elseif ($request->payment_method == 'card') {
                return 'card';
            } else {
                return view('frontend.payment.cash', compact('data', 'carts', 'cartQty', 'cartSubTotal', 'cartTax', 'cartTotal'));
            }
        }
    }
}