<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // functia pt vizualizare comenzi in backend in asteptare
    public function PendingOrders()
    {
        // $orders preia toate comenzile in asteptare / procesare
        $orders = Order::where('status', 'In procesare')->orderBy('id', 'DESC')->get();
        // returnam pagina de vizualizare comenzi in asteptare in admin dashboard cu datele din variabila $orders
        return view('backend.orders.pending_orders', compact('orders'));
    }
}