<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en" xmlns="http://www.w3.org/1999/html">
    <!--<![endif]-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Online Polling -->
        <script src="{{ asset('frontend/js/npop.script.js')}}" defer></script>
        <!-- Comment Management Tools -->
        <script src="{{ asset('frontend/js/npc.script.js')}}" defer></script>
        <!-- userway accessibility start -->
        <!-- <script type="text/javascript">
      var _userway_config = {
      account: "xyS2BuGIbM"
      };
  </script>
  <script type="text/javascript" src="https://cdn.userway.org/widget.js"></script> -->
        <!-- userway accessibility end -->

        <title>{{ config('app.name')}} @yield('clg')</title>
        <!-- Mobile Specific Metas
    ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-Frame-Options" content="deny" />
        <meta name="description" content="" />

        <link rel="icon" type="image/png" href="{{ asset('frontend/images/browser_logo.png') }}">

        <!-- =============== tt canonical End =============================== -->

        <link type="text/css" rel="stylesheet" media="all" href="{{ asset('frontend/css/base.css') }}" />
        <link type="text/css" rel="stylesheet" media="all" href="{{ asset('frontend/css/skeleton.css') }}" />
        <link type="text/css" rel="stylesheet" media="all" href="{{ asset('frontend/css/style.css') }}" />
        <link type="text/css" rel="stylesheet" media="all" href="{{ asset('frontend/css/meganizr.css') }}" />
        <link type="text/css" rel="stylesheet" media="all" href="{{ asset('frontend/css/flaticon.css') }}" />
        <link type="text/css" rel="stylesheet" media="all" href="{{ asset('frontend/css/ministry/style.css') }}" />
        @yield('styles')
        <!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>-->
        <script type="text/javascript" src="{{ asset('frontend/js/jquery-1.11.1.min.js') }}"></script>

        <!-- include the jquery-accessibleMegaMenu plugin script -->
        <script src="{{ asset('frontend/js/jquery-accessibleMegaMenu.js') }}"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;1,300;1,900&display=swap" rel="stylesheet">
        <script>
            //jq160 = jQuery.noConflict( true );
        </script>

        <link rel="stylesheet" href="{{ asset('frontend/css/responsiveslides.css')}}" />

        <link rel="stylesheet" href="{{ asset('frontend/css/ministry/responsive.css')}}" />
        <link rel="stylesheet" href="{{ asset('frontend/css/ministry/accessibility.css')}}" />
        <script src="{{ asset('frontend/js/responsiveslides.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.vticker.js') }}" type="text/javascript"></script>

        <script src="{{ asset('frontend/js/domain_selector.js') }}" type="text/javascript"></script>
        <script src="{{ asset('frontend/js/utils.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/yoxview-init.js') }}"></script>



        @yield('frontscripts')

        <!-- custom accessibility start -->
        <link rel="stylesheet" href="{{ asset('frontend/css/asb.css') }}" />
        <script src="{{ asset('frontend/js/asb.js') }}" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.min.js"></script>
        <!-- custom accessibility end -->
    </head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CHQGVGYRNP"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-CHQGVGYRNP');
    </script>

    <body class="dshe-portal-gov-bd">
        <!-- ====== start jump to selections ======   -->
        <a class="skip-link" href="/accessibility.html" target="_blank">Accessibility Help</a>
        <a class="skip-link" href="#jmenu">Jump  Menu</a>
        <a class="skip-link" href="#contents">Jump to Content</a>
        <a class="skip-link" href="#search">Jump to Search</a>
        <a class="skip-link" href="#btnLang">Jump to Language</a>
        <!-- ====== End jump to selections ======   -->

        <div class="container">
            <script src="//bangladesh.gov.bd/nav/js/obd.main.js?v=1.0.1"></script>
            <script src="{{ asset('frontend/js/select2.js') }}"></script>
            <link rel="stylesheet" media="all" type="text/css" href="{{ asset('frontend/css/obd.main.css') }}" />


            {{-- ...........TOP BAR..... --}}

            @include('frontend_theme.default.front_layout.vertical.topbar')

            {{-- .........END TOPBAR............ --}}


            {{-- ...........SLIDE BAR..... --}}

            @include('frontend_theme.default.front_layout.vertical.slider')

            {{-- ...........END SLIDE BAR..... --}}

            <script>
                /* Responsive Design*/
                $(document).ready(function () {
                    var wi = $(window).width();
                    if (wi < 980) {
                        $("#jmenu .show-menu").click(function () {
                            //$('.mzr-responsive').show();
                            $(".mzr-responsive").slideToggle(400, "linear", function () {});
                        });

                        $("#jmenu a.submenu").click(function () {
                            $("#jmenu a.submenu").siblings().addClass("sibling-toggle");
                            $(this)
                                .parent()
                                .find(".mzr-content")
                                .removeClass("sibling-toggle")
                                .addClass("slide-visible")
                                .slideToggle(400, "linear", function () {
                                    return false;
                                });
                            // return false;
                        });
                    }
                });
            </script>

            {{-- ...........MENU BAR..... --}}

            @php
            $menus = \App\Models\Frontmenu\Frontmenu::where([['type','=','main-menu'],['status','=',true]])->get();
            foreach($menus as $menu)
            {
                $menuitems = $menu->menuItems()->get();
            }
            @endphp
            @isset($menuitems)
            @include('frontend_theme.default.front_layout.vertical.menubar',['menuitems'=>$menuitems])
            @else
            @include('frontend_theme.default.front_layout.vertical.menubar')
            @endisset


            {{-- ...........END MENU BAR..... --}}

            <style>
                .right-side-bar .block ul li a {
                    font-size: 14px;
                }

                #notice-board ul a {
                    font-size: 14px;
                }

                @media screen and (min-width: 1400px) {
                    .mainwrapper .box {
                        margin-right: 13px;
                    }
                }
            </style>



           {{-- .............BODY CONTENT.......... --}}

           <div id="contents" class="sixteen columns">

              @yield('bodycontent')

              @php
                $sidebars = \App\Models\Admin\Sidebar::where([['type','=','Right Side Bar'],['status','=',true]])->get();
                foreach($sidebars as $sidebar)
                {
                    $widgets = $sidebar->widgets()->get();
                }
            @endphp
              @if (!Request::is('widget/details*') && !Request::is('all-teachers-info'))
              @include('frontend_theme.default.front_layout.vertical.sidebar',['widgets'=>$widgets])
              @endif
           </div>

            {{-- .............END BODY CONTENT.......... --}}

        </div>
        <!-- container -->

        <div class="footer-artwork" id="footer-artwork">&nbsp;</div>

        {{-- ............FOOTER......... --}}

        @include('frontend_theme.default.front_layout.vertical.footer')

        {{-- ............END FOOTER......... --}}

        <script>
            function setLanguageCookie(cookieValue) {
                var today = new Date();
                var expire = new Date();
                var cookieName = "lang";
                //var cookieValue = "bn";
                var nDays = 5;
                expire.setTime(today.getTime() + 3600000 * 24 * nDays);
                document.cookie = cookieName + "=" + escape(cookieValue) + ";expires=" + expire.toGMTString();
            }

            function setLanguage() {
                $("#lang_form").submit();
                return false;
            }

            $(function () {
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

        <script>
            $(function () {
                function initNewsTicker(id, options) {
                    var $scroller = $(id);
                    $scroller.vTicker("init", options);

                    $("#news-ticker .next").click(function (event) {
                        event.preventDefault();
                        var checked = true;
                        $("#news-ticker").vTicker("next", { animate: checked });
                    });
                    $("#news-ticker .prev,#news-ticker .next").hover(
                        function () {
                            $("#news-ticker").vTicker("next", { animate: checked });
                            $scroller.vTicker("pause", true);
                        },
                        function () {
                            $("#news-ticker").vTicker("next", { animate: checked });
                            $scroller.vTicker("pause", false);
                        }
                    );
                    $("#news-ticker .prev").click(function (event) {
                        event.preventDefault();
                        var checked = true;
                        $("#news-ticker").vTicker("prev", { animate: checked });
                    });
                }

                function initNoticeBoardTicker(id, options) {
                    var $scroller = $(id);
                    $scroller.vTicker("init", options);

                    $("#notice-board-ticker .next").click(function (event) {
                        event.preventDefault();
                        var checked = true;
                        $("#notice-board-ticker").vTicker("next", { animate: false });
                    });
                    $("#notice-board-ticker .prev,#notice-board-ticker .next").hover(
                        function () {
                            $scroller.vTicker("pause", true);
                        },
                        function () {
                            $scroller.vTicker("pause", false);
                        }
                    );
                    $("#notice-board-ticker .prev").click(function (event) {
                        event.preventDefault();
                        var checked = true;
                        $("#notice-board-ticker").vTicker("prev", { animate: checked });
                    });
                }

                initNewsTicker("#news-ticker", {});
                //initNoticeBoardTicker('#notice-board-ticker', {showItems:10, margin: 0, padding: 0,animate:false});
            });

            /* Responsive Menu*/
        </script>

        <!-- Matomo -->
        <script type="text/javascript">
            var _paq = _paq || [];
            /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
            _paq.push(["trackPageView"]);
            _paq.push(["enableLinkTracking"]);
            (function () {
                var u = "https://analytics.portal.gov.bd/piwik/";
                _paq.push(["setTrackerUrl", u + "piwik.php"]);
                _paq.push(["setSiteId", 152]);
                var d = document,
                    g = d.createElement("script"),
                    s = d.getElementsByTagName("script")[0];
                g.type = "text/javascript";
                g.async = true;
                g.defer = true;
                g.src = u + "piwik.js";
                // s.parentNode.insertBefore(g, s);
            })();
        </script>
        <!-- End Matomo Code -->

        <script>
            $(".meganizr .mzr-drop").keyup(function () {
                $(".mzr-content").attr("aria-hidden", "true");
                $(this).find(".mzr-content").attr("aria-hidden", "false");
            });
            // ============ start tile for <a> and alt for img ========
            $("a").each(function () {
                $(this).attr("title", $(this).text());
            });

            var lan = "bn";
            if (lan == "en") {
                $(".mzr-drop a:first-child").each(function () {
                    $(this).attr("title", "Enter to get more menu");
                });
            } else {
                $(".mzr-drop a:first-child").each(function () {
                    $(this).attr("title", "সাবমেনুর জন্য ক্লিক করুন");
                });
            }
            $("img").each(function () {
                var str = $(this).attr("src");
                var arr = str.split("/");
                var strFine = arr[arr.length - 1];

                var str2 = strFine;
                var arr2 = str2.split(".");
                var strFine2 = arr2[arr2.length - 2];
                $(this).attr("alt", strFine2);
            });
            $("a2iLogo").attr("alt", "Access to information");
            $(".service-box img").each(function () {
                var strTitle = $(this).parent().find("h4").text();
                $(this).attr("alt", strTitle);
            });
            $(".block img").each(function () {
                var strTitleRight = $(this).closest(".block").find(".title").text();
                $(this).attr("alt", strTitleRight);
            });
            $("#notice-board-ticker .btn").attr("title", "সকল নোটিশ");
            $("#news-ticker .btn").attr("title", "সকল খবর");
            $("#search").each(function () {
                $(this).attr("alt", "Search");
            });
            $(".search-btn").each(function () {
                $(this).attr("alt", "Enter to search");
            });
            $(".mzr-content").mouseout(function () {
                $(this).hide();
            });
            $(".submenu").mouseover(function () {
                $(this).siblings(".mzr-content").show();
            });
            $(".mzr-content").mouseover(function () {
                $(this).show();
            });
            // ============ end tile for <a> and alt for img ========
        </script>





        <script>
            $(document).ready(function () {
                $(".slide-panel-button").click(function () {
                    $("#domain-selector-panel").toggle(); //animate({height: "toggle"}, 200);
                    if ($("#domain-selector-panel").is(":visible")) {
                        $("#div-lang").css("z-index", "200");
                    } else {
                        $("#div-lang").css("z-index", "1001");
                    }
                    $(".slide-panel-button").toggle();
                });
            });
        </script>

        <!-- ============ start accessibility megamenu ============ -->

        {{-- <script>
            $(document).ready(function ($) {
                $("#dawgdrops").accessibleMegaMenu({
                    /* prefix for generated unique id attributes, which are required
                 to indicate aria-owns, aria-controls and aria-labelledby */
                    uuidPrefix: "accessible-megamenu",

                    /* css class used to define the megamenu styling */
                    menuClass: "meganizr",

                    /* css class for a top-level navigation item in the megamenu */
                    topNavItemClass: "mzr-drop",

                    /* css class for a megamenu panel */
                    panelClass: "mzr-content",

                    /* css class for a group of items within a megamenu panel */
                    panelGroupClass: "mzr-links",

                    /* css class for the hover state */
                    hoverClass: "hover",

                    /* css class for the focus state */
                    focusClass: "focus-content",

                    /* css class for the open state */
                    openClass: "open hover-content",
                });
            });
        </script> --}}

        <script>
            $(document).ready(function () {
                var wi = $(window).width();
                if (wi < 769) {
                    $("#printable_area td").removeAttr("style");
                    $("#printable_area td p").css("width", "100%");
                }
            });
            $(".meganizr .mzr-drop").keyup(function () {
                $(".mzr-content").attr("aria-hidden", "true");
                $(this).find(".mzr-content").attr("aria-hidden", "false");
            });
            // ============ start tile for <a> and alt for img ========
            $("a").each(function () {
                $(this).attr("title", $(this).text());
            });

            var lan = "bn";
            if (lan == "en") {
                $(".mzr-drop a:first-child").each(function () {
                    $(this).attr("title", "Enter to get more menu");
                });
            } else {
                $(".mzr-drop a:first-child").each(function () {
                    $(this).attr("title", "সাবমেনুর জন্য ক্লিক করুন");
                });
            }
            $("img").each(function () {
                var str = $(this).attr("src");
                var arr = str.split("/");
                var strFine = arr[arr.length - 1];

                var str2 = strFine;
                var arr2 = str2.split(".");
                var strFine2 = arr2[arr2.length - 2];
                $(this).attr("alt", strFine2);
            });
            $("a2iLogo").attr("alt", "Access to information");
            $(".service-box img").each(function () {
                var strTitle = $(this).parent().find("h4").text();
                $(this).attr("alt", strTitle);
            });
            $(".block img").each(function () {
                var strTitleRight = $(this).closest(".block").find(".title").text();
                $(this).attr("alt", strTitleRight);
            });
            $("#notice-board-ticker .btn").attr("title", "সকল নোটিশ");
            $("#news-ticker .btn").attr("title", "সকল খবর");
            $("#search").each(function () {
                $(this).attr("alt", "Search");
            });
            $(".search-btn").each(function () {
                $(this).attr("alt", "Enter to search");
            });
            // ============ end tile for <a> and alt for img ========

            // =============== start dropdown design =======
            $(".mzr-content").mouseout(function () {
                // $(this).hide();
            });
            $(".submenu").mouseover(function () {
                //$('.mzr-content').show();
            });
            $(".mzr-content").mouseover(function () {
                //$(this).show();
            });
            // =============== End dropdown design =======
        </script>
    </body>
</html>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XL3REV1DHW"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag("js", new Date());

    gtag("config", "G-XL3REV1DHW");
    gtag("event", "www.dshe.gov.bd (Frontend)", {
        event_category: "Frontend",
    });
</script>
