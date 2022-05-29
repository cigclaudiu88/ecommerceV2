<?php

namespace App\Http\Controllers\User;

use PDF;
// use Barryvdh\DomPDF\PDF;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
// includem pt a folosim DOMPDF
use Illuminate\Support\Carbon;
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
        // daca utilizatorul are produse setate in comenzi afisam comenzile
        if (isset($order_items)) {
            return view('frontend.profile.order_view', compact('orders', 'order_items'));
            // daca nu are produse setate in comenzi nu afisam comenzile
        } else {
            return view('frontend.profile.order_view', compact('orders'));
        }
        // return view('frontend.profile.order_view', compact('orders', 'order_items'));
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

    // functia pentru retur comenzi
    public function ReturnOrder(Request $request, $order_id)
    {
        // cautam in tabelul orders id-ul comenzii pentru retur
        // actualizam data retur si motivul returului in tabelul orders
        // din formularul din detalii unei comenzi livrate
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d/m/Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);

        // notificarea utilizatorul ca returul a fost inregistrat
        $notification = array(
            'message' => 'Returul a fost inregistrat cu succes!',
            'alert-type' => 'success'
        );
        // returnam la pagina comenzi cu notificare
        return redirect()->route('my.orders')->with($notification);
    }
    // functia de afisare in user dashboard comenzile cu retur
    public function ReturnOrderList()
    {
        // $orders preia toate comenzile unui user autentificat in care campul return_reason nu este gol
        $orders = Order::where('user_id', Auth::id())->where('return_reason', '!=', NULL)->orderBy('id', 'DESC')->get();
        // returnam pagina de vizualizare comenzi cu retur si tirma variabila $orders
        return view('frontend.profile.return_order_view', compact('orders'));
    }
    // functia de vizualizare detaliilor comenziilor anulate
    public function CancelOrders()
    {
        // $orders preia toate comenzile unui user autentificat in care campul status este Anulat
        $orders = Order::where('user_id', Auth::id())->where('status', 'Anulata')->orderBy('id', 'DESC')->get();
        // returnam pagina de vizualizare comenzi anulate si trimitem variabila orders
        return view('frontend.profile.cancel_order_view', compact('orders'));
    }

    public function ReturnOrderDetails(Request $request, $order_id)
    {
        // $order preia din tabelul orders comanda care are id-ul = $order_id primit ca parametru 
        // pentru utilizatorul autentificat adica unde user_id = Auth::id() id-ul utilizaoturlui autentificat
        // order cu functiile division(), district() si user() preia informatiile din acele tabele prin intermediul comenzii
        $order = Order::with('division', 'district', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        // $orderItem preia din tabelul order_items toate produsele din comanda cu id-ul = $order_id primit ca parametru
        // folosim functia product() din modelul OrderItem pentru a preia informatiile din tabelul products
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->whereIN('return_order_item', [1, 2])->orderBy('id', 'DESC')->get();
        // returnam pagina cu detaliile comenzii cu continutul din variabilele $order si $orderItem
        return view('frontend.profile.order_return_details', compact('order', 'orderItem'));
    }
}