@extends('admin.admin_master')

@section('admin')
    <!-- Page Headings Start -->
    <div class="row justify-content-between align-items-center mb-10">

        <!-- Page Heading Start -->
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Administrator</h3>
            </div>
        </div><!-- Page Heading End -->

    </div><!-- Page Headings End -->

    <!--Default Form Start-->
    <div class="col-lg-6 col-12 mb-30 d-flex justify-content-center">
        <div class="box">
            <div class="box-head">
                <h4 class="title">Modifica Parola Admin</h4>
            </div>
            {{-- formular de actualizare date admin pe ruta admin.profile.store cu enctype="multipart/form-data pentru lucrul cu imagini si @csrf --}}
            <div class="box-body">
                <form method="" action="">
                    @csrf
                    <div class="row mbn-20">

                        <div class="col-12 mb-20">
                            <label for="name">Nume</label>
                            <input type="text" name="name" class="form-control" placeholder="Nume">
                        </div>

                        <div class="col-12 mb-20">
                            <label for="email">Adresa Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>

                        <div class="col-12 mb-20">
                            <label for="phone">Telefon</label>
                            <input type="text" name="phone" class="form-control" placeholder="Telefon">
                        </div>


                        <div class="col-12 mb-20">
                            <input type="submit" value="Actualizeaza" class="button button-primary">
                        </div>
                    </div>
                </form>

                <a href="{{ url('/admin/dashboard') }}"><button class="button button-danger">Anuleaza </button></a>

            </div>
        </div>
    </div>
    <!--Default Form End-->
@endsection
