     @php
         // $id preia valoarea id din baza de date pentru utilizatorul autentificat
         $id = Auth::user()->id;
         // $user cauta in tabela users in baza de date utilizatorul cu id-ul $id
         $user = App\Models\User::find($id);
         // returnam view-ul dashboard pentru utilizatori autentificati
     @endphp

     {{-- jQuerry CDN link pentru scriptul de vizualizare imagine profil --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
          integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                 <li><a href="{{ route('dashboard') }}"
                         class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">Acasa</a>
                 </li>
                 <li><a href="{{ route('user.profile') }}"
                         class="nav-link {{ Request::routeIs('user.profile') ? 'active' : '' }}">Detalii
                         Cont</a>
                 </li>
                 <li><a href="{{ route('user.change.password') }}"
                         class="nav-link {{ Request::routeIs('user.change.password') ? 'active' : '' }}">Schimba
                         Parola</a>
                 </li>
                 <li><a href="{{ route('user.address') }}" data-toggle="tab"
                         class="nav-link {{ Request::routeIs('user.address') ? 'active' : '' }}">Adrese
                         Livrare</a></li>
                 <li> <a href="{{ route('my.orders') }}" data-toggle="tab"
                         class="nav-link {{ Request::routeIs('my.orders') ? 'active' : '' }}">Istoric
                         Comenzi</a></li>
                 <li> <a href="{{ route('my.orders') }}" data-toggle="tab"
                         class="nav-link {{ Request::routeIs('my.orders') ? 'active' : '' }}">Comenzi cu Retur</a>
                 </li>
                 <li> <a href="{{ route('my.orders') }}" data-toggle="tab"
                         class="nav-link {{ Request::routeIs('my.orders') ? 'active' : '' }}">Comenzi Anulate</a>
                 </li>
                 <li><a href=" #downloads" data-toggle="tab" class="nav-link">Istoric Facturi</a></li>

                 {{-- adaugat ruta de logout --}}
                 <li><a href="{{ route('user.logout') }}" class="nav-link">Logout</a></li>
             </ul>
         </div>
     </div>
     {{-- meniu navigare --}}
