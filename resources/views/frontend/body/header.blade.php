<!--header area start-->
<!--offcanvas menu area start-->
<div class="off_canvars_overlay">

</div>
{{-- meniu pentru dispozitive mobile start --}}
<div class="offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="canvas_open">
                    <a href="javascript:void(0)"><i class="icon-menu"></i></a>
                </div>
                <div class="offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="javascript:void(0)"><i class="icon-x"></i></a>
                    </div>
                    {{-- <div class="header_social text-right">
                        <ul>
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>                 
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div> --}}
                    
                    @php
                        // $categories preia din modelul Category toate datele din tabelul categories in ordine ascendenta dupa id
                        $categories = App\Models\Category::orderBy('id', 'ASC')->get();
                    @endphp
                    <div id="menu" class="text-left ">
                        <ul class="offcanvas_main_menu">

                            {{-- iteram cu $categories (max 5 inregistrari) si afisam in meniu toate categoriile din baza de date --}}
                            @foreach ($categories->slice(0, 5) as $category)
                                <li class="menu-item-has-children active">
                                    <a href="#">{{ $category->category_name }}</a>
                                    @php
                                        // $subcategories preia din modelul Subcategory toate datele din tabelul subcategories in ordine ascendenta dupa id
                                        $subcategories = App\Models\SubCategory::where('category_id', $category->id)
                                            ->orderBy('id', 'ASC')
                                            ->get();
                                    @endphp
                                    <ul class="sub-menu">
                                        {{-- iteram cu $subcategories (max 5 inregistrari) si afisam in meniu toate subcategoriile din baza de date --}}
                                        @foreach ($subcategories->slice(0, 5) as $subcategory)
                                            <li class="menu-item-has-children">
                                                {{-- adaugat url pentru afisarea produselor functie de subcategorie in magazin --}}
                                                <a
                                                    href="{{ url('subcategory/product/' . $subcategory->id . '/' . $subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a>
                                                @php
                                                    // $subsubcategories preia din modelul Subsubcategory toate datele din tabelul subsubcategories in ordine ascendenta dupa id
                                                    $subsubcategories = App\Models\SubSubCategory::where('subcategory_id', $subcategory->id)
                                                        ->orderBy('id')
                                                        ->get();
                                                @endphp
                                                <ul class="sub-menu">
                                                    {{-- iteram cu $subsubcategories si afisam in meniu toate subsubcategoriile din baza de date --}}
                                                    @foreach ($subsubcategories as $subsubcategory)
                                                        <li><a
                                                                href="{{ url('subsubcategory/product/' . $subsubcategory->id . '/' . $subsubcategory->subsubcategory_slug) }}">{{ $subsubcategory->subsubcategory_name }}</a>
                                                        </li>
                                                    @endforeach {{-- iteratie SubSubCategory incheiata --}}
                                                </ul>
                                            </li>
                                        @endforeach {{-- iteratie SubCategory incheiata --}}
                                    </ul>
                                </li>
                            @endforeach {{-- iteratie Category incheiata --}}
                        </ul>
                        <div class="offcanvas_footer">
                            <span><a href="#"><i class="fa fa-envelope-o"></i> suport@eshopupt.ro</a></span>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
{{-- meniu pentru dispozitive mobile sfarsit --}}

