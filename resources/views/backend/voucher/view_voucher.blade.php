@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-8 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Lista Voucher-uri <span class="badge badge badge-danger">
                            {{ count($vouchers) }} </span></h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Nume Voucher</th>
                                <th>Voucher Discount</th>
                                <th>Voucher Valabilitate</th>
                                <th>Voucher Status</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $vouchers (VoucherView() din VoucherController) ca $item si afisam in tabel toate valorile din tabelul vouchers --}}
                            @foreach ($vouchers as $item)
                                <tr>
                                    <td>{{ $item->voucher_name }}</td>
                                    <td>{{ $item->voucher_discount }}%</td>
                                    <td>{{ Carbon\Carbon::parse($item->voucher_validity)->format('D, d F Y') }}
                                    </td>
                                    <td class="text-center">
                                        {{-- atunci cand data voucherului este mai mare sau egala cu data curenta atunci voucherul este activ invers inactiv --}}
                                        @if ($item->voucher_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                            <span class="badge badge-pill badge-primary"> Activ </span>
                                        @else
                                            <span class="badge badge-pill badge-danger"> Inactiv </span>
                                        @endif
                                    </td>
                                    <td width="30%">
                                        {{-- adaugat ruta de editare categorie --}}
                                        <a href="{{ route('voucher.edit', $item->id) }}" class="btn btn-info">Edit</a>
                                        {{-- adaugat ruta de stergere categorie cu id="delete" pentru scriptul de sweetalert --}}
                                        <a href="{{ route('voucher.delete', $item->id) }}" class="btn btn-danger"
                                            id="delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--Default Data Table End-->

        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Adauga Voucher</h4>
                </div>
                <div class="box-body">
                    {{-- formular de adaugare voucheruri in tabelul vouchers folosind ruta voucher.store si functia VoucherStore() din VocuherController --}}
                    <form method="POST" action="{{ route('voucher.store') }}">
                        @csrf
                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="voucher_name"><strong>Nume Voucher</strong></label>
                                <input type="text" name="voucher_name" id="voucher_name" class="form-control"
                                    placeholder="Denumire Voucher">
                                @error('voucher_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="voucher_discount"><strong>Discount Voucher (%)</strong></label>
                                <input type="text" name="voucher_discount" id="voucher_discount" class="form-control"
                                    placeholder="Discount Voucher (%)">
                                @error('voucher_discount')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="voucher_validity"><strong>Valabilitate Voucher</strong></label>
                                <input type="date" name="voucher_validity" id="voucher_validity" class="form-control"
                                    min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="Valabilitate Voucher">
                                @error('voucher_validity')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>


                            <div class="col-12 mb-20">
                                <input type="submit" value="Adauga Voucher" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
