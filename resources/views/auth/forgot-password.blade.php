<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>eShop Autentificare</title>
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
    <link rel="stylesheet" href="{{ asset('backend/css/helper.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">

</head>

<body class="skin-dark">

    <div class="main-wrapper">

        <!-- Content Body Start -->
        <div class="content-body m-0 p-0">

            <div class="login-register-wrap">
                <div class="row">

                    <div class="d-flex align-self-center justify-content-center order-2 order-lg-1 col-lg-5 col-12">
                        <div class="login-register-form-wrap">

                            <div class="content">
                                <h1>Resetare parola cont</h1>
                                <p>Ai uitat parola? Nici o problema. Completeaza formularul cu o adresa de mail si vei
                                    primi un mail cu un link de resetare parola!</p>
                            </div>

                            <div class="login-register-form">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-12 mb-20"><input class="form-control" type="email"
                                                id="email" name="email" placeholder="Adresa de email."></div>
                                        <div class="col-12 mt-10"><button
                                                class="button button-primary button-outline">Reseteaza parola!</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="login-register-bg order-1 order-lg-2 col-lg-7 col-12">
                        <div class="content">
                            <h1>Sign in</h1>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div><!-- Content Body End -->

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

</body>

</html>
