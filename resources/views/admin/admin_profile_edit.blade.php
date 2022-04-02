{{-- extends resources\views\admin\admin_master.blade.php with the @section('admin') in place of the @yield('admin') --}}
@extends('admin.admin_master')

@section('admin')
    {{-- jQuerry CDN link pentru scriptul de vizualizare imagine profil --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Page Headings Start -->
    <div class="row justify-content-between align-items-center mb-10">

        <!-- Page Heading Start -->
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Administrator</h3>
            </div>
        </div><!-- Page Heading End -->

    </div><!-- Page Headings End -->


    <div class="row mbn-50 d-flex justify-content-center">
        <!--Author Top Start-->
        <div class="col-6 mb-50">
            <div class="author-top">
                <div class="inner">
                    <div class="author-profile">
                        <div class="image">
                            <img src="{{ !empty($adminEditData->profile_photo_path)? url('upload/admin_images/' . $adminEditData->profile_photo_path): url('upload/default_profile.png') }}"
                                alt="" style="">
                        </div>
                        <div class="info">
                            <h5>{{ $adminEditData->name }}</h5>
                            <span>{{ $adminEditData->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Author Top End-->

        <!--Default Form Start-->
        <div class="col-lg-6 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Editeaza Profil Admin</h4>
                </div>
                <div class="box-body">
                    {{-- formular de actualizare date admin enctype="multipart/form-data pentru lucrul cu imagini si @csrf --}}
                    <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="name">Nume</label>
                                <input type="text" name="name" class="form-control" placeholder="Nume"
                                    value="{{ $adminEditData->name }}">
                            </div>

                            <div class="col-12 mb-20">
                                <label for="email">Adresa Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    value="{{ $adminEditData->email }}">
                            </div>

                            <div class="col-12 mb-20">
                                <label for="phone">Telefon</label>
                                <input type="text" name="phone" class="form-control" placeholder="Telefon"
                                    value="{{ $adminEditData->phone }}">
                            </div>

                            <div class="col-12 mb-20">
                                <label for="profile_photo_path">Imagine Profil</label>
                                <input type="file" name="profile_photo_path" class="form-control" id="imagedisplay">
                            </div>

                            <div class="col-12 mb-20">
                                <img id="showImage"
                                    src="{{ !empty($adminData->profile_photo_path)? url('upload/admin_images/' . $adminData->profile_photo_path): url('upload/default_profile.png') }}"
                                    style="width: 100px; height: 100px;" alt="">
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
    </div>

    {{-- javascript pentru a afisa imaginea selectata de profil inainte de inserare --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#imagedisplay').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
