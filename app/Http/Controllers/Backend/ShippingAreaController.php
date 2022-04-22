<?php

namespace App\Http\Controllers\Backend;

use App\Models\ShipDistrict;
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

    public function DistrictView()
    {   // $districts preia toate datele zonelor de livrare
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        // $districts preia toate datele zonelor de livrare
        $district = ShipDistrict::orderBy('id', 'DESC')->get();
        // $district preia toate datele din tabelul shipdistricts + datele din tabelul shipdivisions (folosind functia divisions() din modelul ShipDistrict)
        $district = ShipDistrict::with('division')->orderBy('id', 'DESC')->get();
        // returnam pagina de afisare a tuturor zonelor de livrare
        return view('backend.shipping.district.view_district', compact('division', 'district'));
    }

    public function DistrictStore(Request $request)
    {

        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required',
        ]);

        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Localitatea a fost adaugata cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method 



    public function DistrictEdit($id)
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistrict::findOrFail($id);
        return view('backend.shipping.district.edit_district', compact('district', 'division'));
    }

    public function DistrictUpdate(Request $request, $id)
    {

        ShipDistrict::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Localitatea a fost actualizata cu succes!',
            'alert-type' => 'info'
        );

        return redirect()->route('manage-district')->with($notification);
    } // end mehtod 

    public function DistrictDelete($id)
    {
        ShipDistrict::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Localitatea a fost stearsa cu succes!',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // end method 
}