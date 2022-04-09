@extends('admin.admin_master')
@section('admin')
    {{-- ajax jquerry CDN pentru scriptul de la finalul paginii --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                                    {{-- folosind functia category() din modelul SubSubCategory afisam prin $item->category()->numele categoriei --}}
                                    <td>{{ $item['category']['category_name'] }}</td>
                                    {{-- folosind functia subcategory() din modelul SubSubCategory afisam prin $item->subcategory()->numele subcategoriei --}}
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
                                    <option value="" selected="" disabled="">Selecteaza SubCategoria
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

    {{-- script pentru afisarea subcategoriilor aferente categoriei selectate in formularul de adaugare subsubcategorie produse --}}
    <script type="text/javascript">
        $(document).ready(function() {
            // la schimbarea selectului de nume categorie din formular
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                // if there is something in category_id input field the coresponding subcategory options will apear in the select options input field (subcategory_id)
                // daca in campul category_id avem selectat o categorie, optiunile corespunzatoare subcategoriei vor aparea in campul select al subcategoriei (subcategory_id)
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/category/subcategory/subsubcategory') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        // daca codul de mai sus este succesful optiunile corespunzatoare subcategoriei vor aparea in campul select al subcategoriei (subcategory_id)
                        // altfel continutul va fi gol
                        success: function(data) {
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endsection
