<?php

namespace App\Http\Controllers\Frontend;

// adaugam modelul Product
use App\Models\User;
// adaugam modelul Cart
use App\Models\Product;
use App\Models\Voucher;
use App\Models\Wishlist;
use App\Models\UserAddress;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    // functia de adaugare in cosul de cumparaturi
    public function AddToCart(Request $request, $id)
    {
        // cand adaugam un produs in pagina cosului de cumparaturi 
        // daca sesiunea are voucher, atunci il stergem
        if (Session::has('voucher')) {
            Session::forget('voucher');
        }

        // $product preia id-ul produsului din tabelul products folosind modelul Product si functia findorfail()
        $product = Product::findOrFail($id);
        if ($product->product_quantity == 0 || ($product->product_quantity - $product->blocked_quantity) < $request->quantity || $request->quantity < 1) {
            return response()->json(['error' => 'Stocul produsului este insuficient sau epuizat']);
        }
        // daca produsul nu are discount, atunci in cos se adauga pretul de vanzare (selling_price)
        else if ($product->discount_price == NULL) {
            // adaugam in cosul de cumparaturi produsul cu toate datele
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => $product->product_quantity,
                'options' => [
                    'image' => $product->product_thumbnail,
                    // 'color' => $request->color,
                    // 'size' => $request->size,
                ],
            ]);

            Product::where('id', $id)
                // scadem stocul produselor din tabelul products cu cantitatea produselor din comanda
                ->update(['blocked_quantity' => DB::raw('blocked_quantity+' . $request->quantity)]);

            // returnam mesajul de succes
            return response()->json(['success' => 'Adaugat cu success in Cosul de Cumparaturi']);
            // daca produsul are discount, atunci in cos se adauga pretul de discount (discount_price)
        } else {

            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => $product->product_quantity,
                'options' => [
                    'image' => $product->product_thumbnail,
                    // 'color' => $request->color,
                    // 'size' => $request->size,
                ],
            ]);

            Product::where('id', $id)
                // scadem stocul produselor din tabelul products cu cantitatea produselor din comanda
                ->update(['blocked_quantity' => DB::raw('blocked_quantity+' . $request->quantity)]);

            // returnam mesajul de succes
            return response()->json(['success' => 'Adaugat cu success in Cosul de Cumparaturi']);
        }
    }

    // functia de adaugare in mini cosul de cumparaturi
    public function AddMiniCart()
    {
        // $carts preia toate produsele din mini cosul de cumparaturi
        $carts = Cart::content();
        // $carQty preia numarul total de produse din mini cosul de cumparaturi
        $cartQty = Cart::count();
        // $cartSubtotal preia pretul total al produselor din mini cosul de cumparaturi fara TVA
        if (Session::has('voucher')) {
            $cartSubTotal = number_format(Cart::priceTotalFloat(), 2, '.', ',');
        } else {
            $cartSubTotal = number_format(Cart::subtotalFloat(), 2, '.', ',');
        }
        // $cartTax preia TVA-ul total al produselor din mini cosul de cumparaturi
        $cartTax = number_format(Cart::taxFloat(), 2, '.', ',');
        // $cartTotal preia pretul total al produselor din mini cosul de cumparaturi cu tot cu tva
        $cartTotal = number_format(Cart::totalFloat(), 2, '.', ',');

        // returnam toate datele in format json
        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartSubTotal' => $cartSubTotal,
            'cartTax' => $cartTax,
            'cartTotal' => $cartTotal,

        ));
    }
    // functia de stergere produse dini minicart
    public function RemoveMiniCart($rowId)
    {
        $cart_product_id = Cart::get($rowId)->id;
        $cart_product_quantity = Cart::get($rowId)->qty;
        Product::where('id', $cart_product_id)
            // scadem stocul produselor din tabelul products cu cantitatea produselor din comanda
            ->update(['blocked_quantity' => DB::raw('blocked_quantity-' . $cart_product_quantity)]);

        // cand adaugam un produs in pagina cosului de cumparaturi 
        // daca sesiunea are voucher, atunci il stergem
        if (Session::has('voucher')) {
            // scoatem voucherul din sesiune
            Session::forget('voucher');
            // returnam mesajul de succes ca voucherul a fost sters cu success
            Cart::remove($rowId);
            // returnam mesajul de succes
            return response()->json(['success' => 'Produsul si voucherul au fost sters cu success din Cosul de Cumparaturi']);
        } else {
            Cart::remove($rowId);
            // returnam mesajul de succes
            return response()->json(['success' => 'Produsul a fost sters cu success din Cosul de Cumparaturi']);
        }
    }

    // functia de adaugare produse in wishlist
    public function AddToWishlist(Request $request, $product_id)
    {
        // pentru a avea acces la functionalitatea de wishlist utilizatorul trebuie sa fie autentificat
        // verificam daca userul este autentificat
        if (Auth::check()) {

            // $exists preia din tabelul wishlists pentru utilizatorul autentificat produsul cu id-ul $product_id
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            // adaugam in tabelul wishlists user_id-ul utilizatorului autentificat si in product_id-ul produsului cu id-ul $product_id
            // daca produsul nu exista in wishlist, atunci il adaugam
            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Produsul a fost adaugat cu success in Wishlist']);
                // daca produsul exista in wishlist, atunci afisam mesajul de eroare
            } else {
                return response()->json(['error' => 'Produsul exista deja in Wishlist']);
            }
            //  daca utilizatorul nu este autentificat, atunci afisam mesajul de eroare daca doreste sa adauge produsul in wishlist
        } else {

            return response()->json(['error' => 'Trebuie sa fii autentificat pentru a adauga produsul in Wishlist']);
        }
    }

    // functia de aplicare Voucher in cosul de cumparaturi
    public function VoucherApply(Request $request)
    {
        // $voucher preia din tabelul vouchers acel voucher pentru care numele din tabel = numele voucherului introduse de utilizator in campul voucher din formularul de aplicare voucher
        // pentru acele voucher-uri care au perioada de valabilitate mai mare de ziua de azi, atunci se aplica voucherul
        $voucher = Voucher::where('voucher_name', $request->voucher_name)->where('voucher_validity', '>=', Carbon::now()->format('Y-m-d'))->first();
        if ($voucher) {

            $voucherDiscount = $voucher->voucher_discount;
            $voucherName = $voucher->voucher_name;

            Session::put('voucher', [
                'voucher_name' => $voucherName,
                // pretul inainte de voucher si tva
                'subtotal' => round(Cart::priceTotalFloat(), 2),
                // setarea discountului in functie de voucher
                'voucher_discount' => Cart::setGlobalDiscount($voucherDiscount),
                // pretul dupa voucher
                'discount_amount' => round(Cart::discountFloat(), 2),
                // pretul dupa voucher cu tva
                'tax' => round(Cart::taxFloat(), 2),
                // pretul total dupa voucher cu tva
                'grandtotal' => round(Cart::totalFloat(), 2),
            ]);
            return response()->json(array(
                'validity' => true,
                'success' => 'Voucherul a fost aplicat cu success',
            ));
        } else {
            return response()->json(['error' => 'Voucherul nu este valid sau a expirat']);
        }
    }

    // functia de caulcuarea voucherului in cosul de cumparaturi
    public function VoucherCalculation()
    {
        // daca sesiunea are voucher, atunci calculam pretul total al produselor din cosul de cumparaturi cu voucher
        if (Session::has('voucher')) {
            return response()->json(array(
                'voucher_name' => session()->get('voucher')['voucher_name'],
                'subtotal' => session()->get('voucher')['subtotal'],
                'discount_amount' => session()->get('voucher')['discount_amount'],
                'tax' => session()->get('voucher')['tax'],
                'grandtotal' => session()->get('voucher')['grandtotal'],
            ));
            // daca nu avem voucher calculam pretul total al produselor din cosul de cumparaturi fara voucher
        } else {
            return response()->json(array(
                'subtotal' => round(Cart::priceTotalFloat(), 2),
                'voucher_discount' => round(Cart::setGlobalDiscount(0), 2),
                'tax' => round(Cart::taxFloat(), 2),
                'total' => round(Cart::totalFloat(), 2),
            ));
        }
    }
    // functia de stergere voucherului din cosul de cumparaturi
    public function voucherRemove()
    {
        if (Session::has('voucher')) {
            // scoatem voucherul din sesiune
            Session::forget('voucher');
            // returnam mesajul de succes ca voucherul a fost sters cu success
            return response()->json(['success' => 'Voucherul a fost sters cu success']);
        }
    }

    // functia de Spre Casa
    public function CheckoutCreate()
    {
        // verificam daca utilizatorul este autentificat
        if (Auth::check()) {
            // $id salveaza id-ul utilizatorului autentificat
            $id = Auth::user()->id;
            // $user cauta in modelul User utilizatorul autentificat 
            $user = User::find($id)->first();
            // address preia din tabela useraddresses adresa utilizatorului autentificat
            // dupa inregistrare utilizator acesta variabila este goala
            // de asemenea foloseste functia user() din modelul UserAddress pentru a accesa campurile din tabelul users $var->user->email etc
            $address = UserAddress::with('user', 'district')->where('user_id', $id)->first();
            // $divions preia lista judetelor din tabelul shipdivisions
            $divisions = ShipDivision::all();
            // $districts preia lista oraselor din tabelul districts
            $districts = ShipDistrict::with('division')->get();
            // daca utilizatorul este autentificat, iar cosul de de cumparaturi nu este gol, atunci afisam formularul de checkout
            if (Cart::total() > 0) {
                // daca sesiunea are voucher afisam totalurile cu voucher
                if (Session::has('voucher')) {
                    // $carts preia toate produsele din cosul de cumparaturi
                    $carts = Cart::content();
                    // $cartQty preia numarul de produse din cosul de cumparaturi
                    $cartQty = Cart::count();
                    // $cartTotal preia pretul subtotal al produselor din cosul de cumparaturi inainte de voucher si tva
                    $cartSubTotal = round(Cart::priceTotalFloat(), 2);
                    // $cartTax preia TVA al produselor din cosul de cumparaturi dupa voucher
                    $cartTax = round(Cart::taxFloat(), 2);
                    // $cartTotal preia pretul total al produselor din cosul de cumparaturi dupa voucher si tva
                    $cartTotal = round(Cart::totalFloat(), 2);
                    // returnam pagina de casa in care trimitem datele din variabilele $carts, $cartQty, $cartTotal
                    return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartSubTotal', 'cartTax', 'cartTotal', 'address', 'divisions', 'districts'));
                }
                // daca sesiunea nu voucher afisam totalurile fara voucher
                else {
                    // $carts preia toate produsele din cosul de cumparaturi
                    $carts = Cart::content();
                    // $cartQty preia numarul de produse din cosul de cumparaturi
                    $cartQty = Cart::count();
                    // $cartTotal preia  subtotal al produselor din cosul de cumparaturi
                    $cartSubTotal = round(Cart::subtotalFloat(), 2);
                    // $cartTax preia TVA al produselor din cosul de cumparaturi
                    $cartTax = round(Cart::taxFloat(), 2);
                    // $cartTotal preia totalul produselor din cosul de cumparaturi cu TVA
                    $cartTotal = round(Cart::totalFloat(), 2);
                    // returnam pagina de casa in care trimitem datele din variabilele $carts, $cartQty, $cartTotal
                    return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartSubTotal', 'cartTax', 'cartTotal', 'address', 'divisions', 'districts'));
                }
            } else {

                $notification = array(
                    'message' => 'Trebuie sa ai produse in cos pentru a merge spre Casa',
                    'alert-type' => 'error'
                );
                return redirect()->to('/')->with($notification);
            }
        }
        // daca utilizatorul nu este autentificat afisam mesaj si redirectionam spre pagina de autentificare
        else {
            $notification = array(
                'message' => 'Trebuie sa fii autentificat pentru a cumpara produse din magazin.',
                'alert-type' => 'error'
            );
            // redirectionam utilizatorul (clientul) spre pagina de autentificare cu 
            return redirect()->route('login')->with($notification);
        }
    }
}