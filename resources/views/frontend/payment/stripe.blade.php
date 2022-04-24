@extends('frontend.main_master')
@section('content')

    {{-- ajax jquerry CDN pentru scriptul de validare judet-localitate --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@section('title')
    Modalitate de plata Stripe
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
                                                <strong>{{ $cartSubTotal }} RON</strong>
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
                                                <strong>- {{ session()->get('voucher')['discount_amount'] }}
                                                    RON</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            {{-- preluam din variabila $cartTax din CheckoutCreate() din CartController tva dupa de voucher --}}
                                            <th style="border-left: 1px solid #ededed; border-bottom: 1px solid #ddd;">
                                                TVA</th>
                                            <td style="text-align:right !important;">
                                                <strong>{{ $cartTax }} RON</strong>
                                            </td>
                                        </tr>
                                        {{-- preluam din variabila $cartTotal din CheckoutCreate() din CartController total dupa voucher si tva --}}
                                        <tr class="order_total">
                                            <th style="border-left: 1px solid #ededed; border-bottom: 1px solid #ddd;">
                                                Total de Plata</th>
                                            <td style="text-align:right !important;">
                                                <strong>{{ $cartTotal }} RON</strong>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            {{-- preluam din variabila $cartSubTotal din CheckoutCreate() din CartController subtotal fara voucher --}}
                                            <th style="border-left: 1px solid #ededed; border-bottom: 1px solid #ddd;">
                                                Subtotal</th>
                                            <td style="text-align:right !important;">
                                                <strong>{{ $cartSubTotal }} RON</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            {{-- preluam din variabila $cartTax din CheckoutCreate() din CartController tva fara voucher --}}
                                            <th style="border-left: 1px solid #ededed; border-bottom: 1px solid #ddd;">
                                                TVA</th>
                                            <td style="text-align:right !important;">
                                                <strong>{{ $cartTax }} RON</strong>
                                            </td>
                                        </tr>
                                        {{-- preluam din variabila $cartTotal din CheckoutCreate() din CartController total cu tva si fara voucher --}}
                                        <tr class="order_total">
                                            <th style="border-left: 1px solid #ededed; border-bottom: 1px solid #ddd;">
                                                Total De Plata</th>
                                            <td style="text-align:right !important;">
                                                <strong>{{ $cartTotal }} RON</strong>
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

            </div>
        </div>
    </div>
</div>
<!--Checkout page section end-->
@endsection
