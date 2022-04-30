@extends('admin.admin_master')
@section('admin')
    {{-- ajax jquerry CDN pentru scriptul de validare categorie-subcategorie-subsubcategorie --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <div class="col-lg-12 col-12 mb-30">
        <div class="box">
            <div class="box-head">
                <h4 class="title">Adauga Postare Blog</h4>
            </div>
            <div class="box-body">
                <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="row mbn-20">

                        <div class="col-2 mb-20">
                            <label for="formLayoutUsername3">Categorie Postare</label>
                            <select name="category_id" class="form-control">
                                <option value="" selected="" disabled="">Selecteaza Categoriei</option>
                                {{-- iteram cu $brands din functia AddProduct din ProductController ca $brand si afisam toate brandurile --}}
                                @foreach ($blogcategory as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->blog_category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-4 mb-20">
                            <label for="formLayoutAddress2">Titlu Postare</label>
                            <input type="text" name="post_title" class="form-control">
                            @error('post_title')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-6 mb-20">
                            <label for="formLayoutFile1">Poza Principala</label>
                            <input type="file" name="post_image" class="form-control" onchange="mainThumbnailUrl(this)">

                            @error('post_image')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                            <img src="" alt="" id="mainThumbnail">
                        </div>

                        <div class="col-12 mb-20">
                            <label for="formLayoutMessage1">Continut Postare</label>
                            <textarea class="summernote form-control" name="post_details"></textarea>
                        </div>


                        <div class="col-12 mb-20 mt-10">
                            <input type="submit" value="Adauga Postarea" class="button button-primary">
                            {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- script pt afisarea imaginii principale selectate in formularul de adaugare postare --}}
    <script type="text/javascript">
        function mainThumbnailUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThumbnail').attr('src', e.target.result).width(200).height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
