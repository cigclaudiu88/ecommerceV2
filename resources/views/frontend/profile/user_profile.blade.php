@extends('frontend.main_master')
@section('content')
    {{-- jQuerry CDN link pentru scriptul de vizualizare imagine profil --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- my account start  -->
    <section class="main_content_area">
        <div class="container">
            <div class="account_dashboard">
                <div class="row">
                    {{-- meniu navigare --}}
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        {{-- daca campul profile_photo_path din tabela users nu este goala se afiseaza poza de profil --}}
                        {{-- daca campul profile_photo_path din tabela users este goala se afiseaza poza de profil implicita upload/default_profile.png --}}
                        <img class="card-img-top" style="border-radius:20%"
                            src="{{ !empty($user->profile_photo_path)? url('upload/user_images/' . $user->profile_photo_path): url('upload/default_profile.png') }}"
                            alt="" height="40%" width="40%"><br><br>
                        <!-- Nav tabs -->
                        <div class="dashboard_tab_button">
                            <ul role="tablist" class="nav flex-column dashboard-list">
                                <li><a href="{{ route('dashboard') }}" class="nav-link">Acasa</a>
                                </li>
                                <li><a href="{{ route('user.profile') }}" class="nav-link active">Detalii
                                        Cont</a>
                                </li>
                                <li><a href="{{ route('user.change.password') }}" class="nav-link">Schimba
                                        Parola</a>
                                </li>
                                <li><a href="{{ route('user.address') }}" data-toggle="tab" class="nav-link">Adrese
                                    Livrare</a></li>
                                <li> <a href="#orders" data-toggle="tab" class="nav-link">Istoric Comenzi</a></li>
                                <li><a href="#downloads" data-toggle="tab" class="nav-link">Istoric Facturi</a></li>
                                {{-- adaugat ruta de logout --}}
                                <li><a href="{{ route('user.logout') }}" class="nav-link">logout</a></li>
                            </ul>
                        </div>
                    </div>
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

                                            <form method="post" action="{{ route('user.profile.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label class="info-title" for="name"><strong>Nume si
                                                            Prenume</strong>
                                                    </label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        value="{{ $user->name }}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="info-title" for="email"><strong>Adresa de
                                                            Email</strong></label>
                                                    <input type="email" class="form-control" name="email" id="email"
                                                        value="{{ $user->email }}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="phone"><strong>Telefon</strong></label>
                                                    <input type="text" class="form-control" name="phone" id="phone"
                                                        value="{{ $user->phone }}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="info-title" for="profile_photo_path"><strong>Poza de
                                                            Profil</strong></label>
                                                    <input type="file" class="form-control" name="profile_photo_path"
                                                        id="imagedisplay">
                                                </div>

                                                {{-- afisare poza de profil selectata de utlizator inainte de inserarea in baza de date --}}
                                                <div class="form-group">
                                                    <img id="showImage"
                                                        src="{{ !empty($user->profile_photo_path)? url('upload/user_images/' . $user->profile_photo_path): url('upload/default_profile.png') }}"
                                                        alt="" height="10%" width="10%"><br><br>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success"
                                                        name="profile_photo_path"><strong>Actualizare
                                                            Date</strong></button>
                                                </div>

                                            </form>

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

    {{-- javascript pentru a afisa imaginea selectata de profil inainte de inserare --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#imagedisplay').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
