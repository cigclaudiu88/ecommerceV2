@extends('admin.admin_master')

@section('admin')
    <!-- Page Headings Start -->
    <div class="row justify-content-between align-items-center mb-10">

        <!-- Page Heading Start -->
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Setari SEO</h3>
            </div>
        </div><!-- Page Heading End -->

    </div><!-- Page Headings End -->

    <!--Default Form Start-->
    <div class="col-lg-12 col-12 mb-30 d-flex justify-content-center">
        <div class="box">
            <div class="box-head">
                <h4 class="title">Actualizeaza Setari SEO</h4>
            </div>
            {{-- formular de actualizare date admin pe ruta admin.profile.store cu enctype="multipart/form-data pentru lucrul cu imagini si @csrf --}}
            <div class="box-body">
                <form method="post" action="{{ route('update.site.setting') }}">
                    @csrf
                    <div class="row mbn-20">

                        <input type="hidden" name="id" value="{{ $seo->id }}">

                        <div class="col-4 mb-20">
                            <label for="meta_title"><strong>Titlu Meta</strong></label>
                            <input type="text" name="meta_title" id="meta_title" class="form-control"
                                value="{{ $seo->meta_title }}">
                            @error('meta_title')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-4 mb-20">
                            <label for="meta_author"><strong>Autor Meta</strong></label>
                            <input type="text" name="meta_author" id="meta_author" class="form-control"
                                value="{{ $seo->meta_author }}">
                            @error('meta_author')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-4 mb-20">
                            <label for="meta_keyword"><strong>Meta Cuvinte Cheie</strong></label>
                            <input type="text" name="meta_keyword" id="meta_keyword" class="form-control"
                                value="{{ $seo->meta_keyword }}">
                            @error('meta_keyword')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-6 mb-20">
                            <label for="meta_description">Meta Descriere</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" rows="16"
                                cols="80">{{ $seo->meta_description }}</textarea>
                            @error('meta_description')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-6 mb-20">
                            <label for="google_analytics">Meta Descriere</label>
                            <textarea name="google_analytics" id="google_analytics" class="form-control" rows="16"
                                cols="80">{{ $seo->google_analytics }}</textarea>
                            @error('google_analytics')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-12 mb-20">
                            <input type="submit" value="Actualizeaza Setari SEO" class="button button-primary">
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
