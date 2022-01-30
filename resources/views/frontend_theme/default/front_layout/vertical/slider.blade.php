<div class="sixteen columns">
    <div class="callbacks_container" style="box-shadow: 0 1px 5px #999999;">
        <ul class="rslides" id="front-image-slider">
            @php
                $slides = \App\Models\Admin\Slide\Slide::where([['type','main-slide'],['status',true]])->get();
            @endphp
        @foreach ($slides as $slide)
            @php
                $slideimg = explode("|", $slide->slideimage);
            @endphp
            @foreach ($slideimg as $key => $images)
            <li>
                <img src="{{asset('uploads/slide_image/'.$images)}}" alt="" width="960" height="220" />
            </li>
            @endforeach
        @endforeach


            {{-- <li>
                <img src="//www.dshe.gov.bd/sites/default/files/files/dshe.portal.gov.bd/top_banner/5cc51d8a_8567_4ef5_a4b7_3e2ed817dd7b/banner_dshe.jpg" alt="" width="960" height="220" />
            </li>
            <li>
                <img src="//www.dshe.gov.bd/sites/default/files/files/dshe.portal.gov.bd/top_banner/96357215_8cd5_4a7f_850a_11af0c115f7d/banner-02a.jpg" alt="" width="960" height="220" />
            </li> --}}
        </ul>
        <style>
            .rslides img {
                height: 220px;
            }
            .cabinet-portal-gov-bd .meganizr > li > a {
                font-size: 18px !important;
            }
        </style>
        <script></script>
    </div>

    <div class="header-site-info" id="header-site-info">
        <div>
            @php
                $logo  = \App\Models\Admin\Setting::where([['id',1]])->orderBy('id','desc')->first();
            @endphp
            @isset($logo)
            <div id="logo">
                <a title="Home" href="/">
                    <img alt="Home" src="{{asset('uploads/settings/'.$logo->logo)}}" />
                </a>
            </div>
            @endisset


            {{-- <div class="clearfix" id="site-name-wrapper">
                <span id="site-name">
                    @foreach ($slides as $slide)
                    <a title="Home" href="/"> {{$slide->title}} </a>
                    @endforeach
                </span>
                <span id="slogan"> </span>
            </div> --}}

            <!-- /site-name-wrapper -->
        </div>
        <!-- /header-site-info-inner -->
    </div>
</div>
