<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left d-none d-md-block">
                <div class="info-box info-box-icon-left text-primary justify-content-start p-0">
                    <i class="icon-shipping"></i>

                    <div class="info-box-content">
                        <h4>FREE Next Day Delivery For Orders $35+</h4>
                    </div><!-- End .info-box-content -->
                </div>
            </div><!-- End .header-left -->

            <div class="header-right header-dropdowns ml-0 ml-md-auto w-md-100">
                <div class="header-dropdown ">
                    <a href="#">USD</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">EUR</a></li>
                            <li><a href="#">USD</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropown -->

                <div class="header-dropdown mr-auto mr-md-0">
                    <a href="#"><i class="flag-us flag"></i>ENG</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#"><i class="flag-us flag mr-2"></i>ENG</a>
                            </li>
                            <li><a href="#"><i class="flag-fr flag mr-2"></i>FRA</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropown -->

                <span class="separator d-none d-xl-block"></span>

                <ul class="top-links mega-menu d-none d-xl-flex mb-0 pr-2">
                    <li class="menu-item menu-item-type-post_type menu-item-object-page narrow">
                        <a href="#"><i class="icon-pin"></i>Our Stores</a></li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom narrow">
                        <a href="#"><i class="icon-shipping-truck"></i>Track Your Order</a></li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page narrow">
                        <a href="#"><i class="icon-help-circle"></i>Help</a></li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page narrow">
                        <a href="#"><i class="icon-wishlist-2"></i>Wishlist</a></li>
                </ul>

                <span class="separator d-none d-md-block mr-0 ml-4"></span>

                <div class="social-icons">
                    <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                        title="facebook"></a>
                    <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                        title="twitter"></a>
                    <a href="#" class="social-icon social-instagram icon-instagram mr-0" target="_blank"
                        title="instagram"></a>
                </div><!-- End .social-icons -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div>
    <!-- End .header-top -->

    <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
                <button class="mobile-menu-toggler text-dark mr-2" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset('single_vendor/assets/images/demoes/demo42/shop42_logo.png') }}" class="w-100" width="202" height="80"
                        alt="Porto Logo">
                </a>
            </div><!-- End .header-left -->

            <div class="header-right w-lg-max">
                <div
                    class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mb-0">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search..."
                                required>

                            <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->

                <span class="separator d-none d-lg-block"></span>

                <div class="sicon-box mb-0 d-none d-lg-flex align-items-center pr-3 mr-1">
                    <div class=" sicon-default">
                        <i class="icon-phone-1"></i>
                    </div>
                    <div class="sicon-header">
                        <h4 class="sicon-title ls-n-25">CALL US NOW</h4>
                        <p>+123 5678 890</p>
                    </div> <!-- header -->
                </div>

                <span class="separator d-none d-lg-block mr-4"></span>

                <a href="#" class="d-lg-block d-none">
                    <div class="header-user">
                        <i class="icon-user-2"></i>
                        <div class="header-userinfo">

                            <h4>
                                @if (Auth::check())
                                <a href="{{ route('logout') }}">{{ __('Logout') }}</a> /
                                <a href="{{ route('customer.dashboard') }}">{{ __('My Panel') }}</a>
                                @else
                                <a href="{{ route('login') }}">{{ __('Login') }}</a> /
                                <a href="{{ route('register') }}">Register</a>
                                @endif
                            </h4>
                        </div>
                    </div>
                </a>

                <span class="separator d-block"></span>

                <div id="cart-items">
                    @include('frontend_theme.single_vendor.partials.nav-cart')

                </div>

                <!-- End .dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div>
    <!-- End .header-middle -->

    <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
        <div class="container">
            <nav class="main-nav w-100">
                <ul class="menu w-100">
                    {{-- category section --}}
                    <li class="menu-item d-flex align-items-center">
                        <a class="d-inline-flex align-items-center sf-with-ul">
                            <i class="custom-icon-toggle-menu d-inline-table"></i><span>All Categories</span></a>
                        <ul>
                            @php
                                $categories = \App\Models\Product\Productcategory::where('parent_id', 0)
                                                ->with('childrenRecursive')
                                                ->get();
                            @endphp

                            @foreach ($categories as $category)
                            <li><a href="{{route('shops',$category->slug)}}">{{ $category->name }}</a>
                                <ul>
                                    @foreach ($category->childrenRecursive as $childCategory)
                                        @include('frontend_theme.single_vendor.categories.child_category', ['child_category' => $childCategory])
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach

                        </ul>
                    </li>
                    {{-- end category --}}
                    @isset($menuitems)
                    @foreach ($menuitems as $menuitem)
                    @if($menuitem->childs->isEmpty())

                    <li>

                        @if ($menuitem->slug == null)
                        <a class="active" href="{{$menuitem->url}}">{{$menuitem->title}}</a>
                        @else
                        <a class="active" href="{{route('page',$menuitem->slug)}}">{{$menuitem->title}}</a>
                        @endif
                    </li>

                    @else

                    <li>
                        <a href="#">{{$menuitem->title}}</a>
                        <div class="megamenu megamenu-fixed-width">
                            <div class="row">
                                @foreach ($menuitem->childs as $item)
                                @if ($item->childs->isEmpty())
                                <div class="col-lg-6">
                                    @if ($item->slug == null)
                                    <a href="{{$item->url}}">{{$item->title}}</a>
                                    @else
                                    <a href="{{route('page',$item->slug)}}">{{$item->title}}</a>
                                    @endif
                                </div>
                                @else
                                <div class="col-lg-6">
                                    <a href="#" class="nolink">{{$item->title}}</a>
                                    <ul class="submenu">
                                        @foreach ($item->childs as $itemm)
                                        <li><a href="{{route('page',$itemm->slug)}}">{{$itemm->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @endforeach
                                {{-- <div class="col-lg-4">
                                    <a href="#" class="nolink">PRODUCT LAYOUTS</a>
                                    <ul class="submenu">
                                        <li><a href="product-extended-layout.html">EXTENDED LAYOUT</a></li>
                                        <li><a href="product-grid-layout.html">GRID IMAGE</a></li>
                                        <li><a href="product-full-width.html">FULL WIDTH LAYOUT</a></li>
                                        <li><a href="product-sticky-info.html">STICKY INFO</a></li>
                                        <li><a href="product-sticky-both.html">LEFT & RIGHT STICKY</a></li>
                                        <li><a href="product-transparent-image.html">TRANSPARENT IMAGE</a></li>
                                        <li><a href="product-center-vertical.html">CENTER VERTICAL</a></li>
                                        <li><a href="#">BUILD YOUR OWN</a></li>
                                    </ul>
                                </div><!-- End .col-lg-4 --> --}}

                                {{-- <div class="col-lg-4 p-0">
                                    <div class="menu-banner menu-banner-2">
                                        <figure>
                                            <img src="{{ asset('single_vendor/assets/images/menu-banner-1.jpg') }}" width="182" height="317"
                                                alt="Menu banner" class="product-promo">
                                        </figure>
                                        <i>OFF</i>
                                        <div class="banner-content">
                                            <h4>
                                                <span class="">UP TO</span><br />
                                                <b class="">50%</b>
                                            </h4>
                                        </div>
                                        <a href="category.html" class="btn btn-sm btn-dark">SHOP NOW</a>
                                    </div>
                                </div><!-- End .col-lg-4 --> --}}
                            </div><!-- End .row -->
                        </div><!-- End .megamenu -->
                    </li>
                    @endif
                    @endforeach
                    @endisset
                </ul>
            </nav>
        </div>

    </div>
    <!-- End .header-bottom -->
</header>
