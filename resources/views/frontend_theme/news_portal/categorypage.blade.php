@extends('frontend_theme.news_portal.front_layout.app')

@section('styles')
<style>
.topnav {
  background-color: #d72924;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

/* #exTab1 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
} */

#exTab2 h3 {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

/* remove border radius for the tab */

#exTab1 .nav-pills > li > a {
  border-radius: 0;
  color: red;
}

#exTab1 ul
{
    list-style-type: none;
  margin-right: 20px;
  padding: 0;
}

/* change border radius for the tab , apply corners on top*/

#exTab3 .nav-pills > li > a {
  border-radius: 4px 4px 0 0 ;
}

#exTab3 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}
</style>
@endsection

@section('content')

<section id="content">
    <div class="content-wrap">


        <div class="container clearfix">

            <div class="row">
                <div class="col-lg-3 bottommargin">
                    <div class="col-12">
                        <a class="post-cat ts-orange-bg" href="#">Travel</a>
                        <img src="{{asset('assets/frontend/images/travel6.jpg')}}" alt="Snow" style="width:100%;">
                        <div class="centered"><a href="#">10 critical points from Zuckerberg’s epic security points manifesto <h5>March 21, 2019</h5></a></div>
                    </div>
                </br>
                    <div class="col-12">
                        <a class="post-cat ts-orange-bg" href="#">Travel</a>
                        <img src="{{asset('assets/frontend/images/sports2.jpg')}}" alt="Snow" style="width:100%;">
                        <div class="centered"><a href="#">10 critical points from Zuckerberg’s epic security points manifesto <h5>March 21, 2019</h5></a></div>
                    </div>

                    <style>
                        .centered {
                            position: absolute;
                            top: 70%;
                            left: 40%;
                            transform: translate(-50%, -50%);
                            }
                        .centered a,h5{
                            color: #fff;
                            font-weight: bold;
                            text-decoration: none;
                            outline: 0 solid;
                        }
                        .post-cat{
                            position: absolute;
                            left: 0;
                            top: 0;
                            margin-left: 30px;

                            /* position: relative; */
                            z-index: 1;
                            display: inline-block;
                            color: #fff;
                            font-size: 11px;
                            font-weight: 700;
                            text-transform: uppercase;
                            padding: 0px 10px;
                            /* margin-left: 40px; */
                            line-height: 21px;
                            height: 19px;
                            /* top: -1px; */
                            letter-spacing: .55px;
                        }
                        .ts-orange-bg {
                            background: #ff6e0d;
                        }
                    </style>
                </div>
                <div class="col-lg-6 bottommargin">
                    <div class="col-12">
                        <div class="fslider flex-thumb-grid grid-6" data-animation="fade" data-arrows="true" data-thumbs="true">
                            <div class="flexslider">

                                    <div id="elvideo"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 bottommargin">
                    <div class="col-12">
                        <a class="post-cat ts-orange-bg" href="#">Travel</a>
                        <img src="{{asset('assets/frontend/images/health3.jpg')}}" alt="Snow" style="width:100%;">
                        <div class="centered"><a href="#">10 critical points from Zuckerberg’s epic security points manifesto <h5>March 21, 2019</h5></a></div>
                    </div>
                </br>
                    <div class="col-12">
                        <a class="post-cat ts-orange-bg" href="#">Travel</a>
                        <img src="{{asset('assets/frontend/images/music1.jpg')}}" alt="Snow" style="width:100%;">
                        <div class="centered"><a href="#">10 critical points from Zuckerberg’s epic security points manifesto <h5>March 21, 2019</h5></a></div>
                    </div>
                </div>
            </div>
