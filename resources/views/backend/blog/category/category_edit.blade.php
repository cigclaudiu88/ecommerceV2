@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Actualizeaza Categorie Blog</h4>
                </div>
                <div class="box-body">
                    {{-- formular de adaugare categorii in tabelul categories folosind ruta category.store si functia CategoryStore() din CategoryController --}}
                    {{-- enctype pentru lucrul cu imagini si protectie csrf --}}
                    <form method="POST" action="{{ route('blog.category.update', $blogcategory->id) }}">
                        @csrf
                        <div class="row mbn-20">
                            <div class="col-12 mb-20">
                                <label for="blog_category_name"><strong>Nume Categorie Blog</strong></label>
                                <input type="text" name="blog_category_name" id="blog_category_name" class="form-control"
                                    value="{{ $blogcategory->blog_category_name }}">
                                @error('blog_category_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Actualizeaza Categorie pt Blog" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
