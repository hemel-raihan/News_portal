@extends('frontend_theme.news_portal.front_layout.app')

@section('styles')

@endsection

@section('content')

<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="row gutter-40 col-mb-80">
                <!-- Post Content
                ============================================= -->
                <div class="postcontent col-lg-8">

                    <div class="single-post mb-0">

                        <!-- Single Post
                        ============================================= -->
                        <div class="entry clearfix">

                            <!-- Entry Title
                            ============================================= -->
                            <div class="entry-title">
                                <h2>{{$video->title}}</h2>
                            </div><!-- .entry-title end -->

                            <!-- Entry Meta
                            ============================================= -->
                            <div class="entry-meta">
                                <ul>
                                    <li><i class="icon-calendar3"></i> {{$video->end_datetime}}</li>
                                    <li><a href="#"><i class="icon-user"></i> {{$video->programcategory->name}}</a></li>
                                </ul>
                            </div><!-- .entry-meta end -->

                            <!-- Entry Image
                            ============================================= -->
                            <div class="entry-image">
                                @if ($video->video != null)
                                <video poster="images/videos/explore-poster.jpg" preload="auto" muted autoplay controls style="display: block; width: 100%;">
                                    <source src='{{asset('uploads/video/'.$video->video)}}' type='video/mp4' />
                                </video>
                                @else
                                <iframe width="640" height="425" id='existing-iframe-example' src="https://www.youtube.com/embed/{{$video->embed_code}}?autoplay=1&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @endif

                            </div><!-- .entry-image end -->

                            <!-- Entry Content
                            ============================================= -->
                            <div class="entry-content mt-0">

                                {!!$video->body!!}


                            @php
                            $today = date("Y/m/d");
                            $to_day=date("Y-m-d",strtotime($today));
                            @endphp
                            @foreach (\App\Models\Advertisement\Advertisement::where([['position','=','Single-Position-1'],['status','=',1]])->get() as $advertisement)
                            @php
                                $from_datee=date("Y-m-d",strtotime($advertisement->start_date));
                                $to_datee=date("Y-m-d",strtotime($advertisement->end_date));
                            @endphp
                            @if ($to_day >= $from_datee && $to_day <= $to_datee)
                            <div class="col-12" style="margin-top: 10px; margin-left: 50px;">
                               <a href="{{$advertisement->url}}"> <img height="90" width="720" src="{{asset('uploads/advertisement/'.$advertisement->banner)}}" alt="Ad"></a>
                            </div>
                            @else
                            @endif
                            @endforeach

                            </div>
                        </div><!-- .entry end -->

                    </div>

                </div><!-- .postcontent end -->

                <!-- Sidebar
                ============================================= -->
                <div class="sidebar col-lg-4">
                    <div class="sidebar-widgets-wrap">




                        <div class="widget clearfix">

                            <div class="tabs mb-0 clearfix" id="sidebar-tabs">

                                <ul class="tab-nav clearfix">
                                    <li><a href="#tabs-1">Related Videos</a></li>
                                </ul>

                                <div class="tab-container">

                                    <div class="tab-content clearfix" id="tabs-1">
                                        <div class="posts-sm row col-mb-30" id="popular-post-list-sidebar">
                                            @foreach ($progvideos as $progvideo)
                                            @if ($progvideo->id != $video->id)
                                            <div class="entry col-12">
                                                <div class="grid-inner row g-0">
                                                    <div class="col-auto">
                                                        <div class="entry-image">
                                                            <a href="#"><img class="rounded-circle" src="{{asset('uploads/video/'.$progvideo->poster)}}" alt="Image"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col ps-3">
                                                        <div class="entry-title">
                                                            <h4><a href="#">{{$progvideo->title}}</a></h4>
                                                        </div>
                                                        {{-- <div class="entry-meta">
                                                            <ul>
                                                                <li><i class="icon-comments-alt"></i> 35 Comments</li>
                                                            </ul>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                </div>

                            </div>

                        </div>



                    </div>
                </div><!-- .sidebar end -->
            </div>

        </div>
    </div>
</section>

@endsection()

@section('scripts')




@endsection
