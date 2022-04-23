<?php

namespace App\Http\Controllers\User;

use App\Models\ShipDistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    // functia pentru a returna pe pagina de checkout -> Adresa livreare - localitatea functie de alegerea judetului
    public function DistrictGetAjax($division_id)
    {
        // $ship preia din tabelul shipdistricts toate localitatile care apartin judetului unde division_id =$division_id primit ca parametru din script
        $ship = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        // returnam toate datele in format json
        return response()->json($ship);
    }

    public function CheckoutStore(Request $request)
    {
        dd($request->all());
    }
}