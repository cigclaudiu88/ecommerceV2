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
                    <div class="col-sm-12 col-md-9 col-lg-9" style="margin-top:-100px;">
                        <!-- Tab panes -->
                        <div class="shopping_cart_area mt-70">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table_desc">
                                            <div class="cart_page">

                                                <div class="row">
                                                    <div class="col-lg-12 col-md-6">

                                                        <div class="row">

                                                            @if ($order->status == 'In asteptare')
                                                                <div class="col-md-2 text-center" style="margin-left:10px;">
                                                                    {{ $order->order_date }}
                                                                </div> <!-- // end col md 2 -->
                                                            @endif

                                                            @if ($order->status == 'Confirmata')
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->order_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->confirmed_date }}
                                                                </div> <!-- // end col md 2 -->
                                                            @endif

                                                            @if ($order->status == 'Procesata')
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->order_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->confirmed_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->processing_date }}
                                                                </div> <!-- // end col md 2 -->
                                                            @endif

                                                            @if ($order->status == 'Preluata de curier')
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->order_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->confirmed_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->processing_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->picked_date }}
                                                                </div> <!-- // end col md 2 -->
                                                            @endif

                                                            @if ($order->status == 'In tranzit')
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->order_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->confirmed_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->processing_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->picked_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->shipped_date }}
                                                                </div> <!-- // end col md 2 -->
                                                            @endif

                                                            @if ($order->status == 'Livrata')
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->order_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->confirmed_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->processing_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->picked_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->shipped_date }}
                                                                </div> <!-- // end col md 2 -->
                                                                <div class="col-md-2 text-center">
                                                                    {{ $order->delivered_date }}
                                                                </div> <!-- // end col md 2 -->
                                                            @endif
                                                        </div> <!-- // end row   -->


                                                        <div class="track">

                                                            @if ($order->status == 'In asteptare')
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa-solid fa-cart-arrow-down"></i> </span>
                                                                    <span class="text">Comanda
                                                                        Plasata</span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa fa-check"></i> </span> <span
                                                                        class="text"> Comanda Confirmata</span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa-solid fa-boxes-packing"></i> </span>
                                                                    <span class="text"> Comanda Procesata</span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa-solid fa-people-carry-box"></i> </span>
                                                                    <span class="text"> Preluata de Curier
                                                                    </span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa fa-truck"></i> </span> <span
                                                                        class="text">Comanda in Tranzit</span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa-solid fa-box-open"></i> </span> <span
                                                                        class="text">Comanda Livrata</span>
                                                                </div>
                                                            @endif

                                                            @if ($order->status == 'Confirmata')
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa-solid fa-cart-arrow-down"></i> </span>
                                                                    <span class="text">Comanda
                                                                        Plasta</span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa fa-check"></i> </span> <span
                                                                        class="text"> Comanda Confirmata</span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa-solid fa-boxes-packing"></i> </span>
                                                                    <span class="text"> Comanda Procesata</span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa-solid fa-people-carry-box"></i> </span>
                                                                    <span class="text"> Preluata de Curier
                                                                    </span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa fa-truck"></i> </span> <span
                                                                        class="text">Comanda in Tranzit</span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa-solid fa-box-open"></i> </span> <span
                                                                        class="text">Comanda Livrata</span>
                                                                </div>
                                                            @endif

                                                            @if ($order->status == 'Procesata')
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa-solid fa-cart-arrow-down"></i> </span>
                                                                    <span class="text">Comanda
                                                                        Plasta</span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa fa-check"></i> </span> <span
                                                                        class="text"> Comanda Confirmata</span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa-solid fa-boxes-packing"></i> </span>
                                                                    <span class="text"> Comanda Procesata</span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa-solid fa-people-carry-box"></i> </span>
                                                                    <span class="text"> Preluata de Curier
                                                                    </span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa fa-truck"></i> </span> <span
                                                                        class="text">Comanda in Tranzit</span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa-solid fa-box-open"></i> </span> <span
                                                                        class="text">Comanda Livrata</span>
                                                                </div>
                                                            @endif

                                                            @if ($order->status == 'Preluata de curier')
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa-solid fa-cart-arrow-down"></i> </span>
                                                                    <span class="text">Comanda
                                                                        Plasta</span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa fa-check"></i> </span> <span
                                                                        class="text"> Comanda Confirmata</span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa-solid fa-boxes-packing"></i> </span>
                                                                    <span class="text"> Comanda Procesata</span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa-solid fa-people-carry-box"></i>
                                                                    </span>
                                                                    <span class="text"> Preluata de Curier
                                                                    </span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa fa-truck"></i> </span> <span
                                                                        class="text">Comanda in Tranzit</span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa-solid fa-box-open"></i> </span> <span
                                                                        class="text">Comanda Livrata</span>
                                                                </div>
                                                            @endif

                                                            @if ($order->status == 'In tranzit')
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa-solid fa-cart-arrow-down"></i> </span>
                                                                    <span class="text">Comanda
                                                                        Plasta</span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa fa-check"></i> </span> <span
                                                                        class="text"> Comanda Confirmata</span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa-solid fa-boxes-packing"></i> </span>
                                                                    <span class="text"> Comanda Procesata</span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa-solid fa-people-carry-box"></i>
                                                                    </span>
                                                                    <span class="text"> Preluata de Curier
                                                                    </span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa fa-truck"></i> </span> <span
                                                                        class="text">Comanda in Tranzit</span>
                                                                </div>
                                                                <div class="step"> <span class="icon">
                                                                        <i class="fa-solid fa-box-open"></i> </span> <span
                                                                        class="text">Comanda Livrata</span>
                                                                </div>
                                                            @endif

                                                            @if ($order->status == 'Livrata')
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa-solid fa-cart-arrow-down"></i> </span>
                                                                    <span class="text">Comanda
                                                                        Plasta</span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa fa-check"></i> </span> <span
                                                                        class="text"> Comanda Confirmata</span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa-solid fa-boxes-packing"></i> </span>
                                                                    <span class="text"> Comanda Procesata</span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa-solid fa-people-carry-box"></i>
                                                                    </span>
                                                                    <span class="text"> Preluata de Curier
                                                                    </span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa fa-truck"></i> </span> <span
                                                                        class="text">Comanda in Tranzit</span>
                                                                </div>
                                                                <div class="step active"> <span class="icon">
                                                                        <i class="fa-solid fa-box-open"></i> </span> <span
                                                                        class="text">Comanda Livrata</span>
                                                                </div>
                                                            @endif
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="coupon_code right">
                                                            <h3>Detalii Comanda - {{ $order->order_number }} -
                                                                {{ $order->order_date }}</h3>
                                                        </div>
                                                    </div>
                                                </div>

                                                <table class="table table-responsive">
                                                    <thead>

                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th class="product_name"><a href="#">Nume Destinatar
                                                                </a>
                                                            </th>
                                                            <th class="product_name"><a
                                                                    href="#">{{ $order->shipping_first_name }}</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="product_name"><a href="#">Prenume Destinatar</a>
                                                            </th>
                                                            <th class="product_name"><a
                                                                    href="#">{{ $order->shipping_last_name }}</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="product_name"><a href="#">Telefon Destinatar</a>
                                                            </th>
                                                            <th class="product_name"><a
                                                                    href="#">{{ $order->shipping_phone }}</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="product_name"><a href="#">Email Destinatar</a>
                                                            </th>
                                                            <th class="product_name"><a
                                                                    href="#">{{ $order->shipping_email }}</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="product_name"><a href="#">Adresa Livrare</a>
                                                            </th>
                                                            <th class="product_name"><a href="#">Str.
                                                                    {{ $order->shipping_street }}<span>
                                                                    </span>Nr. {{ $order->shipping_street_number }}<span>
                                                                    </span>Bloc {{ $order->shipping_building }}<span>
                                                                    </span>Ap.{{ $order->shipping_apartment }}<span>
                                                                    </span>Judet
                                                                    {{ $order->division->division_name }}<span>
                                                                    </span>Loc.{{ $order->district->district_name }}<span>
                                                                    </span></a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="product_name"><a href="#">Modalitate de Plata</a>
                                                            </th>
                                                            <th class="product_name"><a
                                                                    href="#">{{ $order->payment_method }}</a>
                                                            </th>
                                                        </tr>
                                                        {{-- daca nu avem transction_id nu afisam campul altfel il afisam --}}
                                                        @if ($order->transaction_id == null)
                                                        @else
                                                            <tr>
                                                                <th class="product_name"><a href="#">ID Tranzatie</a>
                                                                </th>
                                                                <th class="product_name"><a
                                                                        href="#">{{ $order->transaction_id }}</a>
                                                                </th>
                                                            </tr>
                                                        @endif

                                                        <tr>
                                                            <th class="product_name"><a href="#">Subtotal</a>
                                                            </th>
                                                            <th class="product_name"><a
                                                                    href="#">{{ number_format($order->subtotal, 2, '.', ',') }}
                                                                    RON</a>
                                                            </th>
                                                        </tr>

                                                        @if ($order->voucher_name == null)
                                                        @else
                                                            <tr>
                                                                <th class="product_name"><a href="#">Voucher</a>
                                                                </th>
                                                                <th class="product_name text-success"><a
                                                                        href="#">{{ $order->voucher_name }}
                                                                    </a>
                                                                </th>
                                                            </tr>

                                                            <tr>
                                                                <th class="product_name"><a href="#">Reducere Voucher</a>
                                                                </th>
                                                                <th class="product_name text-success"><a
                                                                        href="#">-{{ number_format($order->discount_amount, 2, '.', ',') }}
                                                                        RON</a>
                                                                </th>
                                                            </tr>
                                                        @endif

                                                        <tr>
                                                            <th class="product_name"><a href="#">TVA</a>
                                                            </th>
                                                            <th class="product_name"><a
                                                                    href="#">{{ number_format($order->tax, 2, '.', ',') }}
                                                                    RON</a>
                                                            </th>
                                                        </tr>


                                                        <tr>
                                                            <th class="product_name"><a href="#">Total Comanda</a>
                                                            </th>
                                                            <th class="product_name"><a
                                                                    href="#">{{ number_format($order->amount, 2, '.', ',') }}
                                                                    RON</a>
                                                            </th>
                                                        </tr>

                                                        @if ($order->awb_code == null)
                                                        @else
                                                            <tr>
                                                                <th class="product_name"><a href="#">Cod AWB</a>
                                                                </th>
                                                                <th class="product_name"><a
                                                                        href="#">{{ $order->awb_code }}
                                                                    </a>
                                                                </th>
                                                            <tr>
                                                            <tr>
                                                                <th class="product_name"><a href="#">Nume Courier</a>
                                                                </th>
                                                                <th class="product_name"><a
                                                                        href="">{{ $order->courier_name }}
                                                                    </a>
                                                                </th>
                                                            </tr>
                                                        @endif

                                                        <tr>
                                                            <th class="product_name"><a href="#">Status Comanda</a>
                                                            </th>
                                                            <th>
                                                                @if ($order->status == 'In asteptare')
                                                                    <span id="order_pending"
                                                                        style="width:30% !important;">{{ $order->status }}</span>
                                                                @elseif($order->status == 'Confirmata')
                                                                    <span id="order_confirmed"
                                                                        style="width:30% !important;">{{ $order->status }}</span>
                                                                @elseif($order->status == 'Procesata')
                                                                    <span id="order_procesed"
                                                                        style="width:30% !important;">{{ $order->status }}</span>
                                                                @elseif($order->status == 'Preluata de curier')
                                                                    <span id="order_shipped"
                                                                        style="width:30% !important;">{{ $order->status }}</span>
                                                                @elseif($order->status == 'In tranzit')
                                                                    <span id="order_omw"
                                                                        style="width:30% !important;">{{ $order->status }}</span>
                                                                @elseif($order->status == 'Livrata')
                                                                    <span id="order_delivered"
                                                                        style="width:30% !important;">{{ $order->status }}</span>
                                                                @elseif($order->status == 'Anulata')
                                                                    <span id="order_canceled"
                                                                        style="width:30% !important;">{{ $order->status }}</span>
                                                                @endif
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div class="row">
                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="coupon_code right">
                                                            <h3>Produse</h3>
                                                        </div>
                                                    </div>
                                                </div>

                                                <table class="table table-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th class="product_thumb">Image</th>
                                                            <th class="product_name">Produs</th>
                                                            <th class="product-price">Pret</th>
                                                            <th class="product_quantity">Cantitate</th>
                                                            <th class="product_quantity">Subtotal</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orderItem as $item)
                                                            <tr>
                                                                <td class="col-md-2"><a
                                                                        href="{{ url('product/details/' . $item->product->id . '/' . $item->product->product_slug) }}"><img
                                                                            src="{{ asset($item->product->product_thumbnail) }}"
                                                                            style="width:50px; height:50px"></a>
                                                                </td>
                                                                <td class="col-md-5">
                                                                    <a
                                                                        href="{{ url('product/details/' . $item->product->id . '/' . $item->product->product_slug) }}">
                                                                        {{ $item->product->product_name }}</a>
                                                                </td>
                                                                <td class="col-md-2">
                                                                    {{ number_format($item->price * 1.19, 2, '.', ',') }}
                                                                    RON
                                                                </td>
                                                                <td class="col-md-1">{{ $item->qty }}
                                                                </td>
                                                                <td class="col-md-2">
                                                                    {{-- @if ($item->return_order_item == 0) --}}
                                                                    {{ number_format($item->price * 1.19 * $item->qty, 2, '.', ',') }}
                                                                    RON
                                                                    {{-- @elseif($item->return_order_item == 1)
                                                                        <span id="order_procesed">Retur</span>
                                                                    @elseif($item->return_order_item == 2)
                                                                        <span id="order_canceled">Returnat</span>
                                                                    @endif --}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            {{-- atunci cand statusulu comenzii este Livrata afisam camp pt retur --}}
                                            @if ($order->status !== 'Livrata')
                                            @else
                                                @php
                                                    //  $orders preia din tabelul orders id-ul comenzii unde campul return_reason este null
                                                    $order = App\Models\Order::where('id', $order->id)
                                                        ->where('return_reason', '=', null)
                                                        ->first();
                                                @endphp
                                                @if ($order)
                                                    <form action="{{ route('return.order', $order->id) }}" method="POST">
                                                        @csrf
                                                        <div class="coupon_code left">
                                                            <h3>Retur</h3>
                                                            <div class="coupon_inner">
                                                                <p>Aici puteti face retur la produsele din comanda</p>

                                                                {{-- <input type="text" placeholder="Cod Voucher"> --}}
                                                                <textarea name="return_reason" id="" class="form-control" cols="30" rows="05">Motiv Retur</textarea><br>
                                                                <button type="submit mt-2">Retur</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @else
                                                    <span id="order_canceled"
                                                        style="width:100% !important; margin-top:5px">Returul a fost deja
                                                        solicitat!</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account end   -->

    <style type="text/css">
        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }

        .track {
            position: relative;
            background-color: #ddd;
            height: 7px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 80px;
            margin-top: 30px;
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #40a944
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .step.active .icon {
            background: #40a944;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000
        }

        .track .text {
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

    </style>
@endsection
