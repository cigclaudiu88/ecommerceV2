@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Produse <span class="badge badge badge-danger">
                            {{ count($products) }} </span></h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Poza</th>
                                <th>Nume Produs</th>
                                <th>Cantitate</th>
                                <th>Pret</th>
                                <th>Discount</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $products (ManageProduct() din Product) ca $item si afisam in tabel toate datele din tabelul products --}}
                            @foreach ($products as $item)
                                <tr>
                                    <td><img src="{{ asset($item->product_thumbnail) }}"
                                            style="max-width:none !important; width:100px !important; height:100px !important;">
                                    </td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->product_quantity }}</td>
                                    <td>{{ number_format($item->selling_price, 2, '.', ',') }} RON</td>
                                    <td class="text-center">
                                        {{-- afisare discount ca si % --}}
                                        @if ($item->discount_price == null)
                                            <span class="badge badge-pill badge-primary">Fara Discount</span>
                                        @else
                                            @php
                                                $amount = $item->selling_price - $item->discount_price;
                                                $discount = ($amount / $item->selling_price) * 100;
                                            @endphp
                                            <span class="badge badge-pill badge-primary">{{ round($discount) }}
                                                %</span>
                                        @endif
                                        {{-- display discount as % --}}
                                    </td>
                                    {{-- 18. Product Active Inactive --}}
                                    <td class="text-center">
                                        @if ($item->status == 1)
                                            <span class="badge badge-pill badge-primary"> Activ </span>
                                        @else
                                            <span class="badge badge-pill badge-danger"> Inactiv </span>
                                        @endif
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
