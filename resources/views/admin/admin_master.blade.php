<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/images/favicon.ico') }}">

    <!-- CSS
 ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/vendor/bootstrap.min.css') }}">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/vendor/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/vendor/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/vendor/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/vendor/cryptocurrency-icons.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/plugins/plugins.css') }}">

    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/helper.cs') }}s">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">

    <!-- Toaster CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    {{-- jQuerry CDN link pentru scriptul de vizualizare imagine inserata in formulare --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body class="skin-dark">

    <div class="main-wrapper">

        <!-- Header Section Start -->
        <div class="header-section">
            @include('admin.body.header')
        </div>
        <!-- Header Section End -->

        <!-- Side Header Start -->
        <div class="side-header show">
            <button class="side-header-close"><i class="zmdi zmdi-close"></i></button>
            <!-- Side Header Inner Start -->
            @include('admin.body.sidebar')
        </div><!-- Side Header End -->

        <!-- Content Body Start -->
        <div class="content-body">
            @yield('admin')
        </div><!-- Content Body End -->

        <div class="footer-section">
            @include('admin.body.footer')
        </div>

    </div>

    <!-- JS
============================================ -->

    <!-- Global Vendor, plugins & Activation JS -->
    <script src="{{ asset('backend/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('backend/js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('backend/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('backend/js/vendor/bootstrap.min.js') }}"></script>
    <!--Plugins JS-->
    <script src="{{ asset('backend/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/tippy4.min.js.js') }}"></script>
    <!--Main JS-->
    <script src="{{ asset('backend/js/main.js') }}"></script>

    <!-- Plugins & Activation JS For Only This Page -->

    <!--Moment-->
    <script src="{{ asset('backend/js/plugins/moment/moment.min.js') }}"></script>

    <!--Daterange Picker-->
    <script src="{{ asset('backend/js/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/daterangepicker/daterangepicker.active.js') }}"></script>

    <!--Echarts-->
    <script src="{{ asset('backend/js/plugins/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/chartjs/chartjs.active.js') }}"></script>

    <!--VMap-->
    <script src="{{ asset('backend/js/plugins/vmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/vmap/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/vmap/maps/samples/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/vmap/vmap.active.js') }}"></script>

    <!-- Data Tables JS -->
    <script src="{{ asset('backend/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/datatables/datatables.active.js') }}"></script>

    <!--Toastr Alerts-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- script pentru afisarea notificarilor cu Toaster --}}
    <script>
        // daca exista un mesaj in sesiune, il afiseaza cu un toastr
        @if (Session::has('message'))
            // variabila type preia tipul de alerta si mesajul din sesiune
            var type = "{{ Session::get('alert-type', 'message') }}"
        
            // optiuni de afisare a mesajului Toastr
            // pozitie sus in centru larg cu buton de close
            toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "rtl": false,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 300,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
        
            // functie de tipul de alerta din sesiune se apeleaza notificarea Toastr cu mesajul din sesiune
            switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
        
            case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
        
            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
            }
        @endif
    </script>

    {{-- javascript pentru a afisa imaginea selectata de profil inainte de inserare --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#imagedisplay').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

</body>

</html>
