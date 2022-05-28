@extends('frontend.main_master')
@section('content')
    {{-- sectiune de titlu --}}
@section('title')
    eShop UPT
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
                        {{-- <p>Recent adaugate in magazin</p> --}}
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
                                                            <li class="add_to_cart"><a data-tippy="Adauga in Cos"
                                                                    data-tippy-placement="top" data-tippy-arrow="true"
                                                                    data-tippy-inertia="true" {{-- adaugat id si nume produs --}}
                                                                    id="{{ $product->id }}"
                                                                    name="{{ $product->product_name }}"
                                                                    onclick="addToCartButton(this.id, this.name)">
                                                                    <span class="lnr lnr-cart"></span></a></li>
                                                            {{-- adaugat onclick event si id-ul produsului --}}
                                                            <li class="quick_button"><a data-tippy="Previzualizare"
                                                                    data-tippy-placement="top" data-tippy-arrow="true"
                                                                    data-tippy-inertia="true" data-bs-toggle="modal"
                                                                    data-bs-target="#modal_box"
                                                                    onclick="productView(this.id)"
                                                                    id="{{ $product->id }}">
                                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                                            {{-- adaugat onclick event si id-ul produsului pt wishlist --}}
                                                            <li class="wishlist"><a
                                                                    data-tippy="Adauga in Wishlist"
                                                                    data-tippy-placement="top" data-tippy-arrow="true"
                                                                    data-tippy-inertia="true" id="{{ $product->id }}"
                                                                    onclick="addToWishList(this.id)"><span
                                                                        class="lnr lnr-heart"></span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <figcaption class="product_content">
                                                    <h4 class="product_name"><a
                                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ Str::limit($product->product_name, 40) }}</a>
                                                    </h4>
                                                    {{-- adaugat link spre subsubcategorii din slid-uri de produse --}}
                                                    {{-- inclus rating produse --}}
                                                    @include('frontend.product.product_rating')
                                                    <p><a
                                                            href="{{ url('subsubcategory/product/' . $product->subsubcategory->id . '/' . $product->subsubcategory->subsubcategory_slug) }}">{{ $product->subsubcategory->subsubcategory_name }}</a>
                                                    </p>
                                                    {{-- daca produsul nu are discount afisam doar pretul de vanzare --}}
                                                    <div class="price_box">
                                                        @if ($product->discount_price == null)
                                                            <span
                                                                class="current_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
                                                                RON</span>
                                                            {{-- daca produsul are discount afisam discount + pretul de vanzare fara discount --}}
                                                        @else
                                                            <span
                                                                class="current_price">{{ number_format($product->discount_price * 0.19 + $product->discount_price, 2, '.', ',') }}
                                                                RON</span><br>
                                                            <span
                                                                class="old_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
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
                                                                <li class="add_to_cart"><a data-tippy="Adauga in Cos"
                                                                        data-tippy-placement="top"
                                                                        data-tippy-arrow="true"
                                                                        data-tippy-inertia="true" {{-- adaugat id si nume produs --}}
                                                                        id="{{ $product->id }}"
                                                                        name="{{ $product->product_name }}"
                                                                        onclick="addToCartButton(this.id, this.name)">
                                                                        <span class="lnr lnr-cart"></span></a></li>
                                                                {{-- adaugat onclick event si id-ul produsului --}}
                                                                <li class="quick_button"><a
                                                                        data-tippy="Previzualizare"
                                                                        data-tippy-placement="top"
                                                                        data-tippy-arrow="true"
                                                                        data-tippy-inertia="true" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box"
                                                                        onclick="productView(this.id)"
                                                                        id="{{ $product->id }}">
                                                                        <span class="lnr lnr-magnifier"></span></a></li>
                                                                {{-- adaugat onclick event si id-ul produsului pt wishlist --}}
                                                                <li class="wishlist"><a
                                                                        data-tippy="Adauga in Wishlist"
                                                                        data-tippy-placement="top"
                                                                        data-tippy-arrow="true"
                                                                        data-tippy-inertia="true"
                                                                        id="{{ $product->id }}"
                                                                        onclick="addToWishList(this.id)"><span
                                                                            class="lnr lnr-heart"></span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <figcaption class="product_content">
                                                        <h4 class="product_name"><a
                                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ Str::limit($product->product_name, 40) }}</a>
                                                        </h4>
                                                        {{-- adaugat link spre subsubcategorii din slid-uri de produse --}}
                                                        {{-- inclus rating produse --}}
                                                        @include('frontend.product.product_rating')
                                                        <p><a
                                                                href="{{ url('subsubcategory/product/' . $product->subsubcategory->id . '/' . $product->subsubcategory->subsubcategory_slug) }}">{{ $product->subsubcategory->subsubcategory_name }}</a>
                                                        </p>
                                                        {{-- daca produsul nu are discount afisam doar pretul de vanzare --}}
                                                        <div class="price_box">
                                                            @if ($product->discount_price == null)
                                                                <span
                                                                    class="current_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
                                                                    RON</span>
                                                                {{-- daca produsul are discount afisam discount + pretul de vanzare fara discount --}}
                                                            @else
                                                                <span
                                                                    class="current_price">{{ number_format($product->discount_price * 0.19 + $product->discount_price, 2, '.', ',') }}
                                                                    RON</span><br>
                                                                <span
                                                                    class="old_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
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
                        <a href="shop.html"><img src="{{ asset('frontend/img/bg/apple.png') }}" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="single_banner">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="{{ asset('frontend/img/bg/samsung.png') }}" alt=""></a>
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
                                        {{-- <div class="product_timing">
                                            <div data-countdown="2022/06/20"></div>
                                        </div> --}}
                                        <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart"><a data-tippy="Adauga in Cos"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true" {{-- adaugat id si nume produs --}}
                                                        id="{{ $product->id }}"
                                                        name="{{ $product->product_name }}"
                                                        onclick="addToCartButton(this.id, this.name)">
                                                        <span class="lnr lnr-cart"></span></a></li>
                                                {{-- adaugat onclick event si id-ul produsului --}}
                                                <li class="quick_button"><a data-tippy="Previzualizare"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true" data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" onclick="productView(this.id)"
                                                        id="{{ $product->id }}">
                                                        <span class="lnr lnr-magnifier"></span></a></li>
                                                {{-- adaugat onclick event si id-ul produsului pt wishlist --}}
                                                <li class="wishlist"><a data-tippy="Adauga in Wishlist"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true" id="{{ $product->id }}"
                                                        onclick="addToWishList(this.id)"><span
                                                            class="lnr lnr-heart"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <figcaption class="product_content">
                                        <h4 class="product_name"><a
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ Str::limit($product->product_name, 40) }}</a>
                                        </h4>
                                        {{-- adaugat link spre subsubcategorii din slid-uri de produse --}}
                                        {{-- inclus rating produse --}}
                                        @include('frontend.product.product_rating')
                                        <p><a
                                                href="{{ url('subsubcategory/product/' . $product->subsubcategory->id . '/' . $product->subsubcategory->subsubcategory_slug) }}">{{ $product->subsubcategory->subsubcategory_name }}</a>
                                        </p>
                                        {{-- daca produsul nu are discount afisam doar pretul de vanzare --}}
                                        <div class="price_box">
                                            @if ($product->discount_price == null)
                                                <span
                                                    class="current_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
                                                    RON</span>
                                                {{-- daca produsul are discount afisam discount + pretul de vanzare fara discount --}}
                                            @else
                                                <span
                                                    class="current_price">{{ number_format($product->discount_price * 0.19 + $product->discount_price, 2, '.', ',') }}
                                                    RON</span><br>
                                                <span
                                                    class="old_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
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
                    <strong>
                        <p style="color:black !important;">Zilele eShop UPT</p>
                    </strong>
                    <h2>Foloseste Voucher-ul UPT22<span>pentru reducere de 10% la toate comenzile plasate in perioada
                            01.06.2022 - 30.06.2022</span></h2>
                    {{-- <a href="shop.html">discover now</a> --}}
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
                    <h2>Oferte Speciale</h2>
                </div>
            </div>
        </div>
        <div class="product_banner_container">
            <div class="row">
                <div class="col-lg-12 col-md-7">
                    @foreach ($special_offer->shuffle() as $product)
                        <div class="small_product_area product_carousel product_column3 owl-carousel mt-5">

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

                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a
                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ Str::limit($product->product_name, 40) }}</a>
                                            </h4>
                                            {{-- adaugat link spre subsubcategorii din slid-uri de produse --}}
                                            {{-- inclus rating produse --}}
                                            @include('frontend.product.product_rating')
                                            <p><a
                                                    href="{{ url('subsubcategory/product/' . $product->subsubcategory->id . '/' . $product->subsubcategory->subsubcategory_slug) }}">{{ $product->subsubcategory->subsubcategory_name }}</a>
                                            </p>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a data-tippy="Adauga in Cos"
                                                            data-tippy-placement="top" data-tippy-arrow="true"
                                                            data-tippy-inertia="true" {{-- adaugat id si nume produs --}}
                                                            id="{{ $product->id }}"
                                                            name="{{ $product->product_name }}"
                                                            onclick="addToCartButton(this.id, this.name)">
                                                            <span class="lnr lnr-cart"></span></a></li>
                                                    {{-- adaugat onclick event si id-ul produsului --}}
                                                    <li class="quick_button"><a data-tippy="Previzualizare"
                                                            data-tippy-placement="top" data-tippy-arrow="true"
                                                            data-tippy-inertia="true" data-bs-toggle="modal"
                                                            data-bs-target="#modal_box" onclick="productView(this.id)"
                                                            id="{{ $product->id }}">
                                                            <span class="lnr lnr-magnifier"></span></a></li>
                                                    {{-- adaugat onclick event si id-ul produsului pt wishlist --}}
                                                    <li class="wishlist"><a data-tippy="Adauga in Wishlist"
                                                            data-tippy-placement="top" data-tippy-arrow="true"
                                                            data-tippy-inertia="true" id="{{ $product->id }}"
                                                            onclick="addToWishList(this.id)"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                </ul>
                                            </div>
                                            {{-- daca produsul nu are discount afisam doar pretul de vanzare --}}
                                            <div class="price_box">
                                                @if ($product->discount_price == null)
                                                    <span
                                                        class="current_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
                                                        RON</span>
                                                    {{-- daca produsul are discount afisam discount + pretul de vanzare fara discount --}}
                                                @else
                                                    <span
                                                        class="current_price">{{ number_format($product->discount_price * 0.19 + $product->discount_price, 2, '.', ',') }}
                                                        RON</span><br>
                                                    <span
                                                        class="old_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
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

