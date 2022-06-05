@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-9 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Lista Sliders</h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Poza Slider</th>
                                <th>Titlu Slider</th>
                                <th>Descriere Slider</th>
                                <th>Status Slider</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $sliders  (SliderView() din SliderController) ca $item si afisam in tabel toate valorile din tabelul sliders --}}
                            @foreach ($sliders as $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset($item->slider_image) }}" style="width: 70px; height:40px"
                                            alt="">
                                    </td>
                                    <td>{{ $item->slider_title }}</td>
                                    <td>{{ $item->slider_description }}</td>

                                    <td class="text-center">
                                        @if ($item->slider_status == 1)
                                            <span class="badge badge-pill badge-info"> Activ </span>
                                        @else
                                            <span class="badge badge-pill badge-danger"> Inactiv </span>
                                        @endif
                                    </td>

                                    <td width="30%">
                                        {{-- adaugat ruta de editare a sliderului --}}
                                        <a href="{{ route('slider.edit', $item->id) }}" class="btn btn-success">Edit</a>
                                        {{-- adaugat ruta de stergere a sliderului --}}
                                        <a href="{{ route('slider.delete', $item->id) }}" class="btn btn-danger"
                                            id="delete">Delete</a>

                                        @if ($item->slider_status == 1)
                                            <a href="{{ route('slider.inactive', $item->id) }}"
                                                class="btn btn-danger">Inactiv</a>
                                        @else
                                            <a href="{{ route('slider.active', $item->id) }}"
                                                class="btn btn-success">Activ</a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--Default Data Table End-->

        <div class="col-lg-3 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Adauga Slider-uri</h4>
                </div>
                <div class="box-body">
                    {{-- formular de adaugare slider-uri in tabelul sliders folosind ruta slider.store si functia SliderStore() din SliderController --}}
                    {{-- enctype pentru lucrul cu imagini si protectie csrf --}}
                    <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="slider_title"><strong>Titlu Slider</strong></label>
                                <input type="text" name="slider_title" id="slider_title" class="form-control"
                                    placeholder="Titlu Slider">
                                @error('slider_title')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="slider_description"><strong>Descriere Slider</strong></label>
                                <input type="text" name="slider_description" id="slider_description" class="form-control"
                                    placeholder="Descriere Slider">
                                @error('slider_description')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="offer_products"><strong>Produs Oferta</strong></label>
                                <input type="text" name="offer_products" id="offer_products" class="form-control"
                                    placeholder="Produs Oferta">
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

                            {{-- afisam imaginea salvata in tabela sliders --}}
                            <div class="col-12 mb-20">
                                <img src="" alt="" id="showImage">
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Adauga Slider" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
