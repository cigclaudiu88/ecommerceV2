<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminProfileController extends Controller
{
    // functia de vizualiare date profil admin
    public function AdminProfile()
    {
        // $adminData preia datele din tabela admins primul rand
        $adminData = Admin::find(1);
        // returnam datele in view-ul resources\views\admin\admin_profile_view.blade.php
        return view('admin.admin_profile_view', compact('adminData'));
    }

    // functia de editare date profil admin
    public function AdminProfileEdit()
    {
        // $adminEditData preia datele din tabela admins primul rand
        $adminEditData = Admin::find(1);
        // returnam datele in view-ul resources\views\admin\admin_profile_edit.php
        return view('admin.admin_profile_edit', compact('adminEditData'));
    }
}