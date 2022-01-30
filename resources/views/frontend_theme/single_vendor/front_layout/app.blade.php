<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Porto - Bootstrap eCommerce Template</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Bootstrap eCommerce Template">
    <meta name="author" content="SW-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('single_vendor/assets/images/icons/favicon.png') }}">
    <link rel="preload" href="{{ asset('single_vendor/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2') }}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ asset('single_vendor/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2') }}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ asset('single_vendor/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2') }}" as="font" type="font/woff2"
        crossorigin="anonymous">

    <script>
        //Reset scroll top
        history.scrollRestoration = "manual";

        // $(window).on('beforeunload', function(){
        //     $(window).scrollTop(0);
        // });
    </script>

    <script>
        WebFontConfig = {
            google: { families: [ 'Open+Sans:400,600', 'Poppins:400,500,600,700' ] }
        };
        ( function ( d ) {
            var wf = d.createElement( 'script' ), s = d.scripts[ 0 ];
            wf.src = "{{ asset('single_vendor/assets/js/webfont.js') }}";
            wf.async = true;
            s.parentNode.insertBefore( wf, s );
        } )( document );
    </script>


    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('single_vendor/assets/css/bootstrap.min.css') }}">

    <!-- Main CSS File -->

    <link rel="stylesheet" href="{{ asset('single_vendor/assets/css/demo42.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('single_vendor/assets/vendor/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('single_vendor/assets/css/sismoo-core.css') }}">

    <link rel="stylesheet" href="{{ asset('single_vendor/assets/css/style.min.css') }}">




    @yield('single_styles')

</head>

