<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
    @include('frontend_theme.news_portal.front_layout.vertical.styles')

	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>Home-NotionTV</title>
    @php
    $logo  = \App\Models\Admin\Setting::where([['id',1]])->orderBy('id','desc')->first();
    @endphp
    @isset($logo)
    <link rel="icon" href="{{asset('uploads/settings/'.$logo->logo)}}">
    @endisset

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Top Bar
		============================================= -->

        @include('frontend_theme.news_portal.front_layout.vertical.topbar')

		<!-- #top-bar end -->

		<!-- Header
		============================================= -->
        @php
        $menus = \App\Models\Frontmenu\Frontmenu::where([['type','=','main-menu'],['status','=',true]])->get();
        foreach($menus as $menu)
        {
            $menuitems = $menu->menuItems()->get();
        }
        @endphp
        @isset($menuitems)
         @include('frontend_theme.news_portal.front_layout.vertical.header',['menuitems'=>$menuitems])
         @else
        @include('frontend_theme.news_portal.front_layout.vertical.header')
        @endisset

		<!-- #header end -->

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">

                @yield('content')

			</div>
		</section><!-- #content end -->

		<!-- Footer
		============================================= -->

        @php
        $footer_menus = \App\Models\Frontmenu\Frontmenu::where([['type','=','footer-menu'],['status','=',true]])->get();
        foreach($footer_menus as $footer_menu)
        {
            $footer_menuitems = $footer_menu->menuItems()->get();
        }
        @endphp
        @isset($footer_menuitems)
        @include('frontend_theme.news_portal.front_layout.vertical.footer',['footer_menuitems'=>$footer_menuitems])
        @else
        @include('frontend_theme.news_portal.front_layout.vertical.footer')
        @endisset

		<!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

    @include('frontend_theme.news_portal.front_layout.vertical.scripts')


</body>
</html>
