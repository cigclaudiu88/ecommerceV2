@extends('frontend.main_master')
@section('content')
@section('title')
    Pagina de Cautare Produse
@endsection
<!--shop  area start-->
<div class="shop_area shop_reverse mt-70 mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <!--sidebar widget start-->
                <aside class="sidebar_widget">
                    <div class="widget_inner">
                        <div class="widget_list widget_categories">
                            <h3>Filtru Categorii Produse</h3>

                            <ul>
                                @foreach ($categories as $category)
                                    <li class="widget_sub_categories sub_categories{{ $category->id }}"><a
                                            href="javascript:void(0)">
                                            <i class="fa fa-angle-down"></i> {{ $category->category_name }} </a>
                                        <ul class="widget_dropdown_categories dropdown_categories{{ $category->id }}">
                                            @php
                                                // displays only when category_id from subcategories table matches the id from categories table
                                                $subcategories = App\Models\SubCategory::where('category_id', $category->id)
                                                    ->orderBy('id', 'ASC')
                                                    ->get();
                                            @endphp
                                            @foreach ($subcategories as $subcategory)
                                                <li
                                                    class="widget_sub_categories sub_sub_categories{{ $subcategory->id }}">
                                                    <a href="javascript:void(0)"><i class="fa fa-angle-down"></i>
                                                        {{ $subcategory->subcategory_name }}</a>
                                                    <ul
                                                        class="widget_dropdown_categories dropdown_sub_categories{{ $subcategory->id }}">
                                                        @php
                                                            // displays only when category_id from subcategories table matches the id from categories table
                                                            $subsubcategories = App\Models\SubSubCategory::where('subcategory_id', $subcategory->id)
                                                                ->orderBy('id', 'ASC')
                                                                ->get();
                                                        @endphp
                                                        @foreach ($subsubcategories as $subsubcategory)
                                                            <li><a
                                                                    href="{{ url('subsubcategory/product/' . $subsubcategory->id . '/' . $subsubcategory->subsubcategory_slug) }}">{{ $subsubcategory->subsubcategory_name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>

                        </div>

                        <div class="widget_list widget_filter">
                            <h3>Filter by price</h3>
                            <form action="#">
                                <div id="slider-range"></div>
                                <button type="submit">Filter</button>
                                <input type="text" name="text" id="amount" />

                            </form>
                        </div>
                        <div class="widget_list widget_color">
                            <h3>Select By Color</h3>
                            <ul>
                                <li>
                                    <a href="#">Black <span>(6)</span></a>
                                </li>
                                <li>
                                    <a href="#"> Blue <span>(8)</span></a>
                                </li>
                                <li>
                                    <a href="#">Brown <span>(10)</span></a>
                                </li>
                                <li>
                                    <a href="#"> Green <span>(6)</span></a>
                                </li>
                                <li>
                                    <a href="#">Pink <span>(4)</span></a>
                                </li>

                            </ul>
                        </div>
                        <div class="widget_list widget_color">
                            <h3>Select By SIze</h3>
                            <ul>
                                <li>
                                    <a href="#">S <span>(6)</span></a>
                                </li>
                                <li>
                                    <a href="#"> M <span>(8)</span></a>
                                </li>
                                <li>
                                    <a href="#">L <span>(10)</span></a>
                                </li>
                                <li>
                                    <a href="#"> XL <span>(6)</span></a>
                                </li>
                                <li>
                                    <a href="#">XLL <span>(4)</span></a>
                                </li>

                            </ul>
                        </div>
                        <div class="widget_list widget_manu">
                            <h3>Manufacturer</h3>
                            <ul>
                                <li>
                                    <a href="#">Brake Parts <span>(6)</span></a>
                                </li>
                                <li>
                                    <a href="#">Accessories <span>(10)</span></a>
                                </li>
                                <li>
                                    <a href="#">Engine Parts <span>(4)</span></a>
                                </li>
                                <li>
                                    <a href="#">hermes <span>(10)</span></a>
                                </li>
                                <li>
                                    <a href="#">louis vuitton <span>(8)</span></a>
                                </li>

                            </ul>
                        </div>
                        <div class="widget_list tags_widget">
                            <h3>Product tags</h3>
                            <div class="tag_cloud">
                                <a href="#">Men</a>
                                <a href="#">Women</a>
                                <a href="#">Watches</a>
                                <a href="#">Bags</a>
                                <a href="#">Dress</a>
                                <a href="#">Belt</a>
                                <a href="#">Accessories</a>
                                <a href="#">Shoes</a>
                            </div>
                        </div>
                        <div class="widget_list banner_widget">
                            <div class="banner_thumb">
                                <a href="#"><img src="{{ asset('frontend/img/bg/banner17.jpg') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                </aside>
                <!--sidebar widget end-->
            </div>
            <div class="col-lg-9 col-md-12">
                <!--shop wrapper start-->
                <!--shop toolbar start-->
                <div class="shop_toolbar_wrapper">
                    <div class="shop_toolbar_btn">

                        <button data-role="grid_3" type="button" class="active btn-grid-3" data-toggle="tooltip"
                            title="3"></button>

                        <button data-role="grid_4" type="button" class=" btn-grid-4" data-toggle="tooltip"
                            title="4"></button>

                        <button data-role="grid_list" type="button" class="btn-list" data-toggle="tooltip"
                            title="List"></button>
                    </div>
                    <div class=" niceselect_option">
                        <form class="select_option" action="#">
                            <select name="orderby" id="short">

                                <option selected value="1">Sort by average rating</option>
                                <option value="2">Sort by popularity</option>
                                <option value="3">Sort by newness</option>
                                <option value="4">Sort by price: low to high</option>
                                <option value="5">Sort by price: high to low</option>
                                <option value="6">Product Name: Z</option>
                            </select>
                        </form>
                    </div>
                    <div class="page_amount">
                        <strong class="text-success">{{ count($products) }} produse</strong>
                    </div>
                </div>

                <!--shop toolbar end-->
                <div class="row shop_wrapper">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="single_product">
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
                                                    id="{{ $product->id }}" name="{{ $product->product_name }}"
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
                                {{-- GRID VIEW STARTS --}}
                                <div class="product_content grid_content">
                                    <h4 class="product_name"><a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ Str::limit($product->product_name, 40) }}</a>
                                    </h4>
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
                                </div>
                                {{-- GRID VIEW ENDS --}}

                                {{-- LIST VIEW STARTS --}}
                                <div class="product_content list_content">
                                    <h4 class="product_name"><a href="product-details.html">Aliquam Consequat</a></h4>
                                    <p><a href="#">Fruits</a></p>
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
                                    <div class="product_desc">
                                        <p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis
                                            vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum
                                            primis
                                            in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend
                                            laoreet congue. Viva..</p>
                                    </div>
                                    <div class="action_links list_action_right">
                                        <ul>
                                            <li class="add_to_cart"><a data-tippy="Adauga in Cos"
                                                    data-tippy-placement="top" data-tippy-arrow="true"
                                                    data-tippy-inertia="true" {{-- adaugat id si nume produs --}}
                                                    id="{{ $product->id }}" name="{{ $product->product_name }}"
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
                                {{-- LIST VIEW ENDS --}}

                            </div>
                        </div>
                    @endforeach
                    {{-- for pagination?? --}}

                </div>

                <div class="shop_toolbar t_bottom">
                    <div class="pagination">
                        <ul>
                            {{ $products->links() }}
                        </ul>
                    </div>
                </div>
                <!--shop toolbar end-->
                <!--shop wrapper end-->
            </div>
        </div>
    </div>
</div>
<!--shop  area end-->
@endsection
