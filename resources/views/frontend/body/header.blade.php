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

                    <div class="call-support">
                        <p><a href="tel:(08)23456789">(08) 23 456 789</a> Customer Support</p>
                    </div>
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
                                                <a href="#">{{ $subcategory->subcategory_name }}</a>
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
                                                                href="index.html">{{ $subsubcategory->subsubcategory_name }}</a>
                                                        </li>
                                                    @endforeach {{-- iteratie SubSubCategory incheiata --}}
                                                </ul>
                                            </li>
                                        @endforeach {{-- iteratie SubCategory incheiata --}}
                                    </ul>
                                </li>
                            @endforeach {{-- iteratie Category incheiata --}}
                        </ul>
                    </div>
                    <div class="offcanvas_footer">
                        <span><a href="#"><i class="fa fa-envelope-o"></i> info@yourdomain.com</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- meniu pentru dispozitive mobile end --}}

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
                                <a href="index.html"><img src="{{ asset('frontend/img/logo/logo.png') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-7 col-8">
                            <div class="header_right_info">
                                <div class="search_container mobail_s_none">
                                    <form action="#">
                                        <div class="hover_category">
                                            <select class="select_option" name="select" id="categori2">
                                                <option selected value="1">Select a categories</option>
                                                <option value="2">Accessories</option>
                                                <option value="3">Accessories & More</option>
                                                <option value="4">Butters & Eggs</option>
                                                <option value="5">Camera & Video </option>
                                                <option value="6">Mornitors</option>
                                                <option value="7">Tablets</option>
                                                <option value="8">Laptops</option>
                                                <option value="9">Handbags</option>
                                                <option value="10">Headphone & Speaker</option>
                                                <option value="11">Herbs & botanicals</option>
                                                <option value="12">Vegetables</option>
                                                <option value="13">Shop</option>
                                                <option value="14">Laptops & Desktops</option>
                                                <option value="15">Watchs</option>
                                                <option value="16">Electronic</option>
                                            </select>
                                        </div>
                                        <div class="search_box">
                                            <input placeholder="Search product..." type="text">
                                            <button type="submit"><span class="lnr lnr-magnifier"></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- cand utilizatorul este autentificat are acces la rutele profilului --}}
                        @auth
                            <div class="col-lg-3">
                                <div class="header_account_area">
                                    <div class="header_account_list register">
                                        <ul>

                                            {{-- wishlist --}}
                                            <li>
                                                <div class="header_account_list header_wishlist">
                                                    <a href="wishlist.html"><span class="lnr lnr-heart"></span> <span
                                                            class="item_count">3</span> </a>
                                                </div>
                                            </li>
                                            {{-- mini cos de cumparaturi --}}
                                            <li>
                                                <div class="header_account_list  mini_cart_wrapper">
                                                    <a href="javascript:void(0)"><span class="lnr lnr-cart"></span><span
                                                            class="item_count">2</span></a>
                                                    <!--mini cart-->
                                                    <div class="mini_cart">
                                                        <div class="cart_gallery">
                                                            <div class="cart_close">
                                                                <div class="cart_text">
                                                                    <h3>cart</h3>
                                                                </div>
                                                                <div class="mini_cart_close">
                                                                    <a href="javascript:void(0)"><i
                                                                            class="icon-x"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="cart_item">
                                                                <div class="cart_img">
                                                                    <a href="#"><img
                                                                            src="{{ asset('frontend/img/s-product/product.jpg') }}"
                                                                            alt=""></a>
                                                                </div>
                                                                <div class="cart_info">
                                                                    <a href="#">Primis In Faucibus</a>
                                                                    <p>1 x <span> $65.00 </span></p>
                                                                </div>
                                                                <div class="cart_remove">
                                                                    <a href="#"><i class="icon-x"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="cart_item">
                                                                <div class="cart_img">
                                                                    <a href="#"><img
                                                                            src="{{ asset('frontend/img/s-product/product2.jpg') }}"
                                                                            alt=""></a>
                                                                </div>
                                                                <div class="cart_info">
                                                                    <a href="#">Letraset Sheets</a>
                                                                    <p>1 x <span> $60.00 </span></p>
                                                                </div>
                                                                <div class="cart_remove">
                                                                    <a href="#"><i class="icon-x"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mini_cart_table">
                                                            <div class="cart_table_border">
                                                                <div class="cart_total">
                                                                    <span>Sub total:</span>
                                                                    <span class="price">$125.00</span>
                                                                </div>
                                                                <div class="cart_total mt-10">
                                                                    <span>total:</span>
                                                                    <span class="price">$125.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mini_cart_footer">
                                                            <div class="cart_button">
                                                                <a href="cart.html"><i class="fa fa-shopping-cart"></i> View
                                                                    cart</a>
                                                            </div>
                                                            <div class="cart_button">
                                                                <a href="checkout.html"><i class="fa fa-sign-in"></i>
                                                                    Checkout</a>
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
                                                                <li><a href="{{ route('user.profile') }}">Detalii Cont</a>
                                                                </li>
                                                                <li><a href="{{ route('user.change.password') }}">Schimba
                                                                        Parola</a>
                                                                </li>
                                                                <li><a href="#">Comenzi</a></li>
                                                                <li><a href="{{ route('user.logout') }}">Logout</a></li>
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
                                            <li><a href="{{ route('register') }}"><i class="fa fa-lock"></i>
                                                    Creaza Cont</a></li>
                                            <li><span>/</span></li>
                                            <li><a href="{{ route('login') }}"><i class="fa fa-user"></i>
                                                    Autentificare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="header_bottom sticky-header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 mobail_s_block">
                            <div class="search_container">
                                <form action="#">
                                    <div class="hover_category">
                                        <select class="select_option" name="select" id="categori3">
                                            <option selected value="1">Select a categories</option>
                                            <option value="2">Accessories</option>
                                            <option value="3">Accessories & More</option>
                                            <option value="4">Butters & Eggs</option>
                                            <option value="5">Camera & Video </option>
                                            <option value="6">Mornitors</option>
                                            <option value="7">Tablets</option>
                                            <option value="8">Laptops</option>
                                            <option value="9">Handbags</option>
                                            <option value="10">Headphone & Speaker</option>
                                            <option value="11">Herbs & botanicals</option>
                                            <option value="12">Vegetables</option>
                                            <option value="13">Shop</option>
                                            <option value="14">Laptops & Desktops</option>
                                            <option value="15">Watchs</option>
                                            <option value="16">Electronic</option>
                                        </select>
                                    </div>
                                    <div class="search_box">
                                        <input placeholder="Search product..." type="text">
                                        <button type="submit"><span class="lnr lnr-magnifier"></span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="categories_menu">
                                <div class="categories_title">
                                    <h2 class="categori_toggle">All Cattegories</h2>
                                </div>
                                <div class="categories_menu_toggle">
                                    <ul>
                                        <li class="menu_item_children"><a href="#">Vegetables<i
                                                    class="fa fa-angle-right"></i></a>
                                            <ul class="categories_mega_menu">
                                                <li class="menu_item_children"><a href="#">Dresses</a>
                                                    <ul class="categorie_sub_menu">
                                                        <li><a href="">Sweater</a></li>
                                                        <li><a href="">Evening</a></li>
                                                        <li><a href="">Day</a></li>
                                                        <li><a href="">Sports</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu_item_children"><a href="#">Handbags</a>
                                                    <ul class="categorie_sub_menu">
                                                        <li><a href="">Shoulder</a></li>
                                                        <li><a href="">Satchels</a></li>
                                                        <li><a href="">kids</a></li>
                                                        <li><a href="">coats</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu_item_children"><a href="#">shoes</a>
                                                    <ul class="categorie_sub_menu">
                                                        <li><a href="">Ankle Boots</a></li>
                                                        <li><a href="">Clog sandals </a></li>
                                                        <li><a href="">run</a></li>
                                                        <li><a href="">Books</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu_item_children"><a href="#">Clothing</a>
                                                    <ul class="categorie_sub_menu">
                                                        <li><a href="">Coats Jackets </a></li>
                                                        <li><a href="">Raincoats</a></li>
                                                        <li><a href="">Jackets</a></li>
                                                        <li><a href="">T-shirts</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu_item_children"><a href="#">Fruits <i
                                                    class="fa fa-angle-right"></i></a>
                                            <ul class="categories_mega_menu column_3">
                                                <li class="menu_item_children"><a href="#">Chair</a>
                                                    <ul class="categorie_sub_menu">
                                                        <li><a href="">Dining room</a></li>
                                                        <li><a href="">bedroom</a></li>
                                                        <li><a href=""> Home & Office</a></li>
                                                        <li><a href="">living room</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu_item_children"><a href="#">Lighting</a>
                                                    <ul class="categorie_sub_menu">
                                                        <li><a href="">Ceiling Lighting</a></li>
                                                        <li><a href="">Wall Lighting</a></li>
                                                        <li><a href="">Outdoor Lighting</a></li>
                                                        <li><a href="">Smart Lighting</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu_item_children"><a href="#">Sofa</a>
                                                    <ul class="categorie_sub_menu">
                                                        <li><a href="">Fabric Sofas</a></li>
                                                        <li><a href="">Leather Sofas</a></li>
                                                        <li><a href="">Corner Sofas</a></li>
                                                        <li><a href="">Sofa Beds</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu_item_children"><a href="#"> Salads<i
                                                    class="fa fa-angle-right"></i></a>
                                            <ul class="categories_mega_menu column_2">
                                                <li class="menu_item_children"><a href="#">Brake Tools</a>
                                                    <ul class="categorie_sub_menu">
                                                        <li><a href="">Driveshafts</a></li>
                                                        <li><a href="">Spools</a></li>
                                                        <li><a href="">Diesel </a></li>
                                                        <li><a href="">Gasoline</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu_item_children"><a href="#">Emergency Brake</a>
                                                    <ul class="categorie_sub_menu">
                                                        <li><a href="">Dolls for Girls</a></li>
                                                        <li><a href="">Girls' Learning Toys</a></li>
                                                        <li><a href="">Arts and Crafts for Girls</a></li>
                                                        <li><a href="">Video Games for Girls</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu_item_children"><a href="#"> Fish & Seafood <i
                                                    class="fa fa-angle-right"></i></a>
                                            <ul class="categories_mega_menu column_2">
                                                <li class="menu_item_children"><a href="#">Check Trousers</a>
                                                    <ul class="categorie_sub_menu">
                                                        <li><a href="">Building</a></li>
                                                        <li><a href="">Electronics</a></li>
                                                        <li><a href="">action figures </a></li>
                                                        <li><a href="">specialty & boutique toy</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu_item_children"><a href="#">Calculators</a>
                                                    <ul class="categorie_sub_menu">
                                                        <li><a href="">Dolls for Girls</a></li>
                                                        <li><a href="">Girls' Learning Toys</a></li>
                                                        <li><a href="">Arts and Crafts for Girls</a></li>
                                                        <li><a href="">Video Games for Girls</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#"> Fresh Meat</a></li>
                                        <li><a href="#"> Butter & Eggs</a></li>
                                        <li><a href="#">Milk</a></li>
                                        <li><a href="#">Oil & Vinegars</a></li>
                                        <li><a href="#"> Bread</a></li>
                                        <li><a href="#"> Jam & Honey</a></li>
                                        <li><a href="#"> Frozen Food</a></li>
                                        <li class="hidden"><a href="shop.html">New Sofas</a></li>
                                        <li class="hidden"><a href="shop.html">Sleight Sofas</a></li>
                                        <li><a href="#" id="more-btn"><i class="fa fa-plus" aria-hidden="true"></i>
                                                More Categories</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <!--main menu start-->
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
                                                        <li><a
                                                                href="index.html"><strong>{{ $subcategory->subcategory_name }}</strong></a>
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
                                                                            href="index.html">{{ $subsubcategory->subsubcategory_name }}</a>
                                                                    </li>
                                                                @endforeach {{-- iteratie SubSubCategory incheiata --}}
                                                            </ul>

                                                        </li>
                                                    @endforeach {{-- iteratie SubCategory incheiata --}}
                                                </ul>

                                            </li>
                                        @endforeach {{-- iteratie SubCategory incheiata --}}
                                    </ul>

                                </nav>
                            </div>
                            <!--main menu end-->
                        </div>
                        {{-- <div class="col-lg-3">
                            <div class="call-support">
                                <p><a href="tel:(08)23456789">(08) 23 456 789</a> Customer Support</p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
</header>
<!--header area end-->




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