{{-- Sectiunea de Ofertele Saptamanii start --}}
<div class="product_area mb-65">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Ofertele Saptamanii</h2>
                </div>
            </div>
        </div>
        <div class="product_container">
            <div class="row">
                <div class="col-12">
                    <div class="product_carousel product_column5 owl-carousel">
                        @foreach ($special_deals as $product)
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
                                        <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart"><a data-tippy="Adauga in Cos"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true" {{-- adaugat id si nume produs --}}
                                                        id="{{ $product->id }}"
                                                        name="{{ $product->product_name }}"
                                                        onclick="addToCartButton(this.id, this.name)">
                                                        <span class="lnr lnr-cart"></span></a></li>
                                                {{-- adaugat onclick event si id-ul produsului --}}
                                                <li class="quick_button"><a data-tippy="Previzualizare"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true" data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" onclick="productView(this.id)"
                                                        id="{{ $product->id }}">
                                                        <span class="lnr lnr-magnifier"></span></a></li>
                                                {{-- adaugat onclick event si id-ul produsului pt wishlist --}}
                                                <li class="wishlist"><a data-tippy="Adauga in Wishlist"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true" id="{{ $product->id }}"
                                                        onclick="addToWishList(this.id)"><span
                                                            class="lnr lnr-heart"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <figcaption class="product_content">
                                        <h4 class="product_name"><a
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ Str::limit($product->product_name, 40) }}</a>
                                        </h4>
                                        {{-- adaugat link spre subsubcategorii din slid-uri de produse --}}
                                        {{-- inclus rating produse --}}
                                        @include('frontend.product.product_rating')
                                        <p><a
                                                href="{{ url('subsubcategory/product/' . $product->subsubcategory->id . '/' . $product->subsubcategory->subsubcategory_slug) }}">{{ $product->subsubcategory->subsubcategory_name }}</a>
                                        </p>
                                        {{-- daca produsul nu are discount afisam doar pretul de vanzare --}}
                                        <div class="price_box">
                                            @if ($product->discount_price == null)
                                                <span
                                                    class="current_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
                                                    RON</span>
                                                {{-- daca produsul are discount afisam discount + pretul de vanzare fara discount --}}
                                            @else
                                                <span
                                                    class="current_price">{{ number_format($product->discount_price * 0.19 + $product->discount_price, 2, '.', ',') }}
                                                    RON</span><br>
                                                <span
                                                    class="old_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
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
{{-- Sectiunea de Ofertele Saptamanii sfarsit --}}

