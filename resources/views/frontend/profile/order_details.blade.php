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
                        <div class="shopping_cart_area mt-70">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table_desc">
                                            <div class="cart_page">

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
                                                            <th class="product_name"><a href="#">{{ $order->subtotal }}
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
                                                                        href="#">-{{ $order->discount_amount }}
                                                                        RON</a>
                                                                </th>
                                                            </tr>
                                                        @endif

                                                        <tr>
                                                            <th class="product_name"><a href="#">TVA</a>
                                                            </th>
                                                            <th class="product_name"><a href="#">{{ $order->tax }}
                                                                    RON</a>
                                                            </th>
                                                        </tr>


                                                        <tr>
                                                            <th class="product_name"><a href="#">Total Comanda</a>
                                                            </th>
                                                            <th class="product_name"><a href="#">{{ $order->amount }}
                                                                    RON</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="product_name"><a href="#">Status Comanda</a>
                                                            </th>
                                                            <th class="product_name"><a href="#">{{ $order->status }}
                                                                </a>
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
                                                                    {{ number_format($item->price, 2, '.', ',') }} RON
                                                                </td>
                                                                <td class="col-md-1">{{ $item->qty }}
                                                                </td>
                                                                <td class="col-md-2">
                                                                    {{ number_format($item->price * $item->qty, 2, '.', ',') }}
                                                                    RON
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account end   -->
@endsection
