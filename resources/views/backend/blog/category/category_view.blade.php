@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-8 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Categorii Blog <span class="badge badge badge-danger">
                            {{ count($blogcategory) }} </span></h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Categorie Blog</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $categories (CategoryView() din CategoryController) ca $item si afisam in tabel toate valorile din tabelul categories --}}
                            @foreach ($blogcategory as $item)
                                <tr>
                                    <td>{{ $item->blog_category_name }}</td>
                                    <td>
                                        {{-- adaugat ruta de editare categorie --}}
                                        <a href="{{ route('blog.category.edit', $item->id) }}"
                                            class="btn btn-info">Edit</a>
                                        {{-- adaugat ruta de stergere categorie cu id="delete" pentru scriptul de sweetalert --}}
                                        <a href="{{ route('blog.category.delete', $item->id) }}" class="btn btn-danger"
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

        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Adauga Categorie Blog</h4>
                </div>
                <div class="box-body">
                    {{-- formular de adaugare categorii in tabelul categories folosind ruta category.store si functia CategoryStore() din CategoryController --}}
                    {{-- enctype pentru lucrul cu imagini si protectie csrf --}}
                    <form method="POST" action="{{ route('blogcategory.store') }}">
                        @csrf
                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="blog_category_name"><strong>Nume Categorie Blog</strong></label>
                                <input type="text" name="blog_category_name" id="blog_category_name" class="form-control"
                                    placeholder="Nume Categorie">
                                @error('blog_category_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Adauga Categorie pt Blog" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
