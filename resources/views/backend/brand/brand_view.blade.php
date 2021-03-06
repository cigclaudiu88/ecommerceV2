@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-8 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Branduri <span class="badge badge badge-danger">
                            {{ count($brands) }} </span></h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nume Brand</th>
                                <th>Imagine Brand</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $brands (BrandView() din BrandController) ca $item si afisam in tabel toate valorile din tabelul brands --}}
                            @foreach ($brands as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->brand_name }}</td>
                                    <td>
                                        <img src="{{ asset($item->brand_image) }}" style="width: 70px; height:40px"
                                            alt="">
                                    </td>
                                    <td>
                                        {{-- adaugat ruta de editare brand --}}
                                        <a href="{{ route('brand.edit', $item->id) }}" class="btn btn-info">Edit</a>
                                        {{-- adaugat ruta de stergere brand cu id="delete" pentru scriptul de sweetalert --}}
                                        <a href="{{ route('brand.delete', $item->id) }}" class="btn btn-danger"
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
                    <h4 class="title">Adauga Branduri</h4>
                </div>
                <div class="box-body">
                    {{-- formular de adaugare branduri in tabelul brands folosind ruta brand.store si functia BrandStore() din BrandController --}}
                    {{-- enctype pentru lucrul cu imagini si protectie csrf --}}
                    <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="brand_name"><strong>Nume Brand</strong></label>
                                <input type="text" name="brand_name" id="brand_name" class="form-control"
                                    placeholder="Nume Brand">
                                @error('brand_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="brand_image"><strong>Poza Brand</strong></label>
                                <input type="file" name="brand_image" id="imagedisplay" class="form-control">
                                @error('brand_image')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            {{-- afisam imaginea salvata in tabela brands --}}
                            <div class="col-12 mb-20">
                                <img src="" alt="" id="showImage">
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Adauga Brand" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
