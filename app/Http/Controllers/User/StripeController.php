<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    //functia pentru plata prin Stripe
    public function StripeOrder(Request $request)
    {

        \Stripe\Stripe::setApiKey('sk_test_51Ks1SYI2h4zccwc7VN6nWUxYHmjRd5Onpporbhdz9FUhXn5tdIIyGG9G6KDPDC7ieh3DIVWdVDrrOZTY2T5Drj0N002ERXChzi');

        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount' => 999 * 100,
            'currency' => 'ron',
            'description' => 'eShop UPT',
            'source' => $token,
            'metadata' => ['order_id' => '6735'],
        ]);

        dd($charge);
    }
}