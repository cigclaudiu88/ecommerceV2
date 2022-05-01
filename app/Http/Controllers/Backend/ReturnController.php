<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
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
}