<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminProfileController extends Controller
{
    public function AdminProfile()
    {
        // $adminData preia si returneaza datele din tabela admin
        $adminData = Admin::find(1);
        // returnam view-ul cu datele din tabela admin
        return view('admin.admin_profile_view', compact('adminData'));
    }
}