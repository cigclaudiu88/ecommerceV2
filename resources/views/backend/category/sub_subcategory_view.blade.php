@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-8 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">SubSubCategorii Produse</h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Categorie</th>
                                <th>SubCategorie</th>
                                <th>SubSubCategorie</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $subsubcategories (SubSubCategoryView() din SubSubCategoryController) ca $item si afisam in tabel toate valorile din tabelul subsubcategories --}}
                            @foreach ($subsubcategories as $item)
                                <tr>
                                    {{-- folosind functia category() din modelul SubSubCategory afisam prin $item->category() numele categoriei --}}
                                    <td>{{ $item['category']['category_name'] }}</td>
                                    {{-- folosind functia subcategory() din modelul SubSubCategory afisam prin $item->subcategory() numele subcategoriei --}}
                                    <td>{{ $item['subcategory']['subcategory_name'] }}</td>
                                    <td>{{ $item->subsubcategory_name }}</td>
                                    <td>

                                        <a href="" class="btn btn-info">Edit</a>

                                        <a href="" class="btn btn-danger" id="delete">Delete</a>
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
                    <h4 class="title">Adauga SubSubCategorie Produse</h4>
                </div>
                <div class="box-body">
                    {{-- adaugat ruta subcategory.store in formularul de adaugare --}}
                    <form method="POST" action="">
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
                                <label for="subcategory_id"><strong>SubCategorie</strong></label>
                                <select name="subcategory_id" class="form-control">
                                    <option value="" id="subcategory_id" selected="" disabled="">Selecteaza SubCategoria
                                    </option>

                                    </option>
                                </select>
                                @error('subcategory_id')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="subsubcategory_name"><strong>Nume SubSubCategorie</strong></label>
                                <input type="text" name="subsubcategory_name" id="subsubcategory_name"
                                    class="form-control" placeholder="Nume SubCategorie">
                                @error('subsubcategory_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Adauga SubSubCategorie" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