<body>
    <div class="page-wrapper">
        @include('frontend_theme.single_vendor.front_layout.top-notice')
        <!-- End .top-notice -->

            @php
            $menus = \App\Models\Frontmenu\Frontmenu::where([['type','=','main-menu'],['status','=',true]])->get();
            foreach($menus as $menu)
            {
                $menuitems = $menu->menuItems()->get();
            }
            @endphp
            @isset($menuitems)
             @include('frontend_theme.single_vendor.front_layout.header',['menuitems'=>$menuitems])
             @else
            @include('frontend_theme.single_vendor.front_layout.header')
            @endisset
        <!-- End .header -->

            @yield('main-content')

        <!-- End .main -->
        {{-- Modal --}}
        @yield('modal')
        {{--End Modal --}}

        @php
        $footer_menus = \App\Models\Frontmenu\Frontmenu::where([['type','=','footer-menu'],['status','=',true]])->get();
        foreach($footer_menus as $footer_menu)
        {
            $footer_menuitems = $footer_menu->menuItems()->get();
        }
        @endphp
        @isset($footer_menuitems)
        @include('frontend_theme.single_vendor.front_layout.footer',['footer_menuitems'=>$footer_menuitems])
        @else
        @include('frontend_theme.single_vendor.front_layout.footer')
        @endisset

    </div><!-- End .page-wrapper -->

    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->

    @include('frontend_theme.single_vendor.front_layout.mobile-menu')
    <!-- End .mobile-menu-container -->

    <div class="sticky-navbar">
        <div class="sticky-info">
            <a href="demo42.html">
                <i class="icon-home"></i>Home
            </a>
        </div>
        <div class="sticky-info">
            <a href="demo42-shop.html" class="">
                <i class="icon-bars"></i>Categories
            </a>
        </div>
        <div class="sticky-info">
            <a href="wishlist.html" class="">
                <i class="icon-wishlist-2"></i>Wishlist
            </a>
        </div>
        <div class="sticky-info">
            <a href="login.html" class="">
                <i class="icon-user-2"></i>Account
            </a>
        </div>
        <div class="sticky-info">
            <a href="cart.html" class="">
                <i class="icon-shopping-cart position-relative">
                    <span class="cart-count badge-circle">3</span>
                </i>Cart
            </a>
        </div>
    </div>

    {{-- @include('frontend_theme.single_vendor.partials.newsletter') --}}
    <!-- End .newsletter-popup -->

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    {{-- Modal section --}}

    {{-- show add to card modal --}}
    <div class="modal fade" id="addToCart">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader text-center p-3">
                    <i class="fa fa-spinner fa-spin fa-3x"></i>
                </div>
                <button type="button" class="close absolute-top-right btn-icon close z-1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="fa-2x">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>
    {{-- end add to card modal --}}

    <!-- Plugins JS File -->
    <script src="{{ asset('single_vendor/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('single_vendor/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('single_vendor/assets/js/optional/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('single_vendor/assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('single_vendor/assets/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('single_vendor/assets/js/jquery.plugin.min.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('single_vendor/assets/js/main.min.js') }}"></script>

    @yield('single_scripts')


    <script>
        function show_purchase_history_details(order_id)
        {
            $('#order-details-modal-body').html(null);

            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }

            $.post('{{ route('purchase_history.details') }}', { _token : '{{ csrf_token() }}', order_id : order_id}, function(data){
                $('#order-details-modal-body').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
            });
        }

        //Show add cart modal
        function showAddToCartModal(id){
            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }

            $('#addToCart-modal-body').html(null);
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.post('{{ route('cart.showCartModal') }}', {_token : '{{ csrf_token() }}', id:id}, function(data){
                $('.c-preloader').hide();
                $('#addToCart-modal-body').html(data);
                // SISMOO.plugins.slickCarousel();
                // SISMOO.plugins.zoom();
                // SISMOO.extra.plusMinus();
                // getVariantPrice();
            });
        }

        function addToCart()
        {

            if(checkAddToCartValidity()) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
                    type:"POST",
                    url: '{{ route('cart.addToCart') }}',
                    // product_id:product_id,
                    data: $('#option-choice-form').serializeArray(),

                    success: function(data){
                        console.log("cart added");
                       $('#addToCart-modal-body').html(null);
                       $('.c-preloader').hide();
                       $('#modal-size').removeClass('modal-lg');
                       $('#addToCart-modal-body').html(data.modal_view);
                        updateNavCart(data.nav_cart_view,data.cart_count);
                    }
                });
            }
            else{
                alert('Please choose all the options');
            }

        }

        //visibility check
        function checkAddToCartValidity(){
            var names = {};
            $('#option-choice-form input:radio').each(function() { // find unique names
                  names[$(this).attr('name')] = true;
            });
            var count = 0;
            $.each(names, function() { // then count them
                  count++;
            });

            if($('#option-choice-form input:radio:checked').length == count){
                return true;
            }

            return false;
        }

        function removeFromCart(key){

            $.post('{{ route('cart.removeFromCart') }}', {
              _token : '{{ csrf_token() }}',
                id      :  key
            }, function(data){
                // console.log("success");
                updateNavCart(data.nav_cart_view,data.cart_count);
                 $('#cart-summary').html(data.cart_view);
                 window.location.reload();
                // SISMOO.plugins.notify('success', "{{ translate('Item has been removed from cart') }}");
                // $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
            });
        }


        function updateNavCart(view,count){

            $('.cart-count').html(count);
            $('#cart-items').html(view);
            window.location.reload();
            // window.location.href="{{ route('cart') }}";
        }



        //Customer Dashboard section
        function customer_dashboard(){
             $('#customer-dashboard').html(null);
            $.post('{{ route('customer.dashboard-home') }}', {
              _token : '{{ csrf_token() }}',
            }, function(data){
                console.log("success");
                $('#customer-dashboard').html(data);
            });
        }

        function customer_orders(){
             $('#customer-dashboard').html(null);
            $.post('{{ route('customer.orders') }}', {
              _token : '{{ csrf_token() }}',
            }, function(data){
                console.log("success");
                $('#customer-dashboard').html(data.view_orders);
            });
        }

        function customer_downloads(){
             $('#customer-dashboard').html(null);
            $.post('{{ route('customer.download') }}', {
              _token : '{{ csrf_token() }}',
            }, function(data){
                console.log("success");
                 $('#customer-dashboard').html(data.view_download);
            });
        }
        function customer_address(){
             $('#customer-dashboard').html(null);
            $.post('{{ route('customer.address') }}', {
              _token : '{{ csrf_token() }}',
            }, function(data){
                console.log("success");
                 $('#customer-dashboard').html(data.view_address);
            });
        }

        function customer_account_details(){
             $('#customer-dashboard').html(null);
            $.post('{{ route('customer.account-details') }}', {
              _token : '{{ csrf_token() }}',
            }, function(data){
                console.log("success");
                 $('#customer-dashboard').html(data.view_account);
            });
        }

        function customer_wishlist(){
             $('#customer-dashboard').html(null);
            $.post('{{ route('customer.wishlist') }}', {
              _token : '{{ csrf_token() }}',
            }, function(data){
                console.log("success");
                 $('#customer-dashboard').html(data.view_wish);
            });
        }


    </script>


</body>

</html>
