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
    // functia pt vizualizare detaliile comenzii si produsele din comanda in user dashboard
    public function OrderDetails($order_id)
    {
        // $order preia din tabelul orders comanda care are id-ul = $order_id primit ca parametru 
        // pentru utilizatorul autentificat adica unde user_id = Auth::id() id-ul utilizaoturlui autentificat
        $order = Order::where('id', $order_id)->where('user_id', Auth::id())->first();
        // $orderItem preia din tabelul order_items toate produsele din comanda cu id-ul = $order_id primit ca parametru
        $orderItem = OrderItem::where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        // returnam pagina cu detaliile comenzii cu continutul din variabilele $order si $orderItem
        return view('frontend.profile.order_details', compact('order', 'orderItem'));
    }
}