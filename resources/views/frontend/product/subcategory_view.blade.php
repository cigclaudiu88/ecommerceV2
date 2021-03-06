@extends('frontend.main_master')
@section('content')
@section('title')
    Produse functie de SubCategorie
@endsection
<!-- breadcrumbs_area_-->
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="breadcrumb_content" style="text-align: left !important;">
                <ul>
                    <li><a href="{{ url('/') }}">Acasa</a></li>
                    @foreach ($breadsubcat as $item)
                        <li class="text-success">{{ $item->category->category_name }}</li>
                    @endforeach

                    @foreach ($breadsubcat as $item)
                        <li class="text-success">{{ $item->subcategory_name }}</li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs_area_end -->

<!--shop  area start-->
<div class="shop_area shop_reverse mt-50 mb-70">
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

                        <div class="widget_list widget_color">
                            <h3>Filtreaza dupa pret</h3>
                            <form action="{{ URL::current() }}" method="GET">
                                @php
                                    if (isset($_GET['min']) && isset($_GET['max'])) {
                                        $form_min = $_GET['min'];
                                        $form_max = $_GET['max'];
                                    }
                                @endphp
                                <input type="text" class="form-control" name="form_min" placeholder="Pret Minim"><br>
                                <input type="text" class="form-control" name="form_max" placeholder="Pret Maxim">
                                <button type="submit" class="btn btn-success mt-3">Filtreaza</button>
                            </form>
                        </div>

                        {{-- SECTIUNE FILTRARE BRAND --}}
                        <div class="widget_list widget_color">
                            <h3>Filtrare Brand</h3>
                            <form action="{{ URL::current() }}" method="GET">
                                @foreach ($brand_filters as $filterbrand)
                                    @php
                                        $checked = [];
                                        if (isset($_GET['filterbrand'])) {
                                            $checked = $_GET['filterbrand'];
                                        }
                                    @endphp

                                    <div class="col-12">
                                        <input type="checkbox" value={{ $filterbrand->brand->brand_name }}
                                            name="filterbrand[]" @if (in_array($filterbrand->brand->brand_name, $checked)) checked @endif>

                                        <label>{{ $filterbrand->brand->brand_name }}</label>
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-success mt-3">Filtreaza</button>
                            </form>
                        </div>
                        {{-- SECTIUNE FILTRARE BRAND --}}

                        {{-- SECTIUNE FILTRARE DISPLAY --}}
                        @if ($display_filters->count())
                            <div class="widget_list widget_color">
                                <h3>Filtrare Display</h3>
                                <form action="{{ URL::current() }}" method="GET">
                                    @foreach ($display_filters as $filterdisplay)
                                        @php
                                            $checked = [];
                                            if (isset($_GET['filterdisplay'])) {
                                                $checked = $_GET['filterdisplay'];
                                            }
                                        @endphp

                                        <div class="col-12">
                                            <input type="checkbox" value="{{ $filterdisplay->phone_display }}"
                                                name="filterdisplay[]" @if (in_array($filterdisplay->phone_display, $checked)) checked @endif>

                                            <label>{{ $filterdisplay->phone_display }}</label>
                                        </div>
                                    @endforeach
                                    <button type="submit" class="btn btn-success mt-3">Filtreaza</button>
                                </form>
                            </div>
                        @endif
                        {{-- SECTIUNE FILTRARE DISPLAY --}}



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

                        <button data-role="grid_list" type="button" class="btn-list" data-toggle="tooltip"
                            title="List"></button>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <select class="form-select" name="orderby" id="short"
                            onchange="window.location.href=this.options[this.selectedIndex].value;">
                            <option value="">Sorteaza produsele</option>
                            <option value="{{ URL::current() . '?sort=newest' }}">Sorteaza dupa noutati</option>
                            <option value="{{ URL::current() . '?sort=recommended' }}">Produse recomandate
                            </option>
                            <option value="{{ URL::current() . '?sort=price_asc' }}">Sorteaza dupa Pret: Ascendent
                            </option>
                            <option value="{{ URL::current() . '?sort=price_desc' }}">Sorteaza dupa Pret: Descendent
                            </option>
                        </select>
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
                                    <h4 class="product_name"><a
                                            href="product-details.html">{{ $product->product_name }}</a></h4>
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
                                        <p>{{ $product->short_description }}</p>
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
