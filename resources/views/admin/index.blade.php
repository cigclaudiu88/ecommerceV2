@extends('admin.admin_master')
@section('admin')
    @php
    // format pentru data
    $today_date = Carbon\Carbon::now()->format('d/m/Y');
    // $today preia toate comenzile din ziua curenta si insumeaza valoarea totala a lor
    $today = App\Models\Order::where('order_date', $today_date)->sum('amount');
    // $month format pentru luna
    $month_date = Carbon\Carbon::now()->format('F');
    // $monthly preia toate comenzile din luna curenta si insumeaza valoarea totala a lor
    $month = App\Models\Order::where('order_month', $month_date)->sum('amount');
    $year_date = Carbon\Carbon::now()->format('Y');
    // $year preia toate comenzile din anul curent si insumeaza valoarea totala a lor
    $year = App\Models\Order::where('order_year', $year_date)->sum('amount');
    // $pending preia toate comenzile in asteptare
    $pending = App\Models\Order::where('status', 'In asteptare')->get();
    $pending_value = App\Models\Order::where('status', 'In asteptare')->sum('amount');
    @endphp


    <!-- Page Headings Start -->
    <div class="row justify-content-between align-items-center mb-10">



    </div><!-- Page Headings End -->

    <!-- Top Report Wrap Start -->
    <div class="row">
        <!-- Top Report Start -->
        <div class="col-xlg-3 col-md-6 col-12 mb-30">
            <div class="top-report">

                <!-- Head -->
                <div class="head">
                    <h4>Total Vanzari Ziua Curenta</h4>
                    {{-- <a href="#" class="view"><i class="zmdi zmdi-eye"></i></a> --}}
                </div>

                <!-- Content -->
                <div class="content">
                    <h5>{{ $today_date }}</h5>
                    <h2>{{ number_format($today, 2, '.', ',') }} RON</h2>
                </div>

                <!-- Footer -->
                <div class="footer">
                    <div class="progess">
                        <div class="progess-bar" style="width: 100%;"></div>
                    </div>
                </div>

            </div>
        </div><!-- Top Report End -->

        <!-- Top Report Start -->
        <div class="col-xlg-3 col-md-6 col-12 mb-30">
            <div class="top-report">

                <!-- Head -->
                <div class="head">
                    <h4>Total Vanzari Luna Curenta</h4>
                    {{-- <a href="#" class="view"><i class="zmdi zmdi-eye"></i></a> --}}
                </div>

                <!-- Content -->
                <div class="content">
                    <h5>{{ $month_date }} {{ $year_date }}</h5>
                    <h2>{{ number_format($month, 2, '.', ',') }} RON</h2>
                </div>

                <!-- Footer -->
                <div class="footer">
                    <div class="progess">
                        <div class="progess-bar" style="width: 100%;"></div>
                    </div>
                </div>

            </div>
        </div><!-- Top Report End -->

        <!-- Top Report Start -->
        <div class="col-xlg-3 col-md-6 col-12 mb-30">
            <div class="top-report">

                <!-- Head -->
                <div class="head">
                    <h4>Total Vanzari Anul Curent</h4>
                    {{-- <a href="#" class="view"><i class="zmdi zmdi-eye"></i></a> --}}
                </div>

                <!-- Content -->
                <div class="content">
                    <h5>{{ $year_date }}</h5>
                    <h2>{{ number_format($year, 2, '.', ',') }} RON</h2>
                </div>

                <!-- Footer -->
                <div class="footer">
                    <div class="progess">
                        <div class="progess-bar" style="width: 100%;"></div>
                    </div>
                </div>

            </div>
        </div><!-- Top Report End -->

        <!-- Top Report Start -->
        <div class="col-xlg-3 col-md-6 col-12 mb-30">
            <div class="top-report">

                <!-- Head -->
                <div class="head">
                    <h4>Total Comenzi In Asteptare</h4>
                    {{-- <a href="#" class="view"><i class="zmdi zmdi-eye"></i></a> --}}
                </div>

                <!-- Content -->
                <div class="content">
                    <h5>Numar : {{ count($pending) }}</h5>
                    <h2>{{ number_format($pending_value, 2, '.', ',') }} RON</h2>
                </div>

                <!-- Footer -->
                <div class="footer">
                    <div class="progess">
                        <div class="progess-bar" style="width: 100%;"></div>
                    </div>
                </div>

            </div>
        </div><!-- Top Report End -->

        @php
            $orders = App\Models\Order::where('status', 'In asteptare')
                ->orderBy('id', 'DESC')
                ->get();
        @endphp

        <!--Default Data Table Start-->
        <div class="col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Lista Comenzi in Asteptare</h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Data Comanda</th>
                                <th>Nume Client</th>
                                <th>Telefon</th>
                                <th>Numar Comanda</th>
                                <th>Total Comanda</th>
                                <th>Modalitate de Plata</th>
                                <th>Status Comanda</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $vouchers (VoucherView() din VoucherController) ca $item si afisam in tabel toate valorile din tabelul vouchers --}}
                            @foreach ($orders as $item)
                                <tr>
                                    <td class="col-md-1">{{ $item->order_date }}</td>
                                    <td class="col-md-3">{{ $item->user->name }}</td>
                                    <td class="col-md-1">{{ $item->shipping_phone }}</td>
                                    <td class="col-md-1">{{ $item->order_number }}</td>
                                    <td class="col-md-1">{{ number_format($item->amount, 2, '.', ',') }} RON</td>
                                    <td class="col-md-1">{{ $item->payment_method }}</td>
                                    <td class="text-center">
                                        <h4><span class="badge badge-pill badge-warning">{{ $item->status }}</span></h4>
                                    </td>
                                    </td>
                                    <td width="30%">
                                        {{-- adaugat ruta de vizualizare comanda in asteptare --}}
                                        <a href="{{ route('pending.order.details', $item->id) }}"
                                            class="button button-primary"><i
                                                class="fa-solid fa-magnifying-glass"></i>Vizualizare</a>
                                        {{-- adaugat ruta de stergere categorie cu id="delete" pentru scriptul de sweetalert
                                        <a href="" class="button button-danger" id="delete"><i
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
