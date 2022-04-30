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
            <li class="has-sub-menu {{ $prefix == '/brand' ? 'active' : '' }}"><a href="#"><i
                        class="ti-home"></i>
                    <span>Branduri</span></a>
                <ul class="side-header-sub-menu">
                    <li class="{{ $prefix == '/brand' ? 'active' : '' }}"><a
                            href="{{ route('all.brand') }}"><span>Management Branduri </span></a></li>
                    {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                </ul>
            </li>
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- sectiune meniu navigare admin categorii incepe --}}
            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            <li class="has-sub-menu {{ $prefix == '/category' ? 'active' : '' }}"><a href="#"><i
                        class="ti-home"></i>
                    <span>Categorii Produse</span></a>
                <ul class="side-header-sub-menu">
                    <li class="{{ $route == 'all.category' ? 'active' : '' }}"><a
                            href="{{ route('all.category') }}"><span>Management Categorii </span></a></li>
                    <li class="{{ $route == 'all.subcategory' ? 'active' : '' }}"><a
                            href="{{ route('all.subcategory') }}"><span>Management SubCategorii </span></a></li>
                    <li class="{{ $route == 'all.subsubcategory' ? 'active' : '' }}"><a
                            href="{{ route('all.subsubcategory') }}"><span>Management SubSubCategorii </span></a>
                    </li>
                    {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                </ul>
            </li>
            {{-- sectiune meniu navigare admin categorii termina --}}

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
            {{-- sectiune meniu navigare admin branduri termina --}}

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
            {{-- sectiune meniu navigare admin branduri termina --}}

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
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
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
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
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
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            <li class="has-sub-menu {{ $prefix == '/reports' ? 'active' : '' }}"><a href="#"><i
                        class="ti-home"></i>
                    <span>Rapoarte Vanzari</span></a>
                <ul class="side-header-sub-menu">
                    <li class="{{ $route == 'all-reports' ? 'active' : '' }}"><a
                            href="{{ route('all-reports') }}"><span>Toate Rapoartele</span></a></li>
                    {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                </ul>
            </li>
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            <li class="has-sub-menu {{ $prefix == '/alluser' ? 'active' : '' }}"><a href="#"><i
                        class="ti-home"></i>
                    <span>Clienti</span></a>
                <ul class="side-header-sub-menu">
                    <li class="{{ $route == 'all-users' ? 'active' : '' }}"><a
                            href="{{ route('all-users') }}"><span>Lista Clienti</span></a></li>
                    {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                </ul>
            </li>
            {{-- sectiune meniu navigare admin branduri termina --}}

            {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
            <li class="has-sub-menu {{ $prefix == '/blog' ? 'active' : '' }}"><a href="#"><i
                        class="ti-home"></i>
                    <span>Blog Managemenet</span></a>
                <ul class="side-header-sub-menu">
                    <li class="{{ $route == 'blog.category' ? 'active' : '' }}"><a
                            href="{{ route('blog.category') }}"><span>Categorii Blog</span></a></li>
                    {{-- adaugat valoarea de active in clasa functie de ruta activa --}}
                </ul>
            </li>
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
