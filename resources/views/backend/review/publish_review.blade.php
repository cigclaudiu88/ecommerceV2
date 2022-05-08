@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Lista Recenzii Publicate</h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Titlu Recenzie</th>
                                <th>Cuprins Recenzie</th>
                                <th>Utilizator</th>
                                <th>Produs</th>
                                <th>Status</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $review (PendingReview() din ReviewController) ca $item si afisam in tabel toate valorile din tabelul reviews --}}
                            @foreach ($review as $item)
                                <tr>
                                    <td>{{ $item->summary }}</td>
                                    <td>{{ Str::limit($item->comment, 50) }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ Str::limit($item->product->product_name, 50) }}</td>
                                    <td class="text-center">
                                        @if ($item->status == 0)
                                            <h4> <span class="badge badge-pill badge-warning">In asteptare</span></h4>
                                        @elseif($item->status == 1)
                                            <h4> <span class="badge badge-pill badge-info">Publicat</span></h4>
                                        @endif
                                        {{-- <h4><span class="badge badge-pill badge-primary">{{ $item->status }}</span></h4> --}}
                                    </td>
                                    </td>
                                    <td width="30%">
                                        <a href="{{ route('pending.review.details', $item->id) }}"
                                            class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>
                                            Vizualizare</a>
                                        <a href="{{ route('delete.review', $item->id) }}" class="btn btn-danger"
                                            id="delete"> Sterge
                                        </a>
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
