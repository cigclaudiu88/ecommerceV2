<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReturnController extends Controller
{
    // functia de vizualizare retur comenzi
    public function ReturnRequest()
    {
        // $orders preia din tabelul orders comanda care are return_order = 1
        $orders = Order::where('return_order', 1)->orderBy('id', 'DESC')->get();
        // returnam pagina cu comenzile de returnat cu continutul din variabila $orders
        return view('backend.orders_return.return_request', compact('orders'));
    }
    // functia de aprobare retur comanda
    public function ReturnRequestApprove($order_id)
    {
        // actualizam campul return_order din tabelul orders cu 2 pentru comanda cu id-ul = $order_id primit ca parametru
        Order::where('id', $order_id)->update(['return_order' => 2]);
        // mesaj notificare
        $notification = array(
            'message' => 'Returul comenzii a fost aprobat cu succes!',
            'alert-type' => 'success'
        );
        //redirectiom inapoi la pagina de vizualizare comenzi de returnat cu notificare
        return redirect()->back()->with($notification);
    }

    // functia de vizualizare a tuturor comenzilor returnate
    public function ReturnAllRequest()
    {
        // $orders preia din tabelul orders comanda care are return_order = 2
        $orders = Order::where('return_order', 2)->orderBy('id', 'DESC')->get();
        //  returnam pagina cu comenzile returnate cu continutul din variabila $orders
        return view('backend.orders_return.all_return_request', compact('orders'));
    }

    public function ReturnItemRequestApprove($order_item_id)
    {
        OrderItem::where('id', $order_item_id)->update(['return_order_item' => 1]);
        $notification = array(
            'message' => 'Produsul a fost acceptat pentru retur!',
            'alert-type' => 'success'
        );
        //redirectiom inapoi la pagina de vizualizare comenzi de returnat cu notificare
        return redirect()->back()->with($notification);
    }


    public function ReturnItemFinalized(Request $request, $order_item_id)
    {
        OrderItem::where('id', $order_item_id)->update([
            'return_order_item' => 2,
            'return_qty' => $request->return_qty,
        ]);
        $notification = array(
            'message' => 'Produsul a fost returnat cu succes!',
            'alert-type' => 'success'
        );
        //redirectiom inapoi la pagina de vizualizare comenzi de returnat cu notificare
        return redirect()->back()->with($notification);
    }
}