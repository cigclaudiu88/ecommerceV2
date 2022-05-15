@extends('admin.admin_master')
@section('admin')
    <!--Error Start-->
    <div class="error-wrap">
        <div class="container">
            <div class="row">

                <div class="error-image col-12"><img src="{{ asset('backend/images/error/error-1.png') }}" alt=""></div>

                <div class="error-content col-12">
                    <h1 class="title">EROARE 404</h1>
                    <h4>Ne pare rau dar pagina pe care doriti sa o accesati nu exista sau a fost stearsa sau nu este
                        momentan disponibila.</h4>
                    <a href="{{ url('/admin/dashboard') }}" class="button button-danger button-round"><strong>Inapoi la
                            Dashboard</strong></a>
                </div>
            </div>
        </div>
    </div>
    <!--Error End-->
@endsection
