<div class="four columns right-side-bar" id="right-content">
    {{-- <div class="column block">
        <h5 class="bk-org title">
            জাতীয় সংগীত
        </h5>
        <audio controls="" style="width: 100%;">
            <source src="/sites/default/files/files/admin.portal.gov.bd/npfblock/bd_national_anthem.mp3" type="audio/mp3" />
        </audio>
    </div>
    <style></style>
    <script></script>
    <div class="column block">
        <h5 class="bk-org title">
            মহাপরিচালক
        </h5>

        <p><img alt="" src="https://dshe.portal.gov.bd/uploader/server/../../sites/default/files/files/dshe.portal.gov.bd/npfblock//NewDGSir.jpg" style="height: 214px; width: 220px;" /></p>

        <p>
            <span style="font-size: 14px;"><strong>প্রফেসর ড. সৈয়দ মো. গোলাম ফারুক</strong></span>
        </p>

        <h4>
            <a href="http://dshe.portal.gov.bd/site/page/cecb3807-55c3-4a1b-b73e-2c247aec0c03">
                <u><span style="color: #008000;">বিস্তারিত</span></u>
            </a>
        </h4>
        <p></p>
    </div> --}}
    <style>
        #right-content .block {
            display: block !important;
        }
    </style>
    <script></script>

@foreach ($widgets as $widget)

<div class="column block">
    <h5 class="bk-org title">
        {{$widget->title}}
    </h5>

    @if ($widget->type == 'Text Widget')
    {!!$widget->body!!}
    @endif



@if ($widget->type == 'Blog Category')
<ul>
    @foreach ($widget->category->posts as $post)
    <li>
        <a
            href="http://dshe.portal.gov.bd/uploader/server/../../sites/default/files/files/dshe.portal.gov.bd/npfblock//nirdesika.pdf"
            style="
                padding: 0px;
                margin: 0px;
                font-family: kalpurushregular;
                border: 0px;
                font-variant-numeric: inherit;
                font-variant-east-asian: inherit;
                font-stretch: inherit;
                font-size: 12px;
                line-height: inherit;
                vertical-align: baseline;
                color: rgb(0, 0, 0);
                text-decoration-line: none;
                outline: 0px;
            "
            title="১.&nbsp;{{$post->title}}"
        >
            {{$post->title}}
        </a>
    </li>
    @endforeach
</ul>
@endif


@if ($widget->type == 'Recent Post')
<ul>
    @php
    //$latestposts = $widget->category->posts()->orderBy('created_at', 'desc')->take(2)->get();
    $post_no =$widget->no_of_post;
    $latestposts = \App\Models\blog\Post::orderBy('created_at', 'desc')->take($post_no)->get();
    @endphp
    @foreach ($latestposts as $recentpost)
    <li>
        <a
            href="http://dshe.portal.gov.bd/uploader/server/../../sites/default/files/files/dshe.portal.gov.bd/npfblock//nirdesika.pdf"
            style="
                padding: 0px;
                margin: 0px;
                font-family: kalpurushregular;
                border: 0px;
                font-variant-numeric: inherit;
                font-variant-east-asian: inherit;
                font-stretch: inherit;
                font-size: 12px;
                line-height: inherit;
                vertical-align: baseline;
                color: rgb(0, 0, 0);
                text-decoration-line: none;
                outline: 0px;
            "
            title="১.&nbsp;{{$recentpost->title}}"
        >
            {{$recentpost->title}}
        </a>
    </li>
    @endforeach
</ul>
@endif


@if ($widget->type == 'Image Widget')

<p><img alt="" src="{{asset('uploads/sidebarphoto/'.$widget->image)}}" style="height: 214px; width: 220px;" /></p>

        {{-- {!!$widget->body!!} --}}

        <h4>
            <a href="{{route('widget.details',$widget->id)}}">
                <u><span style="color: #008000;">বিস্তারিত</span></u>
            </a>
        </h4>
        <p></p>

@endif


    <p></p>
</div>

@endforeach


    <style>
        #right-content .block {
            display: block !important;
        }
    </style>
    <script></script>
    {{-- <a href="//bangladesh.gov.bd/site/view/all_eservices_in_bangladesh/">
        <div class="column block central-eservices">
            <h5 class="bk-org title eservice-title">কেন্দ্রীয় ই-সেবা</h5>
        </div>
    </a> --}}

            <!-- <div class="column block central-eservices">
        <h5 class="bk-org title eservice-title">কেন্দ্রীয় ই-সেবা
        </h5>
        <ul>


        <li class="item_"></li>


        <li class="item_"></li>


        <li class="item_"></li>


        <li class="item_"></li>


        <li class="item_"></li>


        <li class="item_"></li>


        <li class="item_"></li>


        <li class="item_"></li>


        <li class="item_"></li>


        <li class="item_"></li>


        <li class="item_"></li>


        <li class="item_"></li>


        <li class="item_"></li>
                </ul>
        <a href="" class="btn" style="display:block;text-align:center;">সকল</a>
    </div>