<!--blog area start-->
<section class="blog_section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    {{-- <p>Our recent articles about Organic</p> --}}
                    <a href="{{ route('home.blog') }}">
                        <h2>Blog</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="blog_carousel blog_column3 owl-carousel">

                @foreach ($blogpost as $blog)
                    <div class="col-lg-3">
                        <article class="single_blog">
                            <figure>
                                <div class="blog_thumb">
                                    <a href="{{ route('post.details', $blog->id) }}"><img
                                            src="{{ asset($blog->post_image) }}" alt=""></a>
                                </div>
                                <figcaption class="blog_content">
                                    <div class="articles_date">
                                        <p>{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }} | <a
                                                href="#">{{ $blog->category->blog_category_name }}</a> </p>
                                    </div>
                                    <h4 class="post_title"><a href="{{ route('post.details', $blog->id) }}">
                                            {{ $blog->post_title }}</a></h4>
                                    <footer class="blog_footer">
                                        <a href="{{ route('post.details', $blog->id) }}">Afla mai multe</a>
                                    </footer>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--blog area end-->

{{-- Sectiunea de Produse a unei categorii specifice start --}}
<div class="product_area mb-65">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Oferte de Telefoane</h2>
                </div>
            </div>
        </div>
        <div class="product_container">
            <div class="row">
                <div class="col-12">
                    <div class="product_carousel product_column5 owl-carousel">
                        @foreach ($skip_product_0 as $product)
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
                                        <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart"><a data-tippy="Adauga in Cos"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true" {{-- adaugat id si nume produs --}}
                                                        id="{{ $product->id }}"
                                                        name="{{ $product->product_name }}"
                                                        onclick="addToCartButton(this.id, this.name)">
                                                        <span class="lnr lnr-cart"></span></a></li>
                                                {{-- adaugat onclick event si id-ul produsului --}}
                                                <li class="quick_button"><a data-tippy="Previzualizare"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true" data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" onclick="productView(this.id)"
                                                        id="{{ $product->id }}">
                                                        <span class="lnr lnr-magnifier"></span></a></li>
                                                {{-- adaugat onclick event si id-ul produsului pt wishlist --}}
                                                <li class="wishlist"><a data-tippy="Adauga in Wishlist"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true" id="{{ $product->id }}"
                                                        onclick="addToWishList(this.id)"><span
                                                            class="lnr lnr-heart"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <figcaption class="product_content">
                                        <h4 class="product_name"><a
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ Str::limit($product->product_name, 40) }}</a>
                                        </h4>
                                        {{-- adaugat link spre subsubcategorii din slid-uri de produse --}}
                                        {{-- inclus rating produse --}}
                                        @include('frontend.product.product_rating')
                                        <p><a
                                                href="{{ url('subsubcategory/product/' . $product->subsubcategory->id . '/' . $product->subsubcategory->subsubcategory_slug) }}">{{ $product->subsubcategory->subsubcategory_name }}</a>
                                        </p>
                                        {{-- daca produsul nu are discount afisam doar pretul de vanzare --}}
                                        <div class="price_box">
                                            @if ($product->discount_price == null)
                                                <span
                                                    class="current_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
                                                    RON</span>
                                                {{-- daca produsul are discount afisam discount + pretul de vanzare fara discount --}}
                                            @else
                                                <span
                                                    class="current_price">{{ number_format($product->discount_price * 0.19 + $product->discount_price, 2, '.', ',') }}
                                                    RON</span><br>
                                                <span
                                                    class="old_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
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
{{-- Sectiunea de Produse a unei categorii specifice sfarsit --}}

