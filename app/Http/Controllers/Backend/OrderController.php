<?php

namespace App\Http\Controllers\Backend;

use PDF;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $orderItem = OrderItem::with('product', 'voucher', 'order')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
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

        Order::findOrFail($order_id)->update([
            'status' => 'Confirmata',
            'confirmed_date' => Carbon::now()->format('d/m/Y H:i')
        ]);

        // $product preia toate produsele din tabelul orderitems (produse comandate) cele care au id-ul comenzii plasate
        $product = OrderItem::where('order_id', $order_id)->get();
        // iteram cu $product ca sa preluam fiecare produs din comanda
        foreach ($product as $item) {
            // cautam in tabelul products produsul care are id-ul = product_id (tabelul orderitems)
            Product::where('id', $item->product_id)
                //  scadem stocul produselor din tabelul products cu cantitatea produselor din comanda
                ->update([
                    'product_quantity' => DB::raw('product_quantity-' . $item->qty),
                    'blocked_quantity' => DB::raw('blocked_quantity-' . $item->qty)
                ]);
        }

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
        Order::findOrFail($order_id)->update([
            'status' => 'Procesata',
            'processing_date' => Carbon::now()->format('d/m/Y H:i')
        ]);

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
        Order::findOrFail($order_id)->update([
            'status' => 'Preluata de curier',
            'picked_date' => Carbon::now()->format('d/m/Y H:i')
        ]);

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
        Order::findOrFail($order_id)->update([
            'status' => 'In tranzit',
            'shipped_date' => Carbon::now()->format('d/m/Y H:i')
        ]);

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
        Order::findOrFail($order_id)->update([
            'status' => 'Livrata',
            'delivered_date' => Carbon::now()->format('d/m/Y H:i')
        ]);

        $notification = array(
            'message' => 'Comanda a fost livrata cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->route('shipped-orders')->with($notification);
    }

    // functia pentru modificare statusului comenzii in Anulata
    public function OrderCanceled($order_id)
    {
        // schimbam statusul comenzii in Livrata
        Order::findOrFail($order_id)->update([
            'status' => 'Anulata',
            'cancel_date' => Carbon::now()->format('d/m/Y H:i')
        ]);

        // $product preia toate produsele din tabelul orderitems (produse comandate) cele care au id-ul comenzii plasate
        $product = OrderItem::where('order_id', $order_id)->get();
        // iteram cu $product ca sa preluam fiecare produs din comanda
        foreach ($product as $item) {
            // cautam in tabelul products produsul care are id-ul = product_id (tabelul orderitems)
            Product::where('id', $item->product_id)
                //  scadem stocul produselor din tabelul products cu cantitatea produselor din comanda
                ->update([
                    'blocked_quantity' => DB::raw('blocked_quantity-' . $item->qty)
                ]);
        }


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

    public function AddAWB(Request $request, $order_id)
    {

        // validari pentru adaugare courier si awb
        $request->validate(
            [
                // awb_code este obligatoriu marime 10 caractere si unic in tabelul awb
                'awb_code' => 'required|size:10|unique:orders',
                // imaginea este necesara si trebuie sa fie de tipul jpeg, png gif sau svg
                'courier_name' => 'required',
                'pickup_date' => 'required',
            ],
            // mesaje speciale pentru fiecare tip de eraore
            [
                'awb_code.required' => 'AWB-ul este obligatoriu!',
                'awb_code.size' => 'AWB-ul trebuie sa aibe 10 caractere!',
                'awb_code.unique' => 'AWB-ul este deja folosit!',
                'courier_name.required' => 'Numele curierului este obligatoriu!',
                'pickup_date.required' => 'Data de preluare este obligatorie!',
            ]
        );

        // dd($request->all());
        // cautam in tabelul orders comanda cu id-ul = $order_id si actualizam awb_code, courier_name si pickup_date cu datele din formular
        Order::findOrFail($order_id)->update([
            'awb_code' => $request->awb_code,
            'courier_name' => $request->courier_name,
            'pickup_date' => $request->pickup_date,
        ]);
        // afisam mesajul de succes
        $notification = array(
            'message' => 'AWB-ul a fost adaugat cu succes!',
            'alert-type' => 'success'
        );
        // redirectam utilizatorul catre pagina cu comenzile cu notificare
        return redirect()->back()->with($notification);
    }

    public function PendingReturnOrdersDetails($order_id)
    {
        // $order preia din tabelul orders comanda care are id-ul = $order_id primit ca parametru 
        // pentru utilizatorul autentificat adica unde user_id = Auth::id() id-ul utilizaoturlui autentificat
        // order cu functiile division(), district() si user() preia informatiile din acele tabele prin intermediul comenzii
        $order = Order::with('division', 'district', 'user', 'user_address')->where('id', $order_id)->first();
        // $orderItem preia din tabelul order_items toate produsele din comanda cu id-ul = $order_id primit ca parametru
        // folosim functia product() din modelul OrderItem pentru a preia informatiile din tabelul products
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        // returnam pagina cu detaliile comenzii cu continutul din variabilele $order si $orderItem
        return view('backend.orders.return_orders_details', compact('order', 'orderItem'));
    }
}