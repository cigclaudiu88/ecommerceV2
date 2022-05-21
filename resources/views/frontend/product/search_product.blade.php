<ul>
    @if ($products->isEmpty())
        <h3 class="text-center text-danger"><strong>Produsul nu a fost gasit!</strong> </h3>
    @else
        <div class="container">
            <div class="row d-flex justify-content-start">
                <div class="col-md-12">
                    <div class="card">

                        {{-- iteram cu $products din functia SearchProduct() din IndexController --}}
                        @foreach ($products as $item)
                            <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">
                                <div class="list border-bottom"> <img src="{{ asset($item->product_thumbnail) }}"
                                        style="width: 50px; height: 50px;">

                                    <div class="d-flex flex-column ml-3" style="margin-left: 10px;">
                                        <span><strong>{{ Str::limit($item->product_name, 40) }} </strong></span>
                                        @if ($item->discount_price == null)
                                            <small>
                                                {{ number_format($item->selling_price * 0.19 + $item->selling_price, 2, '.', ',') }}
                                                RON</small>
                                        @else
                                            <small>
                                                {{ number_format($item->discount_price * 0.19 + $item->discount_price, 2, '.', ',') }}
                                                RON</small>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    @endif
</ul>



<style>
    body {
        background-color: #eee
    }

    .card {
        background-color: #fff;
        padding: 15px;
        border: none
    }

    .input-box {
        position: relative
    }

    .input-box i {
        position: absolute;
        right: 13px;
        top: 15px;
        color: #ced4da
    }

    .form-control {
        height: 50px;
        background-color: #eeeeee69
    }

    .form-control:focus {
        background-color: #eeeeee69;
        box-shadow: none;
        border-color: #eee
    }

    .list {
        padding-top: 20px;
        padding-bottom: 10px;
        display: flex;
        align-items: left;
    }

    .border-bottom {
        border-bottom: 2px solid #eee
    }

    .list i {
        font-size: 19px;
        color: red
    }

    .list small {
        color: #2da71d
    }

    a:hover {
        color: #40a944;
    }

</style>
