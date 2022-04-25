<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AllUserController extends Controller
{
    // functia pentru vizualizarea comenzilor unui user
    public function MyOrders()
    {
        // $orders preia toate comenzile unui user autentificat  
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        foreach ($orders as $order) {
            $order_items[] = OrderItem::where('order_id', $order->id)->orderBy('order_id', 'DESC')->get();
        }
        return view('frontend.profile.order_view', compact('orders', 'order_items'));
    }
}