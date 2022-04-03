<?php

namespace App\Http\Controllers\Frontend;

// adaugam modelul User
use App\Models\User;
use Illuminate\Http\Request;
// adaugam namespace-ul pentru clasa Auth
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// adaugam namespace-ul pentru clasa Hash - cryptare parola
use Illuminate\Support\Facades\Hash;

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
        return Redirect()->route('welcome');
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

    public function UserProfile()
    {
        // $id salveaza id-ul utilizatorului autentificat
        $id = Auth::user()->id;
        // $user cauta in modelul User utilizatorul autentificat 
        $user = User::find($id);
        // returnam pagina de profil userului resources\views\frontend\user_profile.blade.php
        return view('frontend.profile.user_profile', compact('user'));
    }

    public function UserChangePassword()
    {
        // $id salveaza id-ul utilizatorului autentificat
        $id = Auth::user()->id;
        // $user cauta in modelul User utilizatorul autentificat 
        $user = User::find($id);
        // returnam pagina de schimbare parola a userului resources\views\frontend\user_change_password.blade.php
        return view('frontend.profile.change_password', compact('user'));
    }

    // functie de actualizare a parolei userului
    public function UserPasswordUpdate(Request $request)
    {
        // validare campurile din formular schimbare parola
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
        // $hashedPassword takes the current auth users password from DB
        $hashedPassword = Auth::user()->password;
        // if current_password typed matches the password hashed in the DB
        if (Hash::check($request->current_password, $hashedPassword)) {
            // $user takes DB info of auth user using User Model
            $user = User::find(Auth::id());
            // $user's DB password takes the password inserted in the new password field and enctypts it
            $user->password = Hash::make($request->password);
            // saves the new data to DB
            $user->save();
            // logs out logged user
            Auth::logout();
            // redirects user to /user/logout
            return redirect()->route('user.logout');
        } else {
            // returns user to the priviouse page
            return redirect()->route('dashboard');
        }
    }
}
