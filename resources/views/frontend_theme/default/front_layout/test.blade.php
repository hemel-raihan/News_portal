@extends('frontend_theme.default.front_layout.index')

@section('frontscripts')
<script type="text/javascript" src="{{ asset('frontend/js/jquery.media.js') }}"></script>

{{-- preview pdf --}}
<script>
    $(function () {
        // doc viewer
        $("a.viewer").media({ width: 720, height: 600 });
        // Slideshow 4
        $("#front-image-slider").responsiveSlides({
            auto: true,
            pager: false,
            nav: true,
            speed: 2000,
            maxwidth: 960,
            namespace: "callbacks",
        });
        $("#right-content a").click(function () {
            var url = $(this).attr("href");
            if (isExternal(url) && url != "javascript:;") {
                openInNewTab(url);
                return false;
            }
        });
    });
    function openInNewTab(url) {
        var win = window.open(url, "_blank");
        win.focus();
    }
    function isExternal(url) {
        var match = url.match(/^([^:\/?#]+:)?(?:\/\/([^\/?#]*))?([^?#]+)?(\?[^#]*)?(#.*)?/);
        if (typeof match[1] === "string" && match[1].length > 0 && match[1].toLowerCase() !== location.protocol) return true;
        if (
            typeof match[2] === "string" &&
            match[2].length > 0 &&
            match[2].replace(
                new RegExp(
                    ":(" +
                        {
                            "http:": 80,
                            "https:": 443,
                        }[location.protocol] +
                        ")?$"
                ),
                ""
            ) !== location.host
        )
            return true;
        return false;
    }
</script>

{{-- print --}}
<script type="text/javascript">
    function print_content() {
        var html_content = $("#printable_area").html();

        newwindow = window.open();
        newdocument = newwindow.document;
        newdocument.write(html_content);
        newdocument.close();

        newwindow.print();

        return false;
    }
</script>
@endsection

@section('bodycontent')

<div class="accessibilityDesign" id="accessibilityDesign" title="লিখার রঙ ও সাইজ পরিবর্তন করুন">
    <div class="textSize">
        <span>Text size</span>
        <span title="Small font" class="font-small" onclick="fontSize(12)">A</span>
        <span title="Medium font" class="font-medium" onclick="fontSize(20)">A</span>
        <span title="Large font" class="font-large" onclick="fontSize(25)">A</span>
    </div>
    <div class="textBg">
        <span>Color</span>
        <span title="Bancground white text black" class="color-1" onclick="fontBgColor('fff','000')">C</span>
        <span title="Bancground blue text black" class="color-2" onclick="fontBgColor('cfe5fc','21205f')">C</span>
        <span title="Bancground black text yellow" class="color-3" onclick="fontBgColor('2f2f2f','ffff00')">C</span>
        <span title="Bancground grey text blue" class="color-4" onclick="fontBgColor('f7f3d6','000066')">C</span>
    </div>
</div>

<script>
    function fontSize(size) {
        var Size = size;
        $("#left-content").css({ "font-size": Size + "px" });
        $("#left-content div").css({ "font-size": Size + "px" });
        $("#left-content p").css({ "font-size": Size + "px" });
        $("#left-content a").css({ "font-size": Size + "px" });
        $("#left-content h1").css({ "font-size": Size + "px" });
        $("#left-content h2").css({ "font-size": Size + "px" });
        $("#left-content h3").css({ "font-size": Size + "px" });
        $("#left-content h4").css({ "font-size": Size + "px" });
        $("#left-content h5").css({ "font-size": Size + "px" });
        $("#left-content h6").css({ "font-size": Size + "px" });
        $("#left-content span").css({ "font-size": Size + "px" });
    }
    function fontBgColor(bgColor, fontColor) {
        var FontColor = fontColor;
        var BgColor = bgColor;
        $("#left-content").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content div").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content a").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content p").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content span").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content h1").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content h2").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content h3").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content h4").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content h5").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content h6").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
    }
