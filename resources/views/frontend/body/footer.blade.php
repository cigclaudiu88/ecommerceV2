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
                {{-- <div class="col-lg-2 col-md-3 col-sm-5">
                    <div class="widgets_container widget_menu">
                        <h3>Information</h3>
                        <div class="footer_menu">

                            <ul>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="#">Delivery Information</a></li>
                                <li><a href="#"> Privacy Policy</a></li>
                                <li><a href="#"> Terms & Conditions</a></li>
                                <li><a href="contact.html"> Contact Us</a></li>
                                <li><a href="#"> Site Map</a></li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="widgets_container widget_menu">
                        <h3>Extras</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="#">Brands</a></li>
                                <li><a href="#"> Gift Certificates</a></li>
                                <li><a href="#">Affiliate</a></li>
                                <li><a href="#">Specials</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#"> Order History</a></li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="widgets_container widget_newsletter">
                        <h3>Sign up newsletter</h3>
                        <p class="footer_desc">Get updates by subscribe our weekly newsletter</p>
                        <div class="subscribe_form">
                            <form id="mc-form" class="mc-form footer-newsletter">
                                <input id="mc-email" type="email" autocomplete="off" placeholder="Enter you email" />
                                <button id="mc-submit">Subscribe</button>
                            </form>
                            <!-- mailchimp-alerts Start -->
                            <div class="mailchimp-alerts text-centre">
                                <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                            </div><!-- mailchimp-alerts end -->
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="footer_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-7">
                    <div class="copyright_area">
                        <p>Copyright © 2022 <a href="#">eShop UPT</a></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="footer_payment">
                        <ul>
                            <li><a href="#"><img src="assets/img/icon/paypal1.jpg" alt=""></a></li>
                            <li><a href="#"><img src="assets/img/icon/paypal2.jpg" alt=""></a></li>
                            <li><a href="#"><img src="assets/img/icon/paypal3.jpg" alt=""></a></li>
                            <li><a href="#"><img src="assets/img/icon/paypal4.jpg" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer area end-->
