<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// folosit pt formatarea datelor 
use DateTime;
use App\Models\Order;

class ReportController extends Controller
{
    // functie pentru a afisa pagina de rapoarte
    public function ReportView()
    {

        return view('backend.report.report_view');
    }
    // functia pentru raport vanzari dupa data
    public function ReportByDate(Request $request)
    {
        // $date creaza un nou obiect datetime folosind data din formular cautare dupa data
        $date = new DateTime($request->date);
        // $formatDate preia valoarea din $date si o transforma in formatul de data
        $formatDate = $date->format('d/m/Y');
        // return $formatDate;
        // $orders preia din tabelul orders toate comenzile care au data de livrare egala cu data din formular
        $orders = Order::where('order_date', $formatDate)->latest()->get();
        // returnam pagina de vizualizare a rportului de vanzari
        return view('backend.report.report_show', compact('orders'));
    }
    // functia pentru raport vanzari dupa luna si an
    public function ReportByMonth(Request $request)
    {
        // $orders preia din tabelul orders comenziile care au luna egala cu luna din formular si anul egala cu anul din formular
        $orders = Order::where('order_month', $request->month)->where('order_year', $request->year_name)->latest()->get();
        return view('backend.report.report_show', compact('orders'));
    } // end mehtod 

    // functia pentru raport vanzari dupa an
    public function ReportByYear(Request $request)
    {
        // $orders preia din tabelul orders comenziile care au anul egala cu anul din formular
        $orders = Order::where('order_year', $request->year)->latest()->get();
        return view('backend.report.report_show', compact('orders'));
    }
}