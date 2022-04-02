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

    // functia de actualizare date admin
    public function AdminProfileStore(Request $request)
    {
        // $adminData preia datele din tabela admins primul rand
        $data = Admin::find(1);
        // valoarea campului name din tabela admins va fi egal cu valoarea din campul name din formular
        $data->name = $request->name;
        // valoarea campului email din tabela admins va fi egal cu valoarea din campul email din formular
        $data->email = $request->email;
        // valoarea campului phone din tabela admins va fi egal cu valoarea din campul phone din formular
        $data->phone = $request->phone;

        // daca avem un fisier atasat in campul poza profil din formular
        if ($request->file('profile_photo_path')) {
            // $file primeste valoarea fisierului atasat in campul poza profil din formular
            $file = $request->file('profile_photo_path');
            // unlink (stergem) fisierul cu numele $data->profile_photo_path din folderul public/images/admin/profile_photos
            @unlink(public_path('upload/admin_images/' . $data->profile_photo_path));
            // $filename retine generarea unui nume unic pentru fisierul atasat in campul poza profil din formular folosind anul luna data ora si minut
            $filename = date('YmdHi') . $file->getClientOriginalName();
            // salvam fisierul atasat in folderul public/images/admin/profile_photos cu numele $filename unic
            $file->move(public_path('upload/admin_images'), $filename);
            // salvam numele fisierului in tabela admins
            $data['profile_photo_path'] = $filename;
        }
        // salvam datele din tabela admins
        $data->save();
        // returnam la view-ul admin_profile_view.blade.php
        return redirect()->route('admin.profile');
    }
}