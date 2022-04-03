<?php

namespace App\Http\Controllers\Frontend;

// adaugam modelul User
use App\Models\User;
use Illuminate\Http\Request;
// adaugam namespace-ul pentru clasa Auth
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        // returnam pagina principala a aplicatiei resources\views\frontend\index.blade.php
        return view('frontend.index');
    }

    // functia de logout user
    public function UserLogout()
    {
        // logout user
        Auth::logout();
        // redirect user spre pagina de login
        return Redirect()->route('login');
    }

    // functie de actualizare a datelor userului
    public function UserProfileStore(Request $request)
    {
        // $data cauta in modelul User utilizatorul autentificat si preia campul id
        $data = User::find(Auth::user()->id);
        //  $data->name of the authenticated user (DB) gets the $request->name typed in the name form field in user profile view
        // campul name din tabela users se actualizeaza cu valoarea din campul Nume si Prenume din formularul de actualizare a datelor
        $data->name = $request->name;
        //  campul email din tabela users se actualizeaza cu valoarea din campul Email din formularul de actualizare a datelor
        $data->email = $request->email;
        // campul phone din tabela users se actualizeaza cu valoarea din campul Telefon din formularul de actualizare a datelor
        $data->phone = $request->phone;

        // daca se incarca o poza de profil in campul poza de profil din formularul de actualizare a datelor
        if ($request->file('profile_photo_path')) {
            // $file primeste poza de profil din formularul de actualizare a datelor
            $file = $request->file('profile_photo_path');
            // se sterge poza de profil veche
            @unlink(public_path('upload/user_images/' . $data->profile_photo_path));
            // se genereaza un nume pentru poza de profil functie de data
            $filename = date('YmdHi') . $file->getClientOriginalName();
            // se muta poza de profil din formularul de actualizare a datelor in folderul public/upload/user_images
            $file->move(public_path('upload/user_images'), $filename);
            // se actualizeaza campul profile_photo_path din tabela users cu valoarea $filename
            $data['profile_photo_path'] = $filename;
        }
        // se salveaza in baza de date
        $data->save();

        // notificam utilizatorul ca datele au fost actualizate
        $notification = array(
            'message' => 'Datele Contului au fost actualizate cu success!',
            'alert-type' => 'success'
        );
        // redirectioam utilizatorul spre pagina de dashboard
        return redirect()->route('dashboard')->with($notification);
    }
}
