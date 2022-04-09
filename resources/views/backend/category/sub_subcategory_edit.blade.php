@extends('admin.admin_master')
@section('admin')
    {{-- ajax jquerry CDN pentru scriptul de la finalul paginii --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="row">

        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Actualizeaza SubSubCategorie Produse</h4>
                </div>
                <div class="box-body">
                    {{-- adaugat ruta subcategory.store in formularul de adaugare subsubcategorie in tabelul sub_subcategorie --}}
                    <form method="POST" action="{{ route('subsubcategory.update') }}">
                        @csrf
                        {{-- camp ascuns care contine id-ul subsubcategoriei --}}
                        <input type="hidden" name="id" value="{{ $subsubcategories->id }}">

                        <div class="row mbn-20">
                            <div class="col-12 mb-20">
                                <label for="category_id"><strong>Categorie</strong></label>
                                <select name="category_id" class="form-control">
                                    <option value="" id="category_id" selected="" disabled="">Selecteaza Categoria</option>
                                    {{-- iteram cu variabila $categories (SubSubCategoryView() din SubSubCategoryController) ca $category --}}
                                    {{-- daca id-ul categorie = category_id din tabelul sub_sub_categories selectam numele categoriei altfel ramane gol --}}
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $subsubcategories->category_id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
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
                                        {{-- iteram cu variabila $subcategories (SubSubCategoryView() din SubSubCategoryController) ca $index --}}
                                        {{-- daca id-ul index-ului = subcategory_id din tabelul sub_sub_categories selectam numele subcategoriei altfel ramane gol --}}
                                        @foreach ($subcategories as $index)
                                    <option value="{{ $index->id }}"
                                        {{ $index->id == $subsubcategories->subcategory_id ? 'selected' : '' }}>
                                        {{ $index->subcategory_name }}
                                        @endforeach

                                    </option>
                                </select>
                                @error('subcategory_id')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="subsubcategory_name"><strong>Nume SubSubCategorie</strong></label>
                                <input type="text" name="subsubcategory_name" id="subsubcategory_name"
                                    class="form-control" value="{{ $subsubcategories->subsubcategory_name }}">
                                @error('subsubcategory_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Actualizeaza SubSubCategorie" class="button button-primary">
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
