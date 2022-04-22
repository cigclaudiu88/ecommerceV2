@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Adauga Divizie Expediere</h4>
                </div>
                <div class="box-body">
                    {{-- formular de adaugare voucheruri in tabelul vouchers folosind ruta voucher.store si functia VoucherStore() din VocuherController --}}
                    <form method="POST" action="{{ route('division.update', $divisions->id) }}">
                        @csrf
                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="division_name"><strong>Nume Divizie</strong></label>
                                <input type="text" name="division_name" id="division_name" class="form-control"
                                    value={{ $divisions->division_name }}>
                                @error('division_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Actualizeaza Divizie Expedieri" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
