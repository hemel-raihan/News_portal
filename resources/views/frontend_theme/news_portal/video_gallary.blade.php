@extends('frontend_theme.news_portal.front_layout.app')

@section('styles')
<style>
    .itemsContainer {
    background:red;
    float:left;
    position:relative
}
.itemsContainer:hover .play{display:block}
.play{
  position : absolute;
    display:none;
    top:20%;
    width:80px;
    margin:0 auto; left:0px;
    right:0px;
    z-index:100
}
</style>
@endsection

@section('content')

<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="grid-filter-wrap">

                <!-- Portfolio Filter
                ============================================= -->
                <ul class="grid-filter" data-container="#portfolio">
                    <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>
                    @foreach ($categories as $category)
                    <li><a href="#" data-filter=".{{$category->slug}}">{{$category->name}}</a></li>
                    @endforeach
                </ul><!-- .grid-filter end -->

                <div class="grid-shuffle rounded" data-container="#portfolio">
                    <i class="icon-random"></i>
                </div>

            </div>

            <!-- Portfolio Items
            ============================================= -->
            <div id="portfolio" class="portfolio row grid-container gutter-20" data-layout="fitRows">

                <!-- Portfolio Item: Start -->

                @foreach ($programs as $program)
                <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-media {{$program->programcategory->slug}}">
                            <div style="width: 250px;" class="portfolio-image">
                                <a href="{{route('video.details',$program->slug)}}">
                                    <img src="{{asset('uploads/video/'.$program->poster)}}" alt="Locked Steel Gate">
                                </a>
                                <div class="entry-title title-xs nott">
                                    <h3><a href="{{route('video.details',$program->slug)}}">{{Str::limit($program->title, 20)}}</a></h3>
                                </div>
                                <div class="bg-overlay">
                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                        {{-- <a href="{{route('video.details',$program->slug)}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="150" data-lightbox="image" title="Image" data-hover-delay="150"><i class="icon-play-circle"></i></a> --}}
                                        <a href="{{route('video.details',$program->slug)}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="150" data-hover-delay="150"><i class="icon-play-circle"></i></a>
                                    </div>
                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                                </div>
                            </div>
                </article>
                @endforeach



            </div><!-- #portfolio end -->

        </div>
    </div>
</section><!-- #content end -->

@endsection()

@section('scripts')




@endsection
