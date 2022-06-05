@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Actualizare Slider-uri</h4>
                </div>
                <div class="box-body">
                    {{-- formular de adaugare slider-uri in tabelul sliders folosind ruta slider.store si functia SliderStore() din SliderController --}}
                    {{-- enctype pentru lucrul cu imagini si protectie csrf --}}
                    <form method="POST" action="{{ route('slider.update', $sliders->id) }}" enctype="multipart/form-data">
                        @csrf

                        {{-- adaugat camp ascuns pentru a prelua id-ul slider-ului --}}
                        <input type="hidden" name="id" value={{ $sliders->id }}>
                        {{-- adaugat camp ascuns pentru a prelua poza curenta / veche slider-ului care va fi stearsa / inlocuita cu poza noua --}}
                        <input type="hidden" name="old_slider_image" value={{ $sliders->slider_image }}>

                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="slider_title"><strong>Titlu Slider</strong></label>
                                <input type="text" name="slider_title" id="slider_title" class="form-control"
                                    value="{{ $sliders->slider_title }}">
                                @error('slider_title')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="slider_description"><strong>Descriere Slider</strong></label>
                                <input type="text" name="slider_description" id="slider_description" class="form-control"
                                    value="{{ $sliders->slider_description }}">
                                @error('slider_description')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="offer_products"><strong>Produs Oferta</strong></label>
                                <input type="text" name="offer_products" id="offer_products" class="form-control"
                                    value="{{ $sliders->offer_products }}">
                                @error('offer_products')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="slider_image"><strong>Poza Slider</strong></label>
                                <input type="file" name="slider_image" id="imagedisplay" class="form-control">
                                @error('slider_image')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            {{-- afisam imaginea salvata in tabela brands --}}
                            <div class="col-12 mb-20">
                                <img src="{{ asset($sliders->slider_image) }}" alt="" id="showImage">
                            </div>

                            {{-- afisam imaginea salvata in tabela sliders --}}
                            <div class="col-12 mb-20">
                                <img src="" alt="" id="showImage">
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Actualizeaza Slider" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
