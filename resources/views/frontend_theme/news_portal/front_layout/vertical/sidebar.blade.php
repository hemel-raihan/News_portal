@php
    $sidebars = \App\Models\Admin\Sidebar::where([['type','=','Right Side Bar'],['status','=',true]])->get();
    foreach($sidebars as $sidebar)
    {
        $widgets = $sidebar->widgets()->get();
    }
@endphp

<div class="col-lg-3">

    <div class="line d-block d-lg-none"></div>

    <div class="sidebar-widgets-wrap clearfix">
        @foreach ($widgets as $widget)

        <div class="widget clearfix">

            @if ($widget->type == 'Image Widget')
            <img class="aligncenter" src="{{asset('uploads/sidebarphoto/'.$widget->image)}}" alt="Image">
            @endif

            @if ($widget->type == 'Blog Category')
            <div class="tabs mb-0 clearfix" id="sidebar-tabs">

                <ul class="tab-nav clearfix">
                    <h4>{{$widget->title}}</h4>
                </ul>

                <div class="tab-container">

                    <div class="tab-content clearfix" id="tabs-1">
                        <div class="posts-sm row col-mb-30" id="popular-post-list-sidebar">

                            @if ($widget->category->childrenRecursive->isEmpty())
                            @foreach ($widget->category->posts()->orderBy('id', 'desc')->take($widget->no_of_post)->get() as $post)
                            <div class="entry col-12">
                                <div class="grid-inner row g-0">
                                    <div class="col-auto">
                                        <div class="entry-image">
                                            <a href="#"><img class="rounded-circle" src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Image"></a>
                                        </div>
                                    </div>
                                    <div class="col ps-3">
                                        <div class="entry-title">
                                            <h4><a href="#">{{$post->title}}</a></h4>
                                        </div>
                                        <div class="entry-meta">
                                            <ul>
                                                <li style="color: red">@foreach ($post->categories as $category)
                                                    {{$category->name}}
                                                @endforeach</li>
                                                <li>{{ $post->created_at->format('j-F-Y') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            @else

                            @php
                                $data = [];
                            @endphp
                            @foreach($widget->category->childrenRecursive as $key => $subcat)
                            @foreach ($subcat->posts()->orderBy('id','desc')->get() as $post)
                            @php
                            $data[] = $post;
                            @endphp
                            @endforeach
                            @endforeach
                            {{-- {{dd($data);}} --}}

                            @php
                                $postdata = array_slice($data, 0,$widget->no_of_post);
                                //dd($test);
                            @endphp
                            @foreach ($postdata as $post)

                            <div class="entry col-12">
                                <div class="grid-inner row g-0">
                                    <div class="col-auto">
                                        <div class="entry-image">
                                            <a href="#"><img class="rounded-circle" src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Image"></a>
                                        </div>
                                    </div>
                                    <div class="col ps-3">
                                        <div class="entry-title">
                                            <h4><a href="#">{{$post->title}}</a></h4>
                                        </div>
                                        <div class="entry-meta">
                                            <ul>
                                                <li style="color: red">@foreach ($post->categories as $category)
                                                    {{$category->name}}
                                                @endforeach</li>
                                                <li>{{ $post->created_at->format('j-F-Y') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach

                            @endif
                        </div>
                    </div>
                </div>

            </div>
            @endif

            @if ($widget->type == 'Recent Post')
            <div class="tabs mb-0 clearfix" id="sidebar-tabs">

                <ul class="tab-nav clearfix">
                    <h4>{{$widget->title}}</h4>
                </ul>

                <div class="tab-container">
                    <div class="tab-content clearfix" id="tabs-2">
                        <div class="posts-sm row col-mb-30" id="recent-post-list-sidebar">
                            @if ($widget->type == 'Recent Post')
                            @if ($widget->category->childrenRecursive->isEmpty())
                            @foreach ($widget->category->posts as $post)
                            <div class="entry col-12">
                                <div class="grid-inner row g-0">
                                    <div class="col-auto">
                                        <div class="entry-image">
                                            <a href="#"><img class="rounded-circle" src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Image"></a>
                                        </div>
                                    </div>
                                    <div class="col ps-3">
                                        <div class="entry-title">
                                            <h4><a href="#">{{$post->title}}</a></h4>
                                        </div>
                                        <div class="entry-meta">
                                            <ul>
                                                <li>{{ $post->created_at->format('j-F-Y') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            @else

                            @foreach($widget->category->childrenRecursive as $key => $subcat)
                            @foreach ($subcat->posts as $post)
                            <div class="entry col-12">
                                <div class="grid-inner row g-0">
                                    <div class="col-auto">
                                        <div class="entry-image">
                                            <a href="#"><img class="rounded-circle" src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Image"></a>
                                        </div>
                                    </div>
                                    <div class="col ps-3">
                                        <div class="entry-title">
                                            <h4><a href="#">{{$post->title}}</a></h4>
                                        </div>
                                        <div class="entry-meta">
                                            <ul>
                                                <li>{{ $post->created_at->format('j-F-Y') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endforeach
                            @endif
                            @endif
                        </div>
                    </div>


                </div>

            </div>
            @endif

        </div>
        @endforeach

        {{-- <div class="widget clearfix">
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
        </div> --}}

        {{-- <div class="widget clearfix">
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
        </div>

        <div class="widget clearfix">
            <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FEnvato&amp;width=350&amp;height=240&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=499481203443583" style="border:none; overflow:hidden; width:350px; height:240px; max-width: 100% !important;"></iframe>
        </div> --}}

    </div>

</div>
