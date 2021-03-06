@extends('frontend.main_master')
@section('content')

    @extends('frontend.main_master')
@section('content')
    {{-- jQuerry CDN link pentru scriptul de vizualizare imagine profil --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- my account start  -->
    <section class="main_content_area">
        <div class="container">
            <div class="account_dashboard">
                <div class="row">
                    {{-- meniu navigare --}}
                    @include('frontend.profile.user_sidebar')
                    {{-- meniu navigare --}}
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">

                            <h3>Lista Comenzi cu Retur</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Data Comanda</th>
                                            <th>Numar Comanda</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Motiv Retur</th>
                                            {{-- <th>Actiuni</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->order_date }}</td>
                                                <td>{{ $order->order_number }}</td>
                                                <td>
                                                    @if ($order->return_order == 0)
                                                        <span id="order_delivered"
                                                            style="width:100% !important; margin-top:5px">Fara Solictiare de
                                                            Retur
                                                        </span>
                                                    @elseif($order->return_order == 1)
                                                        <span id="order_pending"
                                                            style="width:100% !important; margin-top:5px">Retur in asteptare
                                                        </span>
                                                        <span id="order_canceled"
                                                            style="width:100% !important; margin-top:5px">Retur
                                                            solicitat
                                                        </span>
                                                    @elseif($order->return_order == 2)
                                                        <span id="order_delivered"
                                                            style="width:100% !important; margin-top:5px">Retur
                                                            finalizat</span>
                                                    @endif
                                                </td>
                                                <td style="text-align: right">
                                                    {{ number_format($order->amount, 2, '.', ',') }} RON</td>
                                                <td style="text-align: left">{{ $order->return_reason }} <a
                                                        href="{{ route('my.return.order.details', $order->id) }}"
                                                        class="view"><i
                                                            class="fa-solid fa-magnifying-glass"></i></a><span
                                                        class="text-white"> ---- </span></td>
                                                {{-- <td><a href="{{ url('user/order_details/' . $order->id) }}"
                                                        class="view"><i
                                                            class="fa-solid fa-magnifying-glass"></i></a><span
                                                        class="text-white"> ---- </span>
                                                    <a target="_blank"
                                                        href="{{ url('user/invoice_download/' . $order->id) }}"
                                                        class="view"><i class="fa-solid fa-angles-down"></i></a>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account end   -->
@endsection

@endsection