-->
    <style>
        .eservice-title {
            background-color: #609513 !important;
            color: #fff;
            font-size: 12px;
            padding: 5px;
        }
        .block ul li {
            background: rgba(0, 0, 0, 0) url("/themes/responsive_npf/images/bg_block_list.png") no-repeat scroll center bottom;
            font-size: 120%;
            height: auto;
            list-style-type: none;
            margin-bottom: 5px;
            padding-bottom: 8px;
            padding-left: 32px;
            padding-top: 0;
        }

        body.bpsc-portal-gov-bd .wsis_prize {
            display: none;
        }
    </style>
    {{-- <script></script>
    <div class="column block">
        <h5 class="bk-org title">গুরুত্বপূর্ণ লিংক</h5>
        <ul>
            <li><a href="http://www.pmo.gov.bd">প্রধানমন্ত্রীর কার্যালয়</a></li>

            <li><a href="http://www.moedu.gov.bd/">শিক্ষা মন্ত্রণালয়</a></li>

            <li><a href="http://pmis.mopa.gov.bd/">All cadre PMIS </a></li>

            <li><a href="http://mmc.e-service.gov.bd/">MMC Dashboard Website</a></li>

            <li><a href="http://sss.bkkb.gov.bd/">কর্মচারী কল্যাণ বোর্ডের কল্যাণ, যৌথবীমা ও দাফন-অন্ত্যেষ্টিক্রিয়ার অনুদান</a></li>
        </ul>
        <a href="/site/view/important_links" class="btn" style="display: block; text-align: center;">সকল লিংক</a>
    </div>
    <style></style>
    <script></script>
    <div class="column block">
        <h5 class="bk-org title internal-eservice">
            <a target="_blank" href="https://www.mygov.bd/serviceByOffice/?agent=np&domain=dshe.gov.bd">অভ্যন্তরীণ ই-সেবাসমূহ</a>
        </h5>
        <ul>
            <li><a href="http://emis.gov.bd/emis">emis.gov.bd</a></li>

            <li><a href="http://118.67.223.30/emis">Alternate link of EMIS Server</a></li>

            <li><a href="http://emis.gov.bd">বদলির আবেদন (অধ্যক্ষ /উপাধ্যক্ষ, সরকারি কলেজ)</a></li>

            <li><a href="http://emis.gov.bd">Institution Management System (IMS) </a></li>

            <li><a href="http://103.234.26.37/dashboard">ILC Dashboard</a></li>

            <li><a href="http://203.112.195.166:6081">RELM</a></li>
        </ul>

        <a href="/site/view/internal_eservices" class="btn" style="display: block; text-align: center;">সকল</a>
    </div> --}}
    <style>
        .block h5.internal-eservice {
            background-image: url("/sites/default/files/files/pmo.portal.gov.bd/page/761f04a2_c625_480e_96cc_b9a0c006d5c3/internal_eservice2.png");
            background-repeat: round;
            background-color: white !important;

            font-size: 1.2em;

            height: 50px;
            line-height: 56px;
            padding: 0 0 0 10px !important;
        }

        .block h5.internal-eservice a {
            color: white !important;
            display: block;
            text-decoration: none;
        }

        @media only screen and (max-width: 979px) and (min-width: 320px) {
            .block h5.internal-eservice a {
                margin-top: 15px;
                font-size: 17px;
            }
        }
    </style>
    <script></script>
    {{-- <div class="column block">
        <h5 class="bk-org title">
            ভিডিও
        </h5>

        <p><iframe frameborder="0" height="150" src="https://www.youtube.com/embed/RiN8L5gJ-BU" width="250"></iframe></p>
        <p><iframe frameborder="0" height="150" src="https://www.youtube.com/embed/B4J5n-lNk3g" width="250"></iframe></p>
        <p></p>
    </div>
    <style>
        #right-content .block {
            display: block !important;
        }
    </style>
    <script></script>
    <div class="column block">
        <h5 class="bk-org title">
            মাউশি ফেসবুক পেজ
        </h5>

        <p>
            <a href="https://www.facebook.com/dshe.moebd">
                <img alt="Social Media" src="http://dshe.portal.gov.bd/uploader/server/../../sites/default/files/files/dshe.portal.gov.bd/npfblock//facebook-logo.png" style="height: 74px; width: 200px;" />
            </a>
        </p>
        <p></p>
    </div>
    <style>
        #right-content .block {
            display: block !important;
        }
    </style>
    <script></script>
    <div class="column block">
        <h5 class="bk-org title">
            জরুরি হটলাইন
        </h5>
        <p><img alt="" src="/sites/default/files/files/admin.portal.gov.bd/npfblock//National-Helpline%20%281%29.jpg" style="height: 100%; width: 220px;" /></p>
        <p></p>
    </div>
    <style>
        #right-content .block {
            display: block !important;
        }
    </style>
    <script></script>
    <div class="column block">
        <h5 class="bk-org title">
            করোনা ভাইরাস প্রতিরোধে যোগাযোগ
        </h5>

        <p>
            <a href="https://corona.gov.bd/" target="_blank">
                <img alt="করোনা হটলাইন নম্বর" src="/sites/default/files/files/admin.portal.gov.bd/npfblock//corona_new.jpg" style="border-style: solid; border-width: 1px; width: 100%;" />
            </a>
        </p>

        <p>&nbsp;</p>

        <p><iframe frameborder="0" src="https://www.youtube.com/embed/GVPJHDp29tg" width="100%"></iframe></p>
        <p></p>
    </div>
    <style>
        #right-content .block {
            display: block !important;
        }
    </style>
    <script></script>
    <div class="column block">
        <h5 class="bk-org title">
            করোনা ট্রেসার বিডি
        </h5>

        <p>
            <a href="https://bit.ly/coronatracerbd" target="_blank">
                <img alt="" src="/sites/default/files/files/admin.portal.gov.bd/npfblock/5d18830f_9fe8_42e1_965d_f94a61510be9/2020-06-16-00-21-94946eae5bcbd226dff95be9d2e49445.jpg" style="width: 100%;" />
            </a>
        </p>
        <p></p>
    </div>
    <style>
        #right-content .block {
            display: block !important;
        }
    </style>
    <script></script>
    <div class="column block">
        <h5 class="bk-org title">
            একদেশ
        </h5>

        <p style="text-align: center;">
            <a href="//ekdesh.ekpay.gov.bd/" target="_blank">
                <img alt="" src="/sites/default/files/files/admin.portal.gov.bd/npfblock/6489f67c_f1ab_4c6f_879c_62b91a2bf45c/2020-05-18-15-22-d1cb9a8e17dbdaed8c9badd286910939.jpg" style="width: 100%;" />
            </a>
        </p>
        <p></p>
    </div>
    <style>
        #right-content .block {
            display: block !important;
        }
    </style>
    <script></script>
    <div class="column block">
        <h5 class="bk-org title">
            ডিজিটাল বাংলাদেশ এর এগিয়ে যাওয়ার ১২ বছর
        </h5>

        <p><iframe frameborder="0" src="https://www.youtube.com/embed/B0FgrYBE4uY?rel=0" width="100%"></iframe></p>
        <p></p>
    </div>
    <style>
        #right-content .block {
            display: block !important;
        }
    </style>
    <script></script>
    <div class="column block">
        <h5 class="bk-org title">
            ডেঙ্গু প্রতিরোধে করণীয়
        </h5>
        <p>
            <a href="https://bangladesh.gov.bd/site/page/91530698-c795-4542-88f2-5da1870bd50c" target="_blank"><img alt="" src="/sites/default/files/files/admin.portal.gov.bd/npfblock/dengu.jpg" /></a>
        </p>
        <p></p>
    </div>
    <style>
        #right-content .block {
            display: block !important;
        }
    </style>
    <script></script>
    <div class="column block">
        <h5 class="bk-org title">ইনোভেশন কর্নার</h5>
    </div>
    <style></style>
    <script></script>
    <div class="column block">
        <h5 class="bk-org title">সামাজিক যোগাযোগ</h5>
    </div> --}}

    <div class="clearfix"></div>
    <style>
        .share-buttons img {
            width: 30px;
            padding: 2px;
            border: 0;
            box-shadow: 0;
            display: inline;
        }
    </style>
    <script></script>
    <script>
        $(document).ready(function () {
            el = $('h5:contains("সেবা সহজিকরণ")');
            text = el.html();
            el.html("").html('<a style="color:#fff" href="/site/view/sps_data">' + text + "<a>");
        });
    </script>
    <style></style>
    <script></script>
    <!-- <div style="" class="column block">

        <h5 style="background-color: #eee;">
                                                                                            দর্শক সংখ্যাঃ
                                <span style="padding:5px; background-color: #609513; color: #fff; font-weight:bold;">
                                    <span>
        </h5>
    </div> -->
</div>
