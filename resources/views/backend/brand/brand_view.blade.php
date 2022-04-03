@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Branduri</h3>
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
                                        <a href="" class="btn btn-info">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!--Default Data Table End-->

    </div>
@endsection
