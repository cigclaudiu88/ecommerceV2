@extends('frontend.main_master')
@section('content')

@section('title')
    Cos de cumparaturi
@endsection
<!--breadcrumbs area start-->
{{-- <div class="breadcrumbs_area">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                   <h3>Cart</h3>
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li>Shopping Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div> --}}
<!--breadcrumbs area end-->

<!--shopping cart area start -->
<div class="shopping_cart_area mt-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table_desc">
                    <div class="cart_page">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product_remove">Sterge</th>
                                    <th class="product_thumb">Poza</th>
                                    <th class="product_name">Produs</th>
                                    <th class="product-price">Pret</th>
                                    <th class="product_quantity">Cantitate</th>
                                    <th class="product_total">Total</th>
                                </tr>
                            </thead>
                            {{-- adaugat idul cartPage pentru scriptul de management al cosului de cumparaturi --}}
                            <tbody id="cartPage">



                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="cart_submit">
                        <button type="submit">update cart</button>
                    </div> --}}
                </div>
            </div>
        </div>
        <!--coupon code area start-->
        <div class="coupon_area">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="coupon_code left">
                        <h3>Voucher</h3>
                        <div class="coupon_inner">
                            <p>Daca aveti un Voucher il puteti adauga aici.</p>
                            {{-- adaugat id + onclick pt scriptul de aplicare voucher --}}
                            <input type="text" id="voucher_name" onclick="applyVoucher()" placeholder="Cod Voucher">
                            <button type="submit">Aplica Voucher</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="coupon_code right">
                        <h3>Cart Totals</h3>
                        <div class="coupon_inner">
                            <div class="cart_subtotal">
                                <p>Subtotal</p>
                                <p class="cart_amount">£215.00</p>
                            </div>
                            <div class="cart_subtotal ">
                                <p>Shipping</p>
                                <p class="cart_amount"><span>Flat Rate:</span> £255.00</p>
                            </div>
                            <a href="#">Calculate shipping</a>

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
<!--shopping cart area end -->
@endsection
