@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Actualizare Categorie Produse</h4>
                </div>
                <div class="box-body">
                    {{-- formular de adaugare categorii in tabelul categories folosind ruta category.store si functia CategoryStore() din CategoryController --}}
                    {{-- enctype pentru lucrul cu imagini si protectie csrf --}}
                    <form method="POST" action="{{ route('category.update', $category->id) }}">
                        @csrf

                        {{-- camp ascuns pentru preluarea id-ul categoriei --}}
                        <input type="hidden" name="id" value="{{ $category->id }}">

                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="category_name"><strong>Nume Categorie</strong></label>
                                <input type="text" name="category_name" id="category_name" class="form-control"
                                    value="{{ $category->category_name }}">
                                @error('category_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="category_icon"><strong>Icoana Categorie</strong></label>
                                <input type="text" name="category_icon" id="category_icon" class="form-control"
                                    value="{{ $category->category_icon }}">
                                @error('category_icon')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Actualizare Categorie" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