{{-- Sectiunea de Produse a unui brand specific start --}}
<div class="product_area mb-65">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Oferte Produse Samsung</h2>
                </div>
            </div>
        </div>
        <div class="product_container">
            <div class="row">
                <div class="col-12">
                    <div class="product_carousel product_column5 owl-carousel">
                        @foreach ($skip_brand_product_0 as $product)
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
                                        <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart"><a data-tippy="Adauga in Cos"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true" {{-- adaugat id si nume produs --}}
                                                        id="{{ $product->id }}"
                                                        name="{{ $product->product_name }}"
                                                        onclick="addToCartButton(this.id, this.name)">
                                                        <span class="lnr lnr-cart"></span></a></li>
                                                {{-- adaugat onclick event si id-ul produsului --}}
                                                <li class="quick_button"><a data-tippy="Previzualizare"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true" data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" onclick="productView(this.id)"
                                                        id="{{ $product->id }}">
                                                        <span class="lnr lnr-magnifier"></span></a></li>
                                                {{-- adaugat onclick event si id-ul produsului pt wishlist --}}
                                                <li class="wishlist"><a data-tippy="Adauga in Wishlist"
                                                        data-tippy-placement="top" data-tippy-arrow="true"
                                                        data-tippy-inertia="true" id="{{ $product->id }}"
                                                        onclick="addToWishList(this.id)"><span
                                                            class="lnr lnr-heart"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <figcaption class="product_content">
                                        <h4 class="product_name"><a
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ Str::limit($product->product_name, 40) }}</a>
                                        </h4>
                                        {{-- adaugat link spre subsubcategorii din slid-uri de produse --}}
                                        {{-- inclus rating produse --}}
                                        @include('frontend.product.product_rating')
                                        <p><a
                                                href="{{ url('subsubcategory/product/' . $product->subsubcategory->id . '/' . $product->subsubcategory->subsubcategory_slug) }}">{{ $product->subsubcategory->subsubcategory_name }}</a>
                                        </p>
                                        {{-- daca produsul nu are discount afisam doar pretul de vanzare --}}
                                        <div class="price_box">
                                            @if ($product->discount_price == null)
                                                <span
                                                    class="current_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
                                                    RON</span>
                                                {{-- daca produsul are discount afisam discount + pretul de vanzare fara discount --}}
                                            @else
                                                <span
                                                    class="current_price">{{ number_format($product->discount_price * 0.19 + $product->discount_price, 2, '.', ',') }}
                                                    RON</span><br>
                                                <span
                                                    class="old_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
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
{{-- Sectiunea de Produse a unui brand specific sfarsit --}}


