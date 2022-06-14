@extends('admin.admin_master')
@section('admin')
    <div class="row">

        {{-- sectiune de cautare rapoarte dupa data start --}}
        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Cauta dupa data</h4>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('search-by-date') }}">
                        @csrf
                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="date"><strong>Selecteaza data</strong></label>
                                <input type="date" name="date" id="date" class="form-control" placeholder="Nume Brand">
                                @error('date')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Cauta" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- sectiune de cautare rapoarte dupa data sfarsit --}}

        {{-- sectiune de cautare rapoarte dupa luna start --}}
        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Cauta dupa luna</h4>
                </div>
                <div class="box-body">

                    <form method="POST" action="{{ route('search-by-month') }}">
                        @csrf
                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="formLayoutPassword3"><strong>Selecteaza luna</strong></label>
                                <select name="month" class="form-control">
                                    <option value="" selected="" disabled="">Alege luna
                                    </option>
                                    <option value="January">Ianuarie</option>
                                    <option value="February">Februarie</option>
                                    <option value="March">Martie</option>
                                    <option value="April">Aprilie</option>
                                    <option value="May">Mai</option>
                                    <option value="June">Iunie</option>
                                    <option value="July">Iulie</option>
                                    <option value="August">August</option>
                                    <option value="September">Septembrie</option>
                                    <option value="October">Octombrie</option>
                                    <option value="November">Noiembrie</option>
                                    <option value="December">Decembrie</option>
                                </select>
                                @error('month')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="formLayoutPassword3"><strong>Selecteaza Anul</strong></label>
                                <select name="year_name" class="form-control">
                                    <option value="" selected="" disabled="">Alege Anul
                                    </option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                </select>
                                @error('year_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Cauta" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- sectiune de cautare rapoarte dupa luna sfarsit --}}

        {{-- sectiune de cautare rapoarte dupa an start --}}
        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Cauta dupa an</h4>
                </div>
                <div class="box-body">

                    <form method="POST" action="{{ route('search-by-year') }}">
                        @csrf
                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="formLayoutPassword3"><strong>Selecteaza Anul</strong></label>
                                <select name="year" class="form-control">
                                    <option value="" selected="" disabled="">Alege Anul
                                    </option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                </select>
                                @error('year')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Cauta" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- sectiune de cautare rapoarte dupa an sfarsit --}}

    </div>
@endsection
