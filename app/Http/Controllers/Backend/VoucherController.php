<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Support\Carbon;

class VoucherController extends Controller
{
    // functia de vizualizare a tuturor voucher-urilor
    public function VoucherView()
    {
        // $vouchers preia din tabelul vouchers toate inregistrarile in ordine descrescatoare dupa id
        $vouchers = Voucher::orderBy('id', 'DESC')->get();
        // returnam pagina voucher_view.blade.php si trimitem continutul variabilei $vouchers
        return view('backend.voucher.view_voucher', compact('vouchers'));
    }

    // functia de adaugare a unui voucher in baza de date
    public function VoucherStore(Request $request)
    {
        // validari inserare voucher in tabelul vouchers
        $request->validate(
            [
                'voucher_name' => 'required',
                'voucher_discount' => 'required',
                'voucher_validity' => 'required',
            ],
            // mesaje de eroare pt fiecare tip de validare
            [
                'voucher_name.required' => 'Numele voucher-ului este necesar.',
                'voucher_discount.required' => 'Discountul voucher-ului este necesar.',
                'voucher_validity.required' => 'Valabilitatea voucher-ului este necesara.',
            ]
        );
        // inseram in tabelul vouchers valorile din campurile voucher_name, voucher_discount, voucher_validity
        Voucher::insert([
            'voucher_name' => strtoupper($request->voucher_name),
            'voucher_discount' => $request->voucher_discount,
            'voucher_validity' => $request->voucher_validity,
            'created_at' => Carbon::now(),
        ]);
        // adaugam notificare de succes la inserarea voucher-ului
        $notification = array(
            'message' => 'Voucherul a fost adaugat cu succes!',
            'alert-type' => 'success'
        );
        // redirectionam la aceeasi pagina cu mesajul $notification
        return redirect()->back()->with($notification);
    }

    // functia de editare a unui voucher in baza de date
    public function VoucherEdit($id)
    {
        // $vooucher preia din tabelul vouchers inregistrarea cu id-ul $id
        $vouchers = Voucher::findOrFail($id);
        // returnam pagina voucher_edit.blade.php si trimitem continutul variabilei $vouchers
        return view('backend.voucher.edit_voucher', compact('vouchers'));
    }
    // functia de actualizare a unui voucher in baza de date
    public function VoucherUpdate(Request $request, $id)
    {
        // validari inserare voucher in tabelul vouchers
        $request->validate(
            [
                'voucher_name' => 'required',
                'voucher_discount' => 'required',
                'voucher_validity' => 'required',
            ],
            // mesaje de eroare pt fiecare tip de validare
            [
                'voucher_name.required' => 'Numele voucher-ului este necesar.',
                'voucher_discount.required' => 'Discountul voucher-ului este necesar.',
                'voucher_validity.required' => 'Valabilitatea voucher-ului este necesara.',
            ]
        );

        // actualizam pentru vouncherul cu id
        Voucher::findOrFail($id)->update([
            'voucher_name' => strtoupper($request->voucher_name),
            'voucher_discount' => $request->voucher_discount,
            'voucher_validity' => $request->voucher_validity,
            'created_at' => Carbon::now(),

        ]);
        // adaugam notificare de succes la actualizarea voucher-ului
        $notification = array(
            'message' => 'Voucherul a fost actualizat cu succes!',
            'alert-type' => 'info'
        );
        // redirectionam la aceeasi pagina cu mesajul $notification
        return redirect()->route('manage-voucher')->with($notification);
    } // end mehtod 

    public function VoucherDelete($id)
    {
        // stergem din tabelul vouchers a inregistrarii cu id-ul $id
        Voucher::findOrFail($id)->delete();
        // adaugam notificare de succes la stergerea voucher-ului
        $notification = array(
            'message' => 'Voucherul a fost sters cu succes!',
            'alert-type' => 'info'
        );
        // redirectionam la aceeasi pagina cu mesajul $notification
        return redirect()->back()->with($notification);
    }
}