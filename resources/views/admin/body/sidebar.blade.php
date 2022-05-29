@php
// $prefix preia prefixul rutei
$prefix = Request::route()->getPrefix();
// $route preia numele rutei curente
$route = Route::current()->getName();
@endphp
<div class="side-header-inner custom-scroll">

    <nav class="side-header-menu" id="side-header-menu">
        <ul>
            {{-- sectiune meniu navigare admin branduri incepe --}}
            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            <li class="{{ $route == 'dashboard' ? 'active' : '' }}"><a href="{{ url('admin/dashboard') }}"><i
                        class="ti-home"></i>
                    <span><strong>Dashboard</strong></span></a>

                @php
                    
                    // afisam toate meniurile pentru main admin
                    // si campurile selectate de main admin pt ceilalti admini
                    $brand =
                        auth()
                            ->guard('admin')
                            ->user()->brand == 1;
                    $category =
                        auth()
                            ->guard('admin')
                            ->user()->category == 1;
                    $subcategory =
                        auth()
                            ->guard('admin')
                            ->user()->subcategory == 1;
                    $subsubcategory =
                        auth()
                            ->guard('admin')
                            ->user()->subsubcategory == 1;
                    $product =
                        auth()
                            ->guard('admin')
                            ->user()->product == 1;
                    $stock =
                        auth()
                            ->guard('admin')
                            ->user()->stock == 1;
                    $slider =
                        auth()
                            ->guard('admin')
                            ->user()->slider == 1;
                    $voucher =
                        auth()
                            ->guard('admin')
                            ->user()->voucher == 1;
                    $shipping =
                        auth()
                            ->guard('admin')
                            ->user()->shipping == 1;
                    $orders =
                        auth()
                            ->guard('admin')
                            ->user()->orders == 1;
                    $return_order =
                        auth()
                            ->guard('admin')
                            ->user()->return_order == 1;
                    $reports =
                        auth()
                            ->guard('admin')
                            ->user()->reports == 1;
                    $alluser =
                        auth()
                            ->guard('admin')
                            ->user()->alluser == 1;
                    $blog =
                        auth()
                            ->guard('admin')
                            ->user()->blog == 1;
                    $review =
                        auth()
                            ->guard('admin')
                            ->user()->review == 1;
                    $setting =
                        auth()
                            ->guard('admin')
                            ->user()->setting == 1;
                    $admin_user_role =
                        auth()
                            ->guard('admin')
                            ->user()->admin_user_role == 1;
                @endphp

                @if ($brand == true)
            <li class="has-sub-menu {{ $prefix == '/brand' ? 'active' : '' }}"><a href="#"><i
                        class="ti-home"></i>
                    <span><strong>Branduri</strong></span></a>
                <ul class="side-header-sub-menu"
                    style="{{ $prefix == '/brand' ? 'display: block !important;' : 'display: none !important;' }}">
                    <li class="{{ Route::is('all.brand', 'brand.edit') ? 'active' : '' }}"><a
                            href="{{ route('all.brand') }}"><span>Management Branduri </span></a>
                    </li>
                    {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                </ul>
            </li>
        @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            @if ($category == true)
                {{-- sectiune meniu navigare admin categorii incepe --}}
                {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                <li class="has-sub-menu {{ $prefix == '/category' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span><strong>Categorii Produse</strong></span></a>
                    <ul class="side-header-sub-menu"
                        style="{{ $prefix == '/category' ? 'display: block !important;' : 'display: none !important;' }}">
                        <li class="{{ Route::is('all.category', 'category.edit') ? 'active' : '' }}"><a
                                href="{{ route('all.category') }}"><span>Management Categorii </span></a></li>

                        @if ($subcategory == true)
                            <li class="{{ Route::is('all.subcategory', 'subcategory.edit') ? 'active' : '' }}"><a
                                    href="{{ route('all.subcategory') }}"><span>Management SubCategorii </span></a>
                            </li>
                        @else
                        @endif

                        @if ($subsubcategory == true)
                            <li class="{{ Route::is('all.subsubcategory', 'subsubcategory.edit') ? 'active' : '' }}">
                                <a href="{{ route('all.subsubcategory') }}"><span>Management SubSubCategorii
                                    </span></a>
                            </li>
                        @else
                        @endif
                        {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin categorii termina --}}

            @if ($product == true)
                {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                <li class="has-sub-menu {{ $prefix == '/product' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span><strong>Produse</strong></span></a>
                    <ul class="side-header-sub-menu"
                        style="{{ $prefix == '/product' ? 'display: block !important;' : 'display: none !important;' }}">
                        <li class="{{ Route::is('add-product') ? 'active' : '' }}"><a
                                href="{{ route('add-product') }}"><span>Adauga Produse </span></a></li>
                        <li class="{{ Route::is('manage-product', 'product.edit') ? 'active' : '' }}"><a
                                href="{{ route('manage-product') }}"><span>Management Produse </span></a></li>
                        {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($stock == true)
                <li class="has-sub-menu {{ $prefix == '/stock' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span><strong>Stocuri Produse</strong></span></a>
                    <ul class="side-header-sub-menu"
                        style="{{ $prefix == '/stock' ? 'display: block !important;' : 'display: none !important;' }}">
                        <li class="{{ Route::is('product.stock') ? 'active' : '' }}"><a
                                href="{{ route('product.stock') }}"><span>Stoc Produse</span></a></li>
                        {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($review == true)
                <li class="has-sub-menu {{ $prefix == '/review' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span><strong>Recenzii</strong></span></a>
                    <ul class="side-header-sub-menu"
                        style="{{ $prefix == '/review' ? 'display: block !important;' : 'display: none !important;' }}">
                        <li class="{{ Route::is('pending.review') ? 'active' : '' }}"><a
                                href="{{ route('pending.review') }}"><span>Recenzii in asteptare</span></a></li>
                        <li class="{{ Route::is('publish.review') ? 'active' : '' }}"><a
                                href="{{ route('publish.review') }}"><span>Recenzii publicate</span></a></li>
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            @if ($slider == true)
                {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                <li class="has-sub-menu {{ $prefix == '/slider' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span><strong>Sliders</strong></span></a>
                    <ul class="side-header-sub-menu"
                        style="{{ $prefix == '/slider' ? 'display: block !important;' : 'display: none !important;' }}">
                        <li class="{{ Route::is('manage-slider', 'slider.edit') ? 'active' : '' }}"><a
                                href="{{ route('manage-slider') }}"><span>Management Sliders</span></a></li>
                        {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            @if ($voucher == true)
                {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                <li class="has-sub-menu {{ $prefix == '/voucher' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span><strong>Voucher-uri</strong></span></a>
                    <ul class="side-header-sub-menu"
                        style="{{ $prefix == '/voucher' ? 'display: block !important;' : 'display: none !important;' }}">
                        <li class="{{ Route::is('manage-voucher', 'voucher.edit') ? 'active' : '' }}"><a
                                href="{{ route('manage-voucher') }}"><span>Management Voucher-uri</span></a></li>
                        {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            {{-- @if ($shipping == true)
                <li class="has-sub-menu {{ $prefix == '/shipping' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span>Zone Expedieri</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'manage-division' ? 'active' : '' }}"><a
                                href="{{ route('manage-division') }}"><span>Management Judete</span></a></li>
                        <li class="{{ $route == 'manage-district' ? 'active' : '' }}"><a
                                href="{{ route('manage-district') }}"><span>Management Localitati</span></a></li>
                    </ul>
                </li>
            @else
            @endif --}}
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($orders == true)
                <li class="has-sub-menu {{ $prefix == '/orders' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span><strong>Comenzi</strong></span></a>
                    <ul class="side-header-sub-menu"
                        style="{{ $prefix == '/orders' ? 'display: block !important;' : 'display: none !important;' }}">
                        <li class="{{ Route::is('pending-orders') ? 'active' : '' }}"><a
                                href="{{ route('pending-orders') }}"><span>Comenzi in asteptare</span></a></li>
                        <li class="{{ Route::is('confirmed-orders') ? 'active' : '' }}"><a
                                href="{{ route('confirmed-orders') }}"><span>Comenzi confirmate</span></a></li>
                        <li class="{{ Route::is('processing-orders') ? 'active' : '' }}"><a
                                href="{{ route('processing-orders') }}"><span>Comenzi procesate</span></a></li>
                        <li class="{{ Route::is('picked-orders') ? 'active' : '' }}"><a
                                href="{{ route('picked-orders') }}"><span>Comenzi preluate de curier</span></a></li>
                        <li class="{{ Route::is('shipped-orders') ? 'active' : '' }}"><a
                                href="{{ route('shipped-orders') }}"><span>Comenzi in tranzit</span></a></li>
                        <li class="{{ Route::is('delivered-orders') ? 'active' : '' }}"><a
                                href="{{ route('delivered-orders') }}"><span>Comenzi livrate</span></a></li>
                        <li class="{{ Route::is('cancel-orders') ? 'active' : '' }}"><a
                                href="{{ route('cancel-orders') }}"><span>Comenzi anulate</span></a></li>
                        {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($return_order == true)
                <li class="has-sub-menu {{ $prefix == '/return' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span><strong>Comenzi - Retur</strong></span></a>
                    <ul class="side-header-sub-menu"
                        style="{{ $prefix == '/return' ? 'display: block !important;' : 'display: none !important;' }}">
                        <li class="{{ Route::is('return.request') ? 'active' : '' }}"><a
                                href="{{ route('return.request') }}"><span>Solictiare Retur</span></a></li>
                        <li class="{{ Route::is('all.return.request') ? 'active' : '' }}"><a
                                href="{{ route('all.return.request') }}"><span>Toate Solictarile</span></a></li>
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($reports == true)
                <li class="has-sub-menu {{ $prefix == '/reports' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span><strong>Rapoarte Vanzari</strong></span></a>
                    <ul class="side-header-sub-menu"
                        style="{{ $prefix == '/reports' ? 'display: block !important;' : 'display: none !important;' }}">
                        <li class="{{ Route::is('all-reports') ? 'active' : '' }}"><a
                                href="{{ route('all-reports') }}"><span>Toate Rapoartele</span></a></li>
                        {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($alluser == true)
                <li class="has-sub-menu {{ $prefix == '/alluser' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span><strong>Clienti</strong></span></a>
                    <ul class="side-header-sub-menu"
                        style="{{ $prefix == '/alluser' ? 'display: block !important;' : 'display: none !important;' }}">
                        <li class="{{ Route::is('all-users') ? 'active' : '' }}"><a
                                href="{{ route('all-users') }}"><span>Lista Clienti</span></a></li>
                        {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($blog == true)
                <li class="has-sub-menu {{ $prefix == '/blog' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span><strong>Blog</strong></span></a>
                    <ul class="side-header-sub-menu"
                        style="{{ $prefix == '/blog' ? 'display: block !important;' : 'display: none !important;' }}">
                        <li class="{{ Route::is('blog.category', 'blog.category.edit') ? 'active' : '' }}"><a
                                href="{{ route('blog.category') }}"><span>Categorii Blog</span></a></li>
                        <li class="{{ Route::is('add.post') ? 'active' : '' }}"><a
                                href="{{ route('add.post') }}"><span>Adauga Postare</span></a></li>
                        <li class="{{ Route::is('list.post', 'post.edit') ? 'active' : '' }}"><a
                                href="{{ route('list.post') }}"><span>Lista Postari</span></a></li>
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($setting == true)
                <li class="has-sub-menu {{ $prefix == '/setting' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span><strong>Setari Site</strong></span></a>
                    <ul class="side-header-sub-menu"
                        style="{{ $prefix == '/setting' ? 'display: block !important;' : 'display: none !important;' }}">
                        <li class="{{ Route::is('site.setting') ? 'active' : '' }}"><a
                                href="{{ route('site.setting') }}"><span>Date Companie</span></a></li>
                        <li class="{{ Route::is('seo.setting') ? 'active' : '' }}"><a
                                href="{{ route('seo.setting') }}"><span>Setari SEO</span></a></li>
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($admin_user_role == true)
                <li class="has-sub-menu {{ $prefix == '/admin_user_role' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span><strong>Administratori</strong></span></a>
                    <ul class="side-header-sub-menu"
                        style="{{ $prefix == '/admin_user_role' ? 'display: block !important;' : 'display: none !important;' }}">
                        <li
                            class="{{ Route::is('all.admin.user', 'add.admin', 'edit.admin.user') ? 'active' : '' }}">
                            <a href="{{ route('all.admin.user') }}"><span>Lista Administratori</span></a>
                        </li>
                        {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}
        </ul>
    </nav>

</div><!-- Side Header Inner End -->
