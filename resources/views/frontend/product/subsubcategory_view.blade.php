@extends('frontend.main_master')
@section('content')
@section('title')
    Produse functie de SubSubCategorie
@endsection

<!-- breadcrumbs_area_-->
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="breadcrumb_content" style="text-align: left !important;">
                <ul>
                    <li><a href="{{ url('/') }}">Acasa</a></li>
                    @foreach ($breadsubsubcat as $item)
                        <li class="text-success">{{ $item->category->category_name }}</li>
                    @endforeach

                    @foreach ($breadsubsubcat as $item)
                        <li class="text-success">{{ $item->subcategory->subcategory_name }}</li>
                    @endforeach

                    @foreach ($breadsubsubcat as $item)
                        <li class="text-success">{{ $item->subsubcategory_name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs_area_end -->

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

                        {{-- <div class="widget_list widget_color">
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
                        </div> --}}


                        @if ($phone_display_filter->count() || $phone_storage_filter->count() || $phone_memory_filter->count())
                            {{-- SECTIUNE FILTRARE TELEFOANE --}}
                            <form action="{{ URL::current() }}" method="GET">

                                <div class="widget_list widget_color">
                                    <h3>Filtreaza dupa pret</h3>
                                    {{-- <form action="{{ URL::current() }}" method="GET"> --}}
                                    @php
                                        if (isset($_GET['min']) && isset($_GET['max'])) {
                                            $form_min = $_GET['min'];
                                            $form_max = $_GET['max'];
                                        }
                                    @endphp
                                    <input type="text" class="form-control" name="form_min"
                                        placeholder="Pret Minim"><br>
                                    <input type="text" class="form-control" name="form_max" placeholder="Pret Maxim">
                                    <button type="submit" class="btn btn-success mt-3">Filtreaza</button>
                                    {{-- </form> --}}
                                </div>

                                {{-- SECTIUNE FILTRARE BRAND --}}
                                @if ($brand_filters->count())
                                    <div class="widget_list widget_color">
                                        <h3>Filtrare Brand</h3>

                                        @foreach ($brand_filters as $phone_filterbrand)
                                            @php
                                                $checked = [];
                                                if (isset($_GET['phone_filterbrand'])) {
                                                    $checked = $_GET['phone_filterbrand'];
                                                }
                                            @endphp
                                            <div class="col-12">
                                                <input type="checkbox"
                                                    value={{ $phone_filterbrand->brand->brand_name }}
                                                    name="phone_filterbrand[]"
                                                    @if (in_array($phone_filterbrand->brand->brand_name, $checked)) checked @endif>

                                                <label>{{ $phone_filterbrand->brand->brand_name }}</label>
                                            </div>
                                        @endforeach
                                        <button type="submit" class="btn btn-success mt-2">Filtreaza</button>
                                    </div>
                                @endif
                                {{-- SECTIUNE FILTRARE BRAND --}}

                                {{-- SECTIUNE FILTRARE DISPLAY --}}
                                @if ($phone_display_filter->count())
                                    <div class="widget_list widget_color">
                                        <h3>Dimensiune Ecran Telefon</h3>

                                        @foreach ($phone_display_filter as $phone_filterdisplay)
                                            @php
                                                $checked = [];
                                                if (isset($_GET['phone_filterdisplay'])) {
                                                    $checked = $_GET['phone_filterdisplay'];
                                                }
                                            @endphp

                                            <div class="col-12">
                                                <input type="checkbox"
                                                    value="{{ $phone_filterdisplay->phone_display }}"
                                                    name="phone_filterdisplay[]"
                                                    @if (in_array($phone_filterdisplay->phone_display, $checked)) checked @endif>

                                                <label>{{ $phone_filterdisplay->phone_display }}</label>
                                            </div>
                                        @endforeach
                                        <button type="submit" class="btn btn-success mt-2">Filtreaza</button>
                                    </div>
                                @endif
                                {{-- SECTIUNE FILTRARE DISPLAY --}}

                                {{-- SECTIUNE FILTRARE STORAGE --}}
                                @if ($phone_storage_filter->count())
                                    <div class="widget_list widget_color">
                                        <h3>Spatiu Stocare Telefon</h3>

                                        @foreach ($phone_storage_filter as $phone_filterstorage)
                                            @php
                                                $checked = [];
                                                
                                                if (isset($_GET['phone_filterstorage'])) {
                                                    $checked = $_GET['phone_filterstorage'];
                                                }
                                            @endphp

                                            <div class="col-12">
                                                <input type="checkbox"
                                                    value="{{ $phone_filterstorage->phone_storage }}"
                                                    name="phone_filterstorage[]"
                                                    @if (in_array($phone_filterstorage->phone_storage, $checked)) checked @endif>

                                                <label>{{ $phone_filterstorage->phone_storage }}</label>
                                            </div>
                                        @endforeach
                                        <button type="submit" class="btn btn-success mt-2">Filtreaza</button>
                                    </div>
                                @endif
                                {{-- SECTIUNE FILTRARE STORAGE --}}

                                {{-- SECTIUNE FILTRARE MEMORIE --}}
                                @if ($phone_memory_filter->count())
                                    <div class="widget_list widget_color">
                                        <h3>Memorie Telefon</h3>

                                        @foreach ($phone_memory_filter as $phone_filtermemory)
                                            @php
                                                $checked = [];
                                                if (isset($_GET['phone_filtermemory'])) {
                                                    $checked = $_GET['phone_filtermemory'];
                                                }
                                            @endphp

                                            <div class="col-12">
                                                <input type="checkbox"
                                                    value="{{ $phone_filtermemory->phone_memory }}"
                                                    name="phone_filtermemory[]"
                                                    @if (in_array($phone_filtermemory->phone_memory, $checked)) checked @endif>
                                                <label>{{ $phone_filtermemory->phone_memory }}</label>
                                            </div>
                                        @endforeach
                                        <button type="submit" class="btn btn-success mt-2">Filtreaza</button>
                                    </div>
                                @endif

                                {{-- SECTIUNE FILTRARE MEMORIE --}}
                        @endif

                        {{-- SECTIUNE FILTRARE LAPTOPURI --}}
                        @if ($laptop_display_filter->count() || $laptop_storage_filter->count() || $laptop_memory_filter->count() || $laptop_cpufilter->count() || $laptop_gpufilter->count())

                            <form action="{{ URL::current() }}" method="GET">


                                <div class="widget_list widget_color">
                                    <h3>Filtreaza dupa pret</h3>
                                    {{-- <form action="{{ URL::current() }}" method="GET"> --}}
                                    @php
                                        if (isset($_GET['min']) && isset($_GET['max'])) {
                                            $form_min = $_GET['min'];
                                            $form_max = $_GET['max'];
                                        }
                                    @endphp
                                    <input type="text" class="form-control" name="form_min"
                                        placeholder="Pret Minim"><br>
                                    <input type="text" class="form-control" name="form_max" placeholder="Pret Maxim">
                                    <button type="submit" class="btn btn-success mt-3">Filtreaza</button>
                                    {{-- </form> --}}
                                </div>


                                {{-- SECTIUNE FILTRARE BRAND --}}
                                @if ($brand_filters->count())
                                    <div class="widget_list widget_color">
                                        <h3>Filtrare Brand</h3>

                                        @foreach ($brand_filters as $laptop_filterbrand)
                                            @php
                                                $checked = [];
                                                if (isset($_GET['laptop_filterbrand'])) {
                                                    $checked = $_GET['laptop_filterbrand'];
                                                }
                                            @endphp
                                            <div class="col-12">
                                                <input type="checkbox"
                                                    value={{ $laptop_filterbrand->brand->brand_name }}
                                                    name="laptop_filterbrand[]"
                                                    @if (in_array($laptop_filterbrand->brand->brand_name, $checked)) checked @endif>

                                                <label>{{ $laptop_filterbrand->brand->brand_name }}</label>
                                            </div>
                                        @endforeach
                                        <button type="submit" class="btn btn-success mt-2">Filtreaza</button>
                                    </div>
                                @endif
                                {{-- SECTIUNE FILTRARE BRAND --}}

                                {{-- SECTIUNE FILTRARE LAPTOP DISPLAY --}}
                                @if ($laptop_display_filter->count())
                                    <div class="widget_list widget_color">
                                        <h3>Dimensiune Ecran Laptop</h3>

                                        @foreach ($laptop_display_filter as $laptop_filterdisplay)
                                            @php
                                                $checked = [];
                                                if (isset($_GET['laptop_filterdisplay'])) {
                                                    $checked = $_GET['laptop_filterdisplay'];
                                                }
                                            @endphp

                                            <div class="col-12">
                                                <input type="checkbox"
                                                    value="{{ $laptop_filterdisplay->laptop_display }}"
                                                    name="laptop_filterdisplay[]"
                                                    @if (in_array($laptop_filterdisplay->laptop_display, $checked)) checked @endif>

                                                <label>{{ $laptop_filterdisplay->laptop_display }}</label>
                                            </div>
                                        @endforeach
                                        <button type="submit" class="btn btn-success mt-2">Filtreaza</button>
                                    </div>
                                @endif
                                {{-- SECTIUNE FILTRARE LAPTOP DISPLAY --}}

                                {{-- SECTIUNE FILTRARE LAPTOP STORAGE --}}
                                @if ($laptop_storage_filter->count())
                                    <div class="widget_list widget_color">
                                        <h3>Spatiu Stocare Laptop</h3>

                                        @foreach ($laptop_storage_filter as $laptop_filterstorage)
                                            @php
                                                $checked = [];
                                                
                                                if (isset($_GET['laptop_filterstorage'])) {
                                                    $checked = $_GET['laptop_filterstorage'];
                                                }
                                            @endphp

                                            <div class="col-12">
                                                <input type="checkbox"
                                                    value="{{ $laptop_filterstorage->laptop_storage }}"
                                                    name="laptop_filterstorage[]"
                                                    @if (in_array($laptop_filterstorage->laptop_storage, $checked)) checked @endif>

                                                <label>{{ $laptop_filterstorage->laptop_storage }}</label>
                                            </div>
                                        @endforeach
                                        <button type="submit" class="btn btn-success mt-2">Filtreaza</button>
                                    </div>
                                @endif
                                {{-- SECTIUNE FILTRARE LAPTOP STORAGE --}}

                                {{-- SECTIUNE FILTRARE LAPTOP MEMORIE --}}
                                @if ($laptop_memory_filter->count())
                                    <div class="widget_list widget_color">
                                        <h3>Memorie RAM Laptop</h3>

                                        @foreach ($laptop_memory_filter as $laptop_filtermemory)
                                            @php
                                                $checked = [];
                                                if (isset($_GET['laptop_filtermemory'])) {
                                                    $checked = $_GET['laptop_filtermemory'];
                                                }
                                            @endphp

                                            <div class="col-12">
                                                <input type="checkbox"
                                                    value="{{ $laptop_filtermemory->laptop_memory }}"
                                                    name="laptop_filtermemory[]"
                                                    @if (in_array($laptop_filtermemory->laptop_memory, $checked)) checked @endif>
                                                <label>{{ $laptop_filtermemory->laptop_memory }}</label>
                                            </div>
                                        @endforeach
                                        <button type="submit" class="btn btn-success mt-2">Filtreaza</button>
                                    </div>
                                @endif
                                {{-- SECTIUNE FILTRARE LAPTOP MEMORIE --}}

                                {{-- SECTIUNE FILTRARE LAPTOP CPU --}}
                                @if ($laptop_cpufilter->count())
                                    <div class="widget_list widget_color">
                                        <h3>CPU Laptop</h3>

                                        @foreach ($laptop_cpufilter as $laptop_filtercpu)
                                            @php
                                                $checked = [];
                                                if (isset($_GET['laptop_filtercpu'])) {
                                                    $checked = $_GET['laptop_filtercpu'];
                                                }
                                            @endphp

                                            <div class="col-12">
                                                <input type="checkbox" value="{{ $laptop_filtercpu->laptop_cpu }}"
                                                    name="laptop_filtercpu[]"
                                                    @if (in_array($laptop_filtercpu->laptop_cpu, $checked)) checked @endif>
                                                <label>{{ $laptop_filtercpu->laptop_cpu }}</label>
                                            </div>
                                        @endforeach
                                        <button type="submit" class="btn btn-success mt-2">Filtreaza</button>
                                    </div>
                                @endif
                                {{-- SECTIUNE FILTRARE LAPTOP CPU --}}

                                {{-- SECTIUNE FILTRARE LAPTOP GPU --}}
                                @if ($laptop_gpufilter->count())
                                    <div class="widget_list widget_color">
                                        <h3>GPU Laptop</h3>

                                        @foreach ($laptop_gpufilter as $laptop_filtergpu)
                                            @php
                                                $checked = [];
                                                if (isset($_GET['laptop_filtergpu'])) {
                                                    $checked = $_GET['laptop_filtergpu'];
                                                }
                                            @endphp

                                            <div class="col-12">
                                                <input type="checkbox" value="{{ $laptop_filtergpu->laptop_gpu }}"
                                                    name="laptop_filtergpu[]"
                                                    @if (in_array($laptop_filtergpu->laptop_gpu, $checked)) checked @endif>
                                                <label>{{ $laptop_filtergpu->laptop_gpu }}</label>
                                            </div>
                                        @endforeach
                                        <button type="submit" class="btn btn-success mt-2">Filtreaza</button>
                                    </div>
                                @endif
                                {{-- SECTIUNE FILTRARE LAPTOP GPU --}}
                                {{-- <button type="submit" class="btn btn-success mt-3">Filtreaza</button> --}}
                            </form>
                        @endif

                        {{-- SECTIUNE FILTRARE LAPTOPURI --}}


                        {{-- <div class="widget_list widget_color">
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
                    </div> --}}
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
                                            href="product-details.html">{{ $product->product_name }}</a>
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

<style>
    h3 {
        margin-bottom: 5px !important;
        padding-bottom: 5px !important;
    }

</style>
@endsection
