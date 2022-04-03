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
                                <h1>Inregistrare cont nou</h1>
                            </div>

                            <div class="login-register-form">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row">

                                        <div class="col-12 mb-20"><input class="form-control" type="text" id="name"
                                                name="name" placeholder="Nume si Prenume">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert"></span>
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-20"><input class="form-control" type="email"
                                                id="email" name="email" placeholder="Adresa de Email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert"></span>
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-20"><input class="form-control" type="text" id="phone"
                                                name="phone" placeholder="Phone">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert"></span>
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-20"><input class="form-control" type="password"
                                                id="password" name="password" placeholder="Parola">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert"></span>
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-20"><input class="form-control" type="password"
                                                id="password_confirmation" name="password_confirmation"
                                                placeholder="Confirmare Parola">
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert"></span>
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="col-12">

                                            <div class="row justify-content-between">
                                                <div class="col-auto mb-15">Ai deja cont? <a
                                                        href="{{ route('login') }}">Autentifica-te acum.</a></div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-10"><button
                                                class="button button-primary button-outline">Inregistrare cont</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="login-register-bg order-1 order-lg-2 col-lg-7 col-12">
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
