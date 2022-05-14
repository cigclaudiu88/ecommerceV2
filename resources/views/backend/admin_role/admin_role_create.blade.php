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
                <h3>Adauga User Administrator</h3>
            </div>
        </div><!-- Page Heading End -->

    </div><!-- Page Headings End -->


    <div class="row mbn-50 d-flex justify-content-center">
        <!--Author Top Start-->
        {{-- <div class="col-6 mb-50">
            <div class="author-top">
                <div class="inner">
                    <div class="author-profile">
                        <div class="image">
                            <img src="{{ !empty($adminEditData->profile_photo_path) ? url('upload/admin_images/' . $adminEditData->profile_photo_path) : url('upload/default_profile.png') }}"
                                alt="" style="">
                        </div>
                        <div class="info">
                            <h5>{{ $adminEditData->name }}</h5>
                            <span>{{ $adminEditData->email }}</span>
                            <span>{{ $adminEditData->phone }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--Author Top End-->

        <!--Default Form Start-->
        <div class="col-lg-12 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Adauga User Administrator</h4>
                </div>
                {{-- formular de actualizare date admin pe ruta admin.profile.store cu enctype="multipart/form-data pentru lucrul cu imagini si @csrf --}}
                <div class="box-body">
                    <form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-20">

                            <div class="col-3 mb-20">
                                <label for="name">Nume</label>
                                <input type="text" name="name" class="form-control" placeholder="Adauga Nume">
                            </div>

                            <div class="col-3 mb-20">
                                <label for="email">Adresa Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Adauga Adresa Email">
                            </div>

                            <div class="col-3 mb-20">
                                <label for="phone">Parola</label>
                                <input type="text" name="phone" class="form-control" placeholder="Adauga Parola">
                            </div>

                            <div class="col-3 mb-20">
                                <label for="phone">Telefon</label>
                                <input type="text" name="phone" class="form-control" placeholder="Adauga Telefon">
                            </div>


                        </div>

                        <label class="mb-20">Meniuri Access</label>

                        <div class="row mb-20">

                            <div class="col-3 mb-20">
                                <label class="adomx-checkbox primary"><input type="checkbox" name="brand" value="1"> <i
                                        class="icon"></i>Management Branduri</label>
                                <label class="adomx-checkbox primary"><input type="checkbox" name="category" value="1"> <i
                                        class="icon"></i>Management Categorii</label>
                                <label class="adomx-checkbox primary"><input type="checkbox" name="subcategory" value="1">
                                    <i class="icon"></i>Management Subcategorii</label>
                                <label class="adomx-checkbox primary"><input type="checkbox" name="subsubcategory"
                                        value="1">
                                    <i class="icon"></i>Management SubSubcategorii</label>
                                <label class="adomx-checkbox primary"><input type="checkbox" name="product" value="1"> <i
                                        class="icon"></i>Management Produse</label>

                            </div>

                            <div class="col-3 mb-20">
                                <label class="adomx-checkbox primary"><input type="checkbox" name="stock" value="1"> <i
                                        class="icon"></i>Stocuri Produse</label>
                                <label class="adomx-checkbox primary"><input type="checkbox" name="slider" value="1"> <i
                                        class="icon"></i>Management Reclame Slider</label>
                                <label class="adomx-checkbox primary"><input type="checkbox" name="voucher" value="1"> <i
                                        class="icon"></i>Management Voucher-uri</label>

                                <label class="adomx-checkbox primary"><input type="checkbox" name="orders" value="1"> <i
                                        class="icon"></i>Management Comenzi</label>
                                <label class="adomx-checkbox primary"><input type="checkbox" name="return_order" value="1">
                                    <i class="icon"></i>Management Retur Produse</label>
                            </div>

                            <div class="col-3 mb-20">
                                <label class="adomx-checkbox primary"><input type="checkbox" name="reports" value="1"> <i
                                        class="icon"></i>Rapoarte vanzari</label>
                                <label class="adomx-checkbox primary"><input type="checkbox" name="alluser" value="1"> <i
                                        class="icon"></i>Lista Clienti</label>
                                <label class="adomx-checkbox primary"><input type="checkbox" name="blog" value="1"> <i
                                        class="icon"></i>Management Blog</label>
                                <label class="adomx-checkbox primary"><input type="checkbox" name="review" value="1"> <i
                                        class="icon"></i>Management Recenzii Produse</label>
                            </div>

                            <div class="col-3 mb-20">
                                <label class="adomx-checkbox primary"><input type="checkbox" name="setting" value="1"> <i
                                        class="icon"></i>Setari Site</label>
                                <label class="adomx-checkbox primary"><input type="checkbox" name="shipping" value="1"> <i
                                        class="icon"></i>Management Locatii</label>
                                <label class="adomx-checkbox primary"><input type="checkbox" name="admin_user_role"
                                        value="1">
                                    <i class="icon"></i>Rol Administrator</label>
                            </div>

                        </div>



                        <div class="row mb-20">
                            <div class="col-12 mb-20">
                                <label for="profile_photo_path">Imagine Profil Admin</label>
                                <input type="file" name="profile_photo_path" class="form-control" id="imagedisplay">
                            </div>

                            <div class="col-12 mb-20">
                                <img id="showImage" src="{{ url('upload/default_profile.png') }}"
                                    style="width: 100px; height: 100px;" alt="">
                            </div>



                            <div class="col-12">
                                <input type="submit" value="Adauga Administrator" class="button button-primary">
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
