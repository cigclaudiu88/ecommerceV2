@extends('frontend.main_master')
@section('content')
    {{-- sectiune de titlu --}}
@section('title')
    eShop
@endsection
<!-- Main Slider Begin -->
@include('frontend.main_slider.main_slider')
<!-- Main Slider End -->
<!--product area start-->
<div class="product_area  mb-64">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_header">
                    <div class="section_title">
                        <p>Recent adaugate in magazin</p>
                        <h2>Produse Curente</h2>
                    </div>

                    <div class="product_tab_btn">
                        <ul class="nav" role="tablist" id="nav-tab">
                            {{-- Tab Dinamic Care selecteaza Toate Produsele Noi Adaugat directioneaza spre div-ul cu id="allproducts" --}}
                            <li>
                                <a class="active" data-toggle="tab" href="#allproducts" role="tab"
                                    aria-controls="allproducts" aria-selected="true">
                                    Toate Produsele Noi
                                </a>
                            </li>
                            {{-- Tab Dinamic Care selecteaza Toate Produsele Noi Adaugat aferente categoriei selectate directioneaza spre div-ul cu id="category{{ $category->id }}" --}}
                            {{-- iteram cu $categories din functia index din IndexController si afisam maxim 3 categorii din tabelul categories --}}
                            @foreach ($categories->slice(0, 3) as $category)
                                <li>
                                    {{-- adaugam #category{{ $category->id }} pe <a> pentru link spre tab-urile de categorii care au id category{{ $category->id }} --}}
                                    <a class="" data-toggle="tab" href="#category{{ $category->id }}"
                                        role="tab" aria-controls="category{{ $category->id }}" aria-selected="true">
                                        {{ $category->category_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="product_container">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content">
                        {{-- sectiunea care afiseaza toate produsele curente --}}
                        <div class="tab-pane fade show active" id="allproducts" role="tabpanel">
                            <div class="product_carousel product_column5 owl-carousel">
                                @foreach ($products as $product)
                                    <div class="product_items">
                                        <article class="single_product">
                                            <figure>
                                                <div class="product_thumb">
                                                    <a class="primary_img"
                                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                                            src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                                                    <a class="secondary_img"
                                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                                            src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                                                    @php
                                                        // calculam procentul de discount pe baza pretului de vanzare / pretul de discount
                                                        $amount = $product->selling_price - $product->discount_price;
                                                        $discount = ($amount / $product->selling_price) * 100;
                                                    @endphp
                                                    <div class="label_product">
                                                        {{-- daca produsul nu are pret de discount afisam tag de Nou --}}
                                                        @if ($product->discount_price == null)
                                                            <span class="label_new">Nou</span>
                                                        @else
                                                            {{-- daca produsul are pret de discount afisam % discount --}}
                                                            <span
                                                                class="label_sale">{{ round($discount) }}%</span>
                                                        @endif
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            <li class="add_to_cart"><a href="cart.html"
                                                                    data-tippy="Add to cart" data-tippy-placement="top"
                                                                    data-tippy-arrow="true" data-tippy-inertia="true">
                                                                    <span class="lnr lnr-cart"></span></a></li>
                                                            <li class="quick_button"><a href="#"
                                                                    data-tippy="quick view" data-tippy-placement="top"
                                                                    data-tippy-arrow="true" data-tippy-inertia="true"
                                                                    data-bs-toggle="modal" data-bs-target="#modal_box">
                                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                                            <li class="wishlist"><a href="wishlist.html"
                                                                    data-tippy="Add to Wishlist"
                                                                    data-tippy-placement="top" data-tippy-arrow="true"
                                                                    data-tippy-inertia="true"><span
                                                                        class="lnr lnr-heart"></span></a></li>
                                                            <li class="compare"><a href="#"
                                                                    data-tippy="Add to Compare"
                                                                    data-tippy-placement="top" data-tippy-arrow="true"
                                                                    data-tippy-inertia="true"><span
                                                                        class="lnr lnr-sync"></span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <figcaption class="product_content">
                                                    <h4 class="product_name"><a
                                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ Str::limit($product->product_name, 40) }}</a>
                                                    </h4>
                                                    <p><a href="#">Fruits</a></p>
                                                    {{-- daca produsul nu are discount afisam doar pretul de vanzare --}}
                                                    <div class="price_box">
                                                        @if ($product->discount_price == null)
                                                            <span
                                                                class="current_price">{{ $product->selling_price }}
                                                                RON</span>
                                                            {{-- daca produsul are discount afisam discount + pretul de vanzare fara discount --}}
                                                        @else
                                                            <span
                                                                class="current_price">{{ $product->discount_price }}
                                                                RON</span><br>
                                                            <span
                                                                class="old_price">{{ $product->selling_price }}
                                                                RON</span>
                                                        @endif
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- sectiunea care afiseaza toate produsele curente functie de categoria selectata --}}
                        @foreach ($categories as $category)
                            <div class="tab-pane fade" id="category{{ $category->id }}" role="tabpanel">
                                <div class="product_carousel product_column5 owl-carousel">
                                    @php
                                        // selects products where category_id (products table) is the same as the id from categories table
                                        // $category_selected_products preia produsele din categoria selectata ordonate dupa id desc
                                        $category_selected_products = App\Models\Product::where('category_id', $category->id)
                                            ->orderBy('id', 'DESC')
                                            ->get();
                                    @endphp
                                    {{-- iteram cu $category_selected_products pentru a afisa fiecare produs din categoria selectata --}}
                                    @forelse ($category_selected_products as $product)
                                        <div class="product_items">
                                            <article class="single_product">
                                                <figure>
                                                    <div class="product_thumb">
                                                        <a class="primary_img"
                                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                                                src="{{ asset($product->product_thumbnail) }}"
                                                                alt=""></a>
                                                        <a class="secondary_img"
                                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                                                src="{{ asset($product->product_thumbnail) }}"
                                                                alt=""></a>
                                                        @php
                                                            // calculam procentul de discount pe baza pretului de vanzare / pretul de discount
                                                            $amount = $product->selling_price - $product->discount_price;
                                                            $discount = ($amount / $product->selling_price) * 100;
                                                        @endphp
                                                        <div class="label_product">
                                                            {{-- daca produsul nu are pret de discount afisam tag de Nou --}}
                                                            @if ($product->discount_price == null)
                                                                <span class="label_new">Nou</span>
                                                            @else
                                                                {{-- daca produsul are pret de discount afisam % discount --}}
                                                                <span
                                                                    class="label_sale">{{ round($discount) }}%</span>
                                                            @endif
                                                        </div>
                                                        <div class="action_links">
                                                            <ul>
                                                                <li class="add_to_cart"><a href="cart.html"
                                                                        data-tippy="Add to cart"
                                                                        data-tippy-placement="top"
                                                                        data-tippy-arrow="true"
                                                                        data-tippy-inertia="true"> <span
                                                                            class="lnr lnr-cart"></span></a></li>
                                                                <li class="quick_button"><a href="#"
                                                                        data-tippy="quick view"
                                                                        data-tippy-placement="top"
                                                                        data-tippy-arrow="true"
                                                                        data-tippy-inertia="true" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box"> <span
                                                                            class="lnr lnr-magnifier"></span></a></li>
                                                                <li class="wishlist"><a href="wishlist.html"
                                                                        data-tippy="Add to Wishlist"
                                                                        data-tippy-placement="top"
                                                                        data-tippy-arrow="true"
                                                                        data-tippy-inertia="true"><span
                                                                            class="lnr lnr-heart"></span></a></li>
                                                                <li class="compare"><a href="#"
                                                                        data-tippy="Add to Compare"
                                                                        data-tippy-placement="top"
                                                                        data-tippy-arrow="true"
                                                                        data-tippy-inertia="true"><span
                                                                            class="lnr lnr-sync"></span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <figcaption class="product_content">
                                                        <h4 class="product_name"><a
                                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ Str::limit($product->product_name, 40) }}</a>
                                                        </h4>
                                                        <p><a href="#">Fruits</a></p>
                                                        {{-- daca produsul nu are discount afisam doar pretul de vanzare --}}
                                                        <div class="price_box">
                                                            @if ($product->discount_price == null)
                                                                <span
                                                                    class="current_price">{{ $product->selling_price }}
                                                                    RON</span>
                                                                {{-- daca produsul are discount afisam discount + pretul de vanzare fara discount --}}
                                                            @else
                                                                <span
                                                                    class="current_price">{{ $product->discount_price }}
                                                                    RON</span><br>
                                                                <span
                                                                    class="old_price">{{ $product->selling_price }}
                                                                    RON</span>
                                                            @endif
                                                        </div>
                                                    </figcaption>
                                                </figure>
                                            </article>
                                        </div>
                                    @empty
                                        <h5 class="text-danger">Nu au fost gasite produse</h5>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product area end-->

