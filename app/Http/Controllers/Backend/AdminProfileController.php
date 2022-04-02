<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// pentru actualizare parola avem nevoie de Auth si Hash
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminPasswordRequest;

class AdminProfileController extends Controller
{
    // functia de vizualiare date profil admin
    public function AdminProfile()
    {
        // $adminData preia datele din tabela admins primul rand
        $adminData = Admin::find(1);
        // returnam datele in view-ul resources\views\admin\profile\admin_profile_view.blade.php
        return view('admin.profile.admin_profile_view', compact('adminData'));
    }

    // functia de editare date profil admin
    public function AdminProfileEdit()
    {
        // $adminEditData preia datele din tabela admins primul rand
        $adminEditData = Admin::find(1);
        // returnam datele in view-ul resources\views\admin\profile\admin_profile_edit.php
        return view('admin.profile.admin_profile_edit', compact('adminEditData'));
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

        // adaugam notificare cu Toastr
        $notification = array(
            'message' => 'Admin Profile Updated Succesfully',
            'alert-type' => 'success'
        );
        // returnam view-ul admin_profile_view.php cu notificare Toastr
        return redirect()->route('admin.profile')->with($notification);
    }

    // functia de modificare parola admin
    public function AdminChangePassword()
    {
        // returnam view-ul admin_change_password.php
        return view('admin.password.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request)
    {

        $request->validate(
            [
                // valoarea campului parola curenta din formular trebuie sa fie egala cu valoarea din tabela admins
                'current_password' => 'required',
                // valoarea campului parola noua din formular trebuie fie diferita de valoarea parolei curente din tabela admins si acceasi cu parola curenta
                'password' => 'required|confirmed|min:6|different:current_password',
                // valoarea campului confirmare parola noua din formular trebuie sa fie egala cu valoarea campului parola noua din formular
                'password_confirmation' => 'required|min:6|different:current_password',
            ],

            [
                //mesaje speciale daca campurile sunt goale
                'current_password.required' => 'Parola curenta nu este corecta!',
                'password.required' => 'Parola noua si confirmare parola nu sunt identice!',
                'password_confirmation.required' => 'Parola noua si confirmare parola nu sunt identice!',

                //mesaje speciale daca campurile parola noua si confirmare parola nu sunt identice
                'password.confirmed' => 'Parola noua si confirmare parola nu sunt identice!',
                'password_confirmation.confirmed' => 'Parola noua si confirmare parola nu sunt identice!',

                //mesaje speciale daca campurile parola noua si confirmare parola au mai putin de 6 caractere
                'password.min' => 'Parola trebuie sa contina minim 6 caractere!',
                'password_confirmation.min' => 'Parola trebuie sa contina minim 6 caractere!',

                // mesaje speciale daca campurile parola noua si confirmare parola sunt identice cu parola curenta
                'password.different' => 'Parola noua trebuie sa fie diferita de parola curenta!',
                'password_confirmation.different' => 'Parola noua confirmata trebuie sa fie diferita de parola curenta!',
            ]
        );
        // $hashedPassword preia valoarea din tabela admins din campul password folosind modelul Admin
        $hashedPassword = Admin::find(1)->password;
        // daca parola introdusa in campul parola curenta din formular corespunde cu parola din tabela admins
        if (Hash::check($request->current_password, $hashedPassword)) {
            // $adminData preia datele din tabela admins primul rand
            $admin = Admin::find(1);
            // valoarea campului password din tabela admins va fi egal cu valoarea hash-uita din campul password din formular folosind functia bcrypt
            $admin->password = Hash::make($request->password);
            // salvam datele in tabela admins
            $admin->save();
            // logout admin
            Auth::logout();
            // returnam view-ul admin_login.php
            return redirect()->route('admin.logout');
        } else {
            // redirectionam admin-ul la pagina precedenta
            return redirect()->back();
        }
    }
}