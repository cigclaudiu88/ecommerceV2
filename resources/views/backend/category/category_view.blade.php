@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-8 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Categorii Produse</h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                            <tr>
                                <th>Icoana Categorie</th>
                                <th>Nume Categorie</th>
                                <th>Actiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iteram cu variabila $categories (CategoryView() din CategoryController) ca $item si afisam in tabel toate valorile din tabelul categories --}}
                            @foreach ($categories as $item)
                                <tr>
                                    <td><span><i class="{{ $item->category_icon }} text-white fa-4x "></i></span></td>
                                    <td>{{ $item->category_name }}</td>
                                    <td>
                                        {{-- adaugat ruta de editare categorie --}}
                                        <a href="{{ route('category.edit', $item->id) }}" class="btn btn-info">Edit</a>
                                        {{-- adaugat ruta de stergere categorie cu id="delete" pentru scriptul de sweetalert --}}
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

        <div class="col-lg-4 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Adauga Categorie Produse</h4>
                </div>
                <div class="box-body">
                    {{-- formular de adaugare categorii in tabelul categories folosind ruta category.store si functia CategoryStore() din CategoryController --}}
                    {{-- enctype pentru lucrul cu imagini si protectie csrf --}}
                    <form method="POST" action="{{ route('category.store') }}">
                        @csrf
                        <div class="row mbn-20">

                            <div class="col-12 mb-20">
                                <label for="category_name"><strong>Nume Categorie</strong></label>
                                <input type="text" name="category_name" id="category_name" class="form-control"
                                    placeholder="Nume Categorie">
                                @error('category_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <label for="category_icon"><strong>Icoana Categorie</strong></label>
                                <input type="text" name="category_icon" id="category_icon" class="form-control"
                                    placeholder="Icoana Categorie">
                                @error('category_icon')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-20">
                                <input type="submit" value="Adauga Categorie" class="button button-primary">
                                {{-- <input type="submit" value="cancle" class="button button-danger"> --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
