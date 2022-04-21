@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-8 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Lista Voucher-uri</h3>
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
                                    <td>{{ $item->voucher_discount }}</td>
                                    <td>{{ $item->voucher_validity }}</td>
                                    <td class="text-center">
                                        @if ($item->status == 1)
                                            <span class="badge badge-pill badge-primary"> Activ </span>
                                        @else
                                            <span class="badge badge-pill badge-danger"> Inactiv </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- adaugat ruta de editare categorie --}}
                                        <a href="" class="btn btn-info">Edit</a>
                                        {{-- adaugat ruta de stergere categorie cu id="delete" pentru scriptul de sweetalert --}}
                                        <a href="" class="btn btn-danger" id="delete">Delete</a>
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
                    {{-- formular de adaugare categorii in tabelul categories folosind ruta category.store si functia CategoryStore() din CategoryController --}}
                    {{-- enctype pentru lucrul cu imagini si protectie csrf --}}
                    <form method="POST" action="">
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
                                    placeholder="Valabilitate Voucher">
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
