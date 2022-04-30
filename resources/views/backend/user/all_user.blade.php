@extends('admin.admin_master')
@section('admin')
    <div class="row">
        <!--Default Data Table Start-->
        <div class="col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Total Utilizatori <span class="badge badge badge-danger">
                            {{ count($usersdata) }} </span></h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Poza</th>
                                <th>Nume Client</th>
                                <th>Email</th>
                                <th>Telefon</th>
                                <th>Judet</th>
                                <th>Localtiate</th>
                                <th>Strada</th>
                                <th>Numar</th>
                                <th>Bloc</th>
                                <th>Apartament</th>
                                <th>Status</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $usersdata (AllUsers() din AdminProfileController) ca $data si afisam in tabel toate valorile din tabelul users + user_addresses --}}
                            @foreach ($usersdata as $data)
                                <tr>
                                    <td>
                                        <img src="{{ !empty($data->user->profile_photo_path)? url('upload/user_images/' . $data->user->profile_photo_path): url('upload/default_profile.png') }}"
                                            alt=""
                                            style="max-width:none !important; width:50px !important; height:50px !important;">
                                    </td>
                                    <td class="col-md-2">{{ $data->user->name }}</td>
                                    <td class="col-md-1">{{ $data->user->email }}</td>
                                    <td class="col-md-1">{{ $data->user->phone }}</td>
                                    <td class="col-md-1">{{ $data->state }}</td>
                                    <td class="col-md-1">{{ $data->city }}</td>
                                    <td class="col-md-2">{{ $data->street }}</td>
                                    <td>{{ $data->street_number }}</td>
                                    <td class="col-md-1">{{ $data->building }}</td>
                                    <td class="col-md-1">{{ $data->apartment }}</td>
                                    <td class="col-md-1">
                                        {{-- daca exista date de utilizator in functia UserOnline() din UserAdress Model --}}
                                        @if ($data->UserOnline())
                                            {{-- afisam ca utilizatorul este online --}}
                                            <span class="badge badge-pill badge-success">Online</span>
                                        @else
                                            {{-- altfel afisam ultima logare conform camp last_seen din tabelul users --}}
                                            <span
                                                class="badge badge-pill badge-danger">{{ Carbon\Carbon::parse($data->user->last_seen)->diffForHumans() }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-info">Edit</a>
                                        <a href="" class="btn btn-danger" id="delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--Default Data Table End-->
    </div>
@endsection
