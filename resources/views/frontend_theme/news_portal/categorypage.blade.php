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
            <div class="row">
                <div class="col-lg-12 bottommargin">
                    <div class="container"><h1>Bootstrap  tab panel example (using nav-pills)  </h1></div>
                    <div id="exTab1" class="containe">
                            <div class="topnav">
                                @if($single_category->childrenRecursive->count()>0)
                                @foreach($single_category->childrenRecursive as $key => $sub)
                                <a data-toggle="tab" class="tab "  href="#{{$sub->slug}}">{{$sub->name}}</a>
                                @endforeach
                                @endif
                              </div>
                            </br>
                                <div class="tab-content clearfix">
                                    @if($single_category->childrenRecursive->count()>0)
                                    @foreach($single_category->childrenRecursive as $key => $subcat)
                                    <div class="tab-pane" id="{{$subcat->slug}}">
                                        <div class="row posts-md col-mb-30">
                                            @foreach ($subcat->posts()->orderBy('id', 'desc')->take(3)->get() as $news)
                                            @if ($news->status == 1)
                                            <div class=" entry col-sm-6 col-xl-4">
                                                <div class="grid-inner">
                                                    <div class="entry-image">
                                                        <a href="{{route('news.details',$news->slug)}}"><img src="{{asset('uploads/postphoto/'.$news->image)}}" alt="Image"></a>
                                                    </div>
                                                    <div class="entry-title title-xs nott">
                                                        <h3><a href="{{route('news.details',$news->slug)}}">{{$news->title}}</a></h3>
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

                                        </div>
                                    </div>
                                    @endforeach
                                    @endif

                                </div>
                                <a href="#hem" style="margin-left: 40%;" class="button button-small button-circle button-green"><i class="icon-repeat"></i>More News</a>
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
                                                <a href="{{route('news.details',$post->slug)}}"><img src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Image"></a>
                                            </div>
                                            <div class="entry-title title-xs nott">
                                                <h3><a href="{{route('news.details',$post->slug)}}">{{$post->title}}</a></h3>
                                            </div>
                                            <div class="entry-meta">
                                                <ul>
                                                    <li><i class="icon-calendar3"></i> {{$post->created_at->diffForHumans()}}</li>
                                                    <li></i>@foreach ($post->categories as $category)
                                                        <a href="{{route('categories.all',$category->parent->slug)}}">
                                                        {{$category->parent->name}} </a>
                                                    @endforeach
                                                    </li>
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

    <div class="body-position-1">
        <div class="col-12" style="margin-top: 20px;">
            <div class="fancy-title title-border">
                <h3>আরও সংবাদ</h3>
            </div>
            @foreach($single_category->childrenRecursive as $key => $subcat)
            @foreach ($subcat->posts as $news)
            @if ($news->status == 1)
            {{-- @foreach (\App\Models\blog\Post::orderBy('id', 'desc')->take(6)->get() as $news) --}}
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
            {{-- @endforeach --}}
            @endif
            @endforeach
            @endforeach

        </div>

        <div class="col-12" style="margin-top: 10px; margin-left: 50px;">
            <img height="90" width="720" src="{{asset('assets/frontend/images/banner2.jpg')}}" alt="Ad">
        </div>

    </div>


    {{-- <div class="body-position-1">
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

    </div> --}}

</section>


                    </div>

                </div>

                @include('frontend_theme.news_portal.front_layout.vertical.sidebar')

            </div>

        </div>
    </div>
</section><!-- #content end -->

@endsection()

@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    {{-- <script>
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
    </script> --}}

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
