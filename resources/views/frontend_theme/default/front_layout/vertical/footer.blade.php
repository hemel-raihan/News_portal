
<div class="footer-wrapper full-width" id="footer-wrapper">
    <div id="footer-menu">
        <ul>
            @php
            $contact  = \App\Models\Admin\Setting::where([['id',1]])->orderBy('id','desc')->first();
            @endphp
        @isset($contact)
            <li><a href="#">সাইট ম্যাপ</a></li>
            <li><a href="/contact">যোগাযোগ</a></li>
            <li><a href="{{$contact->facebook_link}}">ফেসবুক</a></li>
        @endisset
        </ul>
        <div style="float: left; font-size: 0.9em;">
            সাইটটি শেষ হাল-নাগাদ করা হয়েছে: <span style="font-style: italic;">&#x09E8;&#x09E6;&#x09E8;&#x09E7;-&#x09E7;&#x09E7;-&#x09E8;&#x09EF; &#x09E6;&#x09EF;:&#x09E6;&#x09E8;:&#x09E7;&#x09EB;</span>
            <!--<span><a href="http://support.portal.gov.bd/" style="color: green" target="_blank"> | <u>হেল্পডেস্ক</u></a></span>-->
        </div>
    </div>

    <div class="footer-credit" id="footer">
        <!--  -->

        {{-- <p>
            পরিকল্পনা ও বাস্তবায়নে:&nbsp;
            <a href="http://www.cabinet.gov.bd/">মন্ত্রিপরিষদ বিভাগ</a>,&nbsp; <a href="https://a2i.gov.bd">এটুআই</a>,&nbsp; <a href="http://www.bcc.net.bd/">বিসিসি</a>,&nbsp;
            <a href="http://doict.gov.bd/">ডিওআইসিটি</a>&nbsp;ও&nbsp; <a href="http://www.basis.org.bd/">বেসিস</a>।
        </p> --}}

        <!-- <p>
        কারিগরি সহায়তায়:<a href="https://a2i.gov.bd"><img
            style=""
            src="/themes/responsive_npf/img/a2i.png"
            alt=""></a>
    </p> -->

    <p>কারিগরি সহায়তায়</p>
        <p>
            <img style="vertical-align: baseline;" src="{{ asset('frontend/images/logo-use-1.png') }}" alt="" />
        </p>
    </div>
    <!-- /footer -->
</div>
