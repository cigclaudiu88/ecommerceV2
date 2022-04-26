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
    // functia pt vizualizare comenzi in asteptare in admin dashboard
    public function PendingOrders()
    {
        // $orders preia toate comenzile in asteptare
        $orders = Order::where('status', 'In asteptare')->orderBy('id', 'DESC')->get();
        // returnam pagina de vizualizare comenzi in asteptare in admin dashboard cu datele din variabila $orders
        return view('backend.orders.pending_orders', compact('orders'));
    }
    // functia pt vizualizare detalii comenzi in asteptare in admin dashboard
    public function PendingOrdersDetails($order_id)
    {
        // $order preia din tabelul orders comanda care are id-ul = $order_id primit ca parametru 
        // pentru utilizatorul autentificat adica unde user_id = Auth::id() id-ul utilizaoturlui autentificat
        // order cu functiile division(), district() si user() preia informatiile din acele tabele prin intermediul comenzii
        $order = Order::with('division', 'district', 'user', 'user_address')->where('id', $order_id)->first();
        // $orderItem preia din tabelul order_items toate produsele din comanda cu id-ul = $order_id primit ca parametru
        // folosim functia product() din modelul OrderItem pentru a preia informatiile din tabelul products
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        // returnam pagina cu detaliile comenzii cu continutul din variabilele $order si $orderItem
        return view('backend.orders.pending_orders_details', compact('order', 'orderItem'));
    }

    public function ConfirmedOrders()
    {
        $orders = Order::where('status', 'Confirmata')->orderBy('id', 'DESC')->get();
        return view('backend.orders.confirmed_orders', compact('orders'));
    }

    public function ProcessingOrders()
    {
        $orders = Order::where('status', 'Procesata')->orderBy('id', 'DESC')->get();
        return view('backend.orders.processing_orders', compact('orders'));
    }

    public function PickedOrders()
    {
        $orders = Order::where('status', 'Preluata de curier')->orderBy('id', 'DESC')->get();
        return view('backend.orders.picked_orders', compact('orders'));
    }

    public function ShippedOrders()
    {
        $orders = Order::where('status', 'In tranzit')->orderBy('id', 'DESC')->get();
        return view('backend.orders.shipped_orders', compact('orders'));
    }

    public function DeliveredOrders()
    {
        $orders = Order::where('status', 'Livrata')->orderBy('id', 'DESC')->get();
        return view('backend.orders.delivered_orders', compact('orders'));
    }

    public function CancelOrders()
    {
        $orders = Order::where('status', 'Anulata')->orderBy('id', 'DESC')->get();
        return view('backend.orders.cancel_orders', compact('orders'));
    }
}