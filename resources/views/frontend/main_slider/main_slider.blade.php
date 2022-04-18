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
            <div class="col-lg-3 col-md-6">
                <div class="single_shipping">
                    <div class="shipping_icone">
                        <img src="{{ asset('frontend/img/about/shipping1.jpg') }}" alt="">
                    </div>
                    <div class="shipping_content">
                        <h3>Transport Gratuit</h3>
                        <p>Transport gratuit pentru compenzi de 500 RON</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single_shipping col_2">
                    <div class="shipping_icone">
                        <img src="{{ asset('frontend/img/about/shipping2.jpg') }}" alt="">
                    </div>
                    <div class="shipping_content">
                        <h3>Suport Clienti 24/7</h3>
                        <p>Contact us 24 hours a day, 7 days a week</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single_shipping col_3">
                    <div class="shipping_icone">
                        <img src="{{ asset('frontend/img/about/shipping3.jpg') }}" alt="">
                    </div>
                    <div class="shipping_content">
                        <h3>30 Days Return</h3>
                        <p>Simply return it within 30 days for an exchange</p>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single_shipping col_4">
                    <div class="shipping_icone">
                        <img src="{{ asset('frontend/img/about/shipping4.jpg') }}" alt="">
                    </div>
                    <div class="shipping_content">
                        <h3>100% Payment Secure</h3>
                        <p>We ensure secure payment with PEV</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--shipping area end-->
