<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    {{-- csrf token pentru scriptul de modal conform script de jos --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    {{-- SweetAlert CDN --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        // functie de ProductView din Quick View Modal de pe butonul cu lupa
        function productView(id) {
            // alert(id)
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json',
                success: function(data) {
                    // afisam numele produsului in modal prin id-ul pname
                    // folosind data si product.product_name din functia ProductViewModalAjax() din IndexController
                    $('#pname').text(data.product.product_name);
                    // daca avem discount afisam pretul cu discount altfel doar pretul normal
                    if (data.product.discount_price == null) {
                        $('#pprice').text('');
                        $('#oldprice').text('');
                        $('#pprice').text(data.product.selling_price);
                    } else {
                        $('#pprice').text(data.product.discount_price);
                        $('#oldprice').text(data.product.selling_price);
                    }
                    // folosind functia category din Product Model accesam numele categoriei
                    $('#psubsubcategory').text(data.product.subsubcategory.subsubcategory_name);
                    // folosind functia brand din Product Model accesam numele brandului
                    $('#pbrand').text(data.product.brand.brand_name);

                    $('#pimage').attr('src', '/' + data.product.product_thumbnail);
                    // pentru randere continut specificatii ca si html si nu text
                    $('#pspecifications').html(data.product.specifications);

                    // Afisare stoc produse in modal
                    if (data.product.product_quantity >= 10) {
                        $('#lowstock').hide();
                        $('#stockout').hide();
                        $('#aviable').text('In Stoc').show();
                    } else if (data.product.product_quantity > 0) {
                        $('#aviable').hide();
                        $('#stockout').hide();
                        $('#lowstock').text('Stoc Scazut').show();
                    } else if (data.product.product_quantity == 0) {
                        $('#aviable').hide();
                        $('#lowstock').hide();
                        $('#stockout').text('Stoc Epuizat').show();
                    }
                    // adaugat in modal id-ul / cantitatea produsului pentru a putea fi folosit in functia addToCart() 
                    $('#product_id').val(id);
                    $('#qty').val(1);
                }
            })
        }

        // Inceput functie adauga in cos
        function addToCart() {
            var product_name = $('#pname').text();
            var id = $('#product_id').val();
            // var color = $('#color option:selected').text();
            // var size = $('#size option:selected').text();
            var quantity = $('#qty').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    // color: color,
                    // size: size,
                    quantity: quantity,
                    product_name: product_name
                },
                url: "/cart/data/store/" + id,
                success: function(data) {
                    miniCart();
                    // id pentru inchidere modal on click
                    $('#closeModel').click();
                    // console.log(data)

                    // Mesaj SweetAlert Adaugat cu succes in cosul de cumparaturi - start
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // Mesaj SweetAlert Adaugat cu succes in cosul de cumparaturi - sfarsit
                }
            })
        }
        //  Sfarsit functie adauga in cos
    </script>

    {{-- script pt afisare produse in mini cart --}}
    <script type="text/javascript">
        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success: function(response) {

                    // afisam in span-urile care au id-urile valorile aduse de cartSubTotal, cartTax, cartTotal din functia AddMiniCart() din CartController
                    $('span[id="cartSubTotal"]').text(response.cartSubTotal);
                    $('span[id="cartTax"]').text(response.cartTax);
                    $('span[id="cartTotal"]').text(response.cartTotal);
                    $('#cartQty').text(response.cartQty);

                    var miniCart = ""

                    $.each(response.carts, function(key, value) {

                        miniCart += `<div class="cart_item">
                                                                <div class="cart_img">
                                                                    <a href="#"><img
                                                                            src="/${value.options.image}"
                                                                            alt=""></a>
                                                                </div>
                                                                <div class="cart_info">
                                                                    <a href="#">${value.name}</a>
                                                                    <p> <span>  ${value.qty}*${value.price} RON </span></p>
                                                                </div>
                                                                <div class="cart_remove">
                                                                    <a href="#"><i class="icon-x"></i></a>
                                                                </div>
                                                            </div>`
                    });
                    $('#miniCart').html(miniCart);
                }
            })
        }
        miniCart();
    </script>



</body>

</html>
