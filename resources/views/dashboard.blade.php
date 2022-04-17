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
                                <li><a href="{{ route('dashboard') }}" class="nav-link active">Acasa</a>
                                </li>
                                <li><a href="{{ route('user.profile') }}" class="nav-link">Detalii
                                        Cont</a>
                                </li>
                                <li><a href="{{ route('user.change.password') }}" class="nav-link">Schimba
                                        Parola</a>
                                </li>
                                <li> <a href="#orders" data-toggle="tab" class="nav-link">Istoric Comenzi</a></li>
                                <li><a href="#downloads" data-toggle="tab" class="nav-link">Istoric Facturi</a></li>
                                <li><a href="#address" data-toggle="tab" class="nav-link">Adrese</a></li>
                                {{-- adaugat ruta de logout --}}
                                <li><a href="{{ route('user.logout') }}" class="nav-link">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    {{-- meniu navigare --}}
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">

                            <div class="tab-pane fade show active" id="dashboard">
                                <h3>Acasa </h3>
                                <p>Buna <strong>{{ Auth::user()->name }}</strong> Din aceasta pagina poti modifica
                                    informatiile contului, poti schimba parola, poti vizualiza istoricul comenzilor plasate
                                    si multe altele.</p>
                            </div>

                            {{-- sectiunea de schimbare parola incepe --}}
                            <div class="tab-pane fade" id="account-password">
                                <h3><strong>Actualizare Parola</strong></h3>
                                <div class="login">
                                    <div class="login_form_container">
                                        <div class="account_login_form">

                                            <form method="post" action="{{ route('user.profile.password.update') }}"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label class="info-title" for="current_password"><strong>Parola
                                                            Curenta</strong></label>
                                                    <input type="password" class="form-control" id="current_password"
                                                        name="current_password">
                                                    @error('current_password')
                                                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="info-title" for="password"><strong>Parola
                                                            Noua</strong></label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password">
                                                    @error('password')
                                                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="password_confirmation"><strong>Confirmare Parola
                                                            Curenta</strong></label>
                                                    <input type="password" class="form-control" id="password_confirmation"
                                                        name="password_confirmation">
                                                    @error('password')
                                                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success"
                                                        name="profile_photo_path"><strong>Actualizare
                                                            Parola</strong></button>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- sectiunea de schimbare parola termina --}}

                            <div class="tab-pane fade" id="orders">
                                <h3>Orders</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>May 10, 2018</td>
                                                <td><span class="success">Completed</span></td>
                                                <td>$25.00 for 1 item </td>
                                                <td><a href="cart.html" class="view">view</a></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>May 10, 2018</td>
                                                <td>Processing</td>
                                                <td>$17.00 for 1 item </td>
                                                <td><a href="cart.html" class="view">view</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="downloads">
                                <h3>Downloads</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Downloads</th>
                                                <th>Expires</th>
                                                <th>Download</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Shopnovilla - Free Real Estate PSD Template</td>
                                                <td>May 10, 2018</td>
                                                <td><span class="danger">Expired</span></td>
                                                <td><a href="#" class="view">Click Here To Download Your File</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Organic - ecommerce html template</td>
                                                <td>Sep 11, 2018</td>
                                                <td>Never</td>
                                                <td><a href="#" class="view">Click Here To Download Your File</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="address">
                                <p>The following addresses will be used on the checkout page by default.</p>
                                <h4 class="billing-address">Billing address</h4>
                                <a href="#" class="view">Edit</a>
                                <p><strong>Bobby Jackson</strong></p>
                                <address>
                                    House #15<br>
                                    Road #1<br>
                                    Block #C <br>
                                    Banasree <br>
                                    Dhaka <br>
                                    1212
                                </address>
                                <p>Bangladesh</p>
                            </div>

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
