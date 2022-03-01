<style>
    li .video-main-title {
    border-left: 4px solid red;
    line-height: 26px;
    margin-bottom: 15px;
}
.video-main-title a {
    color: #ffc107;
}
</style>
<div class="tabs clearfix" id="tab-3">

    <ul class="tab-nav tab-nav2 clearfix">
       <a style="background: #f5f5f5;" href="{{route('video.gallary')}}"> <li><div class="video-main-title">
              <h2> ভিডিও </h2>
          </div></li></a>
        <li class="active"><a href="#all"><i class="icon-home2 me-0"></i></a></li>
        @foreach ($categories as $category)
        <li><a href="#{{$category->slug}}">{{$category->name}}</a></li>
        @endforeach
    </ul>

    <div class="tab-container">

        @foreach ($categories as $category)
        <div class="tab-content clearfix" id="{{$category->slug}}">
            <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-pagi="false" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-lg="4">
            @foreach ($programs as $program)
            @if ($program->programcategory->id == $category->id)
            <div class="portfolio-item" style="background: #333;">
                <div class="portfolio-image">
                    <a href="portfolio-single.html">
                        <img src="{{asset('uploads/video/'.$program->poster)}}" alt="Open Imagination">
                    </a>
                    <div class="bg-overlay" >
                        <div  class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="350">
                            <a href="{{route('video.details',$program->slug)}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350" ><i style="color: red; " class="icon-play-circle"></i></a>
                        </div>
                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>
                    </div>
                </div>
                <div class="portfolio-desc">
                    <h3><a style="color: white" href="{{route('video.details',$program->slug)}}">{{Str::limit($program->title, 20)}}</a></h3>
                </div>
            </div>
            @endif
            @endforeach

            </div>
        </div>
        @endforeach

        <div class="tab-content clearfix" id="all">
            <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-pagi="false" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-lg="4">
            @foreach ($programs as $program)
            {{-- <article class="portfolio-item pf-graphics pf-uielements"  style="padding-right: 10px;">
                <div style="width: 250px;" class="portfolio-image">
                    <a href="{{route('video.details',$program->slug)}}">
                        <img src="{{asset('uploads/video/'.$program->poster)}}" alt="Locked Steel Gate">
                    </a>
                    <div class="entry-title title-xs nott">
                        <h3><a href="{{route('video.details',$program->slug)}}">{{Str::limit($program->title, 20)}}</a></h3>
                    </div>
                    <div class="bg-overlay">
                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn">

                            <a href="{{route('video.details',$program->slug)}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="150" data-hover-delay="150"><i class="icon-play-circle"></i></a>
                        </div>
                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                    </div>
                </div>
            </article> --}}

            <div class="portfolio-item" style="background: #333;">
                <div class="portfolio-image">
                    <a href="portfolio-single.html">
                        <img src="{{asset('uploads/video/'.$program->poster)}}" alt="Open Imagination">
                    </a>
                    <div class="bg-overlay" >
                        <div  class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="350">
                            <a href="{{route('video.details',$program->slug)}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350" ><i style="color: red; " class="icon-play-circle"></i></a>
                        </div>
                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>
                    </div>
                </div>
                <div class="portfolio-desc">
                    <h3><a style="color: white" href="{{route('video.details',$program->slug)}}">{{Str::limit($program->title, 20)}} | {{ $program->created_at->format('j-F-Y') }}</a></h3>
                </div>
            </div>
            @endforeach

            </div>
        </div>

    </div>

</div>
