@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Actualizeaza SubCategorie Produse</h4>
                </div>
                <div class="box-body">

                    <form method="POST" action="">
                        @csrf
                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="category_id"><strong>Categorie</strong></label>
                                <select name="category_id" class="form-control">
                                    <option value="" id="category_id" selected="" disabled="">Selecteaza Categoria</option>
                                    {{-- iteram cu variabila $categories (SubCategoryView() din SubCategoryController) ca $category si afisam in select toate valorile din tabelul categories --}}
                                    @foreach ($categories as $category)
                                        {{-- atunci cand id-ul categoriei este acelasi cu category_id din tabelul subcategories se selecteaza numele categoriei altfel va fi gol --}}
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $subcategories->category_id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                            {{-- 6. Subcategory Crud Part 2 --}}
                                        </option>
                                    @endforeach
                                    </option>
                                </select>
                                @error('category_id')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="subcategory_name"><strong>Nume SubCategorie</strong></label>
                                <input type="text" name="subcategory_name" id="subcategory_name" class="form-control"
                                    value="{{ $subcategories->subcategory_name }}">
                                @error('subcategory_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Actualizeaza SubCategorie" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