@auth

    @if ($wishlist_products->isEmpty())
    @else
        {{-- Sectiunea de Produse din Wishlist pentru Utilizatorul autentificat start --}}
        <div class="product_area mb-65">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_title">
                            <h2>Produse din Wishlist</h2>
                        </div>
                    </div>
                </div>
                <div class="product_container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_carousel product_column5 owl-carousel">
                                @foreach ($wishlist_products as $product)
                                    <article class="single_product">
                                        <figure>
                                            <div class="product_thumb">
                                                <a class="primary_img"
                                                    href="{{ url('product/details/' . $product->product->id . '/' . $product->product->product_slug) }}"><img
                                                        src="{{ asset($product->product->product_thumbnail) }}"
                                                        alt=""></a>
                                                <a class="secondary_img"
                                                    href="{{ url('product/details/' . $product->product->id . '/' . $product->product->product_slug) }}"><img
                                                        src="{{ asset($product->product->product_thumbnail) }}"
                                                        alt=""></a>
                                                @php
                                                    // calculam procentul de discount pe baza pretului de vanzare / pretul de discount
                                                    $amount = $product->product->selling_price - $product->product->discount_price;
                                                    $discount = ($amount / $product->product->selling_price) * 100;
                                                @endphp
                                                <div class="label_product">
                                                    {{-- daca produsul nu are pret de discount afisam tag de Nou --}}
                                                    @if ($product->product->discount_price == null)
                                                        <span class="label_new">Nou</span>
                                                    @else
                                                        {{-- daca produsul are pret de discount afisam % discount --}}
                                                        <span class="label_sale">{{ round($discount) }}%</span>
                                                    @endif
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li class="add_to_cart"><a data-tippy="Adauga in Cos"
                                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                                data-tippy-inertia="true" {{-- adaugat id si nume produs --}}
                                                                id="{{ $product->product->id }}"
                                                                name="{{ $product->product->product_name }}"
                                                                onclick="addToCartButton(this.id, this.name)">
                                                                <span class="lnr lnr-cart"></span></a></li>
                                                        {{-- adaugat onclick event si id-ul produsului --}}
                                                        <li class="quick_button"><a data-tippy="Previzualizare"
                                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                                data-tippy-inertia="true" data-bs-toggle="modal"
                                                                data-bs-target="#modal_box" onclick="productView(this.id)"
                                                                id="{{ $product->product->id }}">
                                                                <span class="lnr lnr-magnifier"></span></a></li>
                                                        {{-- adaugat onclick event si id-ul produsului pt wishlist --}}
                                                        <li class="wishlist"><a data-tippy="Adauga in Wishlist"
                                                                data-tippy-placement="top" data-tippy-arrow="true"
                                                                data-tippy-inertia="true"
                                                                id="{{ $product->product->id }}"
                                                                onclick="addToWishList(this.id)"><span
                                                                    class="lnr lnr-heart"></span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <figcaption class="product_content">
                                                <h4 class="product_name"><a
                                                        href="{{ url('product/details/' . $product->product->id . '/' . $product->product->product_slug) }}">{{ Str::limit($product->product->product_name, 40) }}</a>
                                                </h4>
                                                {{-- adaugat link spre subsubcategorii din slid-uri de produse --}}
                                                {{-- inclus rating produse --}}
                                                @include('frontend.product.product_rating')
                                                <p><a
                                                        href="{{ url('subsubcategory/product/' . $product->product->subsubcategory->id . '/' . $product->product->subsubcategory->subsubcategory_slug) }}">{{ $product->product->subsubcategory->subsubcategory_name }}</a>
                                                </p>
                                                {{-- daca produsul nu are discount afisam doar pretul de vanzare --}}
                                                <div class="price_box">
                                                    @if ($product->product->discount_price == null)
                                                        <span
                                                            class="current_price">{{ number_format($product->product->selling_price * 0.19 + $product->product->selling_price, 2, '.', ',') }}
                                                            RON</span>
                                                        {{-- daca produsul are discount afisam discount + pretul de vanzare fara discount --}}
                                                    @else
                                                        <span
                                                            class="current_price">{{ number_format($product->product->discount_price * 0.19 + $product->product->discount_price, 2, '.', ',') }}
                                                            RON</span><br>
                                                        <span
                                                            class="old_price">{{ number_format($product->product->selling_price * 0.19 + $product->product->selling_price, 2, '.', ',') }}
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
        {{-- Sectiunea de Produse din Wishlist pentru Utilizatorul autentificat start --}}
    @endif
