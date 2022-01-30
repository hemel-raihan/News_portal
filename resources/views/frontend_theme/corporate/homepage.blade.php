@extends('frontend_theme.corporate.front_layout.app')

@section('styles')

@endsection

@section('content')

        @if ($page->rightsidebar_id == 0 && $page->leftsidebar_id == 0)
        <div class="postcontent col-lg-12">
        @elseif(!$page->rightsidebar_id == 0 && $page->leftsidebar_id == 0)
        <div class="postcontent col-lg-9">
        @elseif($page->rightsidebar_id == 0 && !$page->leftsidebar_id == 0)
        <div class="postcontent col-lg-9">
        @elseif(!$page->rightsidebar_id == 0 && !$page->leftsidebar_id == 0)
        <div class="postcontent col-lg-6">
        @endif

        @foreach ($page->pagebuilders as $pagebuilder)
        <div class="container-lg clearfix" style="background-color: {{$pagebuilder->background_color}}; background-image: url('{{asset('uploads/sectionpagephoto/'.$pagebuilder->background_img)}}');  border: {{$pagebuilder->border}} {{$pagebuilder->border_style}} {{$pagebuilder->border_color}};">
            <div class="heading-block center">
                <h2>{{$pagebuilder->title}}</h2>
            </div>
            <div class="row">
                @foreach ($pagebuilder->elements as $key => $element)
                @if ($pagebuilder->layout == 'One Column')
                <div class="col-md-12">
                @elseif ($pagebuilder->layout == 'Two Column')
                <div class="col-md-6">
                @elseif ($pagebuilder->layout == 'Three Column')
                <div class="col-md-4">
                @elseif ($pagebuilder->layout == 'One/Two Column')
                <div class="col-md-{{ ($key%2 == 0) ? 4 : 8 }}">
                @elseif ($pagebuilder->layout == 'Two/One Column')
                <div class="col-md-{{ ($key%2 == 0) ? 8 : 4 }}">
                @elseif ($pagebuilder->layout == 'One/Two/One Column')
                <div class="col-md-{{ ($key%2 == 0) ? 3 : ((!$key%2 == 0) ? 6 : 3) }}">
                @endif

                {{-- <div class="col-md-{{($pagebuilder->layout == 'one-col') ? 12 : 6}}"> --}}

                    <div class="row col-mb-50">
                        @if($element->module_type == 'Blog Post')
                        @if ($element->title)
                        <div class="heading-block">
                            <h3>{{$element->title}}</h3>
                        </div>
                        @endif
                        @isset($blogposts)
                        @foreach ($blogposts as $blogpost)
                        <div class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }}">
                            {{-- <div class="entry col-sm-6 col-12"> --}}
                                <div class="grid-inner">
                                    @isset($blogpost->image)
                                    <div class="entry-image">
                                        <a href="#" data-lightbox="image"><img src="{{asset('uploads/postphoto/'.$blogpost->image)}}" alt="Standard Post with Image"></a>
                                    </div>
                                    @endisset
                                    @isset($blogpost->youtube_link)
                                    <div class="entry-image">
                                    <p>&nbsp;<iframe frameborder="1"  height="400" src="{{$blogpost->youtube_link}}" width="720"></iframe></p>
                                    </div>
                                    @endisset
                                    <div class="entry-title">
                                        <h2><a href="{{route('blog.details',$blogpost->id)}}">{{$blogpost->title}}</a></h2>
                                    </div>
                                    <div class="entry-meta">
                                        <ul>
                                            <li><i class="icon-calendar3"></i> {{ \Carbon\Carbon::parse($blogpost->created_at)->isoFormat('Do MMM YYYY')}}</li>
                                            <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 13</a></li>
                                            <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="entry-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, asperiores quod est tenetur in. Eligendi, deserunt, blanditiis est quisquam doloribus.</p>
                                        <a href="{{route('blog.details',$blogpost->id)}}" class="more-link">Read More</a>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>
                        @endforeach
                        @endisset


                        @elseif($element->module_type == 'Blog Category')
                        @if ($element->title)
                            <h3>{{$element->title}}</h3>
                        @endif
                        @isset($blogcategories)
                        @foreach ($blogcategories as $blogcategory)
                        <div class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }}">

                                <div class="feature-box fbox-rounded fbox-effect">
                                    <div class="fbox-icon">
                                        <a href="{{route('blog.posts',$blogcategory->id)}}"><img src="{{asset('uploads/categoryphoto/'.$blogcategory->image)}}"></a>
                                    </div>
                                    <div class="fbox-content">
                                        <h3>{{$blogcategory->name}}</h3>
                                        <p>{!!Str::limit($blogcategory->desc, 70)!!}</p>
                                    </div>
                                </div>
						</div>
                        @endforeach
                        @endisset


                        @elseif($element->module_type == 'Product Post')
                        @if ($element->title)
                        <div class="heading-block">
                            <h3>{{$element->title}}</h3>
                        </div>
                        @endif
                        @isset($productposts)
                        @php
                        $productcategories = \App\Models\Product\Productcategory::all();
                        @endphp
                        <div class="grid-filter-wrap">
                            <ul class="grid-filter" data-container="#portfolio">
                                <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>
                                @foreach ($productcategories as $category)
                                <li><a href="#" data-filter=".{{$category->id}}" >{{$category->name}}</a></li>
                                @endforeach
                            <div class="grid-shuffle rounded" data-container="#portfolio">
                                <i class="icon-random"></i>
                            </div>
                        </div>


                        <div id="portfolio" class="portfolio row grid-container gutter-20" data-layout="fitRows">
                        @foreach ($productposts as $productpost)
                        @foreach ($productpost->productcategories as $category)
                        <article class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }} {{$category->id}}">
                            <div class="grid-inner">
                                <div class="portfolio-image">
                                    <a href="portfolio-single.html">
                                        <img src="{{asset('uploads/productphoto/'.$productpost->image)}}" alt="Open Imagination">
                                    </a>
                                    <div class="bg-overlay">
                                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                            <a href="{{asset('uploads/productphoto/'.$productpost->image)}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>
                                            <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>
                                        </div>
                                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                                    </div>
                                </div>
                                <div class="portfolio-desc">
                                    <h3><a href="portfolio-single.html">{{$productpost->title}}</a></h3>
                                    <span><a href="#">Media</a>, <a href="#">Icons</a></span>
                                </div>
                            </div>
                        </article>
                        @endforeach
                        @endforeach
                        </div>

                        @endisset


                        @elseif ($element->module_type == 'General Post')
                        @isset($generalposts)
                        @foreach ($generalposts as $generalpost)
                        <div class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }}">
                            {{-- <div class="entry col-sm-6 col-12"> --}}
                                <div class="grid-inner">
                                    @isset($blogpost->image)
                                    <div class="entry-image">
                                        <a href="#" data-lightbox="image"><img src="{{asset('uploads/contentpostphoto/'.$generalpost->image)}}" alt="Standard Post with Image"></a>
                                    </div>
                                    @endisset
                                    @isset($blogpost->youtube_link)
                                    <div class="entry-image">
                                    <p>&nbsp;<iframe frameborder="1"  height="400" src="{{$generalpost->youtube_link}}" width="720"></iframe></p>
                                    </div>
                                    @endisset
                                    <div class="entry-title">
                                        <h2><a href="{{route('general.details',$generalpost->id)}}">{{$generalpost->title}}</a></h2>
                                    </div>
                                    <div class="entry-meta">
                                        <ul>
                                            <li><i class="icon-calendar3"></i> {{ \Carbon\Carbon::parse($generalpost->created_at)->isoFormat('Do MMM YYYY')}}</li>
                                            <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 13</a></li>
                                            <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="entry-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, asperiores quod est tenetur in. Eligendi, deserunt, blanditiis est quisquam doloribus.</p>
                                        <a href="{{route('general.details',$generalpost->id)}}" class="more-link">Read More</a>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>
                        @endforeach
                        @endisset

                        @elseif($element->module_type == 'General Category')
                        @if ($element->title)
                            <h3>{{$element->title}}</h3>
                        @endif
                        @isset($generalcategories)
                        @foreach ($generalcategories as $generalcategory)
                        <div class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }}">

                                <div class="feature-box fbox-rounded fbox-effect">
                                    <div class="fbox-icon">
                                        <a href="{{route('general.posts',$generalcategory->id)}}"><img src="{{asset('uploads/contentcategoryphoto/'.$generalcategory->image)}}"></a>
                                    </div>
                                    <div class="fbox-content">
                                        <h3>{{$generalcategory->name}}</h3>
                                        <p>{!!Str::limit($generalcategory->desc, 70)!!}</p>
                                    </div>
                                </div>
						</div>
                        @endforeach
                        @endisset


                        @elseif($element->module_type == 'Service Category')
                        @isset($servicecategories)
                        @foreach ($servicecategories as $servicecategory)
                        <div class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }}">
                            <div class="feature-box fbox-center fbox-light fbox-effect border-bottom-0">
                                <div class="fbox-icon">
                                    <a href="{{route('service.posts',$servicecategory->id)}}"><img src="{{asset('uploads/servicecategory_photo/'.$servicecategory->image)}}" ></a>
                                </div>
                                <div class="fbox-content">
                                    <h3>{{$servicecategory->name}}<span class="subtitle">{!!$servicecategory->desc!!}</span></h3>
                                </div>

                            </div>
                        </div>
                        @endforeach
                        @endisset


                        @elseif($element->module_type == 'Price-Table Post')
                        @isset($priceposts)
                        @foreach ($priceposts as $pricepost)
                        <div class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }}">

							<div class="pricing-box pricing-simple px-5 py-4 bg-light text-center text-md-start">
								<div class="pricing-title">
									<span class="text-danger">Most Popular</span>
									<h3>{{$pricepost->title}}</h3>
								</div>
								<div class="pricing-price">
									<span class="price-unit">&euro;</span>{{$pricepost->price}}<span class="price-tenure">{{$pricepost->duration}}</span>
								</div>
								<div class="pricing-features">
									{{-- <ul class="iconlist">
										<li><i class="icon-check text-smaller"></i> <strong>Premium</strong> Plugins</li>
										<li><i class="icon-check text-smaller"></i> <strong>SEO</strong> Features</li>
										<li><i class="icon-check text-smaller"></i> <strong>Full</strong> Access</li>
										<li><i class="icon-check text-smaller"></i> <strong>100</strong> User Accounts</li>
										<li><i class="icon-check text-smaller"></i> <strong>1 Year</strong> License</li>
										<li><i class="icon-check text-smaller"></i> <strong>24/7</strong> Support</li>
									</ul> --}}
                                    {!!$pricepost->body!!}
								</div>
								<div class="pricing-action">
									<a href="#" class="btn btn-danger btn-lg">Get Started</a>
								</div>
							</div>

						</div>
                        @endforeach
                        @endisset


                        @elseif($element->module_type == 'Price-Table Category')
                        @isset($pricecategories)
                        @foreach ($pricecategories as $pricecategory)
                        {{-- <div class="col-sm-6 col-lg-{{($element->layout == 'One Column') ? 12 : (($element->layout == 'Two Column') ? 6 : (($element->layout == 'Three Column') ? 4 : 3)) }}">

                                <div class="feature-box fbox-rounded fbox-effect">
                                    <div class="fbox-icon">
                                        <a href="{{route('price.posts',$pricecategory->id)}}"><img src="{{asset('uploads/pricecategory_photo/'.$pricecategory->image)}}"></a>
                                    </div>
                                    <div class="fbox-content">
                                        <h3>{{$pricecategory->name}}</h3>
                                        <p>{!!Str::limit($pricecategory->body, 100)!!}</p>
                                    </div>
                                </div>
						</div> --}}
                        @endforeach
                        @endisset


                        @elseif($element->module_type == 'Portfolio Category' && $element->status == true)
                        @isset($portfoliocategories)

                        <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-margin="1" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-xl="4">
                            @foreach ($portfoliocategories as $portfoliocategory)
                            <div class="portfolio-item">
                                <div class="portfolio-image">
                                    <a href="portfolio-single.html">
                                        <img src="{{asset('uploads/portfoliocategory_photo/'.$portfoliocategory->image)}}" alt="Open Imagination">
                                    </a>
                                    <div class="bg-overlay">
                                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="350">
                                            <a href="{{asset('uploads/portfoliocategory_photo/'.$portfoliocategory->image)}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350" data-lightbox="image"><i class="icon-line-plus"></i></a>
                                            <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>
                                        </div>
                                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>
                                    </div>
                                </div>
                                <div class="portfolio-desc">
                                    <h3><a href="{{route('portfolio.posts',$portfoliocategory->id)}}">{{$portfoliocategory->name}}</a></h3>
                                    {{-- <span><a href="#">Media</a>, <a href="#">Icons</a></span> --}}
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @endisset


                        @else

                        @if ($element->title)
                        <div class="heading-block">
                            <h2>{{$element->title}}</h2>
                        </div>
                        @endif


                        @isset($element->image)
                        <a href="https://vimeo.com/101373765" class="d-block position-relative rounded overflow-hidden" data-lightbox="iframe">
                            <img src="{{asset('uploads/elementphoto/'.$element->image)}}" alt="Image" class="w-100">
                            <div class="bg-overlay">
                                <div class="bg-overlay-content dark">
                                    <i class="i-circled i-light icon-line-play m-0"></i>
                                </div>
                                <div class="bg-overlay-bg op-06 dark"></div>
                            </div>
                        </a>
                        @endisset

                        {!!$element->body!!}

                        @endif

                    </div>
                </div>
                @endforeach
            </div>


            <div class="line"></div>

            {{-- <div class="row col-mb-50">
                <div class="col-md-5">
                    <a href="https://vimeo.com/101373765" class="d-block position-relative rounded overflow-hidden" data-lightbox="iframe">
                        <img src="images/others/1.jpg" alt="Image" class="w-100">
                        <div class="bg-overlay">
                            <div class="bg-overlay-content dark">
                                <i class="i-circled i-light icon-line-play m-0"></i>
                            </div>
                            <div class="bg-overlay-bg op-06 dark"></div>
                        </div>
                    </a>
                </div>

                <div class="col-md-7">
                    <div class="heading-block">
                        <h2>Globally Preferred Ecommerce Platform</h2>
                    </div>

                    <p>Worldwide John Lennon, mobilize humanitarian; emergency response donors; cause human experience effect. Volunteer Action Against Hunger Aga Khan safeguards women's.</p>

                    <div class="row col-mb-30">
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <ul class="iconlist iconlist-color mb-0">
                                <li><i class="icon-caret-right"></i> Responsive Ready Layout</li>
                                <li><i class="icon-caret-right"></i> Retina Display Supported</li>
                                <li><i class="icon-caret-right"></i> Powerful &amp; Optimized Code</li>
                                <li><i class="icon-caret-right"></i> 380+ Templates Included</li>
                            </ul>
                        </div>

                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <ul class="iconlist iconlist-color mb-0">
                                <li><i class="icon-caret-right"></i> 12+ Headers &amp; Menu Designs</li>
                                <li><i class="icon-caret-right"></i> Premium Sliders Included</li>
                                <li><i class="icon-caret-right"></i> Light &amp; Dark Colors</li>
                                <li><i class="icon-caret-right"></i> e-Commerce Design Included</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
        @endforeach
        </div>

        {{-- <div class="section topmargin-lg">
            <div class="container clearfix">

                <div class="heading-block center">
                    <h2>Features that you are gonna Love</h2>
                    <span>Canvas comes with 100+ Feature oriented Shortcodes that are easy to use too.</span>
                </div>

                <div class="row justify-content-center col-mb-50">
                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-phone2"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3>Responsive Layout</h3>
                                <p>Powerful Layout with Responsive functionality that can be adapted to any screen size.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="200">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-eye"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3>Retina Ready Graphics</h3>
                                <p>Looks beautiful &amp; ultra-sharp on Retina Displays with Retina Icons, Fonts &amp; Images.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="400">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-star2"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3>Powerful Performance</h3>
                                <p>Optimized code that are completely customizable and deliver unmatched fast performance.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="600">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-video"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3>HTML5 Video</h3>
                                <p>Canvas provides support for Native HTML5 Videos that can be added to a Full Width Background.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="800">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-params"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3>Parallax Support</h3>
                                <p>Display your Content attractively using Parallax Sections that have unlimited customizable areas.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="1000">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-fire"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3>Endless Possibilities</h3>
                                <p>Complete control on each &amp; every element that provides endless customization possibilities.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="1200">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-bulb"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3>Light &amp; Dark Color Schemes</h3>
                                <p>Change your Website's Primary Scheme instantly by simply adding the dark class to the body.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="1400">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-heart2"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3>Boxed &amp; Wide Layouts</h3>
                                <p>Stretch your Website to the Full Width or make it boxed to surprise your visitors.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="1600">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-note"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3>Extensive Documentation</h3>
                                <p>We have covered each &amp; everything in our Documentation including Videos &amp; Screenshots.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container clearfix">

            <div class="heading-block center">
                <h3>Some of our <span>Featured</span> Works</h3>
                <span>We have worked on some Awesome Projects that are worth boasting of.</span>
            </div>

            <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-margin="1" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-xl="4">

                <div class="portfolio-item">
                    <div class="portfolio-image">
                        <a href="portfolio-single.html">
                            <img src="images/portfolio/4/1.jpg" alt="Open Imagination">
                        </a>
                        <div class="bg-overlay">
                            <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="350">
                                <a href="images/portfolio/full/1.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350" data-lightbox="image"><i class="icon-line-plus"></i></a>
                                <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>
                            </div>
                            <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>
                        </div>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="portfolio-single.html">Open Imagination</a></h3>
                        <span><a href="#">Media</a>, <a href="#">Icons</a></span>
                    </div>
                </div>

                <div class="portfolio-item">
                    <div class="portfolio-image">
                        <a href="portfolio-single.html">
                            <img src="images/portfolio/4/2.jpg" alt="Locked Steel Gate">
                        </a>
                        <div class="bg-overlay">
                            <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="350">
                                <a href="images/portfolio/full/2.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350" data-lightbox="image"><i class="icon-line-plus"></i></a>
                                <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>
                            </div>
                            <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>
                        </div>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="portfolio-single.html">Locked Steel Gate</a></h3>
                        <span><a href="#">Illustrations</a></span>
                    </div>
                </div>
                <div class="portfolio-item">
                    <div class="portfolio-image">
                        <a href="#">
                            <img src="images/portfolio/4/3.jpg" alt="Mac Sunglasses">
                        </a>
                        <div class="bg-overlay">
                            <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="350">
                                <a href="https://vimeo.com/89396394" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350" data-lightbox="iframe"><i class="icon-line-play"></i></a>
                                <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>
                            </div>
                            <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>
                        </div>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="portfolio-single-video.html">Mac Sunglasses</a></h3>
                        <span><a href="#">Graphics</a>, <a href="#">UI Elements</a></span>
                    </div>
                </div>
                <div class="portfolio-item">
                    <div class="portfolio-image">
                        <a href="#">
                            <img src="images/portfolio/4/4.jpg" alt="Morning Dew">
                        </a>
                        <div class="bg-overlay" data-lightbox="gallery">
                            <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                <a href="images/portfolio/full/4.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>
                                <a href="images/portfolio/full/4-1.jpg" class="d-none" data-lightbox="gallery-item"></a>
                                <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>
                            </div>
                            <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                        </div>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="portfolio-single-gallery.html">Morning Dew</a></h3>
                        <span><a href="#">Icons</a>, <a href="#">Illustrations</a></span>
                    </div>
                </div>
                <div class="portfolio-item">
                    <div class="portfolio-image">
                        <a href="portfolio-single.html">
                            <img src="images/portfolio/4/5.jpg" alt="Console Activity">
                        </a>
                        <div class="bg-overlay">
                            <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                <a href="images/portfolio/full/5.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>
                                <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>
                            </div>
                            <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                        </div>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="portfolio-single.html">Console Activity</a></h3>
                        <span><a href="#">UI Elements</a>, <a href="#">Media</a></span>
                    </div>
                </div>
                <div class="portfolio-item">
                    <div class="portfolio-image">
                        <a href="portfolio-single-gallery.html">
                            <img src="images/portfolio/4/6.jpg" alt="Shake It!">
                        </a>
                        <div class="bg-overlay" data-lightbox="gallery">
                            <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                <a href="images/portfolio/full/6.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>
                                <a href="images/portfolio/full/6-1.jpg" class="d-none" data-lightbox="gallery-item"></a>
                                <a href="images/portfolio/full/6-2.jpg" class="d-none" data-lightbox="gallery-item"></a>
                                <a href="images/portfolio/full/6-3.jpg" class="d-none" data-lightbox="gallery-item"></a>
                                <a href="portfolio-single-gallery.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>
                            </div>
                            <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                        </div>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="portfolio-single-gallery.html">Shake It!</a></h3>
                        <span><a href="#">Illustrations</a>, <a href="#">Graphics</a></span>
                    </div>
                </div>
                <div class="portfolio-item">
                    <div class="portfolio-image">
                        <a href="portfolio-single-video.html">
                            <img src="images/portfolio/4/7.jpg" alt="Backpack Contents">
                        </a>
                        <div class="bg-overlay">
                            <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                <a href="https://www.youtube.com/watch?v=kuceVNBTJio" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="iframe"><i class="icon-line-play"></i></a>
                                <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>
                            </div>
                            <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                        </div>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="portfolio-single-video.html">Backpack Contents</a></h3>
                        <span><a href="#">UI Elements</a>, <a href="#">Icons</a></span>
                    </div>
                </div>
                <div class="portfolio-item">
                    <div class="portfolio-image">
                        <a href="portfolio-single.html">
                            <img src="images/portfolio/4/8.jpg" alt="Sunset Bulb Glow">
                        </a>
                        <div class="bg-overlay">
                            <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                <a href="images/portfolio/full/8.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>
                                <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>
                            </div>
                            <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                        </div>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="portfolio-single.html">Sunset Bulb Glow</a></h3>
                        <span><a href="#">Graphics</a></span>
                    </div>
                </div>

            </div>
        </div>

        <div class="section topmargin-sm mb-0">

            <div class="container clearfix">

                <div class="heading-block center">
                    <h3>Testimonials</h3>
                    <span>Check out some of our Client Reviews</span>
                </div>

                <ul class="testimonials-grid grid-1 grid-md-2 grid-lg-3">
                    <li class="grid-item">
                        <div class="testimonial">
                            <div class="testi-image">
                                <a href="#"><img src="images/testimonials/1.jpg" alt="Customer Testimonails"></a>
                            </div>
                            <div class="testi-content">
                                <p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum repellendus!</p>
                                <div class="testi-meta">
                                    John Doe
                                    <span>XYZ Inc.</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="grid-item">
                        <div class="testimonial">
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
                    </li>
                    <li class="grid-item">
                        <div class="testimonial">
                            <div class="testi-image">
                                <a href="#"><img src="images/testimonials/7.jpg" alt="Customer Testimonails"></a>
                            </div>
                            <div class="testi-content">
                                <p>Fugit officia dolor sed harum excepturi ex iusto magnam asperiores molestiae qui natus obcaecati facere sint amet.</p>
                                <div class="testi-meta">
                                    Mary Jane
                                    <span>Google Inc.</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="grid-item">
                        <div class="testimonial">
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
                    </li>
                    <li class="grid-item">
                        <div class="testimonial">
                            <div class="testi-image">
                                <a href="#"><img src="images/testimonials/4.jpg" alt="Customer Testimonails"></a>
                            </div>
                            <div class="testi-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, perspiciatis illum totam dolore deleniti labore.</p>
                                <div class="testi-meta">
                                    Jamie Morrison
                                    <span>Adobe Inc.</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="grid-item">
                        <div class="testimonial">
                            <div class="testi-image">
                                <a href="#"><img src="images/testimonials/8.jpg" alt="Customer Testimonails"></a>
                            </div>
                            <div class="testi-content">
                                <p>Porro dolorem saepe reiciendis nihil minus neque. Ducimus rem necessitatibus repellat laborum nemo quod.</p>
                                <div class="testi-meta">
                                    Cyan Ta'eed
                                    <span>Tutsplus</span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>

        </div>

        <div class="container clearfix">

            <div id="oc-clients" class="owl-carousel owl-carousel-full image-carousel carousel-widget" data-margin="30" data-loop="true" data-nav="false" data-autoplay="5000" data-pagi="false" data-items-xs="2" data-items-sm="3" data-items-md="4" data-items-lg="5" data-items-xl="6" style="padding: 20px 0;">

                <div class="oc-item"><a href="http://logofury.com/"><img src="images/clients/1.png" alt="Clients"></a></div>
                <div class="oc-item"><a href="http://logofury.com/"><img src="images/clients/2.png" alt="Clients"></a></div>
                <div class="oc-item"><a href="http://logofury.com/"><img src="images/clients/3.png" alt="Clients"></a></div>
                <div class="oc-item"><a href="http://logofury.com/"><img src="images/clients/4.png" alt="Clients"></a></div>
                <div class="oc-item"><a href="http://logofury.com/"><img src="images/clients/5.png" alt="Clients"></a></div>
                <div class="oc-item"><a href="http://logofury.com/"><img src="images/clients/6.png" alt="Clients"></a></div>
                <div class="oc-item"><a href="http://logofury.com/"><img src="images/clients/7.png" alt="Clients"></a></div>
                <div class="oc-item"><a href="http://logofury.com/"><img src="images/clients/8.png" alt="Clients"></a></div>
                <div class="oc-item"><a href="http://logofury.com/"><img src="images/clients/9.png" alt="Clients"></a></div>
                <div class="oc-item"><a href="http://logofury.com/"><img src="images/clients/10.png" alt="Clients"></a></div>

            </div>

        </div> --}}


@endsection()

@section('scripts')

@endsection