</script>
<div class="twelve columns" id="left-content">
    <div id="print_btn_div"><img src="{{ asset('frontend/images/print_btn.png') }}" style="cursor: pointer;" onclick="print_content();" width="24" title="প্রিন্ট" /></div>
    <div class="updateText" style="float: right; font-style: italic; font-size: 0.8em; color: #666;">সর্ব-শেষ হাল-নাগাদ: &#x09E9;&#x09E6; নভেম্বর &#x09E8;&#x09E6;&#x09E8;&#x09E7;</div>
    <hr id="print_div_hr" />
    <div id="printable_area">
        <u>নোটিশ</u>
        <h3>মাউশি অধিদপ্তরাধীন সকল সরকারি শিক্ষা প্রতিষ্ঠানে কর্মরত সহকারী গ্রন্থাগারিক কাম ক্যাটালগার ও সহকারী গ্রন্থাগারিকগণের খসড়া জ্যেষ্ঠতার তালিকা।</h3>

        <a href="//dshe.portal.gov.bd/sites/default/files/files/dshe.portal.gov.bd/notices/66822a52_70c3_4562_ad29_60837748d6b3/001-converted (1)_compressed (1).pdf">
            <img src="{{ asset('frontend/images/pdf.png') }}" alt="001-converted (1)_compressed (1).pdf" class="file-icon" /> 001-converted (1)_compressed (1).pdf
        </a>
        <div><a class="viewer" href="//dshe.portal.gov.bd//sites/default/files/files/dshe.portal.gov.bd/notices/66822a52_70c3_4562_ad29_60837748d6b3/001-converted (1)_compressed (1).pdf"></a></div>
        <style></style>
        <script></script>
    </div>

    <div id="share-buttons" style="clear: both;">
        <br />
        <p>
            <b>Share with :</b>
        </p>

        <!-- Facebook -->
        <a
            href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fdshe.portal.gov.bd%2Fsite%2Fnotices%2F4b07fbe3-afce-4b8f-9c60-1293affe5baa%2F%25E0%25A6%25AE%25E0%25A6%25BE%25E0%25A6%2589%25E0%25A6%25B6%25E0%25A6%25BF-%25E0%25A6%2585%25E0%25A6%25A7%25E0%25A6%25BF%25E0%25A6%25A6%25E0%25A6%25AA%25E0%25A7%258D%25E0%25A6%25A4%25E0%25A6%25B0%25E0%25A6%25BE%25E0%25A6%25A7%25E0%25A7%2580%25E0%25A6%25A8-%25E0%25A6%25B8%25E0%25A6%2595%25E0%25A6%25B2-%25E0%25A6%25B8%25E0%25A6%25B0%25E0%25A6%2595%25E0%25A6%25BE%25E0%25A6%25B0%25E0%25A6%25BF-%25E0%25A6%25B6%25E0%25A6%25BF%25E0%25A6%2595%25E0%25A7%258D%25E0%25A6%25B7%25E0%25A6%25BE-%25E0%25A6%25AA%25E0%25A7%258D%25E0%25A6%25B0%25E0%25A6%25A4%25E0%25A6%25BF%25E0%25A6%25B7%25E0%25A7%258D%25E0%25A6%25A0%25E0%25A6%25BE%25E0%25A6%25A8%25E0%25A7%2587-%25E0%25A6%2595%25E0%25A6%25B0%25E0%25A7%258D%25E0%25A6%25AE%25E0%25A6%25B0%25E0%25A6%25A4-%25E0%25A6%25B8%25E0%25A6%25B9%25E0%25A6%2595%25E0%25A6%25BE%25E0%25A6%25B0%25E0%25A7%2580-%25E0%25A6%2597%25E0%25A7%258D%25E0%25A6%25B0%25E0%25A6%25A8%25E0%25A7%258D%25E0%25A6%25A5%25E0%25A6%25BE%25E0%25A6%2597%25E0%25A6%25BE%25E0%25A6%25B0%25E0%25A6%25BF%25E0%25A6%2595-%25E0%25A6%2595%25E0%25A6%25BE%25E0%25A6%25AE-%25E0%25A6%2595%25E0%25A7%258D%25E0%25A6%25AF%25E0%25A6%25BE%25E0%25A6%259F&quote=মাউশি-অধিদপ্তরাধীন-সকল-সরকারি-শিক্ষা-প্রতিষ্ঠানে-কর্মরত-সহকারী-গ্রন্থাগারিক-কাম-ক্যাট"
            target="_blank"
        >
            <img src="/themes/responsive_npf/img/facebook.png " alt="Facebook " />
        </a>
        <a
            href="https://twitter.com/intent/tweet?url=http%3A%2F%2Fdshe.portal.gov.bd%2Fsite%2Fnotices%2F4b07fbe3-afce-4b8f-9c60-1293affe5baa%2F%25E0%25A6%25AE%25E0%25A6%25BE%25E0%25A6%2589%25E0%25A6%25B6%25E0%25A6%25BF-%25E0%25A6%2585%25E0%25A6%25A7%25E0%25A6%25BF%25E0%25A6%25A6%25E0%25A6%25AA%25E0%25A7%258D%25E0%25A6%25A4%25E0%25A6%25B0%25E0%25A6%25BE%25E0%25A6%25A7%25E0%25A7%2580%25E0%25A6%25A8-%25E0%25A6%25B8%25E0%25A6%2595%25E0%25A6%25B2-%25E0%25A6%25B8%25E0%25A6%25B0%25E0%25A6%2595%25E0%25A6%25BE%25E0%25A6%25B0%25E0%25A6%25BF-%25E0%25A6%25B6%25E0%25A6%25BF%25E0%25A6%2595%25E0%25A7%258D%25E0%25A6%25B7%25E0%25A6%25BE-%25E0%25A6%25AA%25E0%25A7%258D%25E0%25A6%25B0%25E0%25A6%25A4%25E0%25A6%25BF%25E0%25A6%25B7%25E0%25A7%258D%25E0%25A6%25A0%25E0%25A6%25BE%25E0%25A6%25A8%25E0%25A7%2587-%25E0%25A6%2595%25E0%25A6%25B0%25E0%25A7%258D%25E0%25A6%25AE%25E0%25A6%25B0%25E0%25A6%25A4-%25E0%25A6%25B8%25E0%25A6%25B9%25E0%25A6%2595%25E0%25A6%25BE%25E0%25A6%25B0%25E0%25A7%2580-%25E0%25A6%2597%25E0%25A7%258D%25E0%25A6%25B0%25E0%25A6%25A8%25E0%25A7%258D%25E0%25A6%25A5%25E0%25A6%25BE%25E0%25A6%2597%25E0%25A6%25BE%25E0%25A6%25B0%25E0%25A6%25BF%25E0%25A6%2595-%25E0%25A6%2595%25E0%25A6%25BE%25E0%25A6%25AE-%25E0%25A6%2595%25E0%25A7%258D%25E0%25A6%25AF%25E0%25A6%25BE%25E0%25A6%259F&text=মাউশি-অধিদপ্তরাধীন-সকল-সরকারি-শিক্ষা-প্রতিষ্ঠানে-কর্মরত-সহকারী-গ্রন্থাগারিক-কাম-ক্যাট"
            target="_blank"
        >
            <img src="/themes/responsive_npf/img/twitter.png" alt="Facebook" />
        </a>
    </div>
</div>


@endsection

