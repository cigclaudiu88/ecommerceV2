@extends('admin.admin_master')

@section('admin')
    {{-- ajax jquerry CDN pentru scriptul de validare categorie-subcategorie-subsubcategorie --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Page Headings Start -->
    <div class="row justify-content-between align-items-center mb-10">

        <!-- Page Heading Start -->
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Setari Site</h3>
            </div>
        </div><!-- Page Heading End -->

    </div><!-- Page Headings End -->

    <!--Default Form Start-->
    <div class="col-lg-12 col-12 mb-30 d-flex justify-content-center">
        <div class="box">
            <div class="box-head">
                <h4 class="title">Actualizeaza Datele de pe Site</h4>
            </div>
            {{-- formular de actualizare date admin pe ruta admin.profile.store cu enctype="multipart/form-data pentru lucrul cu imagini si @csrf --}}
            <div class="box-body">
                <form method="post" action="{{ route('update.site.setting') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mbn-20">

                        <input type="hidden" name="id" value="{{ $setting->id }}">

                        <div class="col-6 mb-20">
                            <label for="company_name"><strong>Nume Companie</strong></label>
                            <input type="text" name="company_name" id="company_name" class="form-control"
                                value="{{ $setting->company_name }}">
                            @error('company_name')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-6 mb-20">
                            <label for="company_address"><strong>Adresa Sediu Social</strong></label>
                            <input type="text" name="company_address" id="company_address" class="form-control"
                                value="{{ $setting->company_address }}">
                            @error('company_address')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-3 mb-20">
                            <label for="phone_one"><strong>Telefon Fix</strong></label>
                            <input type="text" name="phone_one" id="phone_one" class="form-control"
                                value="{{ $setting->phone_one }}">
                            @error('phone_one')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-3 mb-20">
                            <label for="phone_two"><strong>Telefon Mobil</strong></label>
                            <input type="text" name="phone_two" id="phone_two" class="form-control"
                                value="{{ $setting->phone_two }}">
                            @error('phone_two')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-3 mb-20">
                            <label for="email"><strong>Adresa de email</strong></label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ $setting->email }}">
                            @error('email')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-3 mb-20">
                            <label for="logo"><strong>Poza Logo</strong></label>
                            <input type="file" name="logo" id="imagedisplay" class="form-control">
                            @error('logo')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                            <img src="{{ asset($setting->logo) }}" alt="" id="showImage">
                        </div>


                        <div class="col-6 mb-20">
                            <label for="facebook"><strong>Facebook</strong></label>
                            <input type="text" name="facebook" id="facebook" class="form-control"
                                value="{{ $setting->facebook }}">
                            @error('facebook')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>


                        <div class="col-6 mb-20">
                            <label for="twitter"><strong>Twitter</strong></label>
                            <input type="text" name="twitter" id="twitter" class="form-control"
                                value="{{ $setting->twitter }}">
                            @error('twitter')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-6 mb-20">
                            <label for="linkedin"><strong>Linkedin</strong></label>
                            <input type="text" name="linkedin" id="linkedin" class="form-control"
                                value="{{ $setting->linkedin }}">
                            @error('linkedin')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-6 mb-20">
                            <label for="youtube"><strong>Youtube</strong></label>
                            <input type="text" name="youtube" id="youtube" class="form-control"
                                value="{{ $setting->youtube }}">
                            @error('youtube')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-12 mb-20">
                            <input type="submit" value="Actualizeaza Setari" class="button button-primary">
                            <a href="{{ url('/admin/dashboard') }}"><button class="button button-danger">Anuleaza
                                </button></a>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
    <!--Default Form End-->


    {{-- script pt afisarea imaginii principale selectate in formularul de adaugare postare --}}
    <script type="text/javascript">
        function mainThumbnailUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThumbnail').attr('src', e.target.result).width(139).height(139);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
