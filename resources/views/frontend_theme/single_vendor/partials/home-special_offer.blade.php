<section class="product-section2 container">
    <div class="row">
        <div class="col-md-4 appear-animate" data-animation-name="fadeInLeftShorter">
            <h3 class="custom-title">Special Offers</h3>
            <div class="owl-carousel owl-theme dots-simple">
                <div class="banner banner1"
                    style="background: url('{{ asset('single_vendor/assets/images/demoes/demo42/banner/banner1.jpg') }}') rgb(232, 127, 59);
                background-position: center; background-size: cover; background-repeat: no-repeat; min-height: 40.2rem;">
                    <div class="banner-content banner-layer-middle position-absolute">

                        <img src="{{ asset('single_vendor/assets/images/demoes/demo42/shop_brand1.png') }}" width="232" height="28"
                            alt="brand" />
                        <h3 class="banner-subtitle text-uppercase text-white">Interior
                            Accessories</h3>
                        <h2 class="banner-title text-uppercase text-white font-weight-bold">
                            Starting<br>At <sup>$</sup>99<sup>99</sup>
                        </h2>
                        <p class="banner-desc text-white">Start Shopping Right Now</p>
                        <a href="#" class="btn btn-dark btn-rounded btn-icon-right ls-25" role="button">Shop
                            Now
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="banner banner2"
                    style="background: url('{{ asset('single_vendor/assets/images/demoes/demo42/banner/banner2.jpg') }}') rgb(83, 86, 91);
                background-position: center; background-size: cover; background-repeat: no-repeat; min-height: 40.2rem;">
                    <div class="banner-content banner-layer-middle position-absolute">

                        <img src="{{ asset('single_vendor/assets/images/demoes/demo42/shop_brand1.png') }}" width="232" height="28"
                            alt="brand" />
                        <h3 class="banner-subtitle text-uppercase text-white">Interior
                            Accessories</h3>
                        <h2 class="banner-title text-uppercase text-white font-weight-bold">
                            Starting<br>At <sup>$</sup>99<sup>99</sup>
                        </h2>
                        <p class="banner-desc text-white">Start Shopping Right Now</p>
                        <a href="#" class="btn btn-primary btn-rounded btn-icon-right ls-25"
                            role="button">Shop
                            Now
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 appear-animate" data-animation-name="fadeInLeftShorter"
            data-animation-delay="200">
            <div class="d-lg-flex align-items-center">
                <h3 class="custom-title divider">We Suggest</h3>
                <a href="#" class="sicon-title">VIEW ALL<i
                        class="fas fa-arrow-right"></i></a>
            </div>
            @foreach (\App\Models\Product\Product::where(['status'=>1,'todays_deal'=>1])->take(3)->get() as $product)
            <div class="product-default left-details product-widget">
                <figure>
                    <a href="{{ route('product.details',$product->slug) }}">
                        <img src="{{ asset('uploads/productphoto/'.$product->image) }}" width="95"
                            height="95" alt="product">
                    </a>
                </figure>
                <div class="product-details">
                    <div class="category-list">
                        @foreach ($product->productcategories as $category)
                        <a href="#">{{ $category->name }}</a>
                        @endforeach
                    </div>
                    <h3 class="product-title">
                        <a href="{{ route('product.details',$product->slug) }}">{{ $product->title }}</a>
                    </h3>
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:0%"></span>
                            <!-- End .ratings -->
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <!-- End .product-ratings -->
                    </div>
                    <!-- End .product-container -->
                    <div class="price-box">
                        @if ($product->unit_price != home_discounted_base_price($product))
                        <del class="old-price">Tk.{{ $product->unit_price }}</del>
                        @endif
                        {{-- <span class="product-price">Tk.{{ $product->discount }}</span> --}}
                        <span class="product-price">Tk.{{ home_discounted_base_price($product) }}</span>
                    </div>
                    <!-- End .price-box -->
                </div>
                <!-- End .product-details -->
            </div>
            @endforeach

        </div>
        <div class="col-md-4 appear-animate" data-animation-name="fadeInLeftShorter"
            data-animation-delay="400">
            <div class="d-lg-flex align-items-center">
                <h3 class="custom-title divider">Customer Favorites</h3>
                <a href="#" class="sicon-title">VIEW ALL<i
                        class="fas fa-arrow-right"></i></a>
            </div>

            @foreach (\App\Models\Product\Product::where(['status'=>1,'todays_deal'=>1])->take(3)->get() as $product)
            <div class="product-default left-details product-widget">
                <figure>
                    <a href="{{ route('product.details',$product->slug) }}">
                        <img src="{{ asset('uploads/productphoto/'.$product->image) }}" width="95"
                            height="95" alt="product">
                    </a>
                </figure>
                <div class="product-details">
                    <div class="category-list">
                        @foreach ($product->productcategories as $category)
                        <a href="#">{{ $category->name }}</a>
                        @endforeach
                    </div>
                    <h3 class="product-title">
                        <a href="{{ route('product.details',$product->slug) }}">{{ $product->title }}</a>
                    </h3>
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:100%"></span>
                            <!-- End .ratings -->
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <!-- End .product-ratings -->
                    </div>
                    <!-- End .product-container -->
                    <div class="price-box">
                        @if ($product->unit_price != home_discounted_base_price($product))
                        <del class="old-price">Tk.{{ $product->unit_price }}</del>
                        @endif
                        {{-- <span class="product-price">Tk.{{ $product->discount }}</span> --}}
                        <span class="product-price">Tk.{{ home_discounted_base_price($product) }}</span>
                    </div>
                    <!-- End .price-box -->
                </div>
                <!-- End .product-details -->
            </div>
            @endforeach

        </div>
    </div>
</section>
