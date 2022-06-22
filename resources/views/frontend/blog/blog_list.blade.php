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
                    @foreach ($blogpost as $blog)
                        <article class="single_blog">
                            <figure>
                                <div class="blog_thumb">
                                    <a href="{{ route('post.details', $blog->id) }}"><img class="img-responsive"
                                            src="{{ asset($blog->post_image) }}" alt=""></a>
                                </div>
                                <figcaption class="blog_content">
                                    <h4 class="post_title"><a
                                            href="{{ route('post.details', $blog->id) }}">{{ $blog->post_title }}</a>
                                    </h4>
                                    <div class="articles_date">
                                        <p>{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }} | <a
                                                href="#">{{ $blog->category->blog_category_name }}</a> </p>
                                    </div>
                                    <p class="post_desc">{!! Str::limit($blog->post_details, 200) !!}</p>
                                    <footer class="btn_more">
                                        <a href="{{ route('post.details', $blog->id) }}"> Afla mai multe</a>
                                    </footer>
                                </figcaption>
                            </figure>
                        </article>
                    @endforeach
                </div>
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
                    {{-- <div class="widget_list widget_tag">
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
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!--blog area end-->

<!--blog pagination area start-->
{{-- <div class="blog_pagination pagination_full">
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
</div> --}}
<!--blog pagination area end-->

@endsection
