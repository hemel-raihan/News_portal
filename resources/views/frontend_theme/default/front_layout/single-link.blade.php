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
    <div class="updateText" style="float: right; font-style: italic; font-size: 0.8em; color: #666;">সর্ব-শেষ হাল-নাগাদ: {{ $link->created_at->format('Y-m-d') }}</div>
    <hr id="print_div_hr" />
    <div id="printable_area">
        <u>নোটিশ</u>
        <h3>{{ $link->name }}</h3>
        {!! $link->text !!}

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
            href="#" target="_blank"
        >
            <img src="{{ asset('frontend/images/facebook.png') }} " alt="Facebook " />
        </a>
        <a
            href="#"
            target="_blank"
        >
            <img src="{{ asset('frontend/images/twitter.png') }}" alt="Facebook" />
        </a>
    </div>
</div>


@endsection

