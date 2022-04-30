<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// adaugat pentru email comanda
use Illuminate\Support\Facades\Mail;
// inclus OrderMail creat pt email cu datele comenzii
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class StripeController extends Controller
{
    // functia pentru plata prin Stripe inserare comanda - start
    public function StripeOrder(Request $request)
    {
        // daca sesiunea are voucher totalul de plata va curpinde reducerea din voucher
        if (Session::has('voucher')) {
            $voucher_name = Session::get('voucher')['voucher_name'];
            $discount_amount = Session::get('voucher')['discount_amount'];
            $subtotal = Session::get('voucher')['subtotal'];
            $tax = Session::get('voucher')['tax'];
            $total_amount = Session::get('voucher')['grandtotal'];
            // daca nu avem voucher totalul va fi totalul de plata fara reducere voucher
        } else {
            $voucher_name = null;
            $discount_amount = null;
            $subtotal = Cart::pricetotal();
            $voucher_discount = Cart::setGlobalDiscount(0);
            $tax = Cart::tax();
            $total_amount = Cart::total();
        }

        \Stripe\Stripe::setApiKey('sk_test_51Ks1SYI2h4zccwc7VN6nWUxYHmjRd5Onpporbhdz9FUhXn5tdIIyGG9G6KDPDC7ieh3DIVWdVDrrOZTY2T5Drj0N002ERXChzi');
        // datele trimise spre portalul stripe legat de comanda
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            // atentie ca valoarea adusa de cart::total() este string ex : 2,150.53 
            // trebuie scos ' ,' si inlocuita cu nimica si inmultia cu 100 pt a da valoarea corecta
            'amount' => floatval(str_replace(',', '', $total_amount) * 100),
            'currency' => 'ron',
            'description' => 'eShop UPT',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);

        // dd($charge);


        // inseram datele de livrare si cele legate de plata in tabelul orders
        // $orders_id preia id-ul comenzii (id din tabelul orders)
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'shipping_first_name' => $request->shipping_first_name,
            'shipping_last_name' => $request->shipping_last_name,
            'shipping_phone' => $request->shipping_phone,
            'shipping_email' => $request->shipping_email,
            'shipping_street' => $request->shipping_street,
            'shipping_street_number' => $request->shipping_street_number,
            'shipping_building' => $request->shipping_building,
            'shipping_apartment' => $request->shipping_apartment,
            'notes' => $request->notes,

            'payment_type' => 'Stripe',
            'payment_method' => 'Stripe',
            'payment_type' => $charge->payment_method,
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'voucher_name' => $voucher_name,
            'discount_amount' => $discount_amount,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

            'invoice_no' => 'UPT_' . $charge->metadata->order_id,
            'order_date' => Carbon::now()->format('d/m/Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'In asteptare',
            'created_at' => Carbon::now(),
        ]);

        // $carts preia din cosul de cumparaturi toate produsele produsele
        $carts = Cart::content();
        // iteram cu $carts ca sa preluam fiecare produs din cosul de cumparaturi
        // si il inseram in tabelul order_items (produse comandate)
        foreach ($carts as $cart) {
            OrderItem::insert([
                // inseram in order_id id-ul comenzii inserate mai sus in tabelul orders
                // si restul datelor preluate din cosul de cumparaturi
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'product_name' => $cart->name,
                // 'color' => $cart->options->color,
                // 'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        // trasmite mailul cu datele comenzii dupa finalizare plata
        // $invoice preia din tabelul acea comanda care are id=$order_id
        $invoice = Order::findOrFail($order_id);
        // $data preia datele comenzii
        $data = [
            'order_number' => $invoice->order_number,
            'first_name' => $invoice->shipping_first_name,
            'last_name' => $invoice->shipping_last_name,
            'phone' => $invoice->shipping_phone,
            'email' => $invoice->shipping_email,
            'amount' => $total_amount,
            'street' => $invoice->shipping_street,
            'street_number' => $invoice->shipping_street_number,
            'building' => $invoice->shipping_building,
            'apartment' => $invoice->shipping_apartment,
            'payment_method' => $invoice->payment_method,
            'transaction_id' => $invoice->transaction_id,
            'voucher_name' => $invoice->voucher_name,
            'discount_amount' => $invoice->discount_amount,
            'subtotal' => $invoice->subtotal,
            'tax' => $invoice->tax,
            'amount' => $total_amount,
            'order_date' => $invoice->order_date,
        ];

        // $products preia din tabelul order_items produsele pentru care order_id=$order_id inserat mai sus
        // $products = OrderItem::where('order_id', $order_id)->get();

        // foreach ($products as $product=>$key) {
        //     $item['products'][] = [
        //         'name' => $product->product_name,
        //         'qty' => $product->qty,
        //         'price' => $product->price,
        //     ];
        // }

        // trimite spre mail-ul din request afereten adresei de livrare (user email) 
        // toate datele comenzii (data, numarul comenzii, totalul comenzii) prin custom mail creat -> app\Mail\OrderMail.php
        Mail::to($request->shipping_email)->send(new OrderMail($data));

        // dupa inserare comanda daca sesiunea are voucher stergem voucherul din sesiune
        if (Session::has('voucher')) {
            Session::forget('voucher');
        }

        // stergere cosul de cumparaturi dupa inserare comanda
        Cart::destroy();
        $notification = array(
            'message' => 'Comanda a fost inregistrata cu succes!',
            'alert-type' => 'success'
        );
        return redirect()->route('welcome')->with($notification);
    }
}    // functia pentru plata prin Stripe inserare comanda - sfarsit