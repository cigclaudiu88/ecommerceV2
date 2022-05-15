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
                    <span>Dashboard</span></a>

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
                    <span>Branduri</span></a>
                <ul class="side-header-sub-menu">
                    <li class="{{ $prefix == '/brand' ? 'active' : '' }}"><a
                            href="{{ route('all.brand') }}"><span>Management Branduri </span></a></li>
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
                        <span>Categorii Produse</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'all.category' ? 'active' : '' }}"><a
                                href="{{ route('all.category') }}"><span>Management Categorii </span></a></li>

                        @if ($subcategory == true)
                            <li class="{{ $route == 'all.subcategory' ? 'active' : '' }}"><a
                                    href="{{ route('all.subcategory') }}"><span>Management SubCategorii </span></a>
                            </li>
                        @else
                        @endif

                        @if ($subsubcategory == true)
                            <li class="{{ $route == 'all.subsubcategory' ? 'active' : '' }}"><a
                                    href="{{ route('all.subsubcategory') }}"><span>Management SubSubCategorii
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
                        <span>Produse</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'add-product' ? 'active' : '' }}"><a
                                href="{{ route('add-product') }}"><span>Adauga Produse </span></a></li>
                        <li class="{{ $route == 'manage-product' ? 'active' : '' }}"><a
                                href="{{ route('manage-product') }}"><span>Management Produse </span></a></li>
                        {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            @if ($slider == true)
                {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                <li class="has-sub-menu {{ $prefix == '/slider' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span>Sliders</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'manage-slider' ? 'active' : '' }}"><a
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
                        <span>Voucher</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'manage-voucher' ? 'active' : '' }}"><a
                                href="{{ route('manage-voucher') }}"><span>Management Voucher-uri</span></a></li>
                        {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($shipping == true)
                <li class="has-sub-menu {{ $prefix == '/shipping' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span>Zone Expedieri</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'manage-division' ? 'active' : '' }}"><a
                                href="{{ route('manage-division') }}"><span>Management Judete</span></a></li>
                        <li class="{{ $route == 'manage-district' ? 'active' : '' }}"><a
                                href="{{ route('manage-district') }}"><span>Management Localitati</span></a></li>
                        {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($orders == true)
                <li class="has-sub-menu {{ $prefix == '/orders' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span>Comenzi</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'pending-orders' ? 'active' : '' }}"><a
                                href="{{ route('pending-orders') }}"><span>Comenzi in asteptare</span></a></li>
                        <li class="{{ $route == 'confirmed-orders' ? 'active' : '' }}"><a
                                href="{{ route('confirmed-orders') }}"><span>Comenzi confirmate</span></a></li>
                        <li class="{{ $route == 'processing-orders' ? 'active' : '' }}"><a
                                href="{{ route('processing-orders') }}"><span>Comenzi procesate</span></a></li>
                        <li class="{{ $route == 'picked-orders' ? 'active' : '' }}"><a
                                href="{{ route('picked-orders') }}"><span>Comenzi preluate de curier</span></a></li>
                        <li class="{{ $route == 'shipped-orders' ? 'active' : '' }}"><a
                                href="{{ route('shipped-orders') }}"><span>Comenzi in tranzit</span></a></li>
                        <li class="{{ $route == 'delivered-orders' ? 'active' : '' }}"><a
                                href="{{ route('delivered-orders') }}"><span>Comenzi livrate</span></a></li>
                        <li class="{{ $route == 'cancel-orders' ? 'active' : '' }}"><a
                                href="{{ route('cancel-orders') }}"><span>Comenzi anulate</span></a></li>
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
                        <span>Stocuri</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'product.stock' ? 'active' : '' }}"><a
                                href="{{ route('product.stock') }}"><span>Stoc Produse</span></a></li>
                        {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($reports == true)
                <li class="has-sub-menu {{ $prefix == '/reports' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span>Rapoarte Vanzari</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'all-reports' ? 'active' : '' }}"><a
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
                        <span>Clienti</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'all-users' ? 'active' : '' }}"><a
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
                        <span>Blog Managemenet</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'blog.category' ? 'active' : '' }}"><a
                                href="{{ route('blog.category') }}"><span>Categorii Blog</span></a></li>
                        <li class="{{ $route == 'add.post' ? 'active' : '' }}"><a
                                href="{{ route('add.post') }}"><span>Adauga Postare</span></a></li>
                        <li class="{{ $route == 'list.post' ? 'active' : '' }}"><a
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
                        <span>Setari Site</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'site.setting' ? 'active' : '' }}"><a
                                href="{{ route('site.setting') }}"><span>Date Companie</span></a></li>
                        <li class="{{ $route == 'seo.setting' ? 'active' : '' }}"><a
                                href="{{ route('seo.setting') }}"><span>Setari SEO</span></a></li>
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($return_order == true)
                <li class="has-sub-menu {{ $prefix == '/return' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span>Retur comenzi</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'return.request' ? 'active' : '' }}"><a
                                href="{{ route('return.request') }}"><span>Solictiare Retur</span></a></li>
                        <li class="{{ $route == 'all.request' ? 'active' : '' }}"><a
                                href="{{ route('all.request') }}"><span>Toate Solictarile</span></a></li>
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($review == true)
                <li class="has-sub-menu {{ $prefix == '/review' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span>Recenzii</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'pending.review' ? 'active' : '' }}"><a
                                href="{{ route('pending.review') }}"><span>Recenzii in asteptare</span></a></li>
                        <li class="{{ $route == 'publish.review' ? 'active' : '' }}"><a
                                href="{{ route('publish.review') }}"><span>Recenzii publicate</span></a></li>
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            @if ($admin_user_role == true)
                <li class="has-sub-menu {{ $prefix == '/admin_user_role' ? 'active' : '' }}"><a href="#"><i
                            class="ti-home"></i>
                        <span>Nivel Acces Administratori</span></a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ $route == 'all.admin.user' ? 'active' : '' }}"><a
                                href="{{ route('all.admin.user') }}"><span>Lista Administratori</span></a></li>
                        {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                    </ul>
                </li>
            @else
            @endif
            {{-- sectiune meniu navigare admin branduri termina --}}


            <li class="has-sub-menu"><a href="#"><i class="ti-package"></i> <span>Basic
                        Elements</span></a>
                <ul class="side-header-sub-menu">
                    <li><a href="elements-alerts.html"><span>Alerts</span></a></li>
                    <li><a href="elements-accordions.html"><span>Accordions</span></a></li>
                    <li><a href="elements-avatar.html"><span>Avatar</span></a></li>
                    <li><a href="elements-badge.html"><span>Badge</span></a></li>
                    <li><a href="elements-buttons.html"><span>Buttons</span></a></li>
                    <li><a href="elements-carousel.html"><span>Carousel</span></a></li>
                    <li><a href="elements-dropdown.html"><span>Dropdown</span></a></li>
                    <li><a href="elements-list-group.html"><span>List Group</span></a></li>
                    <li><a href="elements-media.html"><span>Media</span></a></li>
                    <li><a href="elements-modal.html"><span>Modal</span></a></li>
                    <li><a href="elements-pagination.html"><span>Pagination</span></a></li>
                    <li><a href="elements-progress.html"><span>Progress Bar</span></a></li>
                    <li><a href="elements-spinners.html"><span>Spinners</span></a></li>
                    <li><a href="elements-tabs.html"><span>Tabs</span></a></li>
                    <li><a href="elements-tooltip.html"><span>Tooltip</span></a></li>
                    <li><a href="elements-typography.html"><span>Typography</span></a></li>
                </ul>
            </li>
            <li class="has-sub-menu"><a href="#"><i class="ti-crown"></i> <span>Advance
                        Elements</span></a>
                <ul class="side-header-sub-menu">
                    <li><a href="elements-clipboard.html"><span>Clipboard</span></a></li>
                    <li><a href="elements-fullcalendar.html"><span>Full Calendar</span></a></li>
                    <li><a href="elements-media-player.html"><span>Media Player</span></a></li>
                    <li><a href="elements-sortable.html"><span>Sortable (Drag&Drop)</span></a></li>
                    <li><a href="elements-toastr.html"><span>Toastr</span></a></li>
                    <li><a href="elements-rating.html"><span>Rating</span></a></li>
                    <li><a href="elements-sweetalert.html"><span>Sweet Alert</span></a></li>
                </ul>
            </li>
            <li class="has-sub-menu"><a href="#"><i class="ti-stamp"></i> <span>Icons</span></a>
                <ul class="side-header-sub-menu">
                    <li><a href="icons-cryptocurrency.html"><span>Cryptocurrency</span></a></li>
                    <li><a href="icons-fontawesome.html"><span>Font Awesome</span></a></li>
                    <li><a href="icons-material.html"><span>Material Icon</span></a></li>
                    <li><a href="icons-themify.html"><span>Themify Icon</span></a></li>
                </ul>
            </li>
            <li class="has-sub-menu"><a href="#"><i class="ti-notepad"></i> <span>Forms</span></a>
                <ul class="side-header-sub-menu">
                    <li><a href="form-basic-elements.html"><span>Basic Elements</span></a></li>
                    <li><a href="form-checkbox.html"><span>Checkbox</span></a></li>
                    <li><a href="form-date-mask.html"><span>Date & Mask</span></a></li>
                    <li><a href="form-editor.html"><span>Editor</span></a></li>
                    <li><a href="form-file-upload.html"><span>File Upload</span></a></li>
                    <li><a href="form-layout.html"><span>Layout</span></a></li>
                    <li><a href="form-radio.html"><span>Radio</span></a></li>
                    <li><a href="form-range-slider.html"><span>Range Slider</span></a></li>
                    <li><a href="form-selects.html"><span>Selects</span></a></li>
                    <li><a href="form-switchers.html"><span>Switchers</span></a></li>
                    <li><a href="form-wizard.html"><span>Wizard</span></a></li>
                </ul>
            </li>
            <li class="has-sub-menu"><a href="#"><i class="ti-layout"></i> <span>Table</span></a>
                <ul class="side-header-sub-menu">
                    <li><a href="table-basic.html"><span>Basic</span></a></li>
                    <li><a href="table-data-table.html"><span>Data Table</span></a></li>
                    <li><a href="table-footable.html"><span>Footable</span></a></li>
                    <li><a href="table-jsgrid.html"><span>Jsgrid</span></a></li>
                </ul>
            </li>
            <li class="has-sub-menu"><a href="#"><i class="ti-pie-chart"></i> <span>Charts</span></a>
                <ul class="side-header-sub-menu">
                    <li><a href="chart-chartjs.html"><span>ChartJs</span></a></li>
                    <li><a href="chart-echarts.html"><span>Echarts</span></a></li>
                    <li><a href="chart-google.html"><span>Google Chart</span></a></li>
                    <li><a href="chart-morris.html"><span>Morris Chart</span></a></li>
                    <li><a href="chart-sparkline.html"><span>Sparkline Chart</span></a></li>
                </ul>
            </li>
            <li class="has-sub-menu"><a href="#"><i class="ti-map"></i> <span>Maps</span></a>
                <ul class="side-header-sub-menu">
                    <li><a href="map-vector.html"><span>Vector Map</span></a></li>
                    <li><a href="map-google.html"><span>Google Map</span></a></li>
                </ul>
            </li>
            <li class="has-sub-menu"><a href="#"><i class="ti-shopping-cart"></i>
                    <span>E-commerce</span></a>
                <ul class="side-header-sub-menu">
                    <li><a href="add-product.html"><span>Add Product</span></a></li>
                    <li><a href="edit-product.html"><span>Edit Product</span></a></li>
                    <li><a href="invoice-list.html"><span>Invoice List</span></a></li>
                    <li><a href="invoice-details.html"><span>Invoice Details</span></a></li>
                    <li><a href="order-list.html"><span>Order List</span></a></li>
                    <li><a href="order-details.html"><span>Order Details</span></a></li>
                    <li><a href="manage-products.html"><span>Manage Products</span></a></li>
                </ul>
            </li>
            <li class="has-sub-menu"><a href="#"><i class="ti-gift"></i> <span>Apps</span></a>
                <ul class="side-header-sub-menu">
                    <li><a href="chat.html"><span>Chat</span></a></li>
                    <li><a href="mail.html"><span>Mail</span></a></li>
                    <li><a href="single-mail.html"><span>Single Mail</span></a></li>
                    <li><a href="todo-list.html"><span>Todo List</span></a></li>
                </ul>
            </li>
            <li class="has-sub-menu"><a href="#"><i class="ti-lock"></i>
                    <span>Authentication</span></a>
                <ul class="side-header-sub-menu">
                    <li><a href="login.html"><span>login</span></a></li>
                    <li><a href="register.html"><span>register</span></a></li>
                    <li><a href="author-profile.html"><span>Profile</span></a></li>
                </ul>
            </li>
            <li class="has-sub-menu"><a href="#"><i class="ti-layers"></i> <span>Pages</span></a>
                <ul class="side-header-sub-menu">
                    <li><a href="blank.html"><span>Blank</span></a></li>
                    <li><a href="timeline.html"><span>Timeline</span></a></li>
                    <li><a href="pricing.html"><span>Pricing</span></a></li>
                    <li><a href="error-1.html"><span>error-1</span></a></li>
                    <li><a href="error-2.html"><span>error-2</span></a></li>
                </ul>
            </li>

        </ul>
    </nav>

</div><!-- Side Header Inner End -->
