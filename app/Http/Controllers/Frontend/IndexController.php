<?php

namespace App\Http\Controllers\Frontend;

// adaugam modelul User
use App\Models\User;
// adaugam modelul Slider 
use App\Models\Brand;
// adaugam modelul Product
use App\Models\Review;
use App\Models\Slider;
// adaugam namespace-ul pentru clasa Hash - cryptare parola
use App\Models\Product;
use App\Models\BlogPost;
// adaugam namespace-ul pentru clasa Auth
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Wishlist;
use App\Models\SubCategory;
use App\Models\UserAddress;
use App\Models\ProductPhone;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class IndexController extends Controller
{
    public function index()
    {
        // $sliders preia din tabela sliders doar datele care au statusul 1 (activ) si le ordoneaza dupa id descendent si le limiteaza la 3 inregistrari
        $sliders = Slider::where('slider_status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        // $categories primeste toate categoriile din baza de date ordonate ascendent dupa id
        $categories = Category::orderBy('id', 'ASC')->get();
        // $products preia din tabela products doar datele care au statusul 1 (activ) si le ordoneaza dupa id descendent si le limiteaza la 10 inregistrari
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(10)->get();
        // $featured preia din tabela products doar datele care au campul featured 1 si le ordoneaza dupa id descendent si le limiteaza la 10 inregistrari
        $featured = Product::where('featured', 1)->orderBy('id', 'DESC')->inRandomOrder()->limit(3)->get();
        // $hot_deals preia din tabela products doar datele care au campul hot_deals 1 si le ordoneaza random si le limiteaza la 10 inregistrari
        $hot_deals = Product::where('hot_deal', 1)->where('discount_price', '!=', NULL)->inRandomOrder()->limit(10)->get();
        // $special_offer preia din tabela products doar datele care au campul special_offer 1 si le ordoneaza dupa id descendent si le limiteaza la 10 inregistrari            
        $special_offer = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(10)->get();
        // $special_deals preia din tabela products doar datele care au campul special_deals 1 si le ordoneaza dupa id descendent si le limiteaza la 10 inregistrari
        $special_deals = Product::where('special_deal', 1)->orderBy('id', 'DESC')->limit(10)->get();
        // $skip_subsubcategory_0 foloseste modelul Category pentru sa sari peste o categorie si preia datele urmatoarei categorii skip(0) - prima categorie skip(1) - a doua categorie skip(2) - a treia categorie etc
        // aici preia subsubcategoria cu id-ul 3 -> telefoane
        $skip_subsubcategory_0 = SubSubCategory::skip(2)->first();
        // $skip_product_0 foloseste modelul Product pentru a preluat doar acele inregistrari care au status = 1 din tabelul products
        // si unde category_id (products) corespunde $skip_subsubcategory_0->id, ordoneaza dupa id Descending
        // aici preia produsele care au subsubcategory_id = id-ul din $skip_subsubcategory_0 adica 3 -> telefoane
        $skip_product_0 = Product::where('status', 1)->where('subsubcategory_id', $skip_subsubcategory_0->id)->orderBy('id', 'DESC')->get();
        // $skip_category useses Category Model to skip and get the first id of categories table if skip(0) - change skip() value to display different categories
        // $skip_category_2 preia din tabela categories a treia categorie
        $skip_category_2 = Category::skip(2)->first();
        // $skip_product_2 foloseste modelul Product pentru a preluat doar acele inregistrari care au status = 1 din tabelul products
        // si unde category_id (products) corespunde $skip_category_2->id, ordoneaza dupa id Descending
        $skip_product_2 = Product::where('status', 1)->where('category_id', $skip_category_2->id)->orderBy('id', 'DESC')->get();
        // sarit branduri -> produse
        // $skip_brand_0 Brand Model to skip and get the first id of brands table if skip(0) - change skip() value to display different categories
        $skip_brand_0 = Brand::skip(0)->first();
        // $skip_brand_product_0 foloseste modelul Product pentru a preluat doar acele inregistrari care au status = 1 din tabelul products
        // si unde brand_id (products) corespunde $skip_brand_0->id, ordoneaza dupa id Descending
        $skip_brand_product_0 = Product::where('status', 1)->where('brand_id', $skip_brand_0->id)->orderBy('id', 'DESC')->get();
        // blogpost preia toate postarile din tabelul blog_posts
        $blogpost = BlogPost::with('category')->latest()->get();
        // verificam daca utilizatorul este autentificat
        if (Auth::check()) {
            // daca este autentificat $wishlist_products preia din tabelul wishlist (cu functia product din model)
            // toate produsele din wishlist ale utilizatorului logat (adica unde user_id = id-ul utilizatorului logat)
            $wishlist_products = Wishlist::with('product')->where('user_id', Auth::user()->id)->get();
        } else {
            // daca nu este autentificat $wishlist_products array gol
            $wishlist_products = [];
        }
        $brand_logo = Brand::all();

        // returnam pagina principala a aplicatiei resources\views\frontend\index.blade.php cu datele din variabilele $sliders si $categories
        return view('frontend.index', compact('categories', 'sliders', 'products', 'featured', 'hot_deals', 'special_offer', 'special_deals', 'skip_subsubcategory_0', 'skip_product_0', 'skip_category_2', 'skip_product_2', 'skip_brand_0', 'skip_brand_product_0', 'blogpost', 'wishlist_products', 'brand_logo'));
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

    public function UserProfileAddress()
    {
        // $id salveaza id-ul utilizatorului autentificat
        $id = Auth::user()->id;
        // $user cauta in modelul User utilizatorul autentificat 
        $user = User::find($id);
        // address preia din tabela useraddresses adresa utilizatorului autentificat
        // dupa inregistrare utilizator acesta variabila este goala
        $address = UserAddress::where('user_id', $id)->first();
        // $divions preia lista judetelor din tabelul shipdivisions
        $divisions = ShipDivision::all();
        // $districts preia lista oraselor din tabelul districts
        $districts = ShipDistrict::with('division')->get();
        // returnam pagina de profil userului resources\views\frontend\user_profile_address.blade.php
        return view('frontend.profile.user_profile_address', compact('user', 'divisions', 'districts', 'address',));
    }

    public function GetCity($state_id)
    {
        // $state preia din tabelul divisions judetul selectat
        $state = ShipDivision::where('division_name', $state_id)->first();
        // preluam in variabila $cities acele localitati care au division_id = $state_id primit ca parametru
        $cities = ShipDistrict::where('division_id', $state->id)->orderBy('district_name', 'ASC')->get();
        // returnam un json cu datele din $cities
        return response()->json($cities);
    }

    public function UserProfileAddressStore(Request $request)
    {
        // $id salveaza id-ul utilizatorului autentificat
        $id = Auth::user()->id;
        // validare campurile din formular adresa de livrare
        $request->validate(
            [
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:3',
                'phone' => 'required',
                'state' => 'required',
                'city' => 'required',
                'street' => 'required',
                'street_number' => 'required',
            ],
            // mesaje pentru inserarea datelor
            [
                'first_name.required' => 'Numele este obligatoriu!',
                'first_name.min' => 'Numele trebuie sa contina minim 3 caractere!',
                'last_name.required' => 'Prenumele este obligatoriu!',
                'last_name.min' => 'Prenumele trebuie sa contina minim 3 caractere!',
                'phone.required' => 'Numarul de telefon este obligatoriu!',
                'state.required' => 'Judetul este obligatoriu!',
                'city.required' => 'Orasul este obligatoriu!',
                'street.required' => 'Strada este obligatorie!',
                'street_number.required' => 'Numarul strazii este obligatoriu!',
            ]
        );

        // se insereaza in tabelul useraddresses adresa utilizatorului autentificat
        UserAddress::insert([
            'user_id' => $id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'state' => $request->state,
            'city' => $request->city,
            'street' => $request->street,
            'street_number' => $request->street_number,
            'building' => $request->building,
            'apartment' => $request->apartment,
        ]);

        // adaugam notificare de succes la inserarea subcategoriei de produse
        $notification = array(
            'message' => 'Adresa de livrare a fost adaugata cu succes!',
            'alert-type' => 'success'
        );
        // redirectionam la aceeasi pagina cu mesajul $notification
        return redirect()->back()->with($notification);
    }

    public function UserProfileAddressUpdate(Request $request)
    {
        // $id salveaza id-ul utilizatorului autentificat
        $address_id = $request->id;
        // validare campurile din formular adresa de livrare
        $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'state' => 'required',
                'city' => 'required',
                'street' => 'required',
                'street_number' => 'required',
            ],
            // mesaje pentru inserarea datelor
            [
                'first_name.required' => 'Numele este obligatoriu!',
                'last_name.required' => 'Prenumele este obligatoriu!',
                'phone.required' => 'Numarul de telefon este obligatoriu!',
                'state.required' => 'Judetul este obligatoriu!',
                'city.required' => 'Orasul este obligatoriu!',
                'street.required' => 'Strada este obligatorie!',
                'street_number.required' => 'Numarul strazii este obligatoriu!',
            ]
        );

        // se insereaza in tabelul useraddresses adresa utilizatorului autentificat
        UserAddress::findOrFail($address_id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'state' => $request->state,
            'city' => $request->city,
            'street' => $request->street,
            'street_number' => $request->street_number,
            'building' => $request->building,
            'apartment' => $request->apartment,
        ]);

        // adaugam notificare de succes la inserarea subcategoriei de produse
        $notification = array(
            'message' => 'Adresa de livrare a fost actualizata cu succes!',
            'alert-type' => 'success'
        );
        // redirectionam la aceeasi pagina cu mesajul $notification
        return redirect()->back()->with($notification);
    }
    // functia de redirectare la pagina de detalii produse
    public function ProductDetails($id, $slug)
    {
        // $product preia datele din tabela products aferenta id-ului primit ca parametru
        $product = Product::findOrFail($id);
        // $multiImage preia datele din tabela multimgs aferenta id-ului primit ca parametru unde product_id (tabel multiimages ) = id (tabel products)
        $multiImage = MultiImg::where('product_id', $id)->get();
        // $subsubcat_id preia id-ul subsubcategoriei din tabela products aferenta id-ului primit ca parametru
        $subsubcat_id = $product->subsubcategory_id;
        // $relatedProduct preia din tabela products produsele care au acelasi subsubcategory_id ca $subsubcat_id
        // si unde id-ul nu este egal cu id-ul produsului care a fost selectat pentru a nu afisa in produse similare produsul selectat
        $relatedProduct = Product::where('subsubcategory_id', $subsubcat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->get();

        $subcat_id = $product->subcategory_id;

        $relatedProductAccesories = Product::where('subcategory_id', $subcat_id)->where('subsubcategory_id', '>', $subsubcat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->get();

        // returnam pagina de detalii produse cu datele produsului din tabela products
        return view('frontend.product.product_details', compact('product', 'multiImage', 'relatedProduct', 'relatedProductAccesories'));
    }

    // functia de afisare a produselor functie de subcategorie
    public function SubCategoryWiseProduct($subcategory_id, $slug)
    {
        // products gets active products (status = 1) where subcategory_id (products tabale) matches $subcategory_id (requested)
        // $products preia din tabela products acele intregistrarile care au statusul 1 
        // si subcategory_id aceeasi cu cea primita ca parametru $subcategory_id ordonate dupa id desc si paginate la 10
        $products = Product::where('status', 1)->where('subcategory_id', $subcategory_id)->orderBy('id', 'DESC')->paginate(9);
        // $subcategory preia datele din tabela subcategories aferenta id-ului primit ca parametru
        $categories = Category::orderBy('id', 'ASC')->get();
        // $breadsubcat preia din tabela subcategories datele aferente id-ului primit ca parametru cu access la coloanele tabelului categories
        $breadsubcat = SubCategory::with(['category'])->where('id', $subcategory_id)->get();

        // SECTIUNE SORTARE PRODUSE
        if (request()->get('sort') == 'price_asc') {
            $products = Product::where('status', 1)->where('subcategory_id', $subcategory_id)->orderBy('selling_price', 'ASC')->paginate(9);
        } elseif (request()->get('sort') == 'price_desc') {
            $products = Product::where('status', 1)->where('subcategory_id', $subcategory_id)->orderBy('selling_price', 'DESC')->paginate(9);
        } elseif (request()->get('sort') == 'newest') {
            $products = Product::where('status', 1)->where('subcategory_id', $subcategory_id)->orderBy('created_at', 'DESC')->paginate(9);
        } elseif (request()->get('sort') == 'recommended') {
            $products = Product::where('status', 1)->where('subcategory_id', $subcategory_id)->where('featured', 1)->orderBy('product_name', 'ASC')->paginate(9);
        }
        // SECTIUNE SORTARE PRODUSE

        // SECTIUNE FILTRARE BRAND
        $brand_filters = Product::with('brand')->select('brand_id')->where('subcategory_id', $subcategory_id)->distinct('brand_id')->get();

        if (request()->get('filterbrand')) {

            $checked = $_GET['filterbrand'];

            $brands_filters = Brand::whereIN('brand_name', $checked)->get();
            $brand_id = [];
            foreach ($brands_filters as $brand_filter) {
                array_push($brand_id, $brand_filter->id);
            }
            $products = Product::where('status', 1)->whereIN('brand_id', $brand_id)->where('subcategory_id', $subcategory_id)->orderBy('id', 'DESC')->paginate(9);
        }
        // SECTIUNE FILTRARE BRAND


        // SECTIUNE FILTRARE PHONE DISPLAY
        $display_filters = ProductPhone::select('phone_display')->whereHas('product', function ($q) use ($subcategory_id) {
            $q->where('subcategory_id', '=', $subcategory_id);
        })->distinct('phone_display')->get();

        if (request()->get('filterdisplay')) {

            $checked = $_GET['filterdisplay'];

            $products = Product::where('status', 1)->whereHas('product_phone', function ($q) use ($checked) {
                $q->whereIn('phone_display', $checked);
            })->where('subcategory_id', $subcategory_id)->orderBy('id', 'DESC')->paginate(9);
        }
        // SECTIUNE FILTRARE PHONE DISPLAY

        // SECTIUNE FILTRARE PRET MIN MAX
        if (request()->get('form_min')) {
            $min = round(request()->get('form_min') / 1.19, 2);
            $max = round(request()->get('form_max') / 1.19, 2);

            // pretul introduse de utilizator in min / max este pretul u tva in products selling_price e fara TVA de aia trebuie sa scadem pretul de TVA in whereBetween
            $products = Product::where('status', 1)->where('subcategory_id', $subcategory_id)->whereBetween('selling_price', [$min, $max])->orderBy('id', 'DESC')->paginate(9);
        }
        // SECTIUNE FILTRARE PRET MIN MAX

        // returnam pagina de produse functie de subcategorie cu datele din variabila $products $categories si $breadsubcat
        return view('frontend.product.subcategory_view', compact('products', 'categories', 'breadsubcat', 'brand_filters', 'display_filters'));
    }
    // functia de afisare a produselor functie de subsubcategorie
    public function SubSubCategoryWiseProduct($subsubcategory_id, $slug)
    {
        // $products preia din tabela products acele intregistrarile care au statusul 1 
        // si subcategory_id aceeasi cu cea primita ca parametru $subcategory_id ordonate dupa id desc si paginate la 10
        $products = Product::where('status', 1)->where('subsubcategory_id', $subsubcategory_id)->orderBy('id', 'DESC')->paginate(9);
        // $subcategory preia datele din tabela subcategories aferenta id-ului primit ca parametru
        $categories = Category::orderBy('id', 'ASC')->get();
        // $breadsubcat preia din tabela subsubcategories datele aferente id-ului primit ca parametru cu access la coloanele tabelului categories si subcategories
        $breadsubsubcat = SubSubCategory::with(['category', 'subcategory'])->where('id', $subsubcategory_id)->get();

        // SECTIUNE SORTARE PRODUSE
        if (request()->get('sort') == 'price_asc') {
            $products = Product::where('status', 1)->where('subsubcategory_id', $subsubcategory_id)->orderBy('selling_price', 'ASC')->paginate(9);
        } elseif (request()->get('sort') == 'price_desc') {
            $products = Product::where('status', 1)->where('subsubcategory_id', $subsubcategory_id)->orderBy('selling_price', 'DESC')->paginate(9);
        } elseif (request()->get('sort') == 'newest') {
            $products = Product::where('status', 1)->where('subsubcategory_id', $subsubcategory_id)->orderBy('created_at', 'DESC')->paginate(9);
        } elseif (request()->get('sort') == 'recommended') {
            $products = Product::where('status', 1)->where('subsubcategory_id', $subsubcategory_id)->where('featured', 1)->orderBy('product_name', 'ASC')->paginate(9);
        }
        // SECTIUNE SORTARE PRODUSE

        // SECTIUNE FILTRARE BRAND
        $brand_filters = Product::with('brand')->select('brand_id')->where('subsubcategory_id', $subsubcategory_id)->distinct('brand_id')->get();

        if (request()->get('filterbrand')) {

            $checked = $_GET['filterbrand'];

            $brands_filters = Brand::whereIN('brand_name', $checked)->get();
            $brand_id = [];
            foreach ($brands_filters as $brand_filter) {
                array_push($brand_id, $brand_filter->id);
            }
            $products = Product::where('status', 1)->whereIN('brand_id', $brand_id)->where('subsubcategory_id', $subsubcategory_id)->orderBy('id', 'DESC')->paginate(9);
        }
        // SECTIUNE FILTRARE BRAND

        // SECTIUNE FILTRARE PHONE DISPLAY
        $display_filters = ProductPhone::select('phone_display')->whereHas('product', function ($q) use ($subsubcategory_id) {
            $q->where('subsubcategory_id', '=', $subsubcategory_id);
        })->distinct('phone_display')->get();

        if (request()->get('filterdisplay')) {

            $checked = $_GET['filterdisplay'];

            $products = Product::where('status', 1)->whereHas('product_phone', function ($q) use ($checked) {
                $q->whereIn('phone_display', $checked);
            })->where('subsubcategory_id', $subsubcategory_id)->orderBy('id', 'DESC')->paginate(9);
        }
        // SECTIUNE FILTRARE PHONE DISPLAY

        // SECTIUNE FILTRARE PRET MIN MAX
        if (request()->get('form_min')) {
            $min = round(request()->get('form_min') / 1.19, 2);
            $max = round(request()->get('form_max') / 1.19, 2);

            // pretul introduse de utilizator in min / max este pretul u tva in products selling_price e fara TVA de aia trebuie sa scadem pretul de TVA in whereBetween
            $products = Product::where('status', 1)->where('subsubcategory_id', $subsubcategory_id)->whereBetween('selling_price', [$min, $max])->orderBy('id', 'DESC')->paginate(9);
        }
        // SECTIUNE FILTRARE PRET MIN MAX

        //  returnam pagina de produse functie de subsubcategorie cu datele din variabila $products $categories si $breadsubsubcat
        return view('frontend.product.subsubcategory_view', compact('products', 'categories', 'breadsubsubcat', 'brand_filters', 'display_filters'));
    }

    // functia de afisare a produselor in modal
    public function ProductViewModalAjax($id)
    {
        // $product preia datele din tabela products aferenta id-ului primit ca parametru
        $product = Product::findOrFail($id);
        //  $product prea id-ul produsului din tabela products folosind functile category, subsubcategory si brand din Modelul Product
        $product = Product::with('category', 'brand', 'subsubcategory')->findOrFail($id);

        $multiImage = MultiImg::where('product_id', $id)->get();
        // $color = $product->product_color;
        // $product_color = explode(',', $color);

        // $size = $product->product_size;
        // $product_size = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'multiImage' => $multiImage,
            // 'color' => $product_color,
            // 'size' => $product_size,

        ));
    }

    // functia de cautare produse si afisare in frontend
    public function ProductSearch(Request $request)
    {
        // campul de cautare din bara de cautare trebuie sa fie completat pentru a cauta produse
        $request->validate(["search" => "required"]);

        // $item preia valoarea din input-ul de cautare
        $item = $request->search;
        // echo "$item";
        //$categories preia din tabelul categories toate categoriile si le ordoneaza ascendent dupa nume
        $categories = Category::orderBy('category_name', 'ASC')->get();
        // $products preia din tabelul products toate produsele care au numele care contine valoarea din variabila $item
        $products = Product::where('product_name', 'LIKE', "%$item%")->paginate(9);

        // returnam pagina de cautare cu datele din variabila $products si $categories
        return view('frontend.product.search', compact('products', 'categories'));
    }
    // functia pentru cautare avansata de produse in frontpage bara de cautare
    public function SearchProduct(Request $request)
    {
        // campul de cautare din bara de cautare trebuie sa fie completat pentru a cauta produse
        $request->validate(["search" => "required"]);
        // $item preia valoarea din input-ul de cautare
        $item = $request->search;
        // $products preia din tabelul products toate produsele care au numele care contine valoarea din variabila $item
        // selecteaza doar campurile product_name si product_thumbnail	 pentru afisarea in sugestii limitat la 5
        $products = Product::where('product_name', 'LIKE', "%$item%")->select('product_name', 'product_thumbnail', 'selling_price', 'id', 'product_slug', 'discount_price')->limit(5)->get();
        // returnam pagina de sugestii cautare cu datele din variabila $products
        return view('frontend.product.search_product', compact('products'));
    }
}