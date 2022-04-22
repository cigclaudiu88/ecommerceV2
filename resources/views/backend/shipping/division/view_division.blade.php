@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-8 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Lista Zone Expediere</h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Nume Divizie</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $vouchers (VoucherView() din VoucherController) ca $item si afisam in tabel toate valorile din tabelul vouchers --}}
                            @foreach ($divisions as $item)
                                <tr>
                                    <td>{{ $item->division_name }}</td>
                                    <td width="40%">
                                        {{-- adaugat ruta de editare categorie --}}
                                        <a href="{{ route('division.edit',$item->id) }}" class="btn btn-info">Edit</a>
                                        {{-- adaugat ruta de stergere categorie cu id="delete" pentru scriptul de sweetalert --}}
                                        <a href="{{ route('division.delete',$item->id) }}" class="btn btn-danger" id="delete">Delete</a>
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
                    <h4 class="title">Adauga Divizie Expediere</h4>
                </div>
                <div class="box-body">
                    {{-- formular de adaugare voucheruri in tabelul vouchers folosind ruta voucher.store si functia VoucherStore() din VocuherController --}}
                    <form method="POST" action="{{ route('division.store') }}">
                        @csrf
                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="division_name"><strong>Nume Divizie</strong></label>
                                <input type="text" name="division_name" id="division_name" class="form-control"
                                    placeholder="Zona Expediere">
                                @error('division_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Adauga Divizie Expedieri" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