<!--banner area start-->
<div class="banner_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="single_banner">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="{{ asset('frontend/img/bg/banner1.jpg') }}" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="single_banner">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="{{ asset('frontend/img/bg/banner2.jpg') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--banner area end-->

<!--product area start-->
<div class="product_area product_deals mb-65">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <p>Produse recent adaugate in magazin </p>
                    <h2>Mega Oferte</h2>
                </div>
            </div>
        </div>
        <div class="product_container">
            <div class="row">
                <div class="col-12">
                    <div class="product_carousel product_column5 owl-carousel">

                        @foreach ($hot_deals as $product)
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img"
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                                src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                                        <a class="secondary_img"
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                                src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                                        @php
                                            // calculam procentul de discount pe baza pretului de vanzare / pretul de discount
                                            $amount = $product->selling_price - $product->discount_price;
                                            $discount = ($amount / $product->selling_price) * 100;
                                        @endphp
                                        <div class="label_product">
                                            {{-- daca produsul nu are pret de discount afisam tag de Nou --}}
                                            @if ($product->discount_price == null)
                                                <span class="label_new">Nou</span>
                                            @else
                                                {{-- daca produsul are pret de discount afisam % discount --}}
                                                <span class="label_sale">{{ round($discount) }}%</span>
                                            @endif
                                        </div>
                                        <div class="product_timing">
                                            <div data-countdown="2022/06/20"></div>
                                        </div>
                                        <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart"><a href="cart.html" data-tippy="Add to cart"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true"> <span
                                                            class="lnr lnr-cart"></span></a>
                                                </li>
                                                <li class="quick_button"><a href="#" data-tippy="quick view"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true" data-bs-toggle="modal"
                                                        data-bs-target="#modal_box"> <span
                                                            class="lnr lnr-magnifier"></span></a></li>
                                                <li class="wishlist"><a href="wishlist.html"
                                                        data-tippy="Add to Wishlist" data-tippy-placement="top"
                                                        data-tippy-arrow="true" data-tippy-inertia="true"><span
                                                            class="lnr lnr-heart"></span></a></li>
                                                <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true"><span
                                                            class="lnr lnr-sync"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <figcaption class="product_content">
                                        <h4 class="product_name"><a
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ Str::limit($product->product_name, 40) }}</a>
                                        </h4>
                                        <p><a href="#">Fruits</a></p>
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
    </div>
