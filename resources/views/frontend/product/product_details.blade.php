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
                        {{-- adaugat id="pname" pentru AddToCart() --}}
                        <h1 id="pname"><a href="#">{{ $product->product_name }}</a></h1>
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
                            {{-- adaugat id="qty" pt scriptul AddToCart --}}
                            <input min="1" value="1" type="number" id="qty">
                            {{-- adaugat camp hiddent pentru product_id --}}
                            <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">
                            {{-- adaugat onclick="addToCart()" --}}
                            <button class="button" type="submit" onclick="addToCart()">Adauga in Cos</button>

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
                                    aria-selected="false">Descriere</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet"
                                    aria-selected="false">Specificatii</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
                                    aria-selected="false">Recenzii (1)</a>
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

                        {{-- sectiunea de recenzii din detalii produse --}}
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
                                {{-- sectiunea de adauga recenzie este vizibila doar pentru utlizatorii autentificati --}}
                                @guest
                                    {{-- mesaj pentru utilizatorii neautentificati --}}
                                    <div class="comment_title">
                                        <h2>Adauga recenzie </h2>
                                        <p>Pentru a adauga recenzii trebuie sa va <a href="{{ route('login') }}">
                                                <strong class="text-success">autentificati! </strong></a> </p>
                                    </div>
                                @else
                                    {{-- utilizatorii autentificati au acess la formularul pentru adaugare recenzii --}}
                                    {{-- <div class="comment_title">
                                        <h2>Adauga recenzie </h2>
                                        <p>Your email address will not be published. Required fields are marked </p>
                                    </div> --}}
                                    <div class="product_review_form">
                                        <form role="form" method="post" action="{{ route('review.store') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="product_ratting mb-10">
                                                    {{-- <h3>Your rating</h3> --}}
                                                    <div class="rate">
                                                        <input type="radio" id="star5" name="rating" value="5" />
                                                        <label for="star5" title="text">5 stars</label>
                                                        <input type="radio" id="star4" name="rating" value="4" />
                                                        <label for="star4" title="text">4 stars</label>
                                                        <input type="radio" id="star3" name="rating" value="3" />
                                                        <label for="star3" title="text">3 stars</label>
                                                        <input type="radio" id="star2" name="rating" value="2" />
                                                        <label for="star2" title="text">2 stars</label>
                                                        <input type="radio" id="star1" name="rating" value="1" />
                                                        <label for="star1" title="text">1 star</label>
                                                        @error('rating')
                                                            <span
                                                                class="text-danger"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                <div class="col-12">
                                                    <label for="summary">Titlu </label>
                                                    <input type="text" name="summary">
                                                    @error('summary')
                                                        <span
                                                            class="text-danger"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="comment">Cuprins Recenzie </label>
                                                    <textarea name="comment"></textarea>
                                                    @error('comment')
                                                        <span
                                                            class="text-danger"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <button type="submit">Trimite</button>
                                        </form>
                                    </div>
                                @endguest
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product info end-->


{{-- Sectiunea de Produse Similare start --}}
<section class="product_area related_products">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Produse Similare</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product_carousel product_column5 owl-carousel">
                    @foreach ($relatedProduct as $product)
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img"
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                            src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                                    <a class="secondary_img"
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                            src="{{ asset($product->product_thumbnail) }}" alt=""></a>

                                    <div class="label_product">
                                        @php
                                            // calculam procentul de discount pe baza pretului de vanzare / pretul de discount
                                            $amount = $product->selling_price - $product->discount_price;
                                            $discount = ($amount / $product->selling_price) * 100;
                                        @endphp
                                        {{-- daca produsul nu are pret de discount afisam tag de Nou --}}
                                        @if ($product->discount_price == null)
                                            <span class="label_new">Nou</span>
                                        @else
                                            {{-- daca produsul are pret de discount afisam % discount --}}
                                            <span class="label_sale">{{ round($discount) }}%</span>
                                        @endif
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
                                                        class="lnr lnr-magnifier"></span></a>
                                            </li>
                                            <li class="wishlist"><a href="wishlist.html"
                                                    data-tippy="Add to Wishlist" data-tippy-placement="top"
                                                    data-tippy-arrow="true" data-tippy-inertia="true"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                    data-tippy-placement="top" data-tippy-arrow="true"
                                                    data-tippy-inertia="true"><span class="lnr lnr-sync"></span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <h4 class="product_name"><a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ Str::limit($product->product_name, 40) }}</a>
                                    </h4>
                                    {{-- <p><a href="#">Fruits</a></p> --}}
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
                                </figcaption>
                            </figure>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Sectiunea de Produse Similare sfarsit --}}

{{-- Sectiunea de Produse Similare start --}}
<section class="product_area related_products">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Acesorii</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product_carousel product_column5 owl-carousel">
                    @foreach ($relatedProductAccesories as $product)
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img"
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                            src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                                    <a class="secondary_img"
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                            src="{{ asset($product->product_thumbnail) }}" alt=""></a>

                                    <div class="label_product">
                                        @php
                                            // calculam procentul de discount pe baza pretului de vanzare / pretul de discount
                                            $amount = $product->selling_price - $product->discount_price;
                                            $discount = ($amount / $product->selling_price) * 100;
                                        @endphp
                                        {{-- daca produsul nu are pret de discount afisam tag de Nou --}}
                                        @if ($product->discount_price == null)
                                            <span class="label_new">Nou</span>
                                        @else
                                            {{-- daca produsul are pret de discount afisam % discount --}}
                                            <span class="label_sale">{{ round($discount) }}%</span>
                                        @endif
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
                                                        class="lnr lnr-magnifier"></span></a>
                                            </li>
                                            <li class="wishlist"><a href="wishlist.html"
                                                    data-tippy="Add to Wishlist" data-tippy-placement="top"
                                                    data-tippy-arrow="true" data-tippy-inertia="true"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                    data-tippy-placement="top" data-tippy-arrow="true"
                                                    data-tippy-inertia="true"><span class="lnr lnr-sync"></span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <h4 class="product_name"><a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ Str::limit($product->product_name, 40) }}</a>
                                    </h4>
                                    {{-- <p><a href="#">Fruits</a></p> --}}
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
                                </figcaption>
                            </figure>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Sectiunea de Produse Similare sfarsit --}}


<style>
    img {
        max-width: 100%;
        max-height: 100%;
        display: block;
        /* remove extra space below image */
    }

    /*
    * {
        margin: 0;
        padding: 0;
    } */

    .rate {
        float: left;
        height: 25px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    /* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */

</style>
@endsection
