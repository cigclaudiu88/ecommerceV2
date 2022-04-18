@extends('frontend.main_master')
@section('content')
    <!--breadcrumbs area start-->
    {{-- <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li>product details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!--breadcrumbs area end-->
    {{-- setiunea de titlu --}}
@section('title')
    {{ $product->product_name }} Product Details
@endsection

<!--product details start-->
{{-- sectiunea de galerie foto produs start --}}
<div class="product_details mt-70 mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details-tab">
                    <div id="slide{{ $product->id }}" class="zoomWrapper single-zoom">
                        <a href="{{ asset(asset($product->product_thumbnail)) }}">
                            <img id="zoom1" src="{{ asset(asset($product->product_thumbnail)) }}"
                                data-zoom-image="{{ asset(asset($product->product_thumbnail)) }}" alt="big-1">
                        </a>
                    </div>
                    <div class="single-zoom-thumb">
                        <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                            {{-- iteram cu $multiImage din ProdcutDetails() din IndexController pentru a afisa toate multiimaginile produsului selectat --}}
                            @foreach ($multiImage as $img)
                                <li>
                                    <a href="#slide{{ $img->id }}" class="elevatezoom-gallery active" data-update=""
                                        data-image="{{ asset(asset($img->photo_name)) }}"
                                        data-zoom-image="{{ asset(asset($img->photo_name)) }}">
                                        <img src="{{ asset(asset($img->photo_name)) }}" alt="zo-th-1" />
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            {{-- sectiunea de galerie foto produs sfarsit --}}

            <div class="col-lg-6 col-md-6">
                <div class="product_d_right">
                    <form action="#">

                        <h1><a href="#">{{ $product->product_name }}</a></h1>
                        {{-- <div class="product_nav">
                            <ul>
                                <li class="prev"><a href="product-details.html"><i
                                            class="fa fa-angle-left"></i></a></li>
                                <li class="next"><a href="variable-product.html"><i
                                            class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </div> --}}
                        <div class=" product_ratting">
                            <ul>
                                <li><a href="#"><i class="icon-star"></i></a></li>
                                <li><a href="#"><i class="icon-star"></i></a></li>
                                <li><a href="#"><i class="icon-star"></i></a></li>
                                <li><a href="#"><i class="icon-star"></i></a></li>
                                <li><a href="#"><i class="icon-star"></i></a></li>
                                <li class="review"><a href="#"> (customer review ) </a></li>
                            </ul>

                        </div>
                        {{-- daca produsul nu are discount afisam doar pretul de vanzare --}}
                        <div class="price_box">
                            @if ($product->discount_price == null)
                                <span class="current_price">{{ $product->selling_price }}
                                    RON</span>
                                {{-- daca produsul are discount afisam discount + pretul de vanzare fara discount --}}
                            @else
                                <span class="current_price">{{ $product->discount_price }}
                                    RON</span><br>
                                <span class="old_price">{{ $product->selling_price }}
                                    RON</span>
                            @endif
                        </div>
                        <div class="product_desc">
                            <p>{{ $product->short_description }}</p>
                        </div>
                        <div class="product_variant color">
                            <h3>Available Options</h3>
                            <label>color</label>
                            <ul>
                                <li class="color1"><a href="#"></a></li>
                                <li class="color2"><a href="#"></a></li>
                                <li class="color3"><a href="#"></a></li>
                                <li class="color4"><a href="#"></a></li>
                            </ul>
                        </div>
                        <div class="product_variant quantity">
                            <label>quantity</label>
                            <input min="1" max="100" value="1" type="number">
                            <button class="button" type="submit">add to cart</button>

                        </div>
                        <div class=" product_d_action">
                            <ul>
                                <li><a href="#" title="Add to wishlist">+ Add to Wishlist</a></li>
                                <li><a href="#" title="Add to wishlist">+ Compare</a></li>
                            </ul>
                        </div>
                        <div class="product_meta">
                            <span>Category: <a href="#">Clothing</a></span>
                        </div>

                    </form>
                    <div class="priduct_social">
                        <ul>
                            <li><a class="facebook" href="#" title="facebook"><i class="fa fa-facebook"></i>
                                    Like</a></li>
                            <li><a class="twitter" href="#" title="twitter"><i class="fa fa-twitter"></i>
                                    tweet</a></li>
                            <li><a class="pinterest" href="#" title="pinterest"><i class="fa fa-pinterest"></i>
                                    save</a></li>
                            <li><a class="google-plus" href="#" title="google +"><i class="fa fa-google-plus"></i>
                                    share</a></li>
                            <li><a class="linkedin" href="#" title="linkedin"><i class="fa fa-linkedin"></i>
                                    linked</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--product details end-->

<!--product info start-->
<div class="product_d_info mb-65">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_d_inner">
                    <div class="product_info_button">
                        <ul class="nav" role="tablist" id="nav-tab">
                            <li>
                                <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info"
                                    aria-selected="false">Description</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet"
                                    aria-selected="false">Specification</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
                                    aria-selected="false">Reviews (1)</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <div class="product_info_content">
                                {{-- Rendering HTML from database table to view in Laravel --}}
                                <p>{!! $product->long_description !!}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sheet" role="tabpanel">
                            <p>{!! $product->specifications !!}</p>
                        </div>

                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="reviews_wrapper">
                                <h2>1 review for Donec eu furniture</h2>
                                <div class="reviews_comment_box">
                                    <div class="comment_thmb">
                                        <img src="{{ asset('frontend/img/blog/comment2.jpg') }}" alt="">
                                    </div>
                                    <div class="comment_text">
                                        <div class="reviews_meta">
                                            <div class="star_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <p><strong>admin </strong>- September 12, 2018</p>
                                            <span>roadthemes</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="comment_title">
                                    <h2>Add a review </h2>
                                    <p>Your email address will not be published. Required fields are marked </p>
                                </div>
                                <div class="product_ratting mb-10">
                                    <h3>Your rating</h3>
                                    <ul>
                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product_review_form">
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="review_comment">Your review </label>
                                                <textarea name="comment" id="review_comment"></textarea>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="author">Name</label>
                                                <input id="author" type="text">

                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="email">Email </label>
                                                <input id="email" type="text">
                                            </div>
                                        </div>
                                        <button type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product info end-->

<!--product area start-->
<section class="product_area related_products">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Related Products </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product_carousel product_column5 owl-carousel">
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product20.jpg') }}" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product21.jpg') }}" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                    <span class="label_new">New</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        <li class="add_to_cart"><a href="cart.html" data-tippy="Add to cart"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a>
                                        </li>
                                        <li class="quick_button"><a href="#" data-tippy="quick view"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true" data-bs-toggle="modal"
                                                data-bs-target="#modal_box"> <span class="lnr lnr-magnifier"></span></a>
                                        </li>
                                        <li class="wishlist"><a href="wishlist.html" data-tippy="Add to Wishlist"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <figcaption class="product_content">
                                <h4 class="product_name"><a href="product-details.html">Quisque In Arcu</a></h4>
                                <p><a href="#">Fruits</a></p>
                                <div class="price_box">
                                    <span class="current_price">$55.00</span>
                                    <span class="old_price">$235.00</span>
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product15.jpg') }}" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product14.jpg') }}" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        <li class="add_to_cart"><a href="cart.html" data-tippy="Add to cart"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a>
                                        </li>
                                        <li class="quick_button"><a href="#" data-tippy="quick view"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true" data-bs-toggle="modal"
                                                data-bs-target="#modal_box"> <span
                                                    class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" data-tippy="Add to Wishlist"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <figcaption class="product_content">
                                <h4 class="product_name"><a href="product-details.html">Cas Meque Metus</a></h4>
                                <p><a href="#">Fruits</a></p>
                                <div class="price_box">
                                    <span class="current_price">$26.00</span>
                                    <span class="old_price">$362.00</span>
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product17.jpg') }}" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product16.jpg') }}" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        <li class="add_to_cart"><a href="cart.html" data-tippy="Add to cart"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a>
                                        </li>
                                        <li class="quick_button"><a href="#" data-tippy="quick view"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true" data-bs-toggle="modal"
                                                data-bs-target="#modal_box"> <span
                                                    class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" data-tippy="Add to Wishlist"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <figcaption class="product_content">
                                <h4 class="product_name"><a href="product-details.html">Aliquam Consequat</a></h4>
                                <p><a href="#">Fruits</a></p>
                                <div class="price_box">
                                    <span class="current_price">$26.00</span>
                                    <span class="old_price">$362.00</span>
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product14.jpg') }}" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product15.jpg') }}" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                    <span class="label_new">New</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        <li class="add_to_cart"><a href="cart.html" data-tippy="Add to cart"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a>
                                        </li>
                                        <li class="quick_button"><a href="#" data-tippy="quick view"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true" data-bs-toggle="modal"
                                                data-bs-target="#modal_box"> <span
                                                    class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" data-tippy="Add to Wishlist"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <figcaption class="product_content">
                                <h4 class="product_name"><a href="product-details.html">Mauris Vel Tellus</a></h4>
                                <p><a href="#">Fruits</a></p>
                                <div class="price_box">
                                    <span class="current_price">$48.00</span>
                                    <span class="old_price">$257.00</span>
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product16.jpg') }}" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product17.jpg') }}" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        <li class="add_to_cart"><a href="cart.html" data-tippy="Add to cart"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a>
                                        </li>
                                        <li class="quick_button"><a href="#" data-tippy="quick view"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true" data-bs-toggle="modal"
                                                data-bs-target="#modal_box"> <span
                                                    class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" data-tippy="Add to Wishlist"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <figcaption class="product_content">
                                <h4 class="product_name"><a href="product-details.html">Nunc Neque Eros</a></h4>
                                <p><a href="#">Fruits</a></p>
                                <div class="price_box">
                                    <span class="current_price">$35.00</span>
                                    <span class="old_price">$245.00</span>
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product18.jpg') }}" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product19.jpg') }}" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        <li class="add_to_cart"><a href="cart.html" data-tippy="Add to cart"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a>
                                        </li>
                                        <li class="quick_button"><a href="#" data-tippy="quick view"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true" data-bs-toggle="modal"
                                                data-bs-target="#modal_box"> <span
                                                    class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" data-tippy="Add to Wishlist"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <figcaption class="product_content">
                                <h4 class="product_name"><a href="product-details.html">Proin Lectus Ipsum</a></h4>
                                <p><a href="#">Fruits</a></p>
                                <div class="price_box">
                                    <span class="current_price">$26.00</span>
                                    <span class="old_price">$362.00</span>
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
<!--product area end-->

