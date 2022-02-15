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
                <div class="postcontent col-lg-9">

                    <div class="single-post mb-0">

                        <!-- Single Post
                        ============================================= -->
                        <div class="entry clearfix">

                            <!-- Entry Title
                            ============================================= -->
                            <div class="entry-title">
                                <h1>{{$news->title}}</h1>
                            </div><!-- .entry-title end -->

                            <!-- Entry Meta
                            ============================================= -->
                            <div class="entry-meta">
                                <ul>
                                    <li><i class="icon-calendar3"></i>{{ $news->created_at->format('h-i a') }} {{ $news->created_at->format('j-F-Y') }} </li>
                                    <li>@foreach ($news->categories as $category)
                                        <a href="{{route('categories.all',$category->parent->slug)}}">
                                        {{$category->parent->name}} </a>
                                    @endforeach</li></li>
                                    <li><i class="icon-category"></i>@foreach ($news->categories as $category)
                                        {{$category->name}}
                                    @endforeach</li>
                                </ul>
                            </div><!-- .entry-meta end -->

                            <!-- Entry Image
                            ============================================= -->
                            <div class="entry-image">
                                <a href="#"><img src="{{asset('uploads/postphoto/'.$news->image)}}" alt="Blog Single"></a>
                            </div><!-- .entry-image end -->

                            <!-- Entry Content
                            ============================================= -->
                            <div class="entry-content mt-0">

                                {!!$news->body!!}

                                <!-- Tag Cloud
                                ============================================= -->
                                {{-- <div class="tagcloud clearfix bottommargin">
                                    @foreach ($news->categories as $category)
                                    <a href="{{route('categories.all',$category->parent->slug)}}">{{$category->parent->name}}</a>
                                    @endforeach

                                    <a href="#">information</a>
                                    <a href="#">media</a>
                                    <a href="#">press</a>
                                    <a href="#">gallery</a>
                                    <a href="#">illustration</a>
                                </div><!-- .tagcloud end --> --}}

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



                        <div class="line"></div>



                        <div class="col-12" style="margin-bottom: 20px;">

                            <div class="fancy-title title-border">
                                <h3>আরও সংবাদ</h3>
                            </div>

                            <div class="row posts-md col-mb-30">
                                @php
                                $data = [];
                                @endphp
                                @foreach($category_id->childrenRecursive as $key => $subcat)
                                @foreach ($subcat->posts()->orderBy('id', 'desc')->get() as $post)
                                @if ($post->status == 1)
                                @if ($post->id != $news->id)
                                @php
                                   $data[] = $post;
                                @endphp
                                @endif
                                @endif
                                @endforeach
                                @endforeach

                                @php
                                $postdata = array_slice($data, 0,6);
                                @endphp
                                @foreach ($postdata as $post)
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
                                @endforeach

                            </div>



                        </div>



                    </div>

                </div><!-- .postcontent end -->

                {{-- Sidebar --}}
                @include('frontend_theme.news_portal.front_layout.vertical.sidebar')


            </div>

        </div>
    </div>
</section>

@endsection()

@section('scripts')




@endsection
