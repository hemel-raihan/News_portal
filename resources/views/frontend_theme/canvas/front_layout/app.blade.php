<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
    @include('frontend_theme.canvas.front_layout.vertical.styles')

	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>Home - Magazine Layout | Canvas</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Top Bar
		============================================= -->

        @include('frontend_theme.canvas.front_layout.vertical.topbar')

		<!-- #top-bar end -->

		<!-- Header
		============================================= -->

        @include('frontend_theme.canvas.front_layout.vertical.header')

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

        @include('frontend_theme.canvas.front_layout.vertical.footer')

		<!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

    @include('frontend_theme.canvas.front_layout.vertical.scripts')


</body>
</html>
