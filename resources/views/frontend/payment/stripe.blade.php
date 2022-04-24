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
{{-- CSS pt formular STRIPE Start --}}
<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }

</style>
{{-- CSS pt formular STRIPE Sfarsit --}}

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
                {{-- formular de efectuare plata cu cardul Stripe start --}}
                <div class="col-lg-6 col-md-6">
                    <form action="{{ route('stripe.order') }}" method="post" id="payment-form">
                        @csrf
                        <div class="form-row">
                            <label for="card-element">
                                Card de Credit sau Debit
                            </label>

                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <br>
                        <button class="btn btn-primary">Efectueaza Plata</button>
                    </form>
                </div>
                {{-- formular de efectuare plata cu cardul Stripe sfarsit --}}
            </div>
        </div>
    </div>
</div>
<!--Checkout page section end-->

{{-- script pt Stripe Plata cu Cardul - Start --}}
<script type="text/javascript">
    // Create a Stripe client.
    var stripe = Stripe(
        'pk_test_51Ks1SYI2h4zccwc75e9oYi0xfU3xHSj21cxOGUZ5U2Gv6TzmmxKLjQjTnhunWICqWSTl662x1MyTVyV5mGUu2lfG00WJZgcGKA'
    );
    // Create an instance of Elements.
    var elements = stripe.elements();
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    // Create an instance of the card Element.
    var card = elements.create('card', {
        style: style
    });
    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');
    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });
    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        // Submit the form
        form.submit();
    }
</script>
{{-- script pt Stripe Plata cu Cardul - Sfarsit --}}
@endsection
