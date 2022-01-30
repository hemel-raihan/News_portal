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

            <h4>Testimonials</h4>
            <div class="fslider testimonial border-0 p-0 shadow-none" data-animation="slide" data-arrows="false">
                <div class="flexslider">
                    <div class="slider-wrap">
                        <div class="slide">
                            <div class="testi-image">
                                <a href="#"><img src="images/testimonials/3.jpg" alt="Customer Testimonails"></a>
                            </div>
                            <div class="testi-content">
                                <p>Similique fugit repellendus expedita excepturi iure perferendis provident quia eaque. Repellendus, vero numquam?</p>
                                <div class="testi-meta">
                                    Steve Jobs
                                    <span>Apple Inc.</span>
                                </div>
                            </div>
                        </div>
                        <div class="slide">
                            <div class="testi-image">
                                <a href="#"><img src="images/testimonials/2.jpg" alt="Customer Testimonails"></a>
                            </div>
                            <div class="testi-content">
                                <p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>
                                <div class="testi-meta">
                                    Collis Ta'eed
                                    <span>Envato Inc.</span>
                                </div>
                            </div>
                        </div>
                        <div class="slide">
                            <div class="testi-image">
                                <a href="#"><img src="images/testimonials/1.jpg" alt="Customer Testimonails"></a>
                            </div>
                            <div class="testi-content">
                                <p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum!</p>
                                <div class="testi-meta">
                                    John Doe
                                    <span>XYZ Inc.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="widget clearfix">

            <h4>Instagram Photos</h4>
            <div id="instagram-photos" class="instagram-photos masonry-thumbs grid-container grid-4" data-user="blog.canvastemplate"></div>

        </div>

        <div class="widget quick-contact-widget form-widget clearfix">

            <h4>Quick Contact</h4>
            <div class="form-result"></div>
            <form id="quick-contact-form" name="quick-contact-form" action="include/form.php" method="post" class="quick-contact-form mb-0">
                <div class="form-process">
                    <div class="css3-spinner">
                        <div class="css3-spinner-scaler"></div>
                    </div>
                </div>

                <input type="text" class="required sm-form-control input-block-level" id="quick-contact-form-name" name="quick-contact-form-name" value="" placeholder="Full Name" />
                <input type="text" class="required sm-form-control email input-block-level" id="quick-contact-form-email" name="quick-contact-form-email" value="" placeholder="Email Address" />
                <textarea class="required sm-form-control input-block-level short-textarea" id="quick-contact-form-message" name="quick-contact-form-message" rows="4" cols="30" placeholder="Message"></textarea>
                <input type="text" class="d-none" id="quick-contact-form-botcheck" name="quick-contact-form-botcheck" value="" />
                <input type="hidden" name="prefix" value="quick-contact-form-">
                <button type="submit" id="quick-contact-form-submit" name="quick-contact-form-submit" class="button button-small button-3d m-0" value="submit">Send Email</button>
            </form>

        </div> --}}

    </div>
</div>