</div>
<!--product area end-->

<!--banner fullwidth area satrt-->
<div class="banner_fullwidth">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="banner_full_content">
                    <p>Black Fridays !</p>
                    <h2>Sale 50% OFf <span>all vegetable products</span></h2>
                    <a href="shop.html">discover now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--banner fullwidth area end-->

<!--product banner area satrt-->
<div class="product_banner_area mb-65">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <p>Recent adaugate in magazin </p>
                    <h2>Oferte Speciale</h2>
                </div>
            </div>
        </div>
        <div class="product_banner_container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="{{ asset('frontend/img/bg/OferteSpeciale.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    @foreach ($special_offer->shuffle() as $product)
                        <div class="small_product_area product_carousel  product_column2 owl-carousel">

                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img"
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                                    src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                                            <a class="secondary_img"
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                                    src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a
                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                            </h4>
                                            <p><a href="#">Fruits</a></p>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html"
                                                            data-tippy="Add to cart" data-tippy-placement="top"
                                                            data-tippy-arrow="true" data-tippy-inertia="true"> <span
                                                                class="lnr lnr-cart"></span></a></li>
                                                    <li class="quick_button"><a href="#" data-tippy="quick view"
                                                            data-tippy-placement="top" data-tippy-arrow="true"
                                                            data-tippy-inertia="true" data-bs-toggle="modal"
                                                            data-bs-target="#modal_box"> <span
                                                                class="lnr lnr-magnifier"></span></a></li>
                                                    <li class="wishlist"><a href="wishlist.html"
                                                            data-tippy="Add to Wishlist" data-tippy-placement="top"
                                                            data-tippy-arrow="true" data-tippy-inertia="true"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                    <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                            data-tippy-placement="top" data-tippy-arrow="true"
                                                            data-tippy-inertia="true"><span
                                                                class="lnr lnr-sync"></span></a></li>
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
                                        </figcaption>
                                    </figure>
                                </article>

                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--product banner area end-->

<!--product area start-->
<div class="product_area mb-65">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <p>Recently added our store </p>
                    <h2>Mostview Products</h2>
                </div>
            </div>
        </div>
        <div class="product_container">
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
                                                    data-bs-target="#modal_box"> <span
                                                        class="lnr lnr-magnifier"></span></a></li>
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
                                    <h4 class="product_name"><a href="product-details.html">Aliquam Consequat</a>
                                    </h4>
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
                                    <h4 class="product_name"><a href="product-details.html">Mauris Vel Tellus</a>
                                    </h4>
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
                                    <h4 class="product_name"><a href="product-details.html">Proin Lectus Ipsum</a>
                                    </h4>
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
    </div>
</div>
<!--product area end-->

<!--blog area start-->
<section class="blog_section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <p>Our recent articles about Organic</p>
                    <h2>Our Blog Posts</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="blog_carousel blog_column3 owl-carousel">
                <div class="col-lg-3">
                    <article class="single_blog">
                        <figure>
                            <div class="blog_thumb">
                                <a href="blog-details.html"><img src="{{ asset('frontend/img/blog/blog1.jpg') }}"
                                        alt=""></a>
                            </div>
                            <figcaption class="blog_content">
                                <div class="articles_date">
                                    <p>23/06/2021 | <a href="#">eCommerce</a> </p>
                                </div>
                                <h4 class="post_title"><a href="blog-details.html">Lorem ipsum dolor sit amet,
                                        elit. Impedit, aliquam animi, saepe ex.</a></h4>
                                <footer class="blog_footer">
                                    <a href="blog-details.html">Show more</a>
                                </footer>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-3">
                    <article class="single_blog">
                        <figure>
                            <div class="blog_thumb">
                                <a href="blog-details.html"><img src="{{ asset('frontend/img/blog/blog2.jpg') }}"
                                        alt=""></a>
                            </div>
                            <figcaption class="blog_content">
                                <div class="articles_date">
                                    <p>23/06/2021 | <a href="#">eCommerce</a> </p>
                                </div>
                                <h4 class="post_title"><a href="blog-details.html"> dolor sit amet, elit. Illo
                                        iste sed animi quaerat nobis odit nulla.</a></h4>
                                <footer class="blog_footer">
                                    <a href="blog-details.html">Show more</a>
                                </footer>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-3">
                    <article class="single_blog">
                        <figure>
                            <div class="blog_thumb">
                                <a href="blog-details.html"><img src="{{ asset('frontend/img/blog/blog3.jpg') }}"
                                        alt=""></a>
                            </div>
                            <figcaption class="blog_content">
                                <div class="articles_date">
                                    <p>23/06/2021 | <a href="#">eCommerce</a> </p>
                                </div>
                                <h4 class="post_title"><a href="blog-details.html">maxime laborum voluptas minus,
                                        est, unde eaque esse tenetur.</a></h4>
                                <footer class="blog_footer">
                                    <a href="blog-details.html">Show more</a>
                                </footer>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-3">
                    <article class="single_blog">
                        <figure>
                            <div class="blog_thumb">
                                <a href="blog-details.html"><img src="{{ asset('frontend/img/blog/blog2.jpg') }}"
                                        alt=""></a>
                            </div>
                            <figcaption class="blog_content">
                                <div class="articles_date">
                                    <p>23/06/2021 | <a href="#">eCommerce</a> </p>
                                </div>
                                <h4 class="post_title"><a href="blog-details.html">Lorem ipsum dolor sit amet,
                                        elit. Impedit, aliquam animi, saepe ex.</a></h4>
                                <footer class="blog_footer">
                                    <a href="blog-details.html">Show more</a>
                                </footer>
                            </figcaption>
                        </figure>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
<!--blog area end-->

<!--custom product area start-->
<div class="custom_product_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <p> Produse recent adaugate in magazin </p>
                    <h2>Produse Recomandate</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="small_product_area product_carousel product_column3 owl-carousel">
                    @foreach ($featured->shuffle() as $product)
                        <div class="product_items">

                            @foreach ($featured->shuffle() as $product)
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img"
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                                    src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                                            <a class="secondary_img"
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                                    src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                                        </div>

                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a
                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ Str::limit($product->product_name, 40) }}</a>
                                            </h4>
                                            <p><a href="#">Fruits</a></p>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html"
                                                            data-tippy="Add to cart" data-tippy-placement="top"
                                                            data-tippy-arrow="true" data-tippy-inertia="true"> <span
                                                                class="lnr lnr-cart"></span></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-tippy="quick view"
                                                            data-tippy-placement="top" data-tippy-arrow="true"
                                                            data-tippy-inertia="true" data-bs-toggle="modal"
                                                            data-bs-target="#modal_box"> <span
                                                                class="lnr lnr-magnifier"></span></a></li>
                                                    <li class="wishlist"><a href="wishlist.html"
                                                            data-tippy="Add to Wishlist" data-tippy-placement="top"
                                                            data-tippy-arrow="true" data-tippy-inertia="true"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                    <li class="compare"><a href="#" data-tippy="Add to Compare"
                                                            data-tippy-placement="top" data-tippy-arrow="true"
                                                            data-tippy-inertia="true"><span
                                                                class="lnr lnr-sync"></span></a>
                                                    </li>
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
                                        </figcaption>
                                    </figure>
                                </article>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--custom product area end-->

<!--brand area start-->
<!--brand area start-->
<div class="brand_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="brand_container owl-carousel ">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend/img/brand/brand1.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend/img/brand/brand2.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend/img/brand/brand3.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend/img/brand/brand4.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend/img/brand/brand2.jpg') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--brand area end-->
<!--brand area end-->
@endsection
