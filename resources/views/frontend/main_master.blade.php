<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Safira Organic food HTML Template </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.ico') }}">

    <!-- CSS
    ========================= -->
    <!--bootstrap min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <!--owl carousel min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <!--slick min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <!--magnific popup min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <!--font awesome css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/font.awesome.css') }}">
    <!--ionicons css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/ionicons.min.css') }}">
    <!--linearicons css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/linearicons.css') }}">
    <!--animate css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <!--jquery ui min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}">
    <!--slinky menu css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/slinky.menu.css') }}">
    <!--plugins css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins.cs') }}s">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <!--modernizr min js here-->
    <script src="{{ asset('frontend/js/vendor/modernizr-3.7.1.min.js') }}"></script>
    <!-- Toaster CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    {{-- Font Asesome CDN --}}
    <script src="https://kit.fontawesome.com/e4b2d9b481.js" crossorigin="anonymous"></script>
</head>

<body>


    <!-- Header Section Begin -->
    @include('frontend.body.header')
    <!-- Header Section End -->

    <!-- Content Section Begin -->
    @yield('content')
    <!-- Content Section End -->

    <!-- Footer Section Begin -->
    @include('frontend.body.footer')
    <!-- Footer Section End -->

    <!-- modal area start-->
    @include('frontend.modal')
    <!-- modal area ends-->

    <!-- JS
============================================ -->
    <!--jquery min js-->
    <script src="{{ asset('frontend/js/vendor/jquery-3.4.1.min.js') }}"></script>
    <!--popper min js-->
    <script src="{{ asset('frontend/js/popper.js') }}"></script>
    <!--bootstrap min js-->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!--owl carousel min js-->
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <!--slick min js-->
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <!--magnific popup min js-->
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <!--counterup min js-->
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <!--jquery countdown min js-->
    <script src="{{ asset('frontend/js/jquery.countdown.js') }}"></script>
    <!--jquery ui min js-->
    <script src="{{ asset('frontend/js/jquery.ui.js') }}"></script>
    <!--jquery elevatezoom min js-->
    <script src="{{ asset('frontend/js/jquery.elevatezoom.js') }}"></script>
    <!--isotope packaged min js-->
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <!--slinky menu js-->
    <script src="{{ asset('frontend/js/slinky.menu.js') }}"></script>
    <!--instagramfeed menu js-->
    <script src="{{ asset('frontend/js/jquery.instagramFeed.min.js') }}"></script>
    <!-- tippy bundle umd js -->
    <script src="{{ asset('frontend/js/tippy-bundle.umd.js') }}"></script>
    <!-- Plugins JS -->
    <script src="{{ asset('frontend/js/plugins.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

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
            "positionClass": "toast-top-right",
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



</body>

</html>