<!--product area start-->
<section class="product_area upsell_products">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Upsell Products </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product_carousel product_column5 owl-carousel">
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product1.jpg') }}" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product2.jpg') }}" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        <li class="add_to_cart"><a href="cart.html" data-tippy="Add to cart"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a>
                                        </li>
                                        <li class="quick_button"><a href="#" data-tippy="quick view"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true" data-bs-toggle="modal"
                                                data-bs-target="#modal_box"> <span
                                                    class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" data-tippy="Add to Wishlist"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <figcaption class="product_content">
                                <h4 class="product_name"><a href="product-details.html">Proin Lectus Ipsum</a></h4>
                                <p><a href="#">Fruits</a></p>
                                <div class="price_box">
                                    <span class="current_price">$26.00</span>
                                    <span class="old_price">$362.00</span>
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product9.jpg') }}" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product4.jpg') }}" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                    <span class="label_new">New</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        <li class="add_to_cart"><a href="cart.html" data-tippy="Add to cart"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a>
                                        </li>
                                        <li class="quick_button"><a href="#" data-tippy="quick view"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true" data-bs-toggle="modal"
                                                data-bs-target="#modal_box"> <span
                                                    class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" data-tippy="Add to Wishlist"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <figcaption class="product_content">
                                <h4 class="product_name"><a href="product-details.html">Quisque In Arcu</a></h4>
                                <p><a href="#">Fruits</a></p>
                                <div class="price_box">
                                    <span class="current_price">$55.00</span>
                                    <span class="old_price">$235.00</span>
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product13.jpg') }}" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product1.jpg') }}" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                    <span class="label_new">New</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        <li class="add_to_cart"><a href="cart.html" data-tippy="Add to cart"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a>
                                        </li>
                                        <li class="quick_button"><a href="#" data-tippy="quick view"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true" data-bs-toggle="modal"
                                                data-bs-target="#modal_box"> <span
                                                    class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" data-tippy="Add to Wishlist"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <figcaption class="product_content">
                                <h4 class="product_name"><a href="product-details.html">Mauris Vel Tellus</a></h4>
                                <p><a href="#">Fruits</a></p>
                                <div class="price_box">
                                    <span class="current_price">$48.00</span>
                                    <span class="old_price">$257.00</span>
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product12.jpg') }}" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product2.jpg') }}" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        <li class="add_to_cart"><a href="cart.html" data-tippy="Add to cart"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a>
                                        </li>
                                        <li class="quick_button"><a href="#" data-tippy="quick view"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true" data-bs-toggle="modal"
                                                data-bs-target="#modal_box"> <span
                                                    class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" data-tippy="Add to Wishlist"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <figcaption class="product_content">
                                <h4 class="product_name"><a href="product-details.html">Nunc Neque Eros</a></h4>
                                <p><a href="#">Fruits</a></p>
                                <div class="price_box">
                                    <span class="current_price">$35.00</span>
                                    <span class="old_price">$245.00</span>
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product1.jpg') }}" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product2.jpg') }}" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                    <span class="label_new">New</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        <li class="add_to_cart"><a href="cart.html" data-tippy="Add to cart"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a>
                                        </li>
                                        <li class="quick_button"><a href="#" data-tippy="quick view"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true" data-bs-toggle="modal"
                                                data-bs-target="#modal_box"> <span
                                                    class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" data-tippy="Add to Wishlist"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <figcaption class="product_content">
                                <h4 class="product_name"><a href="product-details.html">Aliquam Consequat</a></h4>
                                <p><a href="#">Fruits</a></p>
                                <div class="price_box">
                                    <span class="current_price">$26.00</span>
                                    <span class="old_price">$362.00</span>
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product3.jpg') }}" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="{{ asset('frontend/img/product/product4.jpg') }}" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        <li class="add_to_cart"><a href="cart.html" data-tippy="Add to cart"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a>
                                        </li>
                                        <li class="quick_button"><a href="#" data-tippy="quick view"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true" data-bs-toggle="modal"
                                                data-bs-target="#modal_box"> <span
                                                    class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" data-tippy="Add to Wishlist"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                data-tippy-inertia="true"><span class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <figcaption class="product_content">
                                <h4 class="product_name"><a href="product-details.html">Donec Non Est</a></h4>
                                <p><a href="#">Fruits</a></p>
                                <div class="price_box">
                                    <span class="current_price">$46.00</span>
                                    <span class="old_price">$382.00</span>
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
<!--product area end-->

<style>
    img {
        max-width: 100%;
        max-height: 100%;
        display: block;
        /* remove extra space below image */
    }

</style>
@endsection
