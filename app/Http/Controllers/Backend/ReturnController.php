<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // validare astfel incat cantitatea returanta sa fie necesara
        $request->validate(
            [
                'return_qty' => 'required',
            ],
            [
                'return_qty.required' => 'Cantitatea de returnat nu poate fi goala!',
            ]
        );

        // actualizam in tabelul order_item campul return_order_item cu 2 (retur finalizat) 
        // pentru produsul cu id-ul = $order_item_id primit ca parametru
        // si actualizam si cantitatea returanta cu cea din formular
        OrderItem::where('id', $order_item_id)->update([
            'return_order_item' => 2,
            'return_qty' => $request->return_qty,
        ]);

        // cautam in tabelul products produsul care are id-ul =  $request->product_id 
        //(camp ascuns din formularul din pagina resources\views\backend\orders\return_orders_details.blade.php)
        Product::where('id', $request->product_id)
            // crestem stocul produselor din tabelul products cu cantitatea produsului returnat
            ->update(['product_quantity' => DB::raw('product_quantity+' . $request->return_qty)]);

        $notification = array(
            'message' => 'Produsul a fost returnat cu succes!',
            'alert-type' => 'success'
        );
        //redirectiom inapoi la pagina de vizualizare comenzi de returnat cu notificare
        return redirect()->back()->with($notification);
    }
}