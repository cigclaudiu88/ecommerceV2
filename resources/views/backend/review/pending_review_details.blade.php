@extends('admin.admin_master')
@section('admin')
    <div class="row">

        <div class="col-lg-12 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Recenzie</h4>
                </div>
                <div class="box-body">

                    <div class=row>
                        <div class="col-6 mb-20">
                            <label for="comment"><strong>Utilizator</strong></label>
                            <p>{{ $pending_review->user?->name }}</p>
                        </div>

                        <div class="col-6 mb-20">
                            <label for="comment"><strong>Produs</strong></label>
                            <p>{{ $pending_review->product?->product_name }}</p>
                        </div>
                    </div>

                    <div class=row>
                        <div class="col-12 mb-20">
                            <label for="summary"><strong>Titlu Recenzie</strong></label>
                            <p>{{ $pending_review->summary }}</p>
                        </div>

                        <div class="col-12 mb-20">
                            <label for="comment"><strong>Curpins Recenzie</strong></label>
                            <p>{{ $pending_review->comment }}</p>
                        </div>
                    </div>

                    <a href="{{ route('review.approve', $pending_review->id) }}" class="btn btn-success">Aproba
                        Recenzie </a>
                    <a href="{{ route('delete.review', $pending_review->id) }}" class="btn btn-danger" id="delete">
                        Sterge
                    </a>
                    <a href="{{ url('/admin/dashboard') }}" class="btn btn-default">Cancel</a>

                </div>
            </div>
        </div>
    </div>
@endsection
