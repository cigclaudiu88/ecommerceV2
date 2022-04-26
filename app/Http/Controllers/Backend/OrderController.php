<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use PDF;
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
    // functia pt vizualizarea a comenzilor confirmate in admin dashboard
    public function ConfirmedOrders()
    {
        $orders = Order::where('status', 'Confirmata')->orderBy('id', 'DESC')->get();
        return view('backend.orders.confirmed_orders', compact('orders'));
    }
    // functia pt vizualizarea a comenzilor procesate in admin dashboard
    public function ProcessingOrders()
    {
        $orders = Order::where('status', 'Procesata')->orderBy('id', 'DESC')->get();
        return view('backend.orders.processing_orders', compact('orders'));
    }
    // functia pt vizualizarea a comenzilor preluate decurier in admin dashboard
    public function PickedOrders()
    {
        $orders = Order::where('status', 'Preluata de curier')->orderBy('id', 'DESC')->get();
        return view('backend.orders.picked_orders', compact('orders'));
    }
    // functia pt vizualizarea a comenzilor livratein tranzit in admin dashboard
    public function ShippedOrders()
    {
        $orders = Order::where('status', 'In tranzit')->orderBy('id', 'DESC')->get();
        return view('backend.orders.shipped_orders', compact('orders'));
    }
    // functia pt vizualizarea a comenzilor livrate in admin dashboard
    public function DeliveredOrders()
    {
        $orders = Order::where('status', 'Livrata')->orderBy('id', 'DESC')->get();
        return view('backend.orders.delivered_orders', compact('orders'));
    }
    // functia pt vizualizarea a comenzilor anulate in admin dashboard
    public function CancelOrders()
    {
        $orders = Order::where('status', 'Anulata')->orderBy('id', 'DESC')->get();
        return view('backend.orders.cancel_orders', compact('orders'));
    }
    // functia pentru modificare statusului comenzii din in asteptare -> confirmata
    public function PendingToConfirm($order_id)
    {

        Order::findOrFail($order_id)->update(['status' => 'Confirmata']);

        $notification = array(
            'message' => 'Comanda a fost confirmata cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->route('pending-orders')->with($notification);
    }
    // functia pentru modificare statusului comenzii Confirmata -> Procesata
    public function ConfirmToProcessing($order_id)
    {
        // schimbam statusul comenzii in Procesata
        Order::findOrFail($order_id)->update(['status' => 'Procesata']);

        $notification = array(
            'message' => 'Comanda a fost procesata cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->route('confirmed-orders')->with($notification);
    }
    // functia pentru modificare statusului comenzii Procesata -> Preluata de curier
    public function ProcessingToPicked($order_id)
    {
        // schimbam statusul comenzii in Preluata de curier
        Order::findOrFail($order_id)->update(['status' => 'Preluata de curier']);

        $notification = array(
            'message' => 'Comanda a fost preluata de curier cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->route('processing-orders')->with($notification);
    }
    // functia pentru modificare statusului comenzii Preluata de curier -> In tranzit
    public function PickedToShipped($order_id)
    {
        // schimbam statusul comenzii in In tranzit
        Order::findOrFail($order_id)->update(['status' => 'In tranzit']);

        $notification = array(
            'message' => 'Comanda a fost expediata cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->route('picked-orders')->with($notification);
    } // end method

    // functia pentru modificare statusului comenzii In tranzit -> Livrata
    public function ShippedToDelivered($order_id)
    {
        // schimbam statusul comenzii in Livrata
        Order::findOrFail($order_id)->update(['status' => 'Livrata']);

        $notification = array(
            'message' => 'Comanda a fost livrata cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->route('shipped-orders')->with($notification);
    }

    // functia pentru modificare statusului comenzii in Anulata
    public function DeliveredToCanceled($order_id)
    {
        // schimbam statusul comenzii in Livrata
        Order::findOrFail($order_id)->update(['status' => 'Anulata']);

        $notification = array(
            'message' => 'Comanda a fost anulata cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->route('pending-orders')->with($notification);
    }
    // functia pentru descarcat factura PDF din admin dashboard
    public function AdminInvoiceDownload($order_id)
    {
        // $order preia din tabelul orders comanda care are id-ul = $order_id primit ca parametru 
        // pentru utilizatorul autentificat adica unde user_id = Auth::id() id-ul utilizaoturlui autentificat
        // order cu functiile division(), district() si user() preia informatiile din acele tabele prin intermediul comenzii
        $order = Order::with('division', 'district', 'user')->where('id', $order_id)->first();
        // $orderItem preia din tabelul order_items toate produsele din comanda cu id-ul = $order_id primit ca parametru
        // folosim functia product() din modelul OrderItem pentru a preia informatiile din tabelul products
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        // returnam pagina cu detaliile comenzii cu continutul din variabilele $order si $orderItem

        // $pdf preia in PDF pagina order_invoice.blade.php cu datele trimite prin variabilele $order si $orderItem ca pagina a4
        $pdf = PDF::loadView('backend.orders.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('factura.pdf');
    } // end method 
}