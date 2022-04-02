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
                <form method="POST" action="{{ route('admin.update.password') }}">
                    @csrf
                    <div class="row mbn-20">

                        <div class="col-12 mb-20">
                            <label for="current_password"> <strong>Parola Curenta</strong></label>
                            <input type="password" name="current_password" id="current_password" type="text"
                                class="form-control">
                            @error('old_password')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-12 mb-20">
                            <label for="password"><strong>Parola Nou</strong>a</label>
                            <input type="password" name="password" id="password" type="text" class="form-control">
                            @error('password')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-12 mb-20">
                            <label for="password_confirmation"><strong>Confirmare Parola Noua</strong></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" type="text"
                                class="form-control">
                            @error('password_confirmation')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>


                        <div class="col-12 mb-20">
                            <input type="submit" value="Actualizeaza" class="button button-primary">
                            <a href="{{ url('/admin/dashboard') }}"><button class="button button-danger">Anuleaza
                                </button></a>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
    <!--Default Form End-->
@endsection