@endauth


<!--custom product area start-->
<div class="custom_product_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
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
                                            {{-- adaugat link spre subsubcategorii din slid-uri de produse --}}
                                            {{-- inclus rating produse --}}
                                            @include('frontend.product.product_rating')
                                            <p><a
                                                    href="{{ url('subsubcategory/product/' . $product->subsubcategory->id . '/' . $product->subsubcategory->subsubcategory_slug) }}">{{ $product->subsubcategory->subsubcategory_name }}</a>
                                            </p>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a data-tippy="Adauga in Cos"
                                                            data-tippy-placement="top" data-tippy-arrow="true"
                                                            data-tippy-inertia="true" {{-- adaugat id si nume produs --}}
                                                            id="{{ $product->id }}"
                                                            name="{{ $product->product_name }}"
                                                            onclick="addToCartButton(this.id, this.name)">
                                                            <span class="lnr lnr-cart"></span></a></li>
                                                    {{-- adaugat onclick event si id-ul produsului --}}
                                                    <li class="quick_button"><a data-tippy="Previzualizare"
                                                            data-tippy-placement="top" data-tippy-arrow="true"
                                                            data-tippy-inertia="true" data-bs-toggle="modal"
                                                            data-bs-target="#modal_box" onclick="productView(this.id)"
                                                            id="{{ $product->id }}">
                                                            <span class="lnr lnr-magnifier"></span></a></li>
                                                    {{-- adaugat onclick event si id-ul produsului pt wishlist --}}
                                                    <li class="wishlist"><a data-tippy="Adauga in Wishlist"
                                                            data-tippy-placement="top" data-tippy-arrow="true"
                                                            data-tippy-inertia="true" id="{{ $product->id }}"
                                                            onclick="addToWishList(this.id)"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                </ul>
                                            </div>
                                            {{-- daca produsul nu are discount afisam doar pretul de vanzare --}}
                                            <div class="price_box">
                                                @if ($product->discount_price == null)
                                                    <span
                                                        class="current_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
                                                        RON</span>
                                                    {{-- daca produsul are discount afisam discount + pretul de vanzare fara discount --}}
                                                @else
                                                    <span
                                                        class="current_price">{{ number_format($product->discount_price * 0.19 + $product->discount_price, 2, '.', ',') }}
                                                        RON</span><br>
                                                    <span
                                                        class="old_price">{{ number_format($product->selling_price * 0.19 + $product->selling_price, 2, '.', ',') }}
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
                    @foreach ($brand_logo as $item)
                        <div class="single_brand">
                            <a href=""><img src="{{ asset($item->brand_image) }}" alt=""></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--brand area end-->
<!--brand area end-->
@endsection
