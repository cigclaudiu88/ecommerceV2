<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // functie pentru a afisa pagina de rapoarte
    public function ReportView()
    {

        return view('backend.report.report_view');
    }
}