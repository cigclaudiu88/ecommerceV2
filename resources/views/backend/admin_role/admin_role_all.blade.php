@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <a href="{{ route('add.admin') }}" class="btn btn-warning" style="float: right;"><strong>Adauga
                            Administrator<strong></a>
                    <h3 class="title">Lista Administratori <span class="badge badge badge-danger">
                            {{ count($adminuser) }} </span></h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Poza Profil</th>
                                <th>Nume</th>
                                <th>Email</th>
                                <th>Telefon</th>
                                <th>Nivel Acces</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $vouchers (VoucherView() din VoucherController) ca $item si afisam in tabel toate valorile din tabelul vouchers --}}
                            @foreach ($adminuser as $item)
                                <tr>
                                    <td> <img src="{{ asset($item->profile_photo_path) }}" width="80px" height="80px">
                                    </td>
                                    <td> {{ $item->name }} </td>
                                    </td>
                                    <td> {{ $item->email }} </td>
                                    <td> {{ $item->phone }} </td>
                                    <td>
                                        @if ($item->brand == 1)
                                            <span class="badge btn-primary">Management Branduri</span>
                                        @else
                                        @endif

                                        @if ($item->category == 1)
                                            <span class="badge btn-primary">Management Categorii</span>
                                        @else
                                        @endif

                                        @if ($item->subcategory == 1)
                                            <span class="badge btn-primary">Management Subcategorii</span><br>
                                        @else
                                        @endif

                                        @if ($item->subsubcategory == 1)
                                            <span class="badge btn-primary">Management Subcategorii</span>
                                        @else
                                        @endif

                                        @if ($item->product == 1)
                                            <span class="badge btn-primary">Management Produse</span>
                                        @else
                                        @endif

                                        @if ($item->stock == 1)
                                            <span class="badge btn-primary">Stocuri Produse </span><br>
                                        @else
                                        @endif

                                        @if ($item->slider == 1)
                                            <span class="badge btn-info">Management Reclame Slider</span>
                                        @else
                                        @endif


                                        @if ($item->voucher == 1)
                                            <span class="badge btn-info">Management Voucher-uri</span>
                                        @else
                                        @endif


                                        @if ($item->orders == 1)
                                            <span class="badge btn-info">Management Comenzi</span><br>
                                        @else
                                        @endif

                                        @if ($item->return_order == 1)
                                            <span class="badge btn-info">Management Retur Produse</span>
                                        @else
                                        @endif


                                        @if ($item->reports == 1)
                                            <span class="badge btn-success">Rapoarte vanzari</span>
                                        @else
                                        @endif

                                        @if ($item->alluser == 1)
                                            <span class="badge btn-success">Lista Clienti</span><br>
                                        @else
                                        @endif

                                        @if ($item->blog == 1)
                                            <span class="badge btn-warning">Management Blog</span>
                                        @else
                                        @endif

                                        @if ($item->review == 1)
                                            <span class="badge btn-warning">Management Recenzii Produse</span>
                                        @else
                                        @endif

                                        @if ($item->setting == 1)
                                            <span class="badge btn-warning">Setari Site</span><br>
                                        @else
                                        @endif

                                        @if ($item->shipping == 1)
                                            <span class="badge btn-warning">Management Locatii</span>
                                        @else
                                        @endif

                                        @if ($item->admin_user_role == 1)
                                            <span class="badge btn-dark">Rol Administrator</span>
                                        @else
                                        @endif
                                    </td>
                                    </td>
                                    <td>
                                        {{-- adaugat ruta de editare categorie --}}
                                        <a href="{{ route('edit.admin.user', $item->id) }}"
                                            class="btn btn-info">Edit</a>
                                        {{-- adaugat ruta de stergere categorie cu id="delete" pentru scriptul de sweetalert --}}
                                        <a href="{{ route('delete.admin.user', $item->id) }}" class="btn btn-danger"
                                            id="delete">Delete</a>
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
