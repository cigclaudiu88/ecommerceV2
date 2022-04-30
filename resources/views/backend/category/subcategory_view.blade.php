@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-8 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">SubCategorii Produse <span class="badge badge badge-danger">
                            {{ count($subcategories) }} </span></h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Categorie</th>
                                <th>SubCategorie</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $subcategories (SubCategoryView() din SubCategoryController) ca $item si afisam in tabel toate valorile din tabelul subcategories --}}
                            @foreach ($subcategories as $item)
                                <tr>
                                    {{-- folosind functia category() din modelul SubCategory afisam prin $item->category() numele categoriei --}}
                                    <td>{{ $item['category']['category_name'] }}</td>
                                    <td>{{ $item->subcategory_name }}</td>
                                    <td>
                                        {{-- adaugat ruta de editare subcategorii produse --}}
                                        <a href="{{ route('subcategory.edit', $item->id) }}"
                                            class="btn btn-info">Edit</a>
                                        {{-- adaugat ruta de stergere subcategorii produse --}}
                                        <a href="{{ route('subcategory.delete', $item->id) }}" class="btn btn-danger"
                                            id="delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--Default Data Table End-->

        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Adauga SubCategorie Produse</h4>
                </div>
                <div class="box-body">
                    {{-- adaugat ruta subcategory.store in formularul de adaugare --}}
                    <form method="POST" action="{{ route('subcategory.store') }}">
                        @csrf
                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="category_id"><strong>Categorie</strong></label>
                                <select name="category_id" class="form-control">
                                    <option value="" id="category_id" selected="" disabled="">Selecteaza Categoria</option>
                                    {{-- iteram cu variabila $categories (SubCategoryView() din SubCategoryController) ca $category si afisam in select toate valorile din tabelul categories --}}
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}
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
                                    placeholder="Nume SubCategorie">
                                @error('subcategory_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Adauga SubCategorie" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
