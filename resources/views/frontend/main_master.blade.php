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
                    // pt fiecare produs selectat se sterge imagnile din div-ul cu id-ul product_navactive din modal
                    $('.product_navactive').empty();
                    // se afiseaza fiecare imagine din multimea de imagini din baza de date in div-ul cu id-ul product_navactive din modal
                    data.multiImage.forEach((image, index) => $('.product_navactive').append(
                        `<div class="owl-item ${index<4? `active`:`cloned`}" style="width: 96.707px;"><li><a class="nav-link ${index+1==1? `active`:``}" data-toggle="tab" role="tab" aria-controls="tab${index+1}" aria-selected="${index === 0}"><img src=${image.photo_name} alt=""></a></li><div>`
                    ));

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
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // Mesaj SweetAlert Adaugat cu succes in cosul de cumparaturi - sfarsit
                }
            })
        }
        //  Sfarsit functie adauga in cos

        function addToCartButton(product_id, product_name) {

            var product_name = product_name;
            var quantity = 1;
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    // color: color,
                    // size: size,
                    quantity: quantity,
                    product_name: product_name
                },
                url: "/cart/data/store/" + product_id,
                success: function(data) {
                    miniCart();

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
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // Mesaj SweetAlert Adaugat cu succes in cosul de cumparaturi - sfarsit
                }
            })
        }
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
                                                                    <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="icon-x"></i></button>
                                                                </div>
                                                            </div>`
                    });
                    $('#miniCart').html(miniCart);
                }
            })
        }
        miniCart();

        // functia de sters dini mini cart + notificare sweetalert start
        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/product-remove/' + rowId,
                dataType: 'json',
                success: function(data) {
                    // cam redundant pt ca voucherRemove faci si voucherCalculation...
                    voucherRemove();
                    // adaugat functia de calculare voucher ca atunci cand se sterge un produs din cosul de cumparaturi se recalculeaza pretul total
                    voucherCalculation();
                    cart();
                    miniCart();
                    // dupa ce stergem produse care aveau voucher, afisam din nou campul de adaugare voucher
                    $('#voucherField').show();
                    // dupa ce stergem  produse care aveau voucher adaugare voucher valoarea din campul de adaugare voucher devine gol
                    $('#voucher_name').val('');
                    // start mesaj sweetalert
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
                    // sfarsit mesaj sweetalert
                }
            });
        }
        // functia de sters dini mini cart + notificare sweetalert start
    </script>

    {{-- adaugare in wishlist script --}}
    <script type="text/javascript">
        function addToWishList(product_id) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/add-to-wishlist/" + product_id,
                success: function(data) {

                    // Start Mesaj
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                }
            });
        }
    </script>

    {{-- script afisare produse din wishlist start --}}
    <script type="text/javascript">
        function wishlist() {
            $.ajax({
                type: 'GET',
                url: '/user/get-wishlist-product',
                dataType: 'json',
                success: function(response) {
                    // pentru afisare in wishlist numarul de produse din wishlist
                    $('span[id="wishQty"]').text(response.length);
                    var rows = ""
                    $.each(response, function(key, value) {
                        // folosind functia product() din modelul Wishlist acesam campurile dint tabelul products
                        rows += ` <tr>
                                        <td class="product_remove"> <button type="submit"  id="${value.id}" onclick="wishlistRemove(this.id)"><i class="icon-x"></i></button></td>
                                        <td class="product_thumb"><a>
                                            <img
                                                    src="/${value.product.product_thumbnail	}" alt=""></a></td>
                                        <td class="product_name"><a >${value.product.product_name}</a></td>
                                        <td class="product-price">${value.product.discount_price == null ? `<span class="current_price">${value.product.selling_price} RON</span>`:`<span class="current_price">${value.product.discount_price} RON</span> <span class="old_price">${value.product.selling_price} RON</span>`}</td>
                                        <td class="product_quantity">${value.product.product_quantity==0 ? `<span id="stockout">Stoc Epuizat</span>`:`<span id="aviable">In Stoc</span>`}</td>
                                        <td class="product_total"> <span><a
                                                                    data-tippy="quick view" data-tippy-placement="top"
                                                                    data-tippy-arrow="true" data-tippy-inertia="true"
                                                                    data-bs-toggle="modal" data-bs-target="#modal_box"
                                                                    onclick="productView(this.id)"
                                                                    id="${value.product_id}">Adauga in Cos</span></td>
                                    </tr>`
                    });

                    $('#wishlist').html(rows);
                }
            })
        }
        wishlist();

        ///  functia de stergere produse din wishlist + notificare sweetalert start
        function wishlistRemove(id) {
            $.ajax({
                type: 'GET',
                url: '/user/wishlist-remove/' + id,
                dataType: 'json',
                success: function(data) {
                    wishlist();
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    ///  functia de stergere produse din wishlist + notificare sweetalert start
                }
            });
        }
        // End Wishlist remove   
    </script>
    {{-- script afisare produse din wishlist sfarsit --}}

    {{-- script pagina cosului de cumparaturi start --}}
    <script type="text/javascript">
        // functia de afisare produse din cosul de cumparaturi
        function cart() {
            $.ajax({
                type: 'GET',
                url: '/user/get-cart-product',
                dataType: 'json',
                success: function(response) {
                    // pentru afisare in wishlist numarul de produse din wishlist

                    var rows = ""
                    //  pentru fiecare response cu carts json response din GetCartProduct() CartPageController toate datele produseles din cosul de cumparaturi
                    $.each(response.carts, function(key, value) {
                        // acesam datele produselor din functia AddToCart() CartController
                        // atunci cand cantitatea este 1 butonul de scadere cantitate este disabled
                        rows += `<tr>
                            <td class="product_remove"><a id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-trash-o"></i></a></td>                      
                                        <td class="product_thumb"><img
                                                    src="/${value.options.image}" alt=""></td>
                                        <td class="product_name"><a>${value.name}</a></td>
                                        <td class="product-price">${value.price.toLocaleString()} RON</td>
                                        
                                        <td class="product_quantity">
                    
                                            ${value.qty > 1 ? 
                                                `<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)" >-</button> ` 
                                                : `<button type="submit" class="btn btn-danger btn-sm" disabled >-</button> `}

                                            <input min="1" max="100" value="${value.qty}" type="text" class="text-center">
                                            <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrement(this.id)">+</button>
                                        </td>
                                            
                                        <td class="product-price">${value.subtotal.toLocaleString()} RON</td>
                                    </tr>`
                    });

                    $('#cartPage').html(rows);
                }
            })
        }
        cart();

        // functia de stergere produse din cosul de cumparaturi + notificare sweetalert start
        function cartRemove(id) {
            $.ajax({
                type: 'GET',
                url: '/user/cart-remove/' + id,
                dataType: 'json',
                success: function(data) {
                    voucherRemove();
                    // adaugat functia de calculare voucher ca atunci cand se sterge un produs din cosul de cumparaturi se recalculeaza pretul total
                    // voucherCalculation();
                    cart();
                    miniCart();
                    // dupa ce stergem produse care aveau voucher, afisam din nou campul de adaugare voucher
                    $('#voucherField').show();
                    // dupa ce stergem  produse care aveau voucher adaugare voucher valoarea din campul de adaugare voucher devine gol
                    $('#voucher_name').val('');
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    ///  functia de stergere produse din wishlist + notificare sweetalert start
                }
            });
        }
        // End Wishlist remove   

        // functia de incrementare produse din cosul de cumparaturi start
        function cartIncrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "/cart-increment/" + rowId,
                dataType: 'json',
                success: function(data) {
                    //adaugat functia de calcul a voucherului pentru a actualiza pretul total la fiecare incrementare
                    voucherCalculation();
                    // actualizam cantitatea si in cart() si in miniCarT()
                    cart();
                    miniCart();
                }
            });
        }
        // functia de decrementare produse din cosul de cumparaturi start
        function cartDecrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "/cart-decrement/" + rowId,
                dataType: 'json',
                success: function(data) {
                    // adaugat functia de calcul a voucherului pentru a actualiza pretul total la fiecare decrementare
                    voucherCalculation();
                    // actualizam cantitatea si in cart() si in miniCarT()
                    cart();
                    miniCart();
                }
            });
        }
    </script>
    {{-- script pagina cosului de cumparaturi sfarsit --}}

    {{-- script pentru aplicare voucher - start --}}
    <script type="text/javascript">
        function applyVoucher() {
            // variabila voucher_name preia valoarea din inputul de text cu id voucher_name
            var voucher_name = $('#voucher_name').val();
            // script ajax care trimite datele catre controllerul CartController
            $.ajax({
                type: 'POST',
                dataType: 'json',
                // datele trimise catre controller
                data: {
                    voucher_name: voucher_name
                },
                // ruta catre functia VoucherApply din CartController
                url: "{{ url('/voucher-apply') }}",
                success: function(data) {
                    voucherCalculation();
                    // dupa ce aplicam voucherul campul de adaugare voucher dispare
                    $('#voucherField').hide();
                    if (data.validity == true) {
                        $('#VoucherField').hide();
                    }
                    // start mesaj aplicare voucher
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // sfarsit mesaj aplicare voucher

                }
            });
            voucherCalculation();
        }

        // functia de calculare valoare Voucher
        function voucherCalculation() {
            $.ajax({
                type: 'GET',
                url: "{{ url('/voucher-calculation') }}",
                dataType: 'json',
                success: function(data) {
                    // afisare calcul cos de cumparaturi FARA VOUCHER
                    if (data.total) {
                        $('#voucherCalField').html(
                            `<div class="cart_subtotal">
                                <p>Subtotal</p>
                                <p class="cart_amount">${data.subtotal} RON</p>
                            </div>

                            <div class="cart_subtotal ">
                                <p>TVA</p>
                                <p class="cart_amount">${data.tax} RON</p>
                            </div>

                            <div class="cart_subtotal">
                                <p>Total</p>
                                <p class="cart_amount">${data.total} RON</p>
                            </div>

                            <div class="checkout_btn">
                            <a href="{{ route('checkout') }}">Spre Casa</a>
                            </div>`
                        );
                    }
                    // afisare calcul cos de cumparaturi CU VOUCHER
                    else {
                        $('#voucherCalField').html(
                            `<div class="cart_subtotal">
                                <p>Subtotal</p>
                                <p class="cart_amount">${data.subtotal} RON</p>
                            </div>

                            <div class="cart_subtotal ">
                                <p>Voucher: ${data.voucher_name}</p>
                                <p class="cart_amount text-danger">-${data.discount_amount} RON</p>
                            </div>

                            <div class="cart_subtotal ">
                                <p>TVA</p>
                                <p class="cart_amount">${data.tax} RON</p>
                            </div>

                            <div class="cart_subtotal">
                                <p>Total</p>
                                <p class="cart_amount">${data.grandtotal} RON</p>
                            </div> 

                            <div class="checkout_btn">
                                <button class="justify-content-start" type="submit" onclick="voucherRemove()"><i class="fa fa-times"></i> Stergere Voucher</button>
                            <a href="{{ route('checkout') }}">Spre Casa</a>
                            </div>
                            <div class="cart_subtotal ">
                            </div>
                            `);
                    }
                }
            });
        }
        voucherCalculation();
    </script>
    {{-- script pentru aplicare voucher - sfarsit --}}

    {{-- script pentru stergere voucher - start --}}
    <script type="text/javascript">
        function voucherRemove() {
            $.ajax({
                type: 'GET',
                url: "{{ url('/voucher-remove') }}",
                dataType: 'json',
                success: function(data) {
                    // apelez functia de calculare cos de cumparaturi cu sau fara voucher
                    voucherCalculation();
                    // dupa ce stergem voucherul, afisam din nou campul de adaugare voucher
                    $('#voucherField').show();
                    // dupa ce stergem voucherul campul de adaugare voucher valoarea din campul de adaugare voucher devine gol
                    $('#voucher_name').val('');
                    // start mesaj stergere voucher
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                }
            });
        }
    </script>
    {{-- script pentru stergere voucher - sfarsit --}}


</body>

</html>
