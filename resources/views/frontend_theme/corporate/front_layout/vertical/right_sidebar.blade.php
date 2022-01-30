<div class="sidebar col-lg-3">
    <div class="sidebar-widgets-wrap">

        @foreach ($widgets as $widget)
        <div class="widget clearfix">

            <h4>
                {{$widget->title}}
            </h4>

            @if ($widget->type == 'Text Widget')
            {!!$widget->body!!}
            @endif


            @if ($widget->type == 'Blog Category')

                @foreach ($widget->category->posts as $post)
                <div class="posts-sm row col-mb-30" id="post-list-sidebar">
                    <div class="entry col-12">
                        <div class="grid-inner row g-0">
                            <div class="col-auto">
                                <div class="entry-image">
                                    <a href="#"><img src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Image"></a>
                                </div>
                            </div>
                            <div class="col ps-3">
                                <div class="entry-title">
                                    <h4><a href="#">{{$post->title}}</a></h4>
                                </div>
                                <div class="entry-meta">
                                    <ul>
                                        <li>{{ \Carbon\Carbon::parse($post->created_at)->isoFormat('Do MMM YYYY')}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            @endif

            @if ($widget->type == 'Recent Post')
                @php
                //$latestposts = $widget->category->posts()->orderBy('created_at', 'desc')->take(2)->get();
                $post_no =$widget->no_of_post;
                $latestposts = \App\Models\blog\Post::orderBy('created_at', 'desc')->take($post_no)->get();
                @endphp
                @foreach ($latestposts as $recentpost)
                <div class="posts-sm row col-mb-30" id="post-list-sidebar">
                <div class="entry col-12">
                    <div class="grid-inner row g-0">
                        <div class="col-auto">
                            <div class="entry-image">
                                <a href="#"><img src="{{asset('uploads/postphoto/'.$recentpost->image)}}" alt="Image"></a>
                            </div>
                        </div>
                        <div class="col ps-3">
                            <div class="entry-title">
                                <h4><a href="#">{{$recentpost->title}}</a></h4>
                            </div>
                            <div class="entry-meta">
                                <ul>
                                    <li>{{ \Carbon\Carbon::parse($recentpost->created_at)->isoFormat('Do MMM YYYY')}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
            @endif


            @if ($widget->type == 'Image Widget')

            <p><img alt="" src="{{asset('uploads/sidebarphoto/'.$widget->image)}}" style="height: 214px; width: 350px;" /></p>

                    {{-- {!!$widget->body!!} --}}

                    <h4>
                        {{-- <a href="{{route('widget.details',$widget->id)}}"> --}}
                            <a href="#">
                            <u><span style="color: #008000;">বিস্তারিত</span></u>
                        </a>
                    </h4>
                    <p></p>

            @endif



        </div>
        @endforeach
        {{-- <div class="widget clearfix">

            <h4>Connect with Us</h4>
            <a href="#" class="social-icon si-colored si-small si-facebook" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook">
                <i class="icon-facebook"></i>
                <i class="icon-facebook"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-delicious" data-bs-toggle="tooltip" data-bs-placement="top" title="Delicious">
                <i class="icon-delicious"></i>
                <i class="icon-delicious"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-android" data-bs-toggle="tooltip" data-bs-placement="top" title="Android">
                <i class="icon-android"></i>
                <i class="icon-android"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-gplus" data-bs-toggle="tooltip" data-bs-placement="top" title="Google Plus">
                <i class="icon-gplus"></i>
                <i class="icon-gplus"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-stumbleupon" data-bs-toggle="tooltip" data-bs-placement="top" title="Stumbleupon">
                <i class="icon-stumbleupon"></i>
                <i class="icon-stumbleupon"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-foursquare" data-bs-toggle="tooltip" data-bs-placement="top" title="Foursquare">
                <i class="icon-foursquare"></i>
                <i class="icon-foursquare"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-forrst" data-bs-toggle="tooltip" data-bs-placement="top" title="Forrst">
                <i class="icon-forrst"></i>
                <i class="icon-forrst"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-digg" data-bs-toggle="tooltip" data-bs-placement="top" title="Digg">
                <i class="icon-digg"></i>
                <i class="icon-digg"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-spotify" data-bs-toggle="tooltip" data-bs-placement="top" title="Spotify">
                <i class="icon-spotify"></i>
                <i class="icon-spotify"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-reddit" data-bs-toggle="tooltip" data-bs-placement="top" title="Reddit">
                <i class="icon-reddit"></i>
                <i class="icon-reddit"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-blogger" data-bs-toggle="tooltip" data-bs-placement="top" title="Blogger">
                <i class="icon-blogger"></i>
                <i class="icon-blogger"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-dribbble" data-bs-toggle="tooltip" data-bs-placement="top" title="Dribbble">
                <i class="icon-dribbble"></i>
                <i class="icon-dribbble"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-flickr" data-bs-toggle="tooltip" data-bs-placement="top" title="Flickr">
                <i class="icon-flickr"></i>
                <i class="icon-flickr"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-linkedin" data-bs-toggle="tooltip" data-bs-placement="top" title="Linked In">
                <i class="icon-linkedin"></i>
                <i class="icon-linkedin"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-rss" data-bs-toggle="tooltip" data-bs-placement="top" title="RSS">
                <i class="icon-rss"></i>
                <i class="icon-rss"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-skype" data-bs-toggle="tooltip" data-bs-placement="top" title="Skype">
                <i class="icon-skype"></i>
                <i class="icon-skype"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-twitter" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter">
                <i class="icon-twitter"></i>
                <i class="icon-twitter"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-youtube" data-bs-toggle="tooltip" data-bs-placement="top" title="Youtube">
                <i class="icon-youtube"></i>
                <i class="icon-youtube"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-vimeo" data-bs-toggle="tooltip" data-bs-placement="top" title="Vimeo">
                <i class="icon-vimeo"></i>
                <i class="icon-vimeo"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-yahoo" data-bs-toggle="tooltip" data-bs-placement="top" title="Yahoo">
                <i class="icon-yahoo"></i>
                <i class="icon-yahoo"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-github" data-bs-toggle="tooltip" data-bs-placement="top" title="Github">
                <i class="icon-github-circled"></i>
                <i class="icon-github-circled"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-tumblr" data-bs-toggle="tooltip" data-bs-placement="top" title="Trumblr">
                <i class="icon-tumblr"></i>
                <i class="icon-tumblr"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-instagram" data-bs-toggle="tooltip" data-bs-placement="top" title="Instagram">
                <i class="icon-instagram"></i>
                <i class="icon-instagram"></i>
            </a>

            <a href="#" class="social-icon si-colored si-small si-pinterest" data-bs-toggle="tooltip" data-bs-placement="top" title="Pinterst">
                <i class="icon-pinterest"></i>
                <i class="icon-pinterest"></i>
            </a>

        </div>

        <div class="widget clearfix">

            <h4>Embed Videos</h4>
            <iframe src="//player.vimeo.com/video/103927232" width="500" height="250" allow="autoplay; fullscreen" allowfullscreen></iframe>

        </div> --}}

    </div>
</div>
