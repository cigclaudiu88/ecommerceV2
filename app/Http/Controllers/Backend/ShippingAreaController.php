<?php

namespace App\Http\Controllers\Backend;

use App\Models\ShipDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ShippingAreaController extends Controller
{
    // functia pt afisarea tuturor zonelor de livrare
    public function DivisionView()
    {
        // $divisions preia toate datele zonelor de livrare
        $divisions = ShipDivision::orderBy('id', 'DESC')->get();
        // returnam pagina de afisare a tuturor zonelor de livrare
        return view('backend.shipping.division.view_division', compact('divisions'));
    }

    // functia de adaugare a unei noi zonelor de livrare
    public function DivisionStore(Request $request)
    {
        // validari inserare voucher in tabelul vouchers
        $request->validate(
            [
                'division_name' => 'required',
            ],
            // mesaje de eroare pt fiecare tip de validare
            [
                'division_name.required' => 'Numele zonelor de livrare este necesar.',
            ]
        );
        // inseram in tabelul shipdivisions valorile 
        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);
        // adaugam notificare de succes la inserarea voucher-ului
        $notification = array(
            'message' => 'Zona de livrare a fost adaugata cu succes!',
            'alert-type' => 'success'
        );
        // redirectionam la aceeasi pagina cu mesajul $notification
        return redirect()->back()->with($notification);
    }
}