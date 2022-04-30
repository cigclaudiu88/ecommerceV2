@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-12 mb-30">
            <div class="box">

                <div class="box-head">
                    <a href="{{ route('add.post') }}" class="btn btn-success" style="float: right;">Adauga Postare</a>
                    <h3 class="title">Lista Postari Blog <span class="badge badge badge-danger">
                            {{ count($blogpost) }} </span></h3>

                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Categorie Postare</th>
                                <th>Poza Postare</th>
                                <th>Titlu Postare</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $blogcategory (ListBlogPost() din BlogController) ca $item si afisam in tabel toate valorile din tabelul blog_posts --}}
                            @foreach ($blogpost as $item)
                                <tr>
                                    <td>{{ $item->category_id }}</td>
                                    <td> <img src="{{ asset($item->post_image) }}" style="width: 100px; height: 50px;">
                                    </td>
                                    <td>{{ $item->post_title }}</td>
                                    <td>
                                        {{-- adaugat ruta de editare categorie --}}
                                        <a href="{{ route('post.edit', $item->id) }}" class="btn btn-info">Edit</a>
                                        {{-- adaugat ruta de stergere categorie cu id="delete" pentru scriptul de sweetalert --}}
                                        <a href="{{ route('post.delete', $item->id) }}" class="btn btn-danger"
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
