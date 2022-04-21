<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Support\Carbon;

class VoucherController extends Controller
{
    public function VoucherView()
    {
        // $vouchers preia din tabelul vouchers toate inregistrarile in ordine descrescatoare dupa id
        $vouchers = Voucher::orderBy('id', 'DESC')->get();
        // returnam pagina voucher_view.blade.php si trimitem continutul variabilei $vouchers
        return view('backend.voucher.view_voucher', compact('vouchers'));
    }
}