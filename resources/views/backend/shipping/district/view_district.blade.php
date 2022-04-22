@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-8 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Lista Localitati</h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Nume Judet</th>
                                <th>Nume Localitate</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $vouchers (VoucherView() din VoucherController) ca $item si afisam in tabel toate valorile din tabelul vouchers --}}
                            @foreach ($district as $item)
                                <tr>
                                    <td>{{ $item->division->division_name }}</td>
                                    <td>{{ $item->district_name }}</td>
                                    <td width="40%">
                                        {{-- adaugat ruta de editare categorie --}}
                                        <a href="{{ route('district.edit', $item->id) }}" class="btn btn-info">Edit</a>
                                        {{-- adaugat ruta de stergere categorie cu id="delete" pentru scriptul de sweetalert --}}
                                        <a href="{{ route('district.delete', $item->id) }}" class="btn btn-danger"
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
                    <h4 class="title">Adauga Localitate</h4>
                </div>
                <div class="box-body">
                    {{-- formular de adaugare voucheruri in tabelul vouchers folosind ruta voucher.store si functia VoucherStore() din VocuherController --}}
                    <form method="POST" action="{{ route('district.store') }}">
                        @csrf
                        <div class="row mbn-20">


                            <div class="col-12 mb-20">
                                <label for="division_id"><strong>Nume Judet</strong></label>
                                <select name="division_id" class="form-control">
                                    <option value="" id="division_id" selected="" disabled="">Selecteaza Judet</option>
                                    {{-- iteram cu variabila $categories (SubCategoryView() din SubCategoryController) ca $category si afisam in select toate valorile din tabelul categories --}}
                                    @foreach ($division as $div)
                                        <option value="{{ $div->id }}">{{ $div->division_name }} </option>
                                    @endforeach
                                    </option>
                                </select>
                                @error('division_id')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>


                            <div class="col-12 mb-20">
                                <label for="district_name"><strong>Nume Localitate</strong></label>
                                <input type="text" name="district_name" id="district_name" class="form-control"
                                    placeholder="Zona Expediere">
                                @error('district_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Adauga Localitate" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
