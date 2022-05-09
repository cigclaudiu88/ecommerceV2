@extends('frontend.main_master')
@section('content')

@section('title')
    Pagina Inexistenta
@endsection

<!--error section area start-->
<div class="error_section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="error_form">
                    <h1>404</h1>
                    <h2>UPS. PAGINA NU A FOST GASITA</h2>
                    <p>Ne pare rau dar pagina pe care doriti sa o accesati nu exista sau a fost stearsa sau nu este
                        momentan disponibila.
                    </p>
                    <form action="#">
                        {{-- <input placeholder="Search..." type="text"> --}}
                        {{-- <button type="submit"><i class="icon-search"></i></button> --}}
                    </form>
                    <a href="{{ url('/') }}">Intoarcete spre Frontpage</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--error section area end-->

@endsection
