@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Editare Brand</h4>
                </div>
                <div class="box-body">
                    {{-- formular de adaugare branduri in tabelul brands folosind ruta brand.store si functia BrandStore() din BrandController --}}
                    {{-- enctype pentru lucrul cu imagini si protectie csrf --}}
                    <form method="POST" action="{{ route('brand.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mbn-20">

                            {{-- doua inputuri ascunse care preiau id-ul si imaginea brandului care va fi actualizat --}}
                            <input type="hidden" name="id" value={{ $brand->id }}>
                            <input type="hidden" name="old_image" value={{ $brand->brand_image }}>

                            {{-- preluam prin atributul value valoarea din tabela brands campul brand_name --}}
                            <div class="col-12 mb-20">
                                <label for="brand_name"><strong>Nume Brand</strong></label>
                                <input type="text" name="brand_name" id="brand_name" class="form-control"
                                    value="{{ $brand->brand_name }}">
                                @error('brand_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="brand_image"><strong>Poza Brand</strong></label>
                                <input type="file" name="brand_image" class="form-control" id="imagedisplay">
                                @error('brand_image')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            {{-- afisam imaginea salvata in tabela brands --}}
                            <div class="col-12 mb-20">
                                <img src="{{ asset($brand->brand_image) }}" alt="" id="showImage">
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Actualizeaza Brand" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
