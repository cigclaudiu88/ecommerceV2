@extends('frontend.main_master')
@section('content')

@section('title')
    Wishlist
@endsection
<!--breadcrumbs area start-->
<!-- <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                       <h3>Wishlist</h3>
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li>Wishlist</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
<!--breadcrumbs area end-->

<!--wishlist area start -->
<div class="wishlist_area mt-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table_desc wishlist">
                    <div class="cart_page">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product_remove">Sterge</th>
                                    <th class="product_thumb">Poza</th>
                                    <th class="product_name">Produs</th>
                                    <th class="product-price">Pret</th>
                                    <th class="product_quantity">Status Stoc</th>
                                    <th class="product_total">Adauga in Cos</th>
                                </tr>
                            </thead>
                            <tbody id="wishlist">

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="wishlist_share">
                    <h4>Share on:</h4>
                    <ul>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                        <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<!--wishlist area end -->
@endsection
