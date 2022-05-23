    <!-- modal area start-->
    <div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                {{-- adaugat id="closeModel" pentru a inchide modalul dupa apasarea butonului Adauga in Cos --}}
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="closeModel">
                    <span aria-hidden="true"><i class="icon-x"></i></span>
                </button>
                <div class="modal_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="modal_tab">
                                    <div class="tab-content product-details-large">
                                        <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                            <div class="modal_tab_img">
                                                {{-- adaugat id pentru a prelua thumbnail image din ajax script --}}
                                                <a href=""><img src="" alt="" id="pimage"></a>
                                            </div>
                                        </div>
                                        {{-- <div class="tab-pane fade" id="tab2" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img src="assets/img/product/productbig2.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab3" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img src="assets/img/product/productbig3.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab4" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img src="assets/img/product/productbig4.jpg" alt=""></a>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="modal_tab_button">
                                        <ul class="nav product_navactive owl-carousel" role="tablist">
                                            {{-- aici se adauga li - a - img din functia / scriptul productView() --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <div class="modal_right">
                                    <div class="modal_title mb-10">
                                        <h2><strong><span id="pname"></span></strong></h2>
                                        <h2>Categorie: <span id="psubsubcategory"></span></h2>
                                        <h2>Brand: <span id="pbrand"></span></h2>
                                        <h2><span id="aviable"></span></h2>
                                        <h2><span id="lowstock"></span></h2>
                                        <h2><span id="stockout"></span></h2>
                                    </div>
                                    <div class="modal_price mb-10">
                                        <strong>Pret: </strong> <span class="new_price"><strong
                                                id="pprice"></strong>
                                            <strong>
                                                RON</strong></span>
                                        <span class="old_price"><strong id="oldprice"></strong> <strong>
                                            </strong></span>
                                    </div>
                                    <div class="modal_add_to_cart">

                                        {{-- adaugat id qty pentru functia addToCart din scrript --}}
                                        <input min="1" step="1" value="1" type="number" id="qty">
                                        {{-- adaugat camp hiddent pentru product_id --}}
                                        <input type="hidden" id="product_id">
                                        {{-- adaugat onclick event --}}
                                        <button onclick="addToCart()" class="button">Adauga in Cos</button>



                                    </div>
                                    <div class="modal_description mb-15">
                                        <p><span id="pspecifications"></span></p>
                                    </div>

                                    {{-- <div class="variants_selects">
                                        <div class="variants_size">
                                            <h2>size</h2>
                                            <select class="select_option">
                                                <option selected value="1">s</option>
                                                <option value="1">m</option>
                                                <option value="1">l</option>
                                                <option value="1">xl</option>
                                                <option value="1">xxl</option>
                                            </select>
                                        </div>
                                        <div class="variants_color">
                                            <h2>color</h2>
                                            <select class="select_option">
                                                <option selected value="1">purple</option>
                                                <option value="1">violet</option>
                                                <option value="1">black</option>
                                                <option value="1">pink</option>
                                                <option value="1">orange</option>
                                            </select>
                                        </div>
                                        <div class="modal_add_to_cart">
                                            <form action="#">
                                                <input min="1" max="100" step="2" value="1" type="number">
                                                <button type="submit">add to cart</button>
                                            </form>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="modal_social">
                                        <h2>Share this product</h2>
                                        <ul>
                                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a>
                                            </li>
                                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a>
                                            </li>
                                            <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a>
                                            </li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal area end-->
