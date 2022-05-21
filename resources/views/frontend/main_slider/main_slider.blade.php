<!--slider area start-->
<section class="slider_section">
    <div class="slider_area owl-carousel">

        {{-- iteram cu $sliders pentru a afisa in caruselul de pe pagina principala toate slider-urile din tabela sliders --}}
        @foreach ($sliders as $slider)
            <div class="single_slider d-flex align-items-center" data-bgimg="{{ asset($slider->slider_image) }}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="slider_content">
                                <h1>{{ $slider->slider_title }}</h1>
                                {{-- <h2></h2> --}}
                                <p>
                                    {{ $slider->slider_description }}
                                </p>
                                <a href="shop.html">Descopera</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
<!--slider area end-->

<!--shipping area start-->
<div class="shipping_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single_shipping">
                    <div class="shipping_icone">
                        <i class="fa-solid fa-truck fa-3x text-success"></i>
                    </div>
                    <div class="shipping_content">

                        <h3>Transport Gratuit</h3>
                        <p>Transport gratuit pentru orice comanda!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_shipping col_3">
                    <div class="shipping_icone">
                        <i class="fa-solid fa-arrow-rotate-left fa-3x text-success"></i>
                    </div>
                    <div class="shipping_content">
                        <h3>30 Zile Retur</h3>
                        <p>Comenzile pot fi returnate la 30 zile.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_shipping col_4">
                    <div class="shipping_icone">
                        <i class="fa-brands fa-cc-visa fa-3x text-success"></i>
                    </div>
                    <div class="shipping_content ">
                        <h3>100% Plata Securizata</h3>
                        <p>Plateste online cu cardul fara griji.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--shipping area end-->
