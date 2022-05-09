@extends('frontend.main_master')
@section('content')

    {{-- ajax jquerry CDN pentru scriptul de validare judet-localitate --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@section('title')
    Modalitate de plata Cash
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
                <div class="col-lg-6 col-md-6">
                    <div class="coupon_code right">
                        <div class="coupon_inner" style="padding: 0px 0px 0px !important; ">
                            <div class="checkout_btn" style="text-align:left !important;">
                                <a href="{{ route('checkout') }}">Inapoi Spre Casa</a>
                            </div>
                        </div>
                    </div>
                    <form action="#">
                        <h3>Total Comanda</h3>
                        <div class="order_table table-responsive">
                            <table>
                                <tbody>
                                    {{-- daca sesiunea are voucher afisam subtotal inainte de voucher si tva,nume voucher,reducere voucher si total --}}
                                    @if (Session::has('voucher'))
                                        <tr>
                                            {{-- preluam din variabila $cartSubTotal din CheckoutCreate() din CartController subtotalul inainte de voucher --}}
                                            <th style="border-left: 1px solid #ededed; border-bottom: 1px solid #ddd;">
                                                Subtotal</th>
                                            <td style="text-align:right !important;">
                                                <strong>{{ number_format($cartSubTotal, 2, '.', ',') }} RON</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            {{-- preluam din sesiune numele voucherului (voucherapply() vouchercalculation() din CartController) --}}
                                            <th style="border-left: 1px solid #ededed; border-bottom: 1px solid #ddd;">
                                                Voucher</th>
                                            <td style="text-align:right !important;">
                                                <strong>{{ session()->get('voucher')['voucher_name'] }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            {{-- preluam din sesiune reducerea voucherului (voucherapply() vouchercalculation() din CartController) --}}
                                            <th style="border-left: 1px solid #ededed; border-bottom: 1px solid #ddd;">
                                                Reducere</th>
                                            <td class="text-danger" style="text-align:right !important;">
                                                <strong>-
                                                    {{ number_format(session()->get('voucher')['discount_amount'], 2, '.', ',') }}
                                                    RON</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            {{-- preluam din variabila $cartTax din CheckoutCreate() din CartController tva dupa de voucher --}}
                                            <th style="border-left: 1px solid #ededed; border-bottom: 1px solid #ddd;">
                                                TVA</th>
                                            <td style="text-align:right !important;">
                                                <strong>{{ number_format($cartTax, 2, '.', ',') }} RON</strong>
                                            </td>
                                        </tr>
                                        {{-- preluam din variabila $cartTotal din CheckoutCreate() din CartController total dupa voucher si tva --}}
                                        <tr class="order_total">
                                            <th style="border-left: 1px solid #ededed; border-bottom: 1px solid #ddd;">
                                                Total de Plata</th>
                                            <td style="text-align:right !important;">
                                                <strong>{{ number_format($cartTotal, 2, '.', ',') }} RON</strong>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            {{-- preluam din variabila $cartSubTotal din CheckoutCreate() din CartController subtotal fara voucher --}}
                                            <th style="border-left: 1px solid #ededed; border-bottom: 1px solid #ddd;">
                                                Subtotal</th>
                                            <td style="text-align:right !important;">
                                                <strong>{{ number_format($cartSubTotal, 2, '.', ',') }} RON</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            {{-- preluam din variabila $cartTax din CheckoutCreate() din CartController tva fara voucher --}}
                                            <th style="border-left: 1px solid #ededed; border-bottom: 1px solid #ddd;">
                                                TVA</th>
                                            <td style="text-align:right !important;">
                                                <strong>{{ number_format($cartTax, 2, '.', ',') }} RON</strong>
                                            </td>
                                        </tr>
                                        {{-- preluam din variabila $cartTotal din CheckoutCreate() din CartController total cu tva si fara voucher --}}
                                        <tr class="order_total">
                                            <th style="border-left: 1px solid #ededed; border-bottom: 1px solid #ddd;">
                                                Total De Plata</th>
                                            <td style="text-align:right !important;">
                                                <strong>{{ number_format($cartTotal, 2, '.', ',') }} RON</strong>
                                            </td>
                                        </tr>
                                    @endif

                                </tbody>
                                {{-- afisam subtotalul,tva si total din functia CheckoutCreate() din CartController --}}
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>

                    </form>
                </div>
                {{-- formular de efectuare plata cu cardul Stripe start --}}
                <div class="col-lg-6 col-md-6">
                    <form action="{{ route('cash.order') }}" method="post" id="payment-form">
                        @csrf
                        <div class="form-row">
                            <label for="card-element">
                                <strong>Plata Cash</strong>
                                {{-- datele provin din array()-ul cu datele de adresa livrare oferite de CheckoutStore() -> CheckoutController --}}
                                <input type="hidden" name="shipping_first_name"
                                    value="{{ $data['shipping_first_name'] }}">
                                <input type="hidden" name="shipping_last_name"
                                    value="{{ $data['shipping_last_name'] }}">
                                <input type="hidden" name="shipping_phone" value="{{ $data['shipping_phone'] }}">
                                <input type="hidden" name="shipping_email" value="{{ $data['shipping_email'] }}">
                                <input type="hidden" name="division_id" value="{{ $data['division_id'] }}">
                                <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                                <input type="hidden" name="shipping_street" value="{{ $data['shipping_street'] }}">
                                <input type="hidden" name="shipping_street_number"
                                    value="{{ $data['shipping_street_number'] }}">
                                <input type="hidden" name="shipping_building"
                                    value="{{ $data['shipping_building'] }}">
                                <input type="hidden" name="shipping_apartment"
                                    value="{{ $data['shipping_apartment'] }}">
                                <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                            </label>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <br>
                        <button class="btn btn-success">Finalizeaza Comanda</button>
                    </form>
                </div>
                {{-- formular de efectuare plata cu cardul Stripe sfarsit --}}
            </div>
        </div>
    </div>
</div>
<!--Checkout page section end-->
@endsection