<input type="hidden" id="category_id" value="{{$category->id}}">
            <div class="row">
                <div class="col-lg-12 bottommargin">
                    <div class="container"><h1>Bootstrap  tab panel example (using nav-pills)  </h1></div>
                    <div id="exTab1" class="containe">
                            <div class="topnav">
                                @if($category->childrenRecursive->count()>0)
                                @foreach($category->childrenRecursive as $key => $sub)
                                <a data-toggle="tab" class="tab "  href="#{{$sub->slug}}">{{$sub->name}}</a>
                                @endforeach
                                @endif
                              </div>
                            </br>
                                <div class="tab-content clearfix">
                                    @if($category->childrenRecursive->count()>0)
                                    @foreach($category->childrenRecursive as $key => $subcat)
                                    <div class="tab-pane" id="{{$subcat->slug}}">
                                        <div class="row posts-md col-mb-30">
                                            @foreach ($subcat->posts()->orderBy('id', 'desc')->take(3)->get() as $news)
                                            @if ($news->status == 1)
                                            <div class=" entry col-sm-6 col-xl-4">
                                                <div class="grid-inner">
                                                    <div class="entry-image">
                                                        <a href="#"><img src="{{asset('uploads/postphoto/'.$news->image)}}" alt="Image"></a>
                                                    </div>
                                                    <div class="entry-title title-xs nott">
                                                        <h3><a href="blog-single.html">{{$news->title}}</a></h3>
                                                    </div>
                                                    <div class="entry-meta">
                                                        <ul>
                                                            <li><i class="icon-calendar3"></i> {{ $news->created_at->format('j-F-Y') }}</li>
                                                            <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 23</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="entry-content">
                                                        <p>{!!Str::limit($news->body, 100)!!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            {{-- <a href="#hem" style="width: 40%; text-align: center;" class="btn btn-outline-success" >More</a> --}}
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif

                                </div>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-8 bottommargin">

                    <div class="row col-mb-50">


                        <div class="body-position-2" style="margin-top: 20px;">
                            <div class="col-12" style="margin-bottom: 20px;">

                                <div class="fancy-title title-border">
                                    <h3>সর্বশেষ সময়</h3>
                                </div>

                                <div class="row posts-md col-mb-30">
                                    @foreach (\App\Models\blog\Post::orderBy('id', 'desc')->take(6)->get() as $post)
                                    @if ($post->status == 1)
                                    <div class="entry col-sm-6 col-xl-4">
                                        <div class="grid-inner">
                                            <div class="entry-image">
                                                <a href="#"><img src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Image"></a>
                                            </div>
                                            <div class="entry-title title-xs nott">
                                                <h3><a href="blog-single.html">{{$post->title}}</a></h3>
                                            </div>
                                            <div class="entry-meta">
                                                <ul>
                                                    <li><i class="icon-calendar3"></i> {{ $post->created_at->format('j-F-Y') }}</li>
                                                    <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 23</a></li>
                                                </ul>
                                            </div>
                                            <div class="entry-content">
                                                <p>{!!Str::limit($post->body, 100)!!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-12" style="margin-top: 10px; margin-left: 50px;">
                                <img height="90" width="720" src="{{asset('assets/frontend/images/banner2.jpg')}}" alt="Ad">
                            </div>
                        </div>

<section id="hem">

    {{-- <div class="body-position-1">
        <div class="col-12" style="margin-top: 20px;">
            <div class="fancy-title title-border">
                <h3>আরও সংবাদ</h3>
            </div>
            @foreach($category->childrenRecursive as $key => $subcat)
            @foreach ($subcat->posts as $news)
            @if ($news->status == 1)
            <div class="posts-md">
                <div class="entry row mb-5">
                    <div class="col-md-3">
                        <div class="entry-image">
                            <a href="#"><img src="{{asset('uploads/postphoto/'.$news->image)}}" alt="Image"></a>
                        </div>
                    </div>
                    <div class="col-md-9 mt-3 mt-md-0">
                        <div class="entry-title title-sm nott">
                            <h3><a href="blog-single.html">{{$news->title}}</a></h3>
                        </div>
                        <div class="entry-meta">
                            <ul>
                                <li><i class="icon-calendar3"></i> {{ $news->created_at->format('j-F-Y') }}</li>
                                <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 21</a></li>
                                <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                            </ul>
                        </div>
                        <div class="entry-content">
                            <p class="mb-0">{!!Str::limit($news->body, 100)!!}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @endforeach

        </div>

        <div class="col-12" style="margin-top: 10px; margin-left: 50px;">
            <img height="90" width="720" src="{{asset('assets/frontend/images/banner2.jpg')}}" alt="Ad">
        </div>

    </div> --}}


    <div class="body-position-1">
        <div class="col-12" style="margin-top: 20px;">
            <div class="fancy-title title-border">
                <h3>আরও সংবাদ</h3>
            </div>

            <div id="news_body">
            </div>

        </div>

        <div class="col-12" style="margin-top: 10px; margin-left: 50px;">
            <img height="90" width="720" src="{{asset('assets/frontend/images/banner2.jpg')}}" alt="Ad">
        </div>

    </div>
</section>


                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="line d-block d-lg-none"></div>

                    <div class="sidebar-widgets-wrap clearfix">

                        <div class="widget clearfix">
                            <div class="row gutter-20 col-mb-30">
                                <div class="col-4">
                                    <a href="#" class="social-icon si-dark si-colored si-facebook mb-0" style="margin-right: 10px;">
                                        <i class="icon-facebook"></i>
                                        <i class="icon-facebook"></i>
                                    </a>
                                    <div class="counter counter-inherit d-inline-block text-smaller"><span class="d-block fw-bold" data-from="1000" data-to="58742" data-refresh-interval="100" data-speed="3000" data-comma="true"></span><small>Likes</small></div>
                                </div>

                                <div class="col-4">
                                    <a href="#" class="social-icon si-dark si-colored si-twitter mb-0" style="margin-right: 10px;">
                                        <i class="icon-twitter"></i>
                                        <i class="icon-twitter"></i>
                                    </a>
                                    <div class="counter counter-inherit d-inline-block text-smaller"><span class="d-block fw-bold" data-from="500" data-to="9654" data-refresh-interval="50" data-speed="2500" data-comma="true"></span><small>Followers</small></div>
                                </div>

                                <div class="col-4">
                                    <a href="#" class="social-icon si-dark si-colored si-rss mb-0" style="margin-right: 10px;">
                                        <i class="icon-rss"></i>
                                        <i class="icon-rss"></i>
                                    </a>
                                    <div class="counter counter-inherit d-inline-block text-smaller"><span class="d-block fw-bold" data-from="200" data-to="15475" data-refresh-interval="150" data-speed="3500" data-comma="true"></span><small>Readers</small></div>
                                </div>
                            </div>
                        </div>

                        <div class="widget clearfix">
                            <img class="aligncenter" src="{{asset('assets/frontend/images/ad.png')}}" alt="Image">
                        </div>

                        <div class="widget widget_links clearfix">

                            <h4>Categories</h4>

                            <div class="row col-mb-30">
                                <div class="col-sm-6">
                                    <ul>
                                        <li><a href="#">World</a></li>
                                        <li><a href="#">Technology</a></li>
                                        <li><a href="#">Entertainment</a></li>
                                        <li><a href="#">Sports</a></li>
                                        <li><a href="#">Media</a></li>
                                        <li><a href="#">Politics</a></li>
                                        <li><a href="#">Business</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul>
                                        <li><a href="#">Lifestyle</a></li>
                                        <li><a href="#">Travel</a></li>
                                        <li><a href="#">Cricket</a></li>
                                        <li><a href="#">Football</a></li>
                                        <li><a href="#">Education</a></li>
                                        <li><a href="#">Photography</a></li>
                                        <li><a href="#">Nature</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="widget clearfix">

                            <h4>Twitter Feed Scroller</h4>
                            <div class="fslider customjs testimonial twitter-scroll twitter-feed" data-username="envato" data-count="2" data-animation="slide" data-arrows="false">
                                <i class="i-plain color icon-twitter mb-0" style="margin-right: 15px;"></i>
                                <div class="flexslider" style="width: auto;">
                                    <div class="slider-wrap">
                                        <div class="slide"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="widget clearfix">

                            <h4>Flickr Photostream</h4>
                            <div id="flickr-widget" class="flickr-feed masonry-thumbs grid-container grid-5" data-id="613394@N22" data-count="15" data-type="group" data-lightbox="gallery"></div>

                        </div>

                        <div class="widget clearfix">

                            <div class="tabs mb-0 clearfix" id="sidebar-tabs">

                                <ul class="tab-nav clearfix">
                                    <li><a href="#tabs-1">Popular</a></li>
                                    <li><a href="#tabs-2">Recent</a></li>
                                    <li><a href="#tabs-3"><i class="icon-comments-alt me-0"></i></a></li>
                                </ul>

                                <div class="tab-container">

                                    <div class="tab-content clearfix" id="tabs-1">
                                        <div class="posts-sm row col-mb-30" id="popular-post-list-sidebar">
                                            <div class="entry col-12">
                                                <div class="grid-inner row g-0">
                                                    <div class="col-auto">
                                                        <div class="entry-image">
                                                            <a href="#"><img class="rounded-circle" src="images/magazine/small/3.jpg" alt="Image"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col ps-3">
                                                        <div class="entry-title">
                                                            <h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                        </div>
                                                        <div class="entry-meta">
                                                            <ul>
                                                                <li><i class="icon-comments-alt"></i> 35 Comments</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="entry col-12">
                                                <div class="grid-inner row g-0">
                                                    <div class="col-auto">
                                                        <div class="entry-image">
                                                            <a href="#"><img class="rounded-circle" src="images/magazine/small/2.jpg" alt="Image"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col ps-3">
                                                        <div class="entry-title">
                                                            <h4><a href="#">Elit Assumenda vel amet dolorum quasi</a></h4>
                                                        </div>
                                                        <div class="entry-meta">
                                                            <ul>
                                                                <li><i class="icon-comments-alt"></i> 24 Comments</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="entry col-12">
                                                <div class="grid-inner row g-0">
                                                    <div class="col-auto">
                                                        <div class="entry-image">
                                                            <a href="#"><img class="rounded-circle" src="images/magazine/small/1.jpg" alt="Image"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col ps-3">
                                                        <div class="entry-title">
                                                            <h4><a href="#">Debitis nihil placeat, illum est nisi</a></h4>
                                                        </div>
                                                        <div class="entry-meta">
                                                            <ul>
                                                                <li><i class="icon-comments-alt"></i> 19 Comments</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-content clearfix" id="tabs-2">
                                        <div class="posts-sm row col-mb-30" id="recent-post-list-sidebar">
                                            <div class="entry col-12">
                                                <div class="grid-inner row g-0">
                                                    <div class="col-auto">
                                                        <div class="entry-image">
                                                            <a href="#"><img class="rounded-circle" src="images/magazine/small/1.jpg" alt="Image"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col ps-3">
                                                        <div class="entry-title">
                                                            <h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                        </div>
                                                        <div class="entry-meta">
                                                            <ul>
                                                                <li>10th July 2021</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="entry col-12">
                                                <div class="grid-inner row g-0">
                                                    <div class="col-auto">
                                                        <div class="entry-image">
                                                            <a href="#"><img class="rounded-circle" src="images/magazine/small/2.jpg" alt="Image"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col ps-3">
                                                        <div class="entry-title">
                                                            <h4><a href="#">Elit Assumenda vel amet dolorum quasi</a></h4>
                                                        </div>
                                                        <div class="entry-meta">
                                                            <ul>
                                                                <li>10th July 2021</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="entry col-12">
                                                <div class="grid-inner row g-0">
                                                    <div class="col-auto">
                                                        <div class="entry-image">
                                                            <a href="#"><img class="rounded-circle" src="images/magazine/small/3.jpg" alt="Image"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col ps-3">
                                                        <div class="entry-title">
                                                            <h4><a href="#">Debitis nihil placeat, illum est nisi</a></h4>
                                                        </div>
                                                        <div class="entry-meta">
                                                            <ul>
                                                                <li>10th July 2021</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-content clearfix" id="tabs-3">
                                        <div class="posts-sm row col-mb-30" id="recent-comments-list-sidebar">
                                            <div class="entry col-12">
                                                <div class="grid-inner row g-0">
                                                    <div class="col-auto">
                                                        <div class="entry-image">
                                                            <a href="#"><img class="rounded-circle" src="images/icons/avatar.jpg" alt="User Avatar"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col ps-3">
                                                        <strong>John Doe:</strong> Veritatis recusandae sunt repellat distinctio...
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="entry col-12">
                                                <div class="grid-inner row g-0">
                                                    <div class="col-auto">
                                                        <div class="entry-image">
                                                            <a href="#"><img class="rounded-circle" src="images/icons/avatar.jpg" alt="User Avatar"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col ps-3">
                                                        <strong>Mary Jane:</strong> Possimus libero, earum officia architecto maiores....
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="entry col-12">
                                                <div class="grid-inner row g-0">
                                                    <div class="col-auto">
                                                        <div class="entry-image">
                                                            <a href="#"><img class="rounded-circle" src="images/icons/avatar.jpg" alt="User Avatar"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col ps-3">
                                                        <strong>Site Admin:</strong> Deleniti magni labore laboriosam odio...
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="widget clearfix">
                            <iframe src="https://player.vimeo.com/video/100299651" width="500" height="264" allow="autoplay; fullscreen" allowfullscreen></iframe>
                        </div>

                        <div class="widget clearfix">
                            <img class="aligncenter" src="{{asset('assets/frontend/images/banner2.jpg')}}" alt="Image">
                            {{-- <img height="90" width="720" src="{{asset('assets/frontend/images/banner2.jpg')}}" alt="Ad"> --}}
                        </div>

                        <div class="widget clearfix">
                            <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FEnvato&amp;width=350&amp;height=240&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=499481203443583" style="border:none; overflow:hidden; width:350px; height:240px; max-width: 100% !important;"></iframe>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section><!-- #content end -->

@endsection()

@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){

    fetchnews();

    function fetchnews()
    {
    //  var cat_id = document.getElementById("category_id").value;
    //  alert(cat_id);
    var urll = '{{ route('fetchnews',$category->id) }}';
    //urll = urll.replace(':id', data);
    $.ajax({
        type: "GET",
        url: urll,
        dtaType: "json",
        success: function(response)
        {

            $('#news_body').html('');
            // $.each(response.news[0], function(key, item){


                $('#news_body').html(response.news);
            //  });
        }
    });
    }
});
    </script>

    <script>
        $(document).ready(function() {
            $('.tab:first-child').addClass('active');
            $(".tab-pane:first-child").addClass("active");
        $(".tab").click(function () {
            $(".tab").removeClass("active");
            // $(".tab").addClass("active"); // instead of this do the below
            $(this).addClass("active");
        });
        });
    </script>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
</script>


@endsection
