@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Lista Retur Comenzi</h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Client</th>
                                <th>Telefon</th>
                                <th>Nr. Comanda</th>
                                <th>Total</th>
                                <th>Tip Plata</th>
                                <th>Status</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $vouchers (VoucherView() din VoucherController) ca $item si afisam in tabel toate valorile din tabelul vouchers --}}
                            @foreach ($orders as $item)
                                <tr>
                                    <td>{{ $item->order_date }}</td>
                                    <td>{{ $item->shipping_first_name }}<span> </span>{{ $item->shipping_last_name }}
                                    </td>
                                    <td>{{ $item->shipping_phone }}</td>
                                    <td>{{ $item->order_number }}</td>
                                    <td>{{ $item->amount }} RON</td>
                                    <td>{{ $item->payment_method }}</td>
                                    <td class="text-center">
                                        @if ($item->return_order == 1)
                                            <h4> <span class="badge badge-pill badge-warning">In asteptare</span></h4>
                                        @elseif($item->return_order == 2)
                                            <h4> <span class="badge badge-pill badge-success">Finalizat</span></h4>
                                        @endif
                                        {{-- <h4><span class="badge badge-pill badge-primary">{{ $item->status }}</span></h4> --}}
                                    </td>
                                    </td>
                                    <td width="30%">
                                        {{-- <h4><span class="badge badge-success">Retur finalizat</span></h4> --}}
                                        <a href="{{ route('return.pending.order.details', $item->id) }}"
                                            class="button button-primary"><i
                                                class="fa-solid fa-magnifying-glass"></i>Vizualizare</a>
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