{{-- Header Start --}}
<header>

    <div class="main_header">
        <div class="header_top">
            <div class="container">
                <div class="row align-items-center">
                </div>
            </div>

            <div class="header_middle">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-3">
                            <div class="logo">
                                @php
                                    $setting = App\Models\SiteSetting::find(1);
                                @endphp

                                <a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}" alt=""></a>
                            </div>
                        </div>

                        {{-- sectiunea de cautare start --}}
                        <div class="col-lg-7 col-md-6 col-sm-7 col-8">
                            <div class="header_right_info">
                                <div class="search_container mobail_s_none">
                                    <form method="post" action="{{ route('product.search') }}">
                                        @csrf

                                        <div class="search_box">
                                            <input placeholder="Cauta produse..." type="text" name="search" id="search"
                                                onfocus="search_result_show()" onblur="search_result_hide()">
                                            <button type="submit"><span class="lnr lnr-magnifier"></span></button>
                                        </div>
                                    </form>
                                    {{-- adaugat div cu id pentru lista de sugestii produse din script --}}
                                    <div id="searchProducts"></div>
                                </div>
                            </div>
                        </div>
                        {{-- sectiunea de cautare sfarsit --}}

                        {{-- Meniu Utilizator Autentificat / Neautentificat start --}}
                        {{-- cand utilizatorul este autentificat are acces la rutele profilului --}}
                        @auth
                            <div class="col-lg-3">
                                <div class="header_account_area">
                                    <div class="header_account_list register">
                                        <ul>

                                            {{-- wishlist --}}
                                            <li>
                                                <div class="header_account_list header_wishlist">
                                                    {{-- adaugat ruta pt wishlist --}}
                                                    <a href="{{ route('wishlist') }}"><span class="lnr lnr-heart"></span>
                                                        {{-- adaugat id="wishQty" pentru a afisa numarul de produse din wishlist prin functia wishlist() din script --}}
                                                        <span class="item_count" id="wishQty"></span> </a>
                                                </div>
                                            </li>
                                            {{-- mini cos de cumparaturi --}}
                                            <li>
                                                <div class="header_account_list  mini_cart_wrapper">
                                                    {{-- adaugat id="cartQty" pt afisare total cantitate din scritpul minicart --}}
                                                    <a href="javascript:void(0)"><span class="lnr lnr-cart"></span><span
                                                            class="item_count" id="cartQty"></span></a>
                                                    <!--mini cart-->
                                                    <div class="mini_cart">
                                                        <div class="cart_gallery">
                                                            <div class="cart_close">
                                                                <div class="cart_text">
                                                                    <h3>Cos de Cumparaturi</h3>
                                                                </div>
                                                                <div class="mini_cart_close">
                                                                    <a href="javascript:void(0)"><i
                                                                            class="icon-x"></i></a>
                                                                </div>
                                                            </div>

                                                            {{-- Mini Cos Script Ajax Start --}}
                                                            <div id="miniCart">

                                                            </div>
                                                            {{-- Mini Cos Script Ajax Sfarsit --}}



                                                        </div>
                                                        {{-- afisare subtotal, tva si total valaore in mini cart folosind id-urile din scriptul minicart --}}
                                                        <div class="mini_cart_table">
                                                            <div class="cart_table_border">
                                                                <div class="cart_total">
                                                                    <span>Total Fara TVA: </span>
                                                                    <span class="price" id="cartSubTotal"></span>
                                                                </div>
                                                                <div class="cart_total">
                                                                    <span>TVA: </span>
                                                                    <span class="price" id="cartTax"></span>
                                                                </div>
                                                                <div class="cart_total mt-10">
                                                                    <span>Total cu TVA: </span>
                                                                    <span class="price" id="cartTotal"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mini_cart_footer">
                                                            <div class="cart_button">
                                                                {{-- adaugat ruta mycart spre pagina cosului de cumparaturi --}}
                                                                <a href="{{ route('mycart') }}"><i
                                                                        class="fa fa-shopping-cart"></i> Vizualizeaza
                                                                    Cosul
                                                                    de Cumparaturi</a>
                                                            </div>
                                                            <div class="cart_button">
                                                                <a href="{{ route('checkout') }}"><i
                                                                        class="fa fa-sign-in"></i>
                                                                    Spre Casa</a>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <!--mini cart end-->
                                                </div>
                                            </li>
                                            {{-- Meniu Profil Utilizator Autentificat --}}
                                            <li>
                                                <div class="language_currency">
                                                    <ul>
                                                        <li class="currency"><a href="{{ route('dashboard') }}">
                                                                <i class="fa fa-user"></i> Contul Meu
                                                                <i class="icon-right ion-ios-arrow-down"></i></a>
                                                            <ul class="dropdown_currency">
                                                                <li><a href="{{ route('dashboard') }}">Acasa</a>
                                                                </li>
                                                                <li><a href="{{ route('user.profile') }}">Detalii
                                                                        Cont</a>
                                                                </li>
                                                                <li><a href="{{ route('user.change.password') }}">Schimba
                                                                        Parola</a>
                                                                </li>
                                                                <li><a href="{{ route('my.orders') }}">Istoric
                                                                        Comenzi</a></li>
                                                                <li><a href="{{ route('user.logout') }}">Logout</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- cand utilizatorul nu este autentificat are acces la rutele de inregistrare cont nou si autentificare --}}
                        @else
                            <div class="col-lg-3">
                                <div class="header_account_area">
                                    <div class="header_account_list register">
                                        <ul>
                                            <li>
                                                <div class="header_account_list  mini_cart_wrapper">
                                                    {{-- adaugat id="cartQty" pt afisare total cantitate din scritpul minicart --}}
                                                    <a href="javascript:void(0)"><span class="lnr lnr-cart"></span><span
                                                            class="item_count" id="cartQty"></span></a>
                                                    <!--mini cart-->
                                                    <div class="mini_cart">
                                                        <div class="cart_gallery">
                                                            <div class="cart_close">
                                                                <div class="cart_text">
                                                                    <h3>Cos de Cumparaturi</h3>
                                                                </div>
                                                                <div class="mini_cart_close">
                                                                    <a href="javascript:void(0)"><i
                                                                            class="icon-x"></i></a>
                                                                </div>
                                                            </div>

                                                            {{-- Mini Cos Script Ajax Start --}}
                                                            <div id="miniCart">

                                                            </div>
                                                            {{-- Mini Cos Script Ajax Sfarsit --}}



                                                        </div>
                                                        {{-- afisare subtotal, tva si total valaore in mini cart folosind id-urile din scriptul minicart --}}
                                                        <div class="mini_cart_table">
                                                            <div class="cart_table_border">
                                                                <div class="cart_total">
                                                                    <span>Total Fara TVA: </span>
                                                                    <span class="price" id="cartSubTotal"></span>
                                                                </div>
                                                                <div class="cart_total">
                                                                    <span>TVA: </span>
                                                                    <span class="price" id="cartTax"></span>
                                                                </div>
                                                                <div class="cart_total mt-10">
                                                                    <span>Total cu TVA: </span>
                                                                    <span class="price" id="cartTotal"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mini_cart_footer">
                                                            <div class="cart_button">
                                                                {{-- adaugat ruta mycart spre pagina cosului de cumparaturi --}}
                                                                <a href="{{ route('mycart') }}"><i
                                                                        class="fa fa-shopping-cart"></i> Vizualizeaza
                                                                    Cosul
                                                                    de Cumparaturi</a>
                                                            </div>
                                                            <div class="cart_button">
                                                                <a href="{{ route('checkout') }}"><i
                                                                        class="fa fa-sign-in"></i>
                                                                    Spre Casa</a>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <!--mini cart end-->
                                                </div>
                                            </li>
                                            <li><a href="{{ route('register') }}"><i class="fa fa-lock"></i>
                                                    Creaza Cont</a></li>
                                            <li><a href="{{ route('login') }}"><i class="fa fa-user"></i>
                                                    Login</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
            {{-- Meniu Utilizator Autentificat / Neautentificat sfarsit --}}

            {{-- Meniu Orizontal Sticky Start --}}
            <div class="header_bottom sticky-header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 mobail_s_block">

                        </div>
                        {{-- Meniu Vertical Start --}}
                        <div class="col-lg-3 col-md-6">
                            <div class="categories_menu">
                                <div class="categories_title">
                                    <h2 class="categori_toggle">Categorii Produse</h2>
                                </div>
                                <div class="categories_menu_toggle">
                                    <ul>
                                        {{-- iteram cu $categories si afisam in meniul vertical toate categoriile din baza de date --}}
                                        @foreach ($categories as $category)
                                            <li class="menu_item_children"><a href="#"><i
                                                        class="icon {{ $category->category_icon }}"
                                                        aria-hidden="true"></i> {{ $category->category_name }}<i
                                                        class="fa fa-angle-right"></i></a>
                                                @php
                                                    // $subcategories preia din modelul Subcategory toate datele din tabelul subcategories in ordine ascendenta dupa id
                                                    $subcategories = App\Models\SubCategory::where('category_id', $category->id)
                                                        ->orderBy('id', 'ASC')
                                                        ->get();
                                                @endphp
                                                <ul class="categories_mega_menu" style="width:700px !important">
                                                    {{-- iteram cu $subcategories si afisam in meniul vertical toate subcategoriile din baza de date --}}
                                                    @foreach ($subcategories as $subcategory)
                                                        {{-- adaugat url pentru afisarea produselor functie de subcategorie in magazin --}}
                                                        <li class="menu_item_children"><a
                                                                href="{{ url('subcategory/product/' . $subcategory->id . '/' . $subcategory->subcategory_slug) }}">
                                                                {{ $subcategory->subcategory_name }}</a>
                                                            @php
                                                                // $subsubcategories preia din modelul Subsubcategory toate datele din tabelul subsubcategories in ordine ascendenta dupa id
                                                                $subsubcategories = App\Models\SubSubCategory::where('subcategory_id', $subcategory->id)
                                                                    ->orderBy('id', 'ASC')
                                                                    ->get();
                                                            @endphp
                                                            <ul class="categorie_sub_menu">
                                                                {{-- iteram cu $subsubcategories si afisam in meniul vertical toate subsubcategoriile din baza de date --}}
                                                                @foreach ($subsubcategories as $subsubcategory)
                                                                    <li><a
                                                                            href="{{ url('subsubcategory/product/' . $subsubcategory->id . '/' . $subsubcategory->subsubcategory_slug) }}">{{ $subsubcategory->subsubcategory_name }}</a>
                                                                    </li>
                                                                @endforeach
                                                                {{-- iteratie SubSubCategory incheiata --}}
                                                            </ul>
                                                        </li>
                                                    @endforeach {{-- iteratie SubCategory incheiata --}}
                                                </ul>
                                            </li>
                                        @endforeach {{-- iteratie SubCategory incheiata --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- Meniu Vertical Sfarsit --}}
                        {{-- Menu Orizontal Start --}}
                        <div class="col-lg-9">
                            <div class="main_menu menu_position">
                                @php
                                    // $categories preia din modelul Category toate datele din tabelul categories in ordine ascendenta dupa id
                                    $categories = App\Models\Category::orderBy('id', 'ASC')->get();
                                @endphp
                                <nav>
                                    <ul>
                                        {{-- iteram cu $categories (max 3 inregistrari) si afisam in meniu toate categoriile din baza de date --}}
                                        @foreach ($categories->slice(0, 3) as $category)
                                            <li><a class="active"
                                                    href="{{ url('/') }}">{{ $category->category_name }}<i
                                                        class="fa fa-angle-down"></i></a>
                                                @php
                                                    // $subcategories preia din modelul Subcategory toate datele din tabelul subcategories in ordine ascendenta dupa id
                                                    $subcategories = App\Models\SubCategory::where('category_id', $category->id)
                                                        ->orderBy('id', 'ASC')
                                                        ->get();
                                                @endphp
                                                <ul class="sub_menu home_sub_menu d-flex">
                                                    {{-- iteram cu $subcategories (max 3 inregistrari) si afisam in meniu toate subcategoriile din baza de date --}}
                                                    @foreach ($subcategories->slice(0, 3) as $subcategory)
                                                        <li><a {{-- adaugat url pentru afisarea produselor functie de subcategorie in magazin --}}
                                                                href="{{ url('subcategory/product/' . $subcategory->id . '/' . $subcategory->subcategory_slug) }}"><strong>{{ $subcategory->subcategory_name }}</strong></a>
                                                            @php
                                                                // $subsubcategories preia din modelul Subsubcategory toate datele din tabelul subsubcategories in ordine ascendenta dupa id
                                                                $subsubcategories = App\Models\SubSubCategory::where('subcategory_id', $subcategory->id)
                                                                    ->orderBy('id', 'ASC')
                                                                    ->get();
                                                            @endphp
                                                            <ul>
                                                                {{-- iteram cu $subsubcategories (max 3 inregistrari) si afisam in meniu toate subsubcategoriile din baza de date --}}
                                                                @foreach ($subsubcategories as $subsubcategory)
                                                                    <li><a
                                                                            href="{{ url('subsubcategory/product/' . $subsubcategory->id . '/' . $subsubcategory->subsubcategory_slug) }}">{{ $subsubcategory->subsubcategory_name }}</a>
                                                                    </li>
                                                                @endforeach
                                                                {{-- iteratie SubSubCategory incheiata --}}
                                                            </ul>

                                                        </li>
                                                    @endforeach {{-- iteratie SubCategory incheiata --}}
                                                </ul>

                                            </li>
                                        @endforeach {{-- iteratie SubCategory incheiata --}}
                                    </ul>

                                </nav>
                            </div>

                        </div>
                        {{-- Menu Orizontal Sfarsit --}}
                        {{-- <div class="col-lg-3">
                            <div class="call-support">
                                <p><a href="tel:(08)23456789">(08) 23 456 789</a> Customer Support</p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            {{-- Meniu Orizontal Sticky Sfarsit --}}
        </div>
</header>
{{-- Header Sfarsit --}}

{{-- CSS pentru rezultatul sugestiilor din bara de cautare pentru cautare avansata --}}
<style>
    .header_right_info {
        position: relative;
    }

    #searchProducts {
        position: absolute;
        top: 100%;
        /* left: 20px; */
        width: 73%;
        background: #ffffff;
        z-index: 999;
        border-radius: 8px;
        margin-top: 5px;
    }
</style>

{{-- script pt afisarea sugestiilor de produse --}}
<script>
    function search_result_hide() {
        $("#searchProducts").slideUp();
    }

    function search_result_show() {
        $("#searchProducts").slideDown();
    }
</script>


{{-- @auth
    <div class="header__top__right__language">
        <div class="header__top__right__auth mr-3">
            <a href="{{ route('dashboard') }}"><i class="fa fa-user"></i>Profil</a>
        </div>
        <span class="arrow_carrot-down"></span>
        <ul>
            <li><a href="{{ route('dashboard') }}">Acasa</a></li>
            <li><a href="{{ route('user.profile') }}">Detalii Cont</a></li>
            <li><a href="{{ route('user.change.password') }}">Schimba Parola</a></li>
            <li><a href="#">Comenzi</a></li>
            <li><a href="{{ route('user.logout') }}">Logout</a></li>
        </ul>
    </div> --}}

{{-- daca utilizatorul nu este autentificat header-ul va afisa butoanele Login / Inregistrare --}}
{{-- @else
    <div class="header__top__right__auth mr-3">
        <a href="{{ route('login') }}"><i class="fa fa-user"></i>Login</a>
    </div> --}}
{{-- link spre pagina de autentificare --}}
{{-- <div class="header__top__right__auth">
        <a href="{{ route('register') }}"><i class="fa fa-lock"></i>Inregistrare
            cont</a>
    </div>
@endauth --}}
