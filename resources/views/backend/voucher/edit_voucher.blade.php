@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Actualizeaza Voucher</h4>
                </div>
                <div class="box-body">
                    {{-- formular de actualizare voucheruri in tabelul vouchers folosind ruta voucher.update si functia VoucherUpdate() din VocuherController --}}
                    <form method="POST" action="{{ route('voucher.update', $vouchers->id) }}">
                        @csrf
                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="voucher_name"><strong>Nume Voucher</strong></label>
                                <input type="text" name="voucher_name" id="voucher_name" class="form-control"
                                    value="{{ $vouchers->voucher_name }}">
                                @error('voucher_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="voucher_discount"><strong>Discount Voucher (%)</strong></label>
                                <input type="text" name="voucher_discount" id="voucher_discount" class="form-control"
                                    value="{{ $vouchers->voucher_discount }}">
                                @error('voucher_discount')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="voucher_validity"><strong>Valabilitate Voucher</strong></label>
                                <input type="date" name="voucher_validity" id="voucher_validity" class="form-control"
                                    min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                    value="{{ $vouchers->voucher_validity }}">
                                @error('voucher_validity')
                                    <span class=" text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>


                            <div class="col-12 mb-20">
                                <input type="submit" value="Actualizeaza Voucher" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
