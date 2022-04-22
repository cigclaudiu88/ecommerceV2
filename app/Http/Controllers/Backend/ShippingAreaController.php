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
                'division_name.required' => 'Numele zonei de livrare este necesar.',
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
    // functia de editare a unei zonelor de livrare
    public function DivisionEdit($id)
    {
        // $division preia datele unei zonelor de livrare
        $divisions = ShipDivision::findOrFail($id);
        // returnam pagina de editare a unei zonelor de livrare
        return view('backend.shipping.division.edit_division', compact('divisions'));
    }

    public function DivisionUpdate(Request $request, $id)
    {
        // validari inserare voucher in tabelul vouchers
        $request->validate(
            [
                'division_name' => 'required',
            ],
            // mesaje de eroare pt fiecare tip de validare
            [
                'division_name.required' => 'Numele zonei de livrare este necesar.',
            ]
        );
        // actualizam datele unei zonelor de livrare pentru id-ul $id
        ShipDivision::findOrFail($id)->update([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);
        // adaugam notificare de succes la actualizarea voucher-ului
        $notification = array(
            'message' => 'Zona de livrare a fost actualizata cu succes!',
            'alert-type' => 'info'
        );
        // redirectionam la aceeasi pagina cu mesajul $notification
        return redirect()->route('manage-division')->with($notification);
    }

    // functia de stergere a unei zonelor de livrare
    public function DivisionDelete($id)
    {
        // cautam in tabelul shipdivisions datele unei zonelor de livrare pentru id-ul $id si le stergem
        ShipDivision::findOrFail($id)->delete();
        // adaugam notificare de succes la stergerea voucher-ului
        $notification = array(
            'message' => 'Zona de livrare a fost stearsa cu succes!',
            'alert-type' => 'info'
        );
        // redirectionam la aceeasi pagina cu mesajul $notification
        return redirect()->back()->with($notification);
    }
}