<div class="product_ratting">
    @php
        // $avg_rating preia din tabelul reviews valorile medii din coloana rating
        // pentru produsul curent rotunjit la 0 zecimale
        $avg_rating = App\Models\Review::where('product_id', $product->id)
            ->where('status', 1)
            ->avg('rating');
        $count_rating = App\Models\Review::where('product_id', $product->id)
            ->where('status', 1)
            ->count('rating');
    @endphp
    <ul>
        @if ($avg_rating == null || $avg_rating < 1)
            <li><a href="#"><i class="icon-star"></i></a></li>
            <li><a href="#"><i class="icon-star"></i></a></li>
            <li><a href="#"><i class="icon-star"></i></a></li>
            <li><a href="#"><i class="icon-star"></i></a></li>
            <li><a href="#"><i class="icon-star"></i></a></li>
        @elseif($avg_rating == 1 || $avg_rating < 2)
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
            <li><a href="#"><i class="icon-star"></i></a></li>
            <li><a href="#"><i class="icon-star"></i></a></li>
            <li><a href="#"><i class="icon-star"></i></a></li>
            <li><a href="#"><i class="icon-star"></i></a></li>
        @elseif($avg_rating == 2 || $avg_rating < 3)
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
            <li><a href="#"><i class="icon-star"></i></a></li>
            <li><a href="#"><i class="icon-star"></i></a></li>
            <li><a href="#"><i class="icon-star"></i></a></li>
        @elseif($avg_rating == 3 || $avg_rating < 4)
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
            <li><a href="#"><i class="icon-star"></i></a></li>
            <li><a href="#"><i class="icon-star"></i></a></li>
        @elseif($avg_rating == 4 || $avg_rating < 5)
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
            <li><a href="#"><i class="icon-star"></i></a></li>
        @elseif($avg_rating == 5 || $avg_rating < 6)
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
            <li><a href="#"><i class="fa-solid fa-star"></i></a>
            </li>
        @endif
        <li>({{ $count_rating }})</li>
    </ul>

</div>
