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
                {{-- Nav Cart Start--}}

                @php
                    if(auth()->user() != null) {
                        $user_id = Auth::user()->id;
                        $cart = \App\Models\Cart\Cart::where('user_id', $user_id)->get();
                    } else {
                        $temp_user_id = Session()->get('temp_user_id');
                        if($temp_user_id) {
                            $cart = \App\Models\Cart\Cart::where('temp_user_id', $temp_user_id)->get();
                        }
                    }

                @endphp

                <div class="dropdown cart-dropdown">
                    <a href="#" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-cart-thick"></i>
                        @if(isset($cart) && count($cart) > 0)
                        <span class="cart-count badge-circle">{{ count($cart) }}</span>
                        @else
                        <span class="cart-count badge-circle">0</span>
                        @endif
                    </a>

                    <div class="cart-overlay"></div>

                    <div class="dropdown-menu mobile-cart">
                        <a href="#" title="Close (Esc)" class="btn-close">×</a>

                        <div class="dropdownmenu-wrapper custom-scrollbar">
                            <div class="dropdown-cart-header">Shopping Cart</div>
                            <!-- End .dropdown-cart-header -->

                            <div class="dropdown-cart-products">
                                @if(isset($cart) && count($cart) > 0)
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($cart as $cartItem)
                                        @php
                                            $product = \App\Models\Product\Product::find($cartItem['product_id']);
                                            $total = $total + $cartItem['price'] * $cartItem['quantity'];
                                        @endphp
                                    <div class="product">
                                        <div class="product-details">
                                            <h4 class="product-title">
                                                <a href="#">{{ $product->title }}</a>
                                            </h4>

                                            <span class="cart-product-info">
                                                <span class="cart-product-qty">{{ $cartItem->quantity }}</span>
                                                × tk.{{ $cartItem->price }}
                                            </span>
                                        </div><!-- End .product-details -->

                                        <figure class="product-image-container">
                                            <a href="demo42-product.html" class="product-image">
                                                <img src="{{ asset('uploads/productphoto/'.$product->image) }}" alt="product"
                                                    width="80" height="80">
                                            </a>
                                            <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                                        </figure>
                                    </div>
                                    @endforeach
                               

             
                            </div><!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>SUBTOTAL:</span>

                                <span class="cart-total-price float-right">Tk.{{ $total }}</span>
                            </div><!-- End .dropdown-cart-total -->

                            <div class="dropdown-cart-action">
                                <a href="{{ route('cart') }}" class="btn btn-gray btn-block view-cart">View
                                    Cart</a>
                                <a href="{{ route('checkout') }}" class="btn btn-dark btn-block">Checkout</a>
                            </div>
                           
                            @endif
                        </div><!-- End .dropdownmenu-wrapper -->
                    </div><!-- End .dropdown-menu -->
                </div>
                {{-- End Nav Cart --}}
                <!-- End .dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div>
    <!-- End .header-middle -->

    <div class="header-bottom sticky-header d-none d-lg-flex" data-sticky-options="{'mobile': false}">
        <div class="container">
            <nav class="main-nav w-100">
                <ul class="menu w-100">
                    <li class="menu-item d-flex align-items-center">
                        <a href="#" class="d-inline-flex align-items-center sf-with-ul">
                            <i class="custom-icon-toggle-menu d-inline-table"></i><span>All
                                Departments</span></a>
                        <div class="menu-depart">
                            <a href="#"><i class="icon-category-motorcycles"></i>Auto Parts</a>

                            <a href="#">
                                <i class="icon-category-internal-accessories"></i>Interior Accessories
                            </a>

                            <a href="#"><i class="icon-category-mechanics"></i>Performance</a>

                            <a href="#"><i class="icon-category-sound-video"></i>Sound & Video</a>

                            <a href="#"><i class="icon-category-steering"></i>Steering Wheels</a>

                        </div>
                    </li>
                    <li class="active">
                        <a href="demo42.html">Home</a>
                    </li>
                    <li>
                        <a href="demo42-shop.html">Shop</a>
                        <div class="megamenu megamenu-fixed-width megamenu-3cols">
                            <div class="row">
                                <div class="col-lg-4">
                                    <a href="#" class="nolink">VARIATION 1</a>
                                    <ul class="submenu">
                                        <li><a href="demo42-shop.html" title="shop">Fullwidth Banner</a></li>
                                        <li><a href="category-banner-boxed-slider.html">Boxed Slider
                                                Banner</a>
                                        </li>
                                        <li><a href="category-banner-boxed-image.html">Boxed Image
                                                Banner</a>
                                        </li>
                                        <li><a href="demo42-shop.html" title="shop">Left Sidebar</a></li>
                                        <li><a href="category-sidebar-right.html">Right Sidebar</a></li>
                                        <li><a href="category-off-canvas.html">Off Canvas Filter</a></li>
                                        <li><a href="category-horizontal-filter1.html">Horizontal
                                                Filter1</a>
                                        </li>
                                        <li><a href="category-horizontal-filter2.html">Horizontal
                                                Filter2</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-4">
                                    <a href="#" class="nolink">VARIATION 2</a>
                                    <ul class="submenu">
                                        <li><a href="category-list.html">List Types</a></li>
                                        <li><a href="category-infinite-scroll.html">Ajax Infinite Scroll</a>
                                        </li>
                                        <li><a href="demo42-shop.html" title="shop">3 Columns Products</a></li>
                                        <li><a href="category-4col.html">4 Columns Products</a></li>
                                        <li><a href="category-5col.html">5 Columns Products</a></li>
                                        <li><a href="category-6col.html">6 Columns Products</a></li>
                                        <li><a href="category-7col.html">7 Columns Products</a></li>
                                        <li><a href="category-8col.html">8 Columns Products</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 p-0">
                                    <div class="menu-banner">
                                        <figure>
                                            <img src="{{ asset('single_vendor/assets/images/menu-banner.jpg') }}" width="192" height="313"
                                                alt="Menu banner">
                                        </figure>
                                        <div class="banner-content">
                                            <h4>
                                                <span class="">UP TO</span><br />
                                                <b class="">50%</b>
                                                <i>OFF</i>
                                            </h4>
                                            <a href="demo42-shop.html" class="btn btn-sm btn-dark">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End .megamenu -->
                    </li>
                    <li>
                        <a href="demo42-product.html">Products</a>
                        <div class="megamenu megamenu-fixed-width">
                            <div class="row">
                                <div class="col-lg-4">
                                    <a href="#" class="nolink">PRODUCT PAGES</a>
                                    <ul class="submenu">
                                        <li><a href="product.html">SIMPLE PRODUCT</a></li>
                                        <li><a href="product-variable.html">VARIABLE PRODUCT</a></li>
                                        <li><a href="product.html">SALE PRODUCT</a></li>
                                        <li><a href="product.html">FEATURED & ON SALE</a></li>
                                        <li><a href="product-custom-tab.html">WITH CUSTOM TAB</a></li>
                                        <li><a href="product-sidebar-left.html">WITH LEFT SIDEBAR</a></li>
                                        <li><a href="product-sidebar-right.html">WITH RIGHT SIDEBAR</a></li>
                                        <li><a href="product-addcart-sticky.html">ADD CART STICKY</a></li>
                                    </ul>
                                </div><!-- End .col-lg-4 -->

                                <div class="col-lg-4">
                                    <a href="#" class="nolink">PRODUCT LAYOUTS</a>
                                    <ul class="submenu">
                                        <li><a href="product-extended-layout.html">EXTENDED LAYOUT</a></li>
                                        <li><a href="product-grid-layout.html">GRID IMAGE</a></li>
                                        <li><a href="product-full-width.html">FULL WIDTH LAYOUT</a></li>
                                        <li><a href="product-sticky-info.html">STICKY INFO</a></li>
                                        <li><a href="product-sticky-both.html">LEFT & RIGHT STICKY</a></li>
                                        <li><a href="product-transparent-image.html">TRANSPARENT IMAGE</a>
                                        </li>
                                        <li><a href="product-center-vertical.html">CENTER VERTICAL</a></li>
                                        <li><a href="#">BUILD YOUR OWN</a></li>
                                    </ul>
                                </div><!-- End .col-lg-4 -->

                                <div class="col-lg-4 p-0">
                                    <div class="menu-banner menu-banner-2">
                                        <figure>
                                            <img src="{{ asset('single_vendor/assets/images/menu-banner-1.jpg') }}" alt="Menu banner"
                                                class="product-promo">
                                        </figure>
                                        <i>OFF</i>
                                        <div class="banner-content">
                                            <h4>
                                                <span class="">UP TO</span><br />
                                                <b class="">50%</b>
                                            </h4>
                                        </div>
                                        <a href="demo42-shop.html" class="btn btn-sm btn-dark">SHOP NOW</a>
                                    </div>
                                </div><!-- End .col-lg-4 -->
                            </div><!-- End .row -->
                        </div><!-- End .megamenu -->
                    </li>
                    <li>
                        <a href="#">Pages</a>
                        <ul>
                            <li><a href="wishlist.html">Wishlist</a></li>
                            <li><a href="cart.html">Shopping Cart</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li><a href="dashboard.html">Dashboard</a></li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="#">Blog</a>
                                <ul>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="single.html">Blog Post</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact Us</a></li>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="forgot-password.html">Forgot Password</a></li>
                        </ul>
                    </li>
                    <li><a href="https://1.envato.market/DdLk5" rel="noopener" target="_blank">Buy Porto!</a>
                    </li>
                    <li class="float-right"><a href="#" class="pr-0">Special Offers</a></li>
                </ul>
            </nav>
        </div><!-- End .container -->
    </div>
    <!-- End .header-bottom -->
</header>
