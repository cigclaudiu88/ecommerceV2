@extends('admin.admin_master')
@section('admin')
    {{-- ajax jquerry CDN pentru scriptul de validare categorie-subcategorie-subsubcategorie --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="col-lg-12 col-12 mb-30">
        <div class="box">
            <div class="box-head">
                <h4 class="title">Adauga Produse</h4>
            </div>
            <div class="box-body">
                <form method="post" action="{{ route('product-store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mbn-20">

                        <div class="col-3 mb-20">
                            <label for="formLayoutUsername3">Brand</label>
                            <select name="brand_id" class="form-control">
                                <option value="" selected="" disabled="">Selecteaza Brandul</option>
                                {{-- iteram cu $brands din functia AddProduct din ProductController ca $brand si afisam toate brandurile --}}
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">
                                        {{ $brand->brand_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                            </select>
                        </div>

                        <div class="col-3 mb-20">
                            <label for="formLayoutEmail3">Categorie</label>
                            <select name="category_id" class="form-control">
                                <option value="" selected="" disabled="">Selecteaza Categoria
                                </option>
                                {{-- iteram cu $categories din functia AddProduct din ProductController ca $category si afisam toate categoriile --}}
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-3 mb-20">
                            <label for="formLayoutPassword3">SubCategorie</label>
                            <select name="subcategory_id" class="form-control">
                                <option value="" selected="" disabled="">Select SubCategory
                                </option>

                            </select>
                            @error('subcategory_id')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-3 mb-20">
                            <label for="formLayoutAddress1">SubSubCategorie</label>
                            <select name="subsubcategory_id" class="form-control" id="test">
                                <option value="" selected="" disabled="">Select SubSubCategory
                                </option>
                            </select>
                            @error('subsubcategory_id')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-6 mb-20">
                            <label for="formLayoutAddress2">Nume Produs</label>
                            <input type="text" name="product_name" class="form-control">
                            @error('product_name')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-6 mb-20">
                            <label for="formLayoutAddress2">Cod Produs</label>
                            <input type="text" name="product_code" class="form-control">
                            @error('product_code')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-4 mb-20">
                            <label for="formLayoutAddress2">Cantitate</label>
                            <input type="text" name="product_quantity" class="form-control">
                            @error('product_quantity')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-4 mb-20">
                            <label for="formLayoutAddress2">Pret</label>
                            <input type="text" name="selling_price" class="form-control">
                            @error('selling_price')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-4 mb-20">
                            <label for="formLayoutAddress2">Discount</label>
                            <input type="text" name="discount_price" class="form-control">
                            @error('discount_price')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-6 mb-20">
                            <label for="formLayoutFile1">Poza Principala</label>
                            <input type="file" name="product_thumbnail" class="form-control"
                                onchange="mainThumbnailUrl(this)">

                            @error('product_thumbnail')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                            <img src="" alt="" id="mainThumbnail">
                        </div>

                        <div class="col-6 mb-20">
                            <label for="formLayoutFile1">Poze Multiple</label>
                            <input type="file" name="multi_img[]" class="form-control" multiple="" id="multiImg">
                            @error('multi_img')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="row ml-1" id="preview_img"></div>
                        </div>

                        <div class="col-12 mb-20">
                            <label for="formLayoutMessage1">Descriere Scurta</label>
                            <textarea name="short_description" id="textarea" class="form-control" rows="16" cols="80"
                                placeholder="Textarea text"></textarea>
                        </div>

                        <div class="col-6 mb-20">
                            <label for="formLayoutMessage1">Descriere Lunga</label>
                            <textarea class="summernote form-control" name="long_description" placeholder="Message"></textarea>
                        </div>

                        <div class="col-6 mb-20">
                            <label for="formLayoutMessage1">Specificatii</label>
                            <textarea class="summernote form-control" name="specifications" placeholder="Message"></textarea>
                        </div>


                        <div class="col-6 mb-20">
                            <label class="adomx-checkbox primary"><input type="checkbox" name="hot_deal" value="1"> <i
                                    class="icon"></i> Mega Oferta</label>
                            <label class="adomx-checkbox primary"><input type="checkbox" name="featured" value="1"> <i
                                    class="icon"></i> Produse Recomandate</label>
                        </div>

                        <div class="col-6 mb-20">
                            <label class="adomx-checkbox primary"><input type="checkbox" name="special_offer" value="1"> <i
                                    class="icon"></i> Oferta Zilei</label>
                            <label class="adomx-checkbox primary"><input type="checkbox" name="special_deal" value="1"> <i
                                    class="icon"></i> Oferta Saptamanii</label>
                        </div>


                        <div class="col-lg-12 col-12 mb-30" id="fieldLaptop">
                            <div class="box">
                                <div class="box-head">
                                    <h4 class="title">Date Laptop</h4>
                                </div>
                                <div class="box-body">
                                    <div class="row mbn-20">

                                        <div class="col-4 mb-20">
                                            <label for="laptop_os">Laptop Sistem de Operare</label>
                                            <input type="text" name="laptop_os" class="form-control" id="fieldLaptop1">
                                            @error('laptop_os')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div class="col-4 mb-20">
                                            <label for="laptop_cpu">Laptop CPU</label>
                                            <input type="text" name="laptop_cpu" class="form-control" id="fieldLaptop2">
                                            @error('laptop_cpu')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div class="col-4 mb-20">
                                            <label for="laptop_gpu">Laptop GPU</label>
                                            <input type="text" name="laptop_gpu" class="form-control" id="fieldLaptop3">
                                            @error('laptop_gpu')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>


                                        <div class="col-4 mb-20">
                                            <label for="laptop_memory">Laptop Memorie</label>
                                            <input type="text" name="laptop_memory" class="form-control"
                                                id="fieldLaptop4">
                                            @error('laptop_memory')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>


                                        <div class="col-4 mb-20">
                                            <label for="laptop_display">Laptop Diagonala Display</label>
                                            <input type="text" name="laptop_display" class="form-control"
                                                id="fieldLaptop5">
                                            @error('laptop_display')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div class="col-4 mb-20">
                                            <label for="laptop_storage">Spatiu de Stocare</label>
                                            <input type="text" name="laptop_storage" class="form-control"
                                                id="fieldLaptop6">
                                            @error('laptop_storage')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-12 mb-30" id="fieldTablet">
                            <div class="box">
                                <div class="box-head">
                                    <h4 class="title">Date Tableta</h4>
                                </div>
                                <div class="box-body">
                                    <div class="row mbn-20">

                                        <div class="col-4 mb-20">
                                            <label for="tablet_os">Tableta Sistem de Operare</label>
                                            <input type="text" name="tablet_os" class="form-control" id="fieldTablet1">
                                            @error('tablet_os')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div class="col-4 mb-20">
                                            <label for="tablet_cpu">Tableta CPU</label>
                                            <input type="text" name="tablet_cpu" class="form-control" id="fieldTablet2">
                                            @error('tablet_cpu')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div class="col-4 mb-20">
                                            <label for="tablet_memory">Tableta Memorie</label>
                                            <input type="text" name="tablet_memory" class="form-control"
                                                id="fieldTablet3">
                                            @error('tablet_memory')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div class="col-4 mb-20">
                                            <label for="tablet_display">Tableta Diagonala Display</label>
                                            <input type="text" name="tablet_display" class="form-control"
                                                id="fieldTablet4">
                                            @error('tablet_display')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>


                                        <div class="col-4 mb-20">
                                            <label for="tablet_storage">Tableta Spatiu de Stocare</label>
                                            <input type="text" name="tablet_storage" class="form-control"
                                                id="fieldTablet5">
                                            @error('tablet_storage')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div class="col-4 mb-20">
                                            <label for="tablet_camera">Tableta Camera</label>
                                            <input type="text" name="tablet_camera" class="form-control"
                                                id="fieldTablet5">
                                            @error('tablet_camera')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-12 mb-30" id="fieldPhone">
                            <div class="box">
                                <div class="box-head">
                                    <h4 class="title">Date Telefon</h4>
                                </div>
                                <div class="box-body">
                                    <div class="row mbn-20">
                                        <div class="col-4 mb-20">
                                            <label for="phone_os">Telefon Sistem de Operare</label>
                                            <input type="text" name="phone_os" class="form-control" id="fieldPhone1">
                                            @error('phone_os')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div class="col-4 mb-20">
                                            <label for="phone_cpu">Telefon CPU</label>
                                            <input type="text" name="phone_cpu" class="form-control" id="fieldPhone2">
                                            @error('phone_cpu')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>


                                        <div class="col-4 mb-20">
                                            <label for="phone_memory">Telefon Memorie</label>
                                            <input type="text" name="phone_memory" class="form-control" id="fieldPhone3">
                                            @error('phone_memory')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div class="col-4 mb-20">
                                            <label for="phone_display">Telefon Diagonala Display</label>
                                            <input type="text" name="phone_display" class="form-control"
                                                id="fieldPhone4">
                                            @error('phone_display')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div class="col-4 mb-20">
                                            <label for="phone_storage">Telefon Spatiu de Stocare</label>
                                            <input type="text" name="phone_storage" class="form-control"
                                                id="fieldPhone5">
                                            @error('phone_storage')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div class="col-4 mb-20">
                                            <label for="phone_camera">Telefon Camera</label>
                                            <input type="text" name="phone_camera" class="form-control" id="fieldPhone6">
                                            @error('phone_camera')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-20 mt-10">
                            <input type="submit" value="Adauga Produs" class="button button-primary">
                            <input type="submit" value="cancle" class="button button-danger">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- script pentru afisarea subcategoriilor aferente categoriei selectate si subsubcategoriilor aferente subcategoriei selectate in formularul de adaugare produse --}}
    <script type="text/javascript">
        $(document).ready(function() {
            // la schimbarea selectului de nume categorie din formular
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                // daca in campul categorie (category_id) avem selectat o categorie, optiunile corespunzatoare subcategoriei vor aparea in campul select al subcategoriei (subcategory_id)
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/category/subcategory/subsubcategory') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        // daca codul de mai sus este cu succes optiunile corespunzatoare subcategoriei vor aparea in campul select al subcategoriei (subcategory_id)
                        // altfel continutul va fi gol
                        success: function(data) {
                            $('select[name="subsubcategory_id"]').html('');
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
            // la schimbarea selectului de nume subcategorie din formular
            $('select[name="subcategory_id"]').on('change', function() {
                var subcategory_id = $(this).val();
                // daca in campul subcategorie (subcategory_id) avem selectat o subcategorie, optiunile corespunzatoare subsubcategoriei vor aparea in campul select al subsubcategoriei (subsubcategory_id)
                if (subcategory_id) {
                    $.ajax({
                        url: "{{ url('/category/subcategory/subsubcategory/product') }}/" +
                            subcategory_id,
                        type: "GET",
                        dataType: "json",
                        // daca codul de mai sus este cu succes optiunile corespunzatoare subsubcategoriei vor aparea in campul select al subsubcategoriei (subcategory_id)
                        // altfel continutul va fi gol
                        success: function(data) {
                            var d = $('select[name="subsubcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subsubcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subsubcategory_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>


    {{-- script pt afisarea imaginii principale selectate in formularul de adaugare produse --}}
    <script type="text/javascript">
        function mainThumbnailUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThumbnail').attr('src', e.target.result).width(120).height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    {{-- script pt afisarea imaginilor multiple selectate in formularul de adaugare produse --}}
    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data
                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(120)
                                        .height(100); //create image element 
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });
                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#fieldLaptop').hide();
            $('#fieldTablet').hide();
            $('#fieldPhone').hide();

            $("#test").change(function() {
                var subsubcategory_id = $(this).val();
                if (subsubcategory_id == 1) {
                    $('#fieldLaptop').show();
                    $('#fieldTablet').hide();
                    $('#fieldPhone').hide();
                } else if (subsubcategory_id == 2) {
                    $('#fieldLaptop').hide();
                    $('#fieldTablet').show();
                    $('#fieldPhone').hide();
                } else if (subsubcategory_id == 3) {
                    $('#fieldLaptop').hide();
                    $('#fieldTablet').hide();
                    $('#fieldPhone').show();
                } else {
                    $('#fieldLaptop').hide();
                    $('#fieldTablet').hide();
                    $('#fieldPhone').hide();
                }
            });
        });
        $("#test").trigger("change");
    </script>
@endsection
