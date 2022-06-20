<!--footer area start-->
<footer class="footer_widgets">

    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-7">
                    <div class="widgets_container contact_us">
                        @php
                            $setting = App\Models\SiteSetting::find(1);
                        @endphp

                        <p class="footer_desc">eShop este o echipa dedicata comertului online.</p>
                        <p><strong>{{ $setting->company_name }}</strong></p>
                        <p><span>Adresa:</span> {{ $setting->company_address }}</p>
                        <p><span>Email:</span> <a>{{ $setting->email }}</a></p>
                        <p><span>Telefoane:</span> <br> {{ $setting->phone_one }} <br> {{ $setting->phone_two }}
                        </p>
                        <div class="footer_logo">
                            {{-- <a href="index.html"><img src="{{ asset($setting->logo) }}" alt=""></a> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-7">
                    <div class="copyright_area">
                        <p>Copyright ©2022 - eShop UPT - Designed by Cigusevici Claudiu</a></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    {{-- <div class="footer_payment">
                        <ul>
                            <li><a href="#"><img src="{{ asset('frontend/img/icon/paypal1.jpg') }}"
                                        alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('frontend/img/icon/paypal2.jpg') }}"
                                        alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('frontend/img/icon/paypal3.jpg') }}"
                                        alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('frontend/img/icon/paypal4.jpg') }}"
                                        alt=""></a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer area end-->
