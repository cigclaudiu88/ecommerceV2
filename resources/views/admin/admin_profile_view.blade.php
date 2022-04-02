{{-- 6. Admin Profile & Image Update Part 1 --}}
{{-- 1. Admin Template Setup // resources\views\admin\admin_master.blade.php @yield('admin') --}}

{{-- extends resources\views\admin\admin_master.blade.php with the @section('admin') in place of the @yield('admin') --}}
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

    <div class="row mbn-50 d-flex justify-content-center">
        <!--Author Top Start-->
        <div class="col-12 mb-50">
            <div class="author-top">
                <div class="inner">
                    <div class="author-profile">
                        <div class="image">
                            <img src="{{ !empty($adminData->profile_photo_path)? url('upload/admin_images/' . $adminData->profile_photo_path): url('upload/default_profile.png') }}"
                                alt="" style="">
                            {{-- <button class="edit"><i class="zmdi zmdi-cloud-upload"></i>Change Image</button> --}}
                        </div>
                        <div class="info">
                            <h5>{{ $adminData->name }}</h5>
                            <span>{{ $adminData->email }}</span>
                            <button class="btn btn-danger mt-5">Edit Profil</button>
                            {{-- <a href="#" class="edit"><i class="zmdi zmdi-edit"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Author Top End-->

    </div>
@endsection
{{-- 1. Admin Template Setup // resources\views\admin\admin_master.blade.php @yield('admin') --}}
{{-- 6. Admin Profile & Image Update Part 1 --}}
