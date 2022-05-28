@extends('frontend.main_master')
@section('content')
    {{-- ajax jquerry CDN pentru scriptul de validare judet-localitate --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- my account start  -->
    <section class="main_content_area">
        <div class="container">
            <div class="account_dashboard">
                <div class="row">
                    {{-- meniu navigare --}}

                    @include('frontend.profile.user_sidebar')

                    {{-- meniu navigare --}}
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">

                            {{-- sectiunea de actualizare date cont incepe --}}
                            <div class="tab-pane fade active" id="account-details">
                                <h3><strong>Actualizare Detalii Cont client</strong></h3>
                                {{-- adaugat formular de actualizare date si poza (enctype) cont utilizator cu ruta user.profile.store --}}
                                <div class="login">
                                    <div class="login_form_container">
                                        <div class="account_login_form">
                                            {{-- daca colectia de date din $address din functia UserProfileAddress este goala (null) (cand este utilizator nou) --}}
                                            {{-- afisam formularul de adaugare adresa de livrare --}}
                                            @if ($address != null)
                                                <form method="post"
                                                    action="{{ route('user.profile.address.update', $address->id) }}">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="info-title" for="first_name"><strong>Nume
                                                                        Destinatar</strong>
                                                                </label>
                                                                <input type="text" class="form-control" name="first_name"
                                                                    style="margin-bottom: 0px !important;" id="first_name"
                                                                    value="{{ $address->first_name }}">
                                                                @error('first_name')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="info-title" for="last_name"><strong>
                                                                        Prenume Destinatar</strong>
                                                                </label>
                                                                <input type="text" class="form-control" name="last_name"
                                                                    id="last_name" style="margin-bottom: 0px !important;"
                                                                    value="{{ $address->last_name }}">
                                                                @error('last_name')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="info-title" for="phone"><strong>Numar
                                                                        Telefon</strong>
                                                                </label>
                                                                <input type="text" class="form-control" name="phone"
                                                                    id="phone" value="{{ $address->phone }}"
                                                                    value="{{ $address->first_name }}">
                                                                @error('phone')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="info-title" for="state"><strong>
                                                                        Judet</strong>
                                                                </label>
                                                                <select name="state" class="form-control">
                                                                    <option value="" selected="" disabled="">Selecteaza
                                                                        Judetul
                                                                    </option>
                                                                    {{-- iteram cu $categories din functia AddProduct din ProductController ca $category si afisam toate categoriile --}}
                                                                    @foreach ($divisions as $division)
                                                                        <option value="{{ $division->division_name }}"
                                                                            {{ $division->division_name == $address->state ? 'selected' : '' }}>
                                                                            {{ $division->division_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('state')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="info-title" for="city"><strong>
                                                                        Localitate (Oras / Sector)</strong>
                                                                </label>
                                                                <select name="city" class="form-control">
                                                                    <option value="{{ $address->city }}" selected="">
                                                                        {{ $address->city }}
                                                                    </option>

                                                                </select>
                                                                @error('city')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <label class="info-title" for="street"><strong>Nume
                                                                        Strada</strong>
                                                                </label>
                                                                <input type="text" class="form-control" name="street"
                                                                    id="street" style="margin-bottom: 0px !important;"
                                                                    value="{{ $address->street }}">
                                                                @error('street')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="info-title" for="street_number"><strong>
                                                                        Numar Strada</strong>
                                                                </label>
                                                                <input type="text" class="form-control"
                                                                    name="street_number" id="street_number"
                                                                    style="margin-bottom: 0px !important;"
                                                                    value="{{ $address->street_number }}">
                                                                @error('street_number')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <label class="info-title"
                                                                    for="building"><strong>Bloc</strong>
                                                                </label>
                                                                <input type="text" class="form-control" name="building"
                                                                    id="building" value="{{ $address->building }}">
                                                                @error('building')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="info-title" for="apartment"><strong>
                                                                        Apartament</strong>
                                                                </label>
                                                                <input type="text" class="form-control" name="apartment"
                                                                    id="apartment" value="{{ $address->apartment }}">
                                                                @error('apartment')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="form-group user_dashboard_form_button">
                                                        <button type="submit" class="btn btn-success"
                                                            name="profile_photo_path"><strong>Actualizeaza Adresa
                                                            </strong></button>
                                                    </div>

                                                </form>
                                            @else
                                                <form method="post" action="{{ route('user.profile.address.store') }}">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="info-title" for="first_name"><strong>Nume
                                                                        Destinatar</strong>
                                                                </label>
                                                                <input type="text" class="form-control" name="first_name"
                                                                    style="margin-bottom: 0px !important;" id="first_name">
                                                                @error('first_name')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="info-title" for="last_name"><strong>
                                                                        Prenume Destinatar</strong>
                                                                </label>
                                                                <input type="text" class="form-control" name="last_name"
                                                                    id="last_name" style="margin-bottom: 0px !important;">
                                                                @error('last_name')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="info-title" for="phone"><strong>Numar
                                                                        Telefon</strong>
                                                                </label>
                                                                <input type="text" class="form-control" name="phone"
                                                                    id="phone" value={{ $user->phone }}>
                                                                @error('phone')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="info-title" for="state"><strong>
                                                                        Judet</strong>
                                                                </label>
                                                                <select name="state" class="form-control">
                                                                    <option value="" selected="" disabled="">Selecteaza
                                                                        Judetul
                                                                    </option>
                                                                    {{-- iteram cu $categories din functia AddProduct din ProductController ca $category si afisam toate categoriile --}}
                                                                    @foreach ($divisions as $division)
                                                                        <option value="{{ $division->division_name }}">
                                                                            {{ $division->division_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('state')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="info-title" for="city"><strong>
                                                                        Localitate (Oras / Sector)</strong>
                                                                </label>
                                                                <select name="city" class="form-control">
                                                                    <option value="" selected="" disabled="">Selecteaza
                                                                        Localitatea
                                                                    </option>

                                                                </select>
                                                                @error('city')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <label class="info-title" for="street"><strong>Nume
                                                                        Strada</strong>
                                                                </label>
                                                                <input type="text" class="form-control" name="street"
                                                                    id="street" style="margin-bottom: 0px !important;">
                                                                @error('street')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="info-title" for="street_number"><strong>
                                                                        Numar Strada</strong>
                                                                </label>
                                                                <input type="text" class="form-control"
                                                                    name="street_number" id="street_number"
                                                                    style="margin-bottom: 0px !important;">
                                                                @error('street_number')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <label class="info-title"
                                                                    for="building"><strong>Bloc</strong>
                                                                </label>
                                                                <input type="text" class="form-control" name="building"
                                                                    id="building">
                                                                @error('building')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="info-title" for="apartment"><strong>
                                                                        Apartament</strong>
                                                                </label>
                                                                <input type="text" class="form-control" name="apartment"
                                                                    id="apartment">
                                                                @error('apartment')
                                                                    <span
                                                                        class="text-danger"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="form-group user_dashboard_form_button">
                                                        <button type="submit" class="btn btn-success"
                                                            name="profile_photo_path"><strong>Adauga Adresa de Livrare
                                                            </strong></button>
                                                    </div>

                                                </form>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- sectiunea de actualizare date cont termina --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account end   -->

    {{-- script pentru afisarea localitatilor aferente judetului selectat --}}
    <script type="text/javascript">
        $(document).ready(function() {
            // la schimbarea selectului cu nume state (judet) din formular
            $('select[name="state"]').on('change', function() {
                // variabila state_id preia valoarea din atributul value al optiunii selectate
                var state_id = $(this).val();
                // daca in campul judet (state) avem selectat un judet, localitatile aferente acelui judet vor aparea in optiunile selectului cu nume city (oras / sector)
                if (state_id) {
                    $.ajax({
                        // trimitem spre url state_id (id-ul judetului)
                        url: "{{ url('/user/profile/address') }}/" + state_id,
                        type: "GET",
                        dataType: "json",
                        // daca codul de mai sus primeste ok din functia GetCity() din IndexController 
                        // afisam in optiunile selectului cu nume city (camp oras / sector) localitatile
                        // aferente aferente judetului selectat
                        success: function(data) {
                            var d = $('select[name="city"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="city"]').append(
                                    '<option value="' + value.district_name + '">' +
                                    value
                                    .district_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endsection
