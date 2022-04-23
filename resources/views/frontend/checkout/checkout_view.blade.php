@extends('frontend.main_master')
@section('content')

    {{-- ajax jquerry CDN pentru scriptul de validare judet-localitate --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@section('title')
    Casa
@endsection
<!--breadcrumbs area start-->
{{-- <div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Acasa</h3>
                    <ul>
                        <li><a href="index.html">Acasa</a></li>
                        <li>Casa</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!--breadcrumbs area end-->

<!--Checkout page section-->
<div class="Checkout_section mt-70">
    <div class="container">
        <div class="row">

        </div>
        <div class="checkout_form">
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="coupon_code right">
                        <div class="coupon_inner" style="padding: 0px 0px 0px !important; ">
                            <div class="checkout_btn" style="text-align:left !important;">
                                <a href="{{ route('mycart') }}">Inapoi Spre Cosul de
                                    Cumparaturi</a>
                            </div>
                        </div>
                    </div>
                    <form action="#">
                        <h3>Produse din Comanda</h3>
                        <div class="order_table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Poza</th>
                                        <th>Produs</th>
                                        <th>Cantitate</th>
                                        <th>Pret Unitar</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- iteram cu $carts din CheckoutCreate() din CartController pentru a afisa datele (poza,nume,cantitate,pret,total) produselor din cos --}}
                                    {{-- valorile provind din AddToCart() din CartController Cart::Add --}}
                                    @foreach ($carts as $item)
                                        <tr>
                                            <td> <img src="{{ asset($item->options->image) }}" alt=""
                                                    style="height: 100px; width: 100px;"></td>
                                            <td> {{ $item->name }}</td>
                                            <td> {{ $item->qty }}</td>
                                            <td> {{ number_format($item->price, 2, '.', ',') }} RON</td>
                                            <td> {{ number_format($item->qty * $item->price, 2, '.', ',') }} RON</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- afisam subtotalul,tva si total din functia CheckoutCreate() din CartController --}}
                                <tfoot>
                                    {{-- daca sesiunea are voucher afisam subtotal inainte de voucher si tva,nume voucher,reducere voucher si total --}}
                                    @if (Session::has('voucher'))
                                        <tr>
                                            {{-- preluam din variabila $cartSubTotal din CheckoutCreate() din CartController subtotalul inainte de voucher --}}
                                            <th colspan="3" style="text-align:right !important;">Subtotal</th>
                                            <td colspan="3" style="text-align:right !important;">
                                                <strong>{{ $cartSubTotal }} RON</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            {{-- preluam din sesiune numele voucherului (voucherapply() vouchercalculation() din CartController) --}}
                                            <th colspan="3" style="text-align:right !important;">Voucher</th>
                                            <td colspan="3" style="text-align:right !important;">
                                                <strong>{{ session()->get('voucher')['voucher_name'] }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            {{-- preluam din sesiune reducerea voucherului (voucherapply() vouchercalculation() din CartController) --}}
                                            <th colspan="3" style="text-align:right !important;">Reducere</th>
                                            <td colspan="3" style="text-align:right !important;" class="text-danger">
                                                <strong>- {{ session()->get('voucher')['discount_amount'] }}
                                                    RON</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            {{-- preluam din variabila $cartTax din CheckoutCreate() din CartController tva dupa de voucher --}}
                                            <th colspan="3" style="text-align:right !important;">TVA</th>
                                            <td colspan="3" style="text-align:right !important;">
                                                <strong>{{ $cartTax }} RON</strong>
                                            </td>
                                        </tr>
                                        {{-- preluam din variabila $cartTotal din CheckoutCreate() din CartController total dupa voucher si tva --}}
                                        <tr class="order_total">
                                            <th colspan="3" style="text-align:right !important;">Total</th>
                                            <td colspan="3" style="text-align:right !important;">
                                                <strong>{{ $cartTotal }} RON</strong>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            {{-- preluam din variabila $cartSubTotal din CheckoutCreate() din CartController subtotal fara voucher --}}
                                            <th colspan="3" style="text-align:right !important;">Subtotal</th>
                                            <td colspan="3" style="text-align:right !important;">
                                                <strong>{{ $cartSubTotal }} RON</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            {{-- preluam din variabila $cartTax din CheckoutCreate() din CartController tva fara voucher --}}
                                            <th colspan="3" style="text-align:right !important;">TVA</th>
                                            <td colspan="3" style="text-align:right !important;">
                                                <strong>{{ $cartTax }} RON</strong>
                                            </td>
                                        </tr>
                                        {{-- preluam din variabila $cartTotal din CheckoutCreate() din CartController total cu tva si fara voucher --}}
                                        <tr class="order_total">
                                            <th colspan="3" style="text-align:right !important;">Total</th>
                                            <td colspan="3" style="text-align:right !important;">
                                                <strong>{{ $cartTotal }} RON</strong>
                                            </td>
                                        </tr>
                                    @endif

                                </tfoot>
                            </table>
                        </div>

                    </form>
                </div>


                <div class="col-lg-12 col-md-6">
                    {{-- adaugat ruta pt formularul de adresa livrare --}}
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <h3>Adresa de Livrare</h3>
                        <div class="row">

                            <div class="col-lg-6 mb-20">
                                <label>Nume Destinatar <span>*</span></label>
                                <input type="text" name="shipping_first_name" value="{{ $address->first_name }}">
                            </div>

                            <div class="col-lg-6 mb-20">
                                <label>Prenume Destinatar <span>*</span></label>
                                <input type="text" name="shipping_last_name" value="{{ $address->last_name }}">
                            </div>

                            <div class="col-lg-6 mb-20">
                                <label>Numar Telefon<span>*</span></label>
                                <input type="text" name="shipping_phone" value="{{ $address->phone }}">
                            </div>

                            <div class="col-lg-6 mb-20">
                                <label>Adresa de E-mail<span>*</span></label>
                                <input type="text" name="shipping_email" value="{{ $address->user->email }}">
                            </div>


                            <div class="col-6 mb-20">
                                <label for="country">Judet <span>*</span></label>
                                <select name="division_id" class="form-control" id="country">
                                    <option value="" selected="" disabled="">Selecteaza
                                        Judetul
                                    </option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}"
                                            {{ $division->division_name == $address->state ? 'selected' : '' }}>
                                            {{ $division->division_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 mb-20">
                                <label for="country">Localitate <span>*</span></label>
                                <select name="district_id" class="form-control">
                                    <option value="" selected="" disabled="">Selecteaza
                                        Localitatea
                                    </option>
                                    <option value="{{ $address->district->id }}" selected="">
                                        {{ $address->city }}
                                    </option>

                                </select>
                            </div>

                            <div class="col-lg-6 mb-20">
                                <label>Nume Strada<span>*</span></label>
                                <input type="text" name="shipping_street" value="{{ $address->street }}">
                            </div>

                            <div class="col-lg-2 mb-20">
                                <label>Nr.Strada<span>*</span></label>
                                <input type="text" name="shipping_street_number"
                                    value="{{ $address->street_number }}">
                            </div>

                            <div class="col-lg-2 mb-20">
                                <label>Bloc<span>*</span></label>
                                <input type="text" name="shipping_building" value="{{ $address->building }}">
                            </div>

                            <div class="col-lg-2 mb-20">
                                <label>Apartament<span>*</span></label>
                                <input type="text" name="shipping_apartment" value="{{ $address->apartment }}">
                            </div>

                            <div class="col-12">
                                <div class="order-notes">
                                    <label for="order_note">Informatii suplimentare</label>
                                    <textarea id="order_note" placeholder="Aici puteti adauga informatii suplimentare." name="notes"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="payment_method mt-4">
                            <div class="row text-center">

                                <div class="col-lg-4 mb-20">
                                    <div class="panel-default">
                                        <input id="payment" name="stripe" type="radio" data-target="createp_account" />
                                        <a href="#method" data-bs-toggle="collapse" aria-controls="method">Stripe <i
                                                class="fa-brands fa-cc-stripe fa-2x"></i> </a>
                                        <div id="method" class="collapse one" data-parent="#accordion">
                                            <div class="card-body1">
                                                <p>Please send a check to Store Name, Store Street, Store Town, Store
                                                    State
                                                    /
                                                    County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 mb-20">
                                    <div class="panel-default">
                                        <input id="payment_defult" name="card" type="radio"
                                            data-target="createp_account" />
                                        <a href="#method" data-bs-toggle="collapse" aria-controls="collapsedefult">Plata
                                            cu Card <i class="fa-brands fa-cc-visa fa-2x"></i><i
                                                class="fa-brands fa-cc-mastercard fa-2x"></i><i
                                                class="fa-solid fa-credit-card fa-2x"></i><img
                                                src="assets/img/icon/papyel.png" alt=""></a>
                                        <div id="method" class="collapse one" data-parent="#accordion">
                                            <div class="card-body1">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a
                                                    PayPal
                                                    account.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 mb-20">
                                    <div class="panel-default">
                                        <input id="payment" name="cash" type="radio" data-target="createp_account" />
                                        <a href="#method" data-bs-toggle="collapse" aria-controls="method">Plata
                                            Cash <i class="fa-solid fa-money-bill-wave fa-2x"></i></a>
                                        <div id="method" class="collapse one" data-parent="#accordion">
                                            <div class="card-body1">
                                                <p>Please send a check to Store Name, Store Street, Store Town, Store
                                                    State
                                                    /
                                                    County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-20 text-center">
                                    <div class="order_button">
                                        <button type="submit">Finalizeaza Comanda</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<!--Checkout page section end-->

{{-- script pentru afisarea localitatilor aferente judetului selectat --}}
<script type="text/javascript">
    $(document).ready(function() {
        // la schimbarea selectului cu nume state (judet) din formular
        $('select[name="division_id"]').on('change', function() {
            // variabila state_id preia valoarea din atributul value al optiunii selectate
            var division_id = $(this).val();
            // daca in campul judet (state) avem selectat un judet, localitatile aferente acelui judet vor aparea in optiunile selectului cu nume city (oras / sector)
            if (division_id) {
                $.ajax({
                    // trimitem spre url state_id (id-ul judetului)
                    url: "{{ url('/district-get/ajax') }}/" + division_id,
                    type: "GET",
                    dataType: "json",
                    // daca codul de mai sus primeste ok din functia GetCity() din IndexController 
                    // afisam in optiunile selectului cu nume city (camp oras / sector) localitatile
                    // aferente aferente judetului selectat
                    success: function(data) {
                        var d = $('select[name="district_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="district_id"]').append(
                                '<option value="' + value.id +
                                '">' +
                                value.district_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>
@endsection
