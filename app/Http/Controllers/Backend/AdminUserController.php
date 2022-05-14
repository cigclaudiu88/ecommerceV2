<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Carbon;

class AdminUserController extends Controller
{
    public function AllAdminRole()
    {
        // $adminuser preia toti adminii din baza de date care au type = 2
        $adminuser = Admin::where('type', 2)->latest()->get();
        // returnam pagina admin_role_all.blade.php cu datele din $adminuser
        return view('backend.admin_role.admin_role_all', compact('adminuser'));
    }
}