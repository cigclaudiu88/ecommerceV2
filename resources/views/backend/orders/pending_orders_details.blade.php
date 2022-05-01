@extends('admin.admin_master')
@section('admin')
    <!-- Content Body Start -->


    <!-- Page Headings Start -->
    <div class="row justify-content-between align-items-center mb-10">

        <!-- Page Heading Start -->
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3><span>Detalii Comanda</span></h3>
            </div>
        </div><!-- Page Heading End -->

    </div><!-- Page Headings End -->

    <div class="row mbn-30">

        <!--Order Details Head Start-->
        <div class="col-12 mb-30">
            <div class="row mbn-15">
                <div class="col-12 col-md-4 mb-15">
                    <h4>Numar Comanda: </h4>
                    <h4 class="text-primary fw-600 m-0">{{ $order->order_number }}</h4>
                </div>
                <div class="text-left text-md-center col-12 col-md-4 mb-15">
                    <h4>Status: <span><span class="badge badge-round badge-primary">
                                {{ $order->status }}</span></span></h4>
                </div>

            </div>
        </div>
        <!--Order Details Head End-->

        <!--Order Details Customer Information Start-->
        <div class="col-12 mb-30">
            <div class="order-details-customer-info row mbn-20">

                <!--Billing Info Start-->
                <div class="col-lg-4 col-md-6 col-12 mb-20">
                    <h4 class="mb-25">Date Client</h4>
                    <ul>
                        <li> <span>Nume</span> <span>{{ $order->user_address->first_name }}
                                {{ $order->user_address->last_name }}</span> </li>
                        <li> <span>Email</span> <span>{{ $order->user->email }}</span> </li>
                        <li> <span>Telefon</span> <span>{{ $order->user->phone }}</span> </li>
                        <li> <span>Adresa</span>
                            <span>Str.{{ $order->user_address->street }}
                                Nr.{{ $order->user_address->street_number }} Bloc
                                {{ $order->user_address->street_number }}
                                Ap.{{ $order->user_address->apartment }}</span>
                        </li>
                        <li> <span>Judet</span> <span>{{ $order->user_address->state }}</span> </li>
                        <li> <span>Localitate</span> <span>{{ $order->user_address->city }}</span> </li>
                    </ul>
                </div>
                <!--Billing Info End-->

                <!--Shipping Info Start-->
                <div class="col-lg-4 col-md-6 col-12 mb-20">
                    <h4 class="mb-25">Date Adresa Livrare</h4>
                    <ul>
                        <li> <span>Name</span> <span>{{ $order->shipping_first_name }}
                                {{ $order->shipping_last_name }}</span> </li>
                        <li> <span>Email</span> <span>{{ $order->shipping_email }}</span> </li>
                        <li> <span>Telefon</span> <span>{{ $order->shipping_phone }}</span> </li>
                        <li> <span>Adresa</span>
                            <span>Str.{{ $order->shipping_street }}
                                Nr.{{ $order->shipping_street_number }} Bloc
                                {{ $order->shipping_building }}
                                Ap.{{ $order->shipping_apartment }}</span>
                        </li>
                        <li> <span>Judet</span> <span>{{ $order->division->division_name }}</span> </li>
                        <li> <span>Oras</span> <span>{{ $order->district->district_name }}</span> </li>

                    </ul>
                </div>
                <!--Shipping Info End-->

                <!--Purchase Info Start-->
                <div class="col-lg-4 col-md-6 col-12 mb-20">
                    <h4 class="mb-25">Date Plata Comanda</h4>
                    <ul>
                        <li> <span>Subtotal</span> <span>{{ $order->subtotal }} RON</span> </li>
                        @if ($order->voucher_name == null)
                        @else
                            <li> <span>Voucher</span> <span>{{ $order->voucher_name }}</span> </li>
                            <li> <span>Reducere</span> <span class="text-success">- {{ $order->discount_amount }}
                                    RON</span> </li>
                        @endif
                        <li> <span>TVA</span> <span>{{ $order->tax }} RON</span> </li>
                        <li> <span>Total</span> <span>{{ $order->amount }}</span> </li>
                        @if ($order->transaction_id == null)
                            <li> <span class="h5 fw-600">Tip</span> <span class="h5 fw-600 text-danger">Cash la
                                    livrare</span>
                            </li>
                        @else
                            <li> <span class="h5 fw-600">Card</span> <span
                                    class="h5 fw-600 text-success">{{ $order->payment_method }}</span>
                            </li>
                            <li> <span class="h5 fw-600">ID</span> <span
                                    class="h5 fw-600 text-success">{{ $order->transaction_id }}</span>
                            </li>
                            <li> <span class="h5 fw-600">Type</span> <span
                                    class="h5 fw-600 text-success">Achitat</span>
                            </li>
                        @endif
                    </ul>
                </div>
                <!--Purchase Info End-->

            </div>
        </div>
        <!--Order Details Customer Information Start-->
        {{-- daca status comanda este in asteptare trimitem comanda spre confirmare --}}
        <div class="col-2 mb-30">
            @if ($order->status == 'In asteptare')
                <a href="{{ route('pending-confirm', $order->id) }}" class="btn btn-block btn-success"
                    id="confirm"><strong>Confirma Comanda</strong></a>
            @elseif($order->status == 'Confirmata')
                <a href="{{ route('confirm.processing', $order->id) }}" class="btn btn-block btn-success"
                    id="processing">Proceseaza Comanda</a>
            @elseif($order->status == 'Procesata')
                <a href="{{ route('processing.picked', $order->id) }}" class="btn btn-block btn-success"
                    id="picked">Preda Comanda Curierului</a>
            @elseif($order->status == 'Preluata de curier')
                <a href="{{ route('picked.shipped', $order->id) }}" class="btn btn-block btn-success"
                    id="shipped">Expediaza Comanda</a>
            @elseif($order->status == 'In tranzit')
                <a href="{{ route('shipped.delivered', $order->id) }}" class="btn btn-block btn-success"
                    id="delivered">Comanda livrata</a>
                {{-- @elseif($order->status == 'Livrata')
                <a href="{{ route('delivered.canceled', $order->id) }}" class="btn btn-block btn-success"
                    id="cancel_order">Anuleaza Comanda</a> --}}
            @endif
        </div>
        <div class="col-8 mb-30"></div>
        <div class="col-2 mb-30">
            @if ($order->status == 'In asteptare')
                <a href="{{ route('delivered.canceled', $order->id) }}" class="btn btn-block btn-danger"
                    id="cancel_order"><strong>Anuleaza Comanda</strong></a>
            @endif
        </div>

        <!--Order Details List Start-->
        <div class="col-12 mb-30">
            <div class="table-responsive">
                <table class="table table-bordered table-vertical-middle">
                    <thead class="thead-dark">
                        <tr>
                            <th>Poza</th>
                            <th>Cod Produs</th>
                            <th>Nume Produs</th>
                            <th>Pret</th>
                            <th>Cantitate</th>
                            <th>Subtotal</th>
                            @if ($order->status == 'Livrata')
                                <th>Actiuni</th>
                            @else
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItem as $item)
                            <tr>
                                <td class="col-md-1"><img src="{{ asset($item->product->product_thumbnail) }}"
                                        height="100px;" width="100px;"></td>
                                <td class="col-md-2"> {{ $item->product->product_code }}</td>
                                <td class="col-md-6"><a href="#">{{ $item->product->product_name }}</a></td>
                                <td class="col-md-1">{{ number_format($item->price, 2, '.', ',') }} RON</td>
                                <td class="col-md-1">{{ $item->qty }} BUC</td>
                                <td class="col-md-1">{{ number_format($item->price * $item->qty, 2, '.', ',') }}
                                    RON</td>
                                @if ($item->return_order_item == 0 && $order->status == 'Livrata')
                                    <td class="col-md-1">
                                        <a href="{{ route('return.item.approve', $item->id) }}"
                                            class="btn btn-danger">Aproba
                                            Retur </a>
                                    </td>
                                @elseif($item->return_order_item == 1)
                                    <td class="col-md-1">
                                        <a href="{{ route('return.item.finalized', $item->id) }}"
                                            class="btn btn-danger">Finalizeaza retur</a>
                                    </td>
                                @elseif($item->return_order_item == 2)
                                    <td class="col-md-1">
                                        <h4><span class="badge badge-pill badge-success">Produs returnat</span></h4>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--Order Details List End-->

    </div>

    <!-- Content Body End -->
@endsection
