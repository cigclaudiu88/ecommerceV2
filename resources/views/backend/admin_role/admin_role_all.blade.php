@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Lista Administratori</h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Poza Profil</th>
                                <th>Nume</th>
                                <th>Email</th>
                                <th>Telefon</th>
                                <th>Nivel Acces</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $vouchers (VoucherView() din VoucherController) ca $item si afisam in tabel toate valorile din tabelul vouchers --}}
                            @foreach ($adminuser as $item)
                                <tr>
                                    <td> <img src="{{ asset($item->profile_photo_path) }}"> </td>
                                    <td> {{ $item->name }} </td>
                                    </td>
                                    <td> ${{ $item->email }} </td>
                                    <td> ${{ $item->phone }} </td>
                                    <td></td>
                                    <td class="text-center">
                                        <h4><span class="badge badge-pill badge-primary">{{ $item->status }}</span></h4>
                                    </td>
                                    </td>
                                    <td width="30%">
                                        <a href="{{ route('pending.order.details', $item->id) }}"
                                            class="button button-primary"><i
                                                class="fa-solid fa-magnifying-glass"></i>Vizualizare</a>
                                        <a href="{{ route('invoice.download', $item->id) }}" class="button button-info"><i
                                                class="fa-solid fa-circle-down"></i>Factura</a>
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
