@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Actualizeaza Localitate</h4>
                </div>
                <div class="box-body">
                    {{-- formular de adaugare voucheruri in tabelul vouchers folosind ruta voucher.store si functia VoucherStore() din VocuherController --}}
                    <form method="POST" action="{{ route('district.update', $district->id) }}">
                        @csrf
                        <div class="row mbn-20">


                            <div class="col-12 mb-20">
                                <label for="division_id"><strong>Nume Judet</strong></label>
                                <select name="division_id" class="form-control">
                                    <option value="" id="division_id" selected="" disabled="">Selecteaza Judet</option>
                                    {{-- iteram cu variabila $categories (SubCategoryView() din SubCategoryController) ca $category si afisam in select toate valorile din tabelul categories --}}
                                    @foreach ($division as $div)
                                        <option value="{{ $div->id }}"
                                            {{ $div->id == $district->division_id ? 'selected' : '' }}>
                                            {{ $div->division_name }} </option>
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
                                    value="{{ $district->district_name }}">
                                @error('district_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Actualizeaza Localitate" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
