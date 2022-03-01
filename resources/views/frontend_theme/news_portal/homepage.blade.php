@extends('frontend_theme.news_portal.front_layout.app')

@section('styles')
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
<style>
    .common-heading-style {
    width: 100%;
}
.common-heading-text {
    line-height: 36px;
    background: #343334;
    margin-bottom: 15px;
}
.common-heading-text .read-more-left {
    background: #ff4444;
    padding: 0 20px;
    line-height: 36px;
    display: inline-block;
    position: relative;
    padding-top: 4px;
    font-size: 24px;
}
.common-heading-text .read-more-left a {
    color: #fff;
}
.common-heading-text .read-more-right {
    float: right;
    padding-right: 15px;
    font-size: 22px;
    line-height: 40px;
}
.common-heading-text .read-more-left:before {
    content: "";
    width: 1px;
    height: 1px;
    position: absolute;
    left: 100%;
    top: 0;
    border-top: 40px solid #ff4444;
    border-right: 35px solid transparent;
    border-bottom: 0;
    border-left: 0;
}
</style>
@endsection

@section('content')

<section id="content">
    <div class="content-wrap">

        {{-- <div class="section header-stick bottommargin-lg py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-auto">
                        <div class="d-flex">
                            <span class="badge bg-danger text-uppercase col-auto">Breaking News</span>
                        </div>
                    </div>

                    <div class="col-lg mt-2 mt-lg-0">
                        <div class="fslider" data-speed="800" data-pause="6000" data-arrows="false" data-pagi="false" style="min-height: 0;">
                            <div class="flexslider">
                                <div class="slider-wrap">
                                    <div class="slide"><a href="#"><strong>Russia hits back, says US acts like a 'bad surgeon'..</strong></a></div>
                                    <div class="slide"><a href="#"><strong>'Sulking' Narayan Rane needs consolation: Uddhav reacts to Cong leader's attack..</strong></a></div>
                                    <div class="slide"><a href="#"><strong>Rane needs consolation. I pray to God that he gets mental peace in a political party..</strong></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="container clearfix">

            <div class="row">
                <div class="col-lg-9 bottommargin">
                    <div class="row">
                        @foreach (\App\Models\blog\Post::where('hot_news', 1)->orderBy('id', 'desc')->take(6)->get() as $key => $post)
                        @if ($post->status == 1)
                        <div class="col-md-4 mb-3">
                            @include('frontend_theme.news_portal.partials.news_box_2',['post'=>$post])
                        </div>


                        @endif
                        @endforeach
                    </div>

                </div>
                <div class="col-lg-3" id="mobile_tv">
                    <div class="col-12">
                        <div class="fslider flex-thumb-grid grid-6" data-animation="fade" data-arrows="true" data-thumbs="true">
                            <div class="flexslider">

                                @foreach (\App\Models\Program\Program::all() as $program)
                                    @php
                                        //$program = \App\Models\Program\Program::find(5);
                                        // $today = date("Y/m/d");
                                        // $to_day=date("Y-m-d",strtotime($today));
                                        $mytime = Carbon\Carbon::now();
                                        $start = Carbon\Carbon::parse($mytime)->format('h:i a');
                                        $today = date("Y/m/d h:i a");
                                        $to_day=date("Y-m-d h:i a",strtotime($today));
                                        // $from_datetime=date("Y-m-d",strtotime($program->start_datetime));
                                        // $from_time=date("h:i a",strtotime($program->start_time));
                                        // $to_datetime=date("Y-m-d",strtotime($program->end_datetime));
                                        // $to_time=date("h:i a",strtotime($program->end_time));
                                    @endphp
                                    @if($to_day >= $program->start_datetime && $to_day <= $program->end_datetime)
                                    @if ($program->video != null)
                                    <video  style="background: black;" id='videoElem' width=640 height=425 controls controlsList='nodownload'  playsinline muted autoplay>
                                        <source  src="{{asset('uploads/video/'.$program->video)}}"  type="video/mp4" />
                                    </video>
                                    @else
                                    {{-- <iframe width='640' id='existing-iframe-example' height='425' src='https://www.youtube.com/embed/"kB4mWA-Rhak"??controls=0&autoplay=1'
                                    title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen>
                                    </iframe> --}}
                                    <iframe  style="background: black;" width="640" height="425" id='existing-iframe-example' src="https://www.youtube.com/embed/{{$program->embed_code}}?autoplay=1&mute=1&enablejsapi=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    {{-- <iframe id="ik_player_iframe" frameborder="0" height="315" src="http://www.youtube.com/embed/5EnL2WXsxNQ?enablejsapi=1" width="560"></iframe> --}}
                                    {{-- <iframe id="existing-iframe-example"
                                            width="640" height="360"
                                            src="https://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1"
                                            frameborder="0"
                                            style="border: solid 4px #37474F"
                                    ></iframe> --}}
                                    @endif

                                    @endif

                                    @endforeach

                                    @php
                                        $last_video = \App\Models\Program\Program::orderBy('id','desc')->first();
                                    @endphp
                                    @if ($last_video->end_datetime < $to_day)
                                    @if ($last_video->video != null)
                                    <video  style="background: black;" id='videoElem' width=300 height=225 controls controlsList='nodownload'  playsinline muted autoplay>
                                        <source  src="{{asset('uploads/video/'.$last_video->video)}}"  type="video/mp4" />
                                    </video>
                                    @else
                                    <iframe  style="background: black;" width="300" height="225" id='existing-iframe-example' src="https://www.youtube.com/embed/{{$last_video->embed_code}}?autoplay=1&mute=1&enablejsapi=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    @endif
                                    @endif

                                    {{-- <div style="width: 640px; height: 425px; background: black;">
                                        <p style="color: white; jutify-content: center;">LIVE VIDEO</p>
                                    </div> --}}
                                    {{-- <div style="background: black;" id="elvideo"></div> --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    @php
                    $categories = App\Models\Program\Programcategory::all();
                    $today = date("Y/m/d h:i a");
                    $to_day=date("Y-m-d h:i a",strtotime($today));
                    $programs = App\Models\Program\Program::where('end_datetime','<',$to_day)->get();
                @endphp
                @include('frontend_theme.news_portal.video',[['categories'=>$categories],['programs'=>$programs]])
                </div>
            </div>

            <div class="row">
                <div class="col-lg-9 bottommargin">

                    <div class="row col-mb-50">


                        <div class="body-position-1" style="margin-top: 20px;">
                            @foreach (\App\Models\blog\category::where([['position','=','Body-Position-1'],['status','=',1]])->get() as $category)
                            @if ($category->childrenRecursive->isEmpty())
                            <div class="col-12" style="margin-bottom: 20px;">

                                <div class="common-heading-style">
                                    <h2 class="common-heading-text"><span class="read-more-left"><a href="{{route('categories',$category->parent->slug)}}"> {{$category->name}} </a></span><span class="read-more-right"><a href="{{route('categories',$category->parent->slug)}}">আরও</a></span></h2>
                                </div>

                                <div class="row posts-md col-mb-30">

                                    @foreach ($category->posts()->orderBy('id','desc')->take(4)->get() as $post)
                                    @if ($post->status == 1)
                                    <div class="entry col-sm-6 col-xl-3">
                                        @include('frontend_theme.news_portal.partials.news_box_3',['post'=>$post])
                                    </div>
                                    @endif
                                    @endforeach

                                </div>
                            </div>

                            @else

                            <div class="col-12" style="margin-bottom: 20px;">

                                <div class="common-heading-style">
                                    <h2 class="common-heading-text"><span class="read-more-left"><a href="{{route('categories',$category->slug)}}"> {{$category->name}} </a></span><span class="read-more-right"><a href="{{route('categories',$category->slug)}}">আরও</a></span></h2>
                                </div>

                                <div class="row posts-md col-mb-30">
                                    @php
                                    $data = [];
                                    @endphp
                                    @foreach($category->childrenRecursive as $key => $subcat)
                                    @foreach ($subcat->posts()->orderBy('id','desc')->get() as $post)
                                    @if ($post->status == 1)
                                    @php
                                    $data[] = $post;
                                    @endphp

                                    @endif
                                    @endforeach
                                    @endforeach

                                    @php
                                        $postdata = array_slice($data, 0,4);
                                    @endphp
                                    @foreach ($postdata as $post)
                                    <div class="entry col-sm-6 col-xl-3">
                                        @include('frontend_theme.news_portal.partials.news_box_3',['post'=>$post])
                                    </div>
                                    @endforeach

                                </div>
                            </div>

                            @endif
                            @endforeach

                            @php
                            $today = date("Y/m/d");
                            $to_day=date("Y-m-d",strtotime($today));
                            @endphp
                            @foreach (\App\Models\Advertisement\Advertisement::where([['position','=','Body-Position-1'],['status','=',1]])->get() as $advertisement)
                            @php
                                $from_datee=date("Y-m-d",strtotime($advertisement->start_date));
                                $to_datee=date("Y-m-d",strtotime($advertisement->end_date));
                            @endphp
                            @if ($to_day >= $from_datee && $to_day <= $to_datee)
                            <div class="col-12" style="margin-top: 10px;">
                               <a href="{{$advertisement->url}}"> <img  src="{{asset('uploads/advertisement/'.$advertisement->banner)}}" alt="Ad"> </a>
                            </div>
                            @else
                            @endif
                            @endforeach
                        </div>




                        <div class="body-position-2" style="margin-top: 20px;">
                            @foreach (\App\Models\blog\category::where([['position','=','Body-Position-2'],['status','=',1]])->get() as $category)

                            @if(!$category->childrenRecursive->isEmpty())

                            <div class="col-12" style="margin-bottom: 20px;">
                                {{-- <div class="fancy-title title-border">
                                    <h3>{{$category->name}}</h3>
                                </div> --}}
                                <div class="common-heading-style">
                                    <h2 class="common-heading-text"><span class="read-more-left"><a href="{{route('categories',$category->slug)}}"> {{$category->name}} </a></span><span class="read-more-right"><a href="{{route('categories',$category->slug)}}">আরও</a></span></h2>
                                </div>

                                @php
                                if($category->childrenRecursive->isEmpty())
                                {
                                    $latest_news = $category->posts->first();
                                }
                                else {
                                    foreach($category->childrenRecursive as $key => $subcat)
                                    {
                                        //$latest_news = $subcat->posts()->latest('id')->first();
                                        foreach ($subcat->posts as $post)
                                        {
                                            $latest_news = $post;
                                        }
                                    }
                                }
                                @endphp

                                {{-- @if (!$subcat->posts->isEmpty()) --}}

                                <div class="posts-md">
                                    <div class="entry row mb-5">
                                        <div class="col-md-4" id="single_news">
                                            <div class="entry-image-body">
                                                <a href="{{route('news.details',$latest_news->slug)}}"><img src="{{asset('uploads/postphoto/'.$latest_news->image)}}" alt="Image"></a>
                                                <div class="centered"><a href="{{route('news.details',$latest_news->slug)}}" style="text-shadow: 1px 1px 1px #000;">{{$latest_news->title}}</a></div>
                                            </div>
                                        </div>

                                        <div class="col-md-8 mt-3 mt-md-0">
                                            @php
                                            $second_data = [];
                                            @endphp
                                            <div class="row">
                                            @foreach($category->childrenRecursive as $key => $subcat)
                                            @foreach ($subcat->posts()->orderBy('id','desc')->get() as $post)
                                            @if ($post->id != $latest_news->id)
                                            @if ($post->status == 1)
                                            @php
                                            $second_data[] = $post;
                                            @endphp
                                            @endif
                                            @endif
                                            @endforeach
                                            @endforeach

                                            @php
                                                $postdata_2 = array_slice($second_data, 0,4);
                                            @endphp
                                            @foreach ($postdata_2 as $post)
                                            <div class="col-md-6 mb-3">
                                                @include('frontend_theme.news_portal.partials.news_box_2',['post'=>$post])
                                            </div>
                                            @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @else

                            <div class="col-12" style="margin-bottom: 20px;">
                                {{-- <div class="fancy-title title-border">
                                    <h3>{{$category->name}}</h3>
                                </div> --}}
                                <div class="common-heading-style">
                                    <h2 class="common-heading-text"><span class="read-more-left"><a href="{{route('categories',$category->parent->slug)}}"> {{$category->name}} </a></span><span class="read-more-right"><a href="{{route('categories',$category->parent->slug)}}">আরও</a></span></h2>
                                </div>

                                @php
                                if($category->childrenRecursive->isEmpty())
                                {
                                    $latest_news = $category->posts->first();
                                }
                                else {
                                    foreach($category->childrenRecursive as $key => $subcat)
                                    {
                                        $latest_news = $subcat->posts->first();
                                    }
                                }
                                @endphp

                                {{-- @if (!$subcat->posts->isEmpty()) --}}

                                <div class="posts-md">
                                    <div class="entry row mb-5">
                                        <div class="col-md-4" id="single_news">
                                            <div class="entry-image-body">
                                                <a href="{{route('news.details',$latest_news->slug)}}"><img src="{{asset('uploads/postphoto/'.$latest_news->image)}}" alt="Image"></a>
                                                <div class="centered"><a href="{{route('news.details',$latest_news->slug)}}" style="text-shadow: 1px 1px 1px #000;">{{$latest_news->title}}</a></div>
                                            </div>
                                        </div>

                                        <div class="col-md-8 mt-3 mt-md-0">
                                            <div class="row">
                                            {{-- @foreach($category->childrenRecursive as $key => $subcat) --}}
                                            @foreach ($category->posts->take(5) as $post)
                                            @if ($post->id != $latest_news->id)
                                            @if ($post->status == 1)
                                            <div class="col-md-6 mb-3">
                                            @include('frontend_theme.news_portal.partials.news_box_2',['post'=>$post])
                                            </div>
                                            @endif
                                            @endif
                                            @endforeach
                                            {{-- @endforeach --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endif

                            @endforeach

                            @php
                            $today = date("Y/m/d");
                            $to_day=date("Y-m-d",strtotime($today));
                            @endphp
                            @foreach (\App\Models\Advertisement\Advertisement::where([['position','=','Body-Position-2'],['status','=',1]])->get() as $advertisement)
                            @php
                                $from_datee=date("Y-m-d",strtotime($advertisement->start_date));
                                $to_datee=date("Y-m-d",strtotime($advertisement->end_date));
                            @endphp
                            @if ($to_day >= $from_datee && $to_day <= $to_datee)
                            <div class="col-12" style="margin-top: 10px;">
                                <a href="{{$advertisement->url}}"> <img height="90" width="720" src="{{asset('uploads/advertisement/'.$advertisement->banner)}}" alt="Ad"> </a>
                            </div>
                            @else
                            @endif
                            @endforeach

                        </div>





                        {{-- <div class="body-position-2">
                            @foreach (\App\Models\blog\category::where('position','=','Body-Position-2')->get() as $category)
                            <div class="col-12">
                                <div class="fancy-title title-border">
                                    <h3>{{$category->name}}</h3>
                                </div>

                                <div class="masonry-thumbs grid-container grid-6" data-big="5" data-lightbox="gallery">
                                    @foreach ($category->posts as $post)
                                    <a class="grid-item" href="{{asset('uploads/postphoto/'.$post->image)}}" data-lightbox="gallery-item"><img src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Gallery Thumb 1"></a>
                                    <a class="grid-item" href="images/magazine/2.jpg" data-lightbox="gallery-item"><img src="images/magazine/thumb/2.jpg" alt="Gallery Thumb 2"></a>
                                    <a class="grid-item" href="images/magazine/3.jpg" data-lightbox="gallery-item"><img src="images/magazine/thumb/3.jpg" alt="Gallery Thumb 3"></a>
                                    <a class="grid-item" href="images/magazine/4.jpg" data-lightbox="gallery-item"><img src="images/magazine/thumb/4.jpg" alt="Gallery Thumb 4"></a>
                                    <a class="grid-item" href="images/magazine/5.jpg" data-lightbox="gallery-item"><img src="images/magazine/thumb/5.jpg" alt="Gallery Thumb 5"></a>
                                    <a class="grid-item" href="images/magazine/6.jpg" data-lightbox="gallery-item"><img src="images/magazine/thumb/6.jpg" alt="Gallery Thumb 6"></a>
                                    <a class="grid-item" href="images/magazine/7.jpg" data-lightbox="gallery-item"><img src="images/magazine/thumb/7.jpg" alt="Gallery Thumb 7"></a>
                                    <a class="grid-item" href="images/magazine/8.jpg" data-lightbox="gallery-item"><img src="images/magazine/thumb/8.jpg" alt="Gallery Thumb 8"></a>
                                    <a class="grid-item" href="images/magazine/9.jpg" data-lightbox="gallery-item"><img src="images/magazine/thumb/9.jpg" alt="Gallery Thumb 9"></a>
                                    <a class="grid-item" href="images/magazine/10.jpg" data-lightbox="gallery-item"><img src="images/magazine/thumb/10.jpg" alt="Gallery Thumb 10"></a>
                                    <a class="grid-item" href="images/magazine/11.jpg" data-lightbox="gallery-item"><img src="images/magazine/thumb/11.jpg" alt="Gallery Thumb 11"></a>
                                    <a class="grid-item" href="images/magazine/12.jpg" data-lightbox="gallery-item"><img src="images/magazine/thumb/12.jpg" alt="Gallery Thumb 12"></a>
                                    <a class="grid-item" href="images/magazine/13.jpg" data-lightbox="gallery-item"><img src="images/magazine/thumb/13.jpg" alt="Gallery Thumb 13"></a>
                                    <a class="grid-item" href="images/magazine/14.jpg" data-lightbox="gallery-item"><img src="images/magazine/thumb/14.jpg" alt="Gallery Thumb 14"></a>
                                    <a class="grid-item" href="images/magazine/15.jpg" data-lightbox="gallery-item"><img src="images/magazine/thumb/15.jpg" alt="Gallery Thumb 15"></a>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach

                            <div class="col-12" style="margin-top: 10px;">
                                <img height="90" width="720" src="{{asset('assets/frontend/images/banner2.jpg')}}" alt="Ad">
                            </div>

                        </div> --}}

                        <div class="body-position-3" style="margin-top: 20px;">
                            @foreach (\App\Models\blog\category::where([['position','=','Body-Position-3'],['status','=',1]])->get() as $category)
                            @if ($category->childrenRecursive->isEmpty())
                            <div class="col-12" style="margin-bottom: 20px;">

                                <div class="common-heading-style">
                                    <h2 class="common-heading-text"><span class="read-more-left"><a href="{{route('categories',$category->parent->slug)}}"> {{$category->name}} </a></span><span class="read-more-right"><a href="{{route('categories',$category->parent->slug)}}">আরও</a></span></h2>
                                </div>

                                <div class="row posts-md col-mb-30">

                                    @foreach ($category->posts()->orderBy('id','desc')->take(4)->get() as $post)
                                    @if ($post->status == 1)
                                    <div class="entry col-sm-6 col-xl-3">
                                        @include('frontend_theme.news_portal.partials.news_box_3',['post'=>$post])
                                    </div>
                                    @endif
                                    @endforeach

                                </div>
                            </div>

                            @else

                            <div class="col-12" style="margin-bottom: 20px;">

                                <div class="common-heading-style">
                                    <h2 class="common-heading-text"><span class="read-more-left"><a href="{{route('categories',$category->slug)}}"> {{$category->name}} </a></span><span class="read-more-right"><a href="{{route('categories',$category->slug)}}">আরও</a></span></h2>
                                </div>

                                <div class="row posts-md col-mb-30">
                                    @php
                                    $data = [];
                                    @endphp
                                    @foreach($category->childrenRecursive as $key => $subcat)
                                    @foreach ($subcat->posts()->orderBy('id','desc')->get() as $post)
                                    @if ($post->status == 1)
                                    @php
                                    $data[] = $post;
                                    @endphp

                                    @endif
                                    @endforeach
                                    @endforeach

                                    @php
                                        $postdata = array_slice($data, 0,4);
                                    @endphp
                                    @foreach ($postdata as $post)
                                    <div class="entry col-sm-6 col-xl-3">
                                        @include('frontend_theme.news_portal.partials.news_box_3',['post'=>$post])
                                    </div>
                                    @endforeach

                                </div>
                            </div>

                            @endif
                            @endforeach

                            @php
                            $today = date("Y/m/d");
                            $to_day=date("Y-m-d",strtotime($today));
                            @endphp
                            @foreach (\App\Models\Advertisement\Advertisement::where([['position','=','Body-Position-3'],['status','=',1]])->get() as $advertisement)
                            @php
                                $from_datee=date("Y-m-d",strtotime($advertisement->start_date));
                                $to_datee=date("Y-m-d",strtotime($advertisement->end_date));
                            @endphp
                            @if ($to_day >= $from_datee && $to_day <= $to_datee)
                            <div class="col-12" style="margin-top: 10px;">
                               <a href="{{$advertisement->url}}"> <img  src="{{asset('uploads/advertisement/'.$advertisement->banner)}}" alt="Ad"> </a>
                            </div>
                            @else
                            @endif
                            @endforeach
                        </div>




                        {{-- <div class="body-position-4" style="margin-top: 20px;">
                                <div class="col-12" style="margin-bottom: 20px;">

                                    <div class="fancy-title title-border">
                                        <h3>সর্বশেষ সময়</h3>
                                    </div>

                                    <div class="row posts-md col-mb-30">
                                        @foreach (\App\Models\blog\Post::orderBy('id', 'desc')->take(6)->get() as $post)
                                        @if ($post->status == 1)
                                        @include('frontend_theme.news_portal.partials.news_box_1',['post'=>$post])
                                        @endif
                                        @endforeach
                                    </div>
                                </div>

                                @php
                                $today = date("Y/m/d");
                                $to_day=date("Y-m-d",strtotime($today));
                                @endphp
                                @foreach (\App\Models\Advertisement\Advertisement::where([['position','=','Body-Position-1'],['status','=',1]])->get() as $advertisement)
                                @php
                                    $from_datee=date("Y-m-d",strtotime($advertisement->start_date));
                                    $to_datee=date("Y-m-d",strtotime($advertisement->end_date));
                                @endphp
                                @if ($to_day >= $from_datee && $to_day <= $to_datee)
                                <div class="col-12" style="margin-top: 10px;">
                                   <a href="{{$advertisement->url}}"> <img height="90" width="720" src="{{asset('uploads/advertisement/'.$advertisement->banner)}}" alt="Ad"></a>
                                </div>
                                @endif
                                @endforeach


                            </div> --}}

                    </div>

                </div>

                {{-- Sidebar --}}
                @include('frontend_theme.news_portal.front_layout.vertical.sidebar')


            </div>



        </div>
    </div>
</section><!-- #content end -->

@endsection()

@section('scripts')

{{-- <script src="http://www.youtube.com/iframe_api"></script> --}}

{{-- <script>
    var path = "{{route('search.news')}}";

    $('input.typehead').typeahead({
        source: function(terms,process)
        {
            return $.get(path,{terms:terms},function(data){
                return process(data);
            })
        }
    })
</script> --}}

<script type="text/javascript">
    var tag = document.createElement('script');
    tag.id = 'iframe-demo';
    tag.src = 'https://www.youtube.com/iframe_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;
    function onYouTubeIframeAPIReady() {
      player = new YT.Player('existing-iframe-example', {
          events: {
            //'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
      });
    }
//     function onYouTubeIframeAPIReady() {
//   var player;
//   player = new YT.Player('existing-iframe-example', {
//     videoId: 'M7lc1UVf-VE',
//     playerVars: { 'autoplay': 1, 'controls': 0 },
//     events: {
//       'onReady': onPlayerReady,
//       'onStateChange': onPlayerStateChange,
//       //'onError': onPlayerError
//     }
//   });
// }
    // function onPlayerReady(event) {
    //   alert('ready');
    // }

    function onPlayerStateChange(event) {
        if (event.data === YT.PlayerState.ENDED) {
            location.reload();
        }

    }


  </script>

<script>
    var videoplayer = document.getElementById('videoElem');
    videoplayer.onended = function(){
    location.reload();
   }

//    var ik_player;

// //this function is called by the API
// function onYouTubeIframeAPIReady() {
//   //creates the player object
//   ik_player = new YT.Player('ik_player_iframe');

//   console.log('Video API is loaded');

//   //subscribe to events
//   ik_player.addEventListener("onReady",       "onYouTubePlayerReady");
//   ik_player.addEventListener("onStateChange", "onYouTubePlayerStateChange");
// }

// function onYouTubePlayerReady() {
//   console.log('Video is ready to play');
// }

// function onYouTubePlayerStateChange(event) {
//   console.log('Video state changed');
//   if (event.data == YT.PlayerState.PLAYING) {
//         _gaq.push(['_trackEvent', 'Video', 'Play']);
//     }else if ( event.data == YT.PlayerState.ENDED){
//         _gaq.push(['_trackEvent', 'Video', 'Finish']);
//     }
// }


    // $(document).ready(function(){

    //     fetchvideo();

    // function fetchvideo()
    // {
    //     $.ajax({
    //         type: "GET",
    //         url: "{{route('home.video')}}",
    //         dtaType: "json",
    //         success: function(response)
    //         {


    //             $.each(response.prog_video, function(key, item){

    //             if(item.embed_code == null)
    //             {
    //                        var len= response.programs.length;
    //                        console.log(len);

    //                         function formatAMPM(date) {
    //                         var datee = date.getDate();
    //                         var month = date.getMonth() + 1;
    //                         var year = date.getFullYear();
    //                         var hours = date.getHours();
    //                         var minutes = date.getMinutes();
    //                         var ampm = hours >= 12 ? 'pm' : 'am';
    //                         hours = hours % 12;
    //                         //hours = hours ? hours : 12; // the hour '0' should be '12'
    //                         hours = hours < 10 ? '0'+hours : hours;
    //                         minutes = minutes < 10 ? '0'+minutes : minutes;
    //                         month = month < 10 ? '0'+month : month;
    //                         var strTime = datee + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes + ' ' + ampm;
    //                         var strTime = year + '-' + month + '-' + datee + ' ' + hours + ':' + minutes + ' ' + ampm;
    //                         return strTime;
    //                         }

    //                         var datetime = formatAMPM(new Date);



    //                         if(len == 1)
    //                         {
    //                             $.each(response.programs, function(key, item){
    //                                 document.getElementById('elvideo').innerHTML ="<video id='videoElement' width=640 height=425 controls controlsList='nodownload'  playsinline muted autoplay><p>Tu navegador no funciona, actualizalo</p></video>";
    //                                 var videoPlayer = document.getElementById('videoElement');
    //                                 videoPlayer.src = "http://localhost/News_portal/public/uploads/video/"+item;
    //                                 videoPlayer.onended = function(){
    //                                     location.reload();

    //                               }
    //                             });
    //                         }
    //                         else
    //                         {
    //                             var coma = response.programs.join(",");
    //                             var str = coma;
    //                             //var str = "VID-20220127-WA0010.mp4,VID-20220130-WA0000.mp4";
    //                             var n = str.includes(",");
    //                             if (n) {
    //                             var nArr = str.split(',');
    //                             // $.each(response.prog_video, function(key, item){
    //                             //     console.log(item.end_datetime);
    //                             //   if(datetime >= item.start_datetime && datetime <= item.end_datetime)
    //                             //   {
    //                                 document.getElementById('elvideo').innerHTML ="<video id='videoElement' width=640 height=425 controls controlsList='nodownload'  playsinline muted autoplay><p>Tu navegador no funciona, actualizalo</p></video>";
    //                             var videoPlayer = document.getElementById('videoElement');
    //                             videoPlayer.src = "http://localhost/News_portal/public/uploads/video/"+nArr[0];
    //                             i = 1;
    //                             videoPlayer.onended = function(){
    //                                 if (i < nArr.length) {
    //                                     videoPlayer.src = "http://localhost/News_portal/public/uploads/video/"+nArr[i];
    //                                 i++
    //                                 }

    //                               }
    //                             //   }
    //                             // });
    //                             }
    //                         }
    //             }
    //             else
    //             {
    //                 var len= response.embed_video.length;
    //                 if(len == 1)
    //                 {
    //                     // $.each(response.embed_video, function(key, item){
    //                     document.getElementById('elvideo').innerHTML ="<iframe width='640' height='425' src='https://www.youtube.com/embed/"+response.embed_video+"??controls=0&autoplay=1&muted=1' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
    //                     // });
    //                 }
    //                 else
    //                 {
    //                     var coma = response.embed_video.join(",");
    //                     var str = coma;
    //                     var n = str.includes(",");
    //                     if (n) {
    //                     var nArr = str.split(',');

    //                     document.getElementById('elvideo').innerHTML ="<iframe width='640' height='425' src='https://www.youtube.com/embed/"+nArr[0]+"?controls=0&autoplay=1&muted=1' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay;  clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
    //                     i = 1;

    //                     // videoPlayer.onended = function(){
    //                     //     if (i < nArr.length) {
    //                     //         document.getElementById('elvideo').innerHTML ="<iframe width='640' height='425' src='https://www.youtube.com/embed/"+nArr[i]+"?controls=0' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
    //                     //         i++;
    //                     //         }
    //                     //     }
    //                     }
    //                 }
    //             }


    //                     });

    //         }
    //     });
    // }

    // });



</script>


@endsection
