<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class StripeController extends Controller
{
    //functia pentru plata prin Stripe
    public function StripeOrder(Request $request)
    {
        // daca sesiunea are voucher totalul de plata va curpinde reducerea din voucher
        if (Session::has('voucher')) {
            $total_amount = Session::get('voucher')['grandtotal'];
            // daca nu avem voucher totalul va fi totalul de plata fara reducere voucher
        } else {
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

        dd($charge);
        // $id salveaza id-ul utilizatorului autentificat
        $id = Auth::user()->id;
        // $user_id cauta in modelul User utilizatorul autentificat 
        $user_id = User::find($id)->first();

        // inseram datele in tabelul orders
        $order_id = Order::insertGetId([
            'user_id' => $user_id,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'shipping_first_name' => $request->shipping_first_name,
            'shipping_last_name' => $request->shipping_last_name,
            'shipping_phone' => $request->shipping_phone,
            'shipping_email' => $request->shipping_email,
            'shipping_street' => $request->shipping_street,
            'shipping_street_number	' => $request->shipping_street_number,
            'shipping_building' => $request->shipping_building,
            'shipping_apartment' => $request->shipping_apartment,
            'notes' => $request->notes,

            'payment_type' => 'Stripe',
            'payment_method' => 'Stripe',
            'payment_type' => $charge->payment_method,
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

            'invoice_no' => 'UPT' . $charge->metadata->order_id,
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'In procesare',
            'created_at' => Carbon::now(),
        ]);
    }
}