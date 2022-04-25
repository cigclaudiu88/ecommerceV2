@extends('frontend.main_master')
@section('content')
    {{-- jQuerry CDN link pentru scriptul de vizualizare imagine profil --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- my account start  -->
    <section class="main_content_area">
        <div class="container">
            <div class="account_dashboard">
                <div class="row">
                    {{-- meniu navigare --}}
                    @include('frontend.profile.user_sidebar')
                    {{-- meniu navigare --}}
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="shopping_cart_area mt-70">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table_desc">
                                            <div class="cart_page">

                                                <div class="row">
                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="coupon_code right">
                                                            <h3>Detalii Comanda - {{ $order->order_number }} -
                                                                {{ $order->order_date }}</h3>
                                                        </div>
                                                    </div>
                                                </div>

                                                <table class="table table-responsive">
                                                    <thead>

                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th class="product_name"><a href="#">Nume Destinatar
                                                                </a>
                                                            </th>
                                                            <th class="product_name"><a
                                                                    href="#">{{ $order->shipping_first_name }}</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="product_name"><a href="#">Prenume Destinatar</a>
                                                            </th>
                                                            <th class="product_name"><a
                                                                    href="#">{{ $order->shipping_last_name }}</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="product_name"><a href="#">Telefon Destinatar</a>
                                                            </th>
                                                            <th class="product_name"><a
                                                                    href="#">{{ $order->shipping_phone }}</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="product_name"><a href="#">Email Destinatar</a>
                                                            </th>
                                                            <th class="product_name"><a
                                                                    href="#">{{ $order->shipping_email }}</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="product_name"><a href="#">Adresa Livrare</a>
                                                            </th>
                                                            <th class="product_name"><a href="#">Str.
                                                                    {{ $order->shipping_street }}<span>
                                                                    </span>Nr. {{ $order->shipping_street_number }}<span>
                                                                    </span>Bloc {{ $order->shipping_building }}<span>
                                                                    </span>Ap.{{ $order->shipping_apartment }}<span>
                                                                    </span>Judet
                                                                    {{ $order->division->division_name }}<span>
                                                                    </span>Loc.{{ $order->district->district_name }}<span>
                                                                    </span></a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="product_name"><a href="#">Modalitate de Plata</a>
                                                            </th>
                                                            <th class="product_name"><a
                                                                    href="#">{{ $order->payment_method }}</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="product_name"><a href="#">ID Tranzatie</a>
                                                            </th>
                                                            <th class="product_name"><a
                                                                    href="#">{{ $order->transaction_id }}</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="product_name"><a href="#">Total Comanda</a>
                                                            </th>
                                                            <th class="product_name"><a href="#">{{ $order->amount }}
                                                                    RON</a>
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div class="row">
                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="coupon_code right">
                                                            <h3>Produse Comanda</h3>
                                                        </div>
                                                    </div>
                                                </div>

                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th class="product_thumb">Image</th>
                                                            <th class="product_name">Produs</th>
                                                            <th class="product-price">Pret</th>
                                                            <th class="product_quantity">Cantitate</th>
                                                            <th class="product_total">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="product_thumb"><a href="#"><img
                                                                        src="assets/img/product/productbig1.jpg" alt=""></a>
                                                            </td>
                                                            <td class="product_name"><a href="#">Handbag fringilla</a>
                                                            </td>
                                                            <td class="product-price">£65.00</td>
                                                            <td class="product_quantity"><label>Quantity</label> <input
                                                                    min="1" max="100" value="1" type="number"></td>
                                                            <td class="product_total">£130.00</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="cart_submit">
                                                <button type="submit">update cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--coupon code area start-->
                                <div class="coupon_area">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-6">
                                            <div class="coupon_code right">
                                                <h3>Total Comanda</h3>
                                                <div class="coupon_inner">
                                                    <div class="cart_subtotal">
                                                        <p>Subtotal</p>
                                                        <p class="cart_amount">£215.00</p>
                                                    </div>

                                                    <div class="cart_subtotal">
                                                        <p>Total</p>
                                                        <p class="cart_amount">£215.00</p>
                                                    </div>
                                                    <div class="checkout_btn">
                                                        <a href="#">Proceed to Checkout</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--coupon code area end-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account end   -->
@endsection
