{{-- UL lista cu toate sugestiile de produse --}}
<ul>
    {{-- iteram cu variabila $products din functia SearchProduct() din IndexController --}}
    @foreach ($products as $item)
        <li> <img src="{{ asset($item->product_thumbnail) }}" style="width: 50px; height: 50px;">
            {{ Str::limit($item->product_name, 40) }} </li>
    @endforeach
</ul>
