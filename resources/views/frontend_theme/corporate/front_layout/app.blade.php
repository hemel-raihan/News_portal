<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
    @include('frontend_theme.corporate.front_layout.vertical.styles')

	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>Home-</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">


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
            @include('frontend_theme.corporate.front_layout.vertical.header',['menuitems'=>$menuitems])
            @else
            @include('frontend_theme.corporate.front_layout.vertical.header')
            @endisset

			<div class="header-wrap-clone"></div>

		</header>

        {{-- ........header end........ --}}

        <!-- Slider start
		============================================= -->

        @include('frontend_theme.corporate.front_layout.vertical.slider')

        <!-- Slider end
		============================================= -->



		<!-- Content
		============================================= -->
		{{-- <section id="content">
			<div class="content-wrap"> --}}
                @php
                    $page = \App\Models\Pagebuilder\Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
                @endphp
                <section id="content" style="background-color: {{$page->background_color}}; background-image: url('{{asset('uploads/custompagephoto/'.$page->background_img)}}');">
                    <div class="content-wrap">
                       <div class="{{$page->container}} clearfix">
                            <div class="row gutter-40 col-mb-80">
                                @if(!$page->leftsidebar_id == 0)
                                @php
                                $sidebars = \App\Models\Admin\Sidebar::where([['type','=','Left Side Bar'],['id','=',$page->leftsidebar_id]])->get();
                                foreach($sidebars as $sidebar)
                                {
                                    $widgets = $sidebar->widgets()->get();
                                }
                                @endphp

                                @include('frontend_theme.corporate.front_layout.vertical.left_sidebar',['widgets'=>$widgets])
                                @endif

                                @yield('content')

                                @if(!$page->rightsidebar_id == 0)
                                @php
                                $sidebars = \App\Models\Admin\Sidebar::where([['type','=','Right Side Bar'],['id','=',$page->rightsidebar_id]])->get();
                                foreach($sidebars as $sidebar)
                                {
                                    $widgets = $sidebar->widgets()->get();
                                }
                                @endphp
                                @isset($blog)
                                @if (!$blog->rightsidebar_id == 0)
                                @include('frontend_theme.corporate.front_layout.vertical.right_sidebar',['widgets'=>$widgets])
                                @endif
                                @else
                                @include('frontend_theme.corporate.front_layout.vertical.right_sidebar',['widgets'=>$widgets])
                                @endisset
                                @endif

                            </div>
                        </div>
                    </div>
                </section>
{{--
			</div>
		</section><!-- #content end --> --}}

		<!-- Footer
		============================================= -->

        @include('frontend_theme.corporate.front_layout.vertical.footer')

		<!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

    @include('frontend_theme.corporate.front_layout.vertical.scripts')


</body>
</html>
