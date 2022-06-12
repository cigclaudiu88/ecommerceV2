@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Lista Comenzi In Tranzit <span class="badge badge badge-danger">
                            {{ count($orders) }} </span></h3>
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
                                    <td>{{ number_format($item->amount, 2, '.', ',') }} RON</td>
                                    <td>{{ $item->payment_method }}</td>
                                    <td class="text-center">
                                        <h4><span class="badge badge-pill badge-primary">{{ $item->status }}</span></h4>
                                    </td>
                                    </td>
                                    <td width="30%">
                                        {{-- adaugat ruta de vizualizare comanda in asteptare --}}
                                        <a href="{{ route('pending.order.details', $item->id) }}"
                                            class="button button-primary"><i
                                                class="fa-solid fa-magnifying-glass"></i>Vizualizare</a>

                                        @if ($item->status == 'In asteptare')
                                            <a href="{{ route('pending-confirm', $item->id) }}"
                                                class="button button-success" id="confirm"><strong>Confirma
                                                    Comanda</strong></a>
                                        @elseif($item->status == 'Confirmata')
                                            <a href="{{ route('confirm.processing', $item->id) }}"
                                                class="button button-success" id="processing">Proceseaza</a>
                                        @elseif($item->status == 'Procesata')
                                            <a href="{{ route('processing.picked', $item->id) }}"
                                                class="button button-success" id="picked">Preda Comanda
                                            </a>
                                        @elseif($item->status == 'Preluata de curier' && $item->awb_code != null)
                                            <a href="{{ route('picked.shipped', $item->id) }}"
                                                class="button button-success" id="shipped">Expediaza</a>
                                        @elseif($item->status == 'In tranzit')
                                            <a href="{{ route('shipped.delivered', $item->id) }}"
                                                class="button button-success" id="delivered">Comanda livrata</a>
                                            {{-- @elseif($order->status == 'Livrata')
                                                            <a href="{{ route('delivered.canceled', $order->id) }}" class="btn btn-block btn-success"
                                                                id="cancel_order">Anuleaza Comanda</a> --}}
                                        @endif
                                        {{-- adaugat ruta de stergere categorie cu id="delete" pentru scriptul de sweetalert --}}
                                        {{-- <a href="" class="button button-danger" id="delete"><i
                                                class="fa-solid fa-trash-can"></i>Delete</a> --}}
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
