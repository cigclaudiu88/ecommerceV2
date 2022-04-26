<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
// use Barryvdh\DomPDF\PDF;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use PDF;
// includem pt a folosim DOMPDF
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
        // order cu functiile division(), district() si user() preia informatiile din acele tabele prin intermediul comenzii
        $order = Order::with('division', 'district', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        // $orderItem preia din tabelul order_items toate produsele din comanda cu id-ul = $order_id primit ca parametru
        // folosim functia product() din modelul OrderItem pentru a preia informatiile din tabelul products
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        // returnam pagina cu detaliile comenzii cu continutul din variabilele $order si $orderItem
        return view('frontend.profile.order_details', compact('order', 'orderItem'));
    }
    // functia pt descarcat facturi comenzii pdf
    public function InvoiceDownload($order_id)
    {
        // $order preia din tabelul orders comanda care are id-ul = $order_id primit ca parametru 
        // pentru utilizatorul autentificat adica unde user_id = Auth::id() id-ul utilizaoturlui autentificat
        // order cu functiile division(), district() si user() preia informatiile din acele tabele prin intermediul comenzii
        $order = Order::with('division', 'district', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        // $orderItem preia din tabelul order_items toate produsele din comanda cu id-ul = $order_id primit ca parametru
        // folosim functia product() din modelul OrderItem pentru a preia informatiile din tabelul products
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        // returnam pagina cu detaliile comenzii cu continutul din variabilele $order si $orderItem
        // return view('frontend.profile.order_invoice', compact('order', 'orderItem'));

        // $pdf preia in PDF pagina order_invoice.blade.php cu datele trimite prin variabilele $order si $orderItem ca pagina a4
        $pdf = PDF::loadView('frontend.profile.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('factura.pdf');
    } // end mehtod 

}