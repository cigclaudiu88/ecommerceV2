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

                            <h3>Lista Comenzi</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Data Comanda</th>
                                            <th>Numar Comanda</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Actiuni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->order_date }}</td>
                                                <td>{{ $order->order_number }}</td>
                                                <td>
                                                    @if ($order->status == 'In asteptare')
                                                        <span id="order_pending"
                                                            style="width:100% !important;">{{ $order->status }}</span>
                                                    @elseif($order->status == 'Confirmata')
                                                        <span id="order_confirmed"
                                                            style="width:100% !important;">{{ $order->status }}</span>
                                                    @elseif($order->status == 'Procesata')
                                                        <span id="order_procesed"
                                                            style="width:100% !important;">{{ $order->status }}</span>
                                                    @elseif($order->status == 'Preluata de curier')
                                                        <span id="order_shipped"
                                                            style="width:100% !important;">{{ $order->status }}</span>
                                                    @elseif($order->status == 'In tranzit')
                                                        <span id="order_omw"
                                                            style="width:100% !important;">{{ $order->status }}</span>
                                                    @elseif($order->status == 'Livrata')
                                                        <span id="order_delivered"
                                                            style="width:100% !important;">{{ $order->status }}</span>
                                                    @elseif($order->status == 'Anulata')
                                                        <span id="order_canceled"
                                                            style="width:100% !important;">{{ $order->status }}</span>
                                                    @endif
                                                </td>
                                                <td style="text-align: right">{{ $order->amount }} RON</td>
                                                <td><a href="{{ url('user/order_details/' . $order->id) }}"
                                                        class="view"><i
                                                            class="fa-solid fa-magnifying-glass"></i></a><span
                                                        class="text-white"> ---- </span>
                                                    <a target="_blank"
                                                        href="{{ url('user/invoice_download/' . $order->id) }}"
                                                        class="view"><i class="fa-solid fa-angles-down"></i></a>
                                                </td>
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
