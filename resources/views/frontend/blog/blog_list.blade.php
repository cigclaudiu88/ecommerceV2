@extends('frontend.main_master')
@section('content')

    {{-- ajax jquerry CDN pentru scriptul de validare judet-localitate --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@section('title')
    Blog
@endsection

<!--blog area start-->
<div class="blog_page_section blog_fullwidth mt-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="blog_wrapper">

                    <article class="single_blog">
                        <figure>
                            <div class="blog_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blog-big1.jpg" alt=""></a>
                            </div>
                            <figcaption class="blog_content">
                                <h4 class="post_title"><a href="blog-details.html">Blog image post</a></h4>
                                <div class="articles_date">
                                    <p>18/01/2020 | <a href="#">eCommerce</a> </p>
                                </div>
                                <p class="post_desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Perspiciatis doloribus itaque nulla, ratione laboriosam quisquam dolorum expedita
                                    libero facere eius repellat qui suscipit illum a fuga odio velit. sint laboriosam
                                    explicabo asperiores eaque minus, magnam nesciunt.</p>
                                <footer class="btn_more">
                                    <a href="blog-details.html"> Read more</a>
                                </footer>
                            </figcaption>
                        </figure>
                    </article>

                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="blog_sidebar_widget">
                    <div class="widget_list widget_search">
                        <div class="widget_title">
                            <h3>Search</h3>
                        </div>
                        <form action="#">
                            <input placeholder="Search..." type="text">
                            <button type="submit">search</button>
                        </form>
                    </div>
                    <div class="widget_list comments">
                        <div class="widget_title">
                            <h3>Recent Comments</h3>
                        </div>
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/comment2.png.jpg" alt=""></a>
                            </div>
                            <div class="post_info">
                                <span> <a href="#">demo</a> says:</span>
                                <a href="blog-details.html">Quisque semper nunc</a>
                            </div>
                        </div>
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/comment2.png.jpg" alt=""></a>
                            </div>
                            <div class="post_info">
                                <span><a href="#">admin</a> says:</span>
                                <a href="blog-details.html">Quisque orci porta...</a>
                            </div>
                        </div>
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/comment2.png.jpg" alt=""></a>
                            </div>
                            <div class="post_info">
                                <span><a href="#">demo</a> says:</span>
                                <a href="blog-details.html">Quisque semper nunc</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget_list widget_post">
                        <div class="widget_title">
                            <h3>Recent Posts</h3>
                        </div>
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blogs1.jpg" alt=""></a>
                            </div>
                            <div class="post_info">
                                <h4><a href="blog-details.html">Blog image post</a></h4>
                                <span>March 16, 2018 </span>
                            </div>
                        </div>
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blogs2.jpg" alt=""></a>
                            </div>
                            <div class="post_info">
                                <h4><a href="blog-details.html">Post with Gallery</a></h4>
                                <span>March 16, 2018 </span>
                            </div>
                        </div>
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blogs3.jpg" alt=""></a>
                            </div>
                            <div class="post_info">
                                <h4><a href="blog-details.html">Post with Audio</a></h4>
                                <span>March 16, 2018 </span>
                            </div>
                        </div>
                    </div>
                    <div class="widget_list widget_categories">
                        <div class="widget_title">
                            <h3>Categories</h3>
                        </div>
                        <ul>
                            <li><a href="#">Audio</a></li>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">Gallery</a></li>
                            <li><a href="#">Image</a></li>
                            <li><a href="#">Other</a></li>
                            <li><a href="#">Travel</a></li>
                        </ul>
                    </div>
                    <div class="widget_list widget_tag">
                        <div class="widget_title">
                            <h3>Tag products</h3>
                        </div>
                        <div class="tag_widget">
                            <ul>
                                <li><a href="#">asian</a></li>
                                <li><a href="#">brown</a></li>
                                <li><a href="#">euro</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--blog area end-->

<!--blog pagination area start-->
<div class="blog_pagination pagination_full">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="pagination">
                    <ul>
                        <li class="current">1</li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li class="next"><a href="#">next</a></li>
                        <li><a href="#">>></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--blog pagination area end-->

@endsection
