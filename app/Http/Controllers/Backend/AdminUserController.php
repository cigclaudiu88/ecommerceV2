<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    // functia pentru vizualiarea tuturor utilizatorilor admin
    public function AllAdminRole()
    {
        // $adminuser preia toti adminii din baza de date care au type = 2
        $adminuser = Admin::where('type', 2)->latest()->get();
        // returnam pagina admin_role_all.blade.php cu datele din $adminuser
        return view('backend.admin_role.admin_role_all', compact('adminuser'));
    }
    // functia pentru redirectionare spre pagina de adaugare a unui utilizator admin
    public function AddAdminRole()
    {
        // returneaza pagina admin_role_add.blade.php
        return view('backend.admin_role.admin_role_create');
    }

    public function StoreAdminRole(Request $request)
    {
        // $image preia imaginea din inputul de tip file din formularul de adaugare a unui utilizator admin
        $image = $request->file('profile_photo_path');
        // $name_gen preia numele generat al imaginii din inputul de tip file din formularul de adaugare a unui utilizator admin
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        // folosind Image cream imaginea si o salvam in folderul public/upload/admin_images/
        Image::make($image)->save('upload/admin_images/' . $name_gen);
        // $save_url preia locatia imaginii din folderul public/upload/admin_images/
        $save_url = 'upload/admin_images/' . $name_gen;

        // inseram in tabelul admins datele din formula de adaugare a unui utilizator admin
        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'profile_photo_path' => $save_url,

            'brand' => $request->brand,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'subsubcategory' => $request->subcategory,
            'product' => $request->product,
            'stock' => $request->stock,

            'slider' => $request->slider,
            'voucher' => $request->voucher,
            'shipping' => $request->shipping,
            'orders' => $request->orders,
            'return_order' => $request->return_order,

            'reports' => $request->reports,
            'alluser' => $request->alluser,
            'blog' => $request->blog,
            'review' => $request->review,
            'setting' => $request->setting,
            // adminiul principal este de tip 1
            // restul adminilor este de tip 2
            'type' => 2,
            'admin_user_role' => $request->admin_user_role,
            'created_at' => Carbon::now(),
        ]);
        // mesaje de notificare
        $notification = array(
            'message' => 'Administratorul a fost adaugat cu succes!',
            'alert-type' => 'success'
        );
        // returnam spre pagina de vizualizare a tuturor utilizatorilor admin cu mesajul de notificare
        return redirect()->route('all.admin.user')->with($notification);
    }

    // functia de editare a unui utilizator admin
    public function EditAdminRole($id)
    {
        // $adminuser preia datele unui utilizator admin dupa id-ul primit ca parametru
        $adminuser = Admin::findOrFail($id);
        // returnam pagina admin_role_edit.blade.php cu datele din $adminuser
        return view('backend.admin_role.admin_role_edit', compact('adminuser'));
    }

    // functia de actualizare a unui utilizator admin
    public function UpdateAdminRole(Request $request)
    {
        // $adminuser preia id-ul userului admin care va fi editat din campul hidden din formularul de actualizare
        $admin_id = $request->id;
        // $adminuser preia poza de profil curenta a unui utilizator admin din campul hidden din formularul de actualizare
        $old_img = $request->old_image;

        // daca exista o poza de profil actualizam toate datele + poza de profil
        if ($request->file('profile_photo_path')) {

            // stergem poza de profil veche din folderul public/upload/admin_images/
            unlink($old_img);
            // $image preia imaginea din inputul de tip file din formularul de adaugare a unui utilizator admin
            $image = $request->file('profile_photo_path');
            // $name_gen preia numele generat al imaginii din inputul de tip file din formularul de adaugare a unui utilizator admin
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            // folosind Image cream imaginea si o salvam in folderul public/upload/admin_images/
            Image::make($image)->save('upload/admin_images/' . $name_gen);
            // $save_url preia locatia imaginii din folderul public/upload/admin_images/
            $save_url = 'upload/admin_images/' . $name_gen;

            // actualizam datele din tabelul admins pentru adminul cu id-ul $admin_id
            Admin::findOrFail($admin_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'profile_photo_path' => $save_url,

                'brand' => $request->brand,
                'category' => $request->category,
                'subcategory' => $request->subcategory,
                'subsubcategory' => $request->subcategory,
                'product' => $request->product,
                'stock' => $request->stock,

                'slider' => $request->slider,
                'voucher' => $request->voucher,
                'shipping' => $request->shipping,
                'orders' => $request->orders,
                'return_order' => $request->return_order,

                'reports' => $request->reports,
                'alluser' => $request->alluser,
                'blog' => $request->blog,
                'review' => $request->review,
                'setting' => $request->setting,
                // adminiul principal este de tip 1
                // restul adminilor este de tip 2
                'type' => 2,
                'admin_user_role' => $request->admin_user_role,
                'created_at' => Carbon::now(),
            ]);
            // mesaj de notificare
            $notification = array(
                'message' => 'Administratorul a fost actualizat cu succes!',
                'alert-type' => 'info'
            );
            // returnam spre pagina de vizualizare a tuturor utilizatorilor admin cu mesajul de notificare
            return redirect()->route('all.admin.user')->with($notification);
            // daca nu exista o poza de profil actualizam doar toate datele fara poza de profil
        } else {
            // actualizam datele din tabelul admins pentru adminul cu id-ul $admin_id
            Admin::findOrFail($admin_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,

                'brand' => $request->brand,
                'category' => $request->category,
                'subcategory' => $request->subcategory,
                'subsubcategory' => $request->subcategory,
                'product' => $request->product,
                'stock' => $request->stock,

                'slider' => $request->slider,
                'voucher' => $request->voucher,
                'shipping' => $request->shipping,
                'orders' => $request->orders,
                'return_order' => $request->return_order,

                'reports' => $request->reports,
                'alluser' => $request->alluser,
                'blog' => $request->blog,
                'review' => $request->review,
                'setting' => $request->setting,
                // adminiul principal este de tip 1
                // restul adminilor este de tip 2
                'type' => 2,
                'admin_user_role' => $request->admin_user_role,
                'created_at' => Carbon::now(),

            ]);
            // mesaj de notificare
            $notification = array(
                'message' => 'Administratorul a fost actualizat cu succes!',
                'alert-type' => 'info'
            );
            // returnam spre pagina de vizualizare a tuturor utilizatorilor admin cu mesajul de notificare
            return redirect()->route('all.admin.user')->with($notification);
        }
    }
    // functia de stergere a unui utilizator admin
    public function DeleteAdminRole($id)
    {
        // $adminimg preia toate datele pentru adminul cu id-ul primit ca parametru
        $adminimg = Admin::findOrFail($id);
        // $img preia poza de profil a unui utilizator admin
        $img = $adminimg->profile_photo_path;
        // stergem poza de profil din folderul public/upload/admin_images/ pentru adminul cu id-ul $id
        unlink($img);
        // cautam adminul cu id-ul $id in tabelul admins si il stergem
        Admin::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Administratorul a fost sters cu succes!',
            'alert-type' => 'info'
        );
        // returnam spre pagina de vizualizare a tuturor utilizatorilor admin cu mesajul de notificare
        return redirect()->back()->with($notification);
    }
}