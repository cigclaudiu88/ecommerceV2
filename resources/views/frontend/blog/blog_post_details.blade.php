@extends('frontend.main_master')
@section('content')

    {{-- ajax jquerry CDN pentru scriptul de validare judet-localitate --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@section('title')
    {{ $blogpost->post_title }}
@endsection

<!--breadcrumbs area start-->
<div class="breadcrumbs_area"> {{-- style="
    background: url({{ asset($blogpost->post_image) }}) no-repeat 0 0;
    background-size: cover;
    height: 200px;
    display: flex;
    align-items: center;" --}}>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Blog</h3>
                    <ul>
                        <li><a href="{{ url('/') }}">Acasa</a></li>
                        <li> {{ $blogpost->post_title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--blog body area start-->
<div class="blog_details">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <!--blog grid area start-->
                <div class="blog_wrapper blog_wrapper_details">
                    <article class="single_blog">
                        <figure>
                            <div class="post_header">
                                <h3 class="post_title">{{ $blogpost->post_title }}</h3>
                                <div class="blog_meta">
                                    <p>Posted by : <a href="#">admin</a> / On : <a
                                            href="#">{{ Carbon\Carbon::parse($blogpost->created_at)->diffForHumans() }}</a>
                                        / In :
                                        <a href="#">{{ $blogpost->category->blog_category_name }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="blog_thumb">
                                <a href="#"><img class="img-responsive" src="{{ asset($blogpost->post_image) }}"
                                        alt=""></a>
                            </div>
                            <figcaption class="blog_content">
                                <div class="post_content">
                                    <p>{!! $blogpost->post_details !!}</p>
                                </div>

                            </figcaption>
                        </figure>
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox_wup6"></div>
                    </article>




                </div>
                <!--blog grid area start-->
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="blog_sidebar_widget">

                    <div class="widget_list widget_categories">
                        <div class="widget_title">
                            <h3>Categorii Blog</h3>
                        </div>
                        @foreach ($blogcategory as $category)
                            <ul>
                                <li><a
                                        href="{{ url('blog/category/post/' . $category->id) }}">{{ $category->blog_category_name }}</a>
                                </li>
                            </ul>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--blog section area end-->
{{-- script addthis.com pentru butoane de social media share --}}
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6278053b87584298"></script>
@endsection
