@extends('frontend_theme.single_vendor.front_layout.app')

@section('main-content')
<main class="main">
<div class="container" id="single_product_view">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="demo42.html"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item"><a href="#">Lanterns & lighting</a></li>
            <li class="breadcrumb-item active"><a href="#">Product Short Name</a></li>
        </ol>
    </nav>

    <div class="product-single-container product-single-default">
        <div class="cart-message d-none">
            <strong class="single-cart-notice">{{ $product->title }}</strong>
            <span>has been added to your cart.</span>
        </div>

        <div class="row">
            <div class="col-lg-5 col-md-6 product-single-gallery">
                <div class="product-slider-container">
                    @php
                        $photos = explode('|',$product->gallaryimage);
                    @endphp
                    <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                        @foreach ($photos as $key=>$photo)
                        <div class="product-item">
                            <img class="product-single-image"
                                src="{{ asset('uploads/productgallary_image/'.$photo) }}"
                                data-zoom-image="{{ asset('uploads/productgallary_image/'.$photo) }}"
                                width="468" height="468" alt="product" />
                        </div>
                        @endforeach

                    </div>
                    <!-- End .product-single-carousel -->
                    <span class="prod-full-screen">
                        <i class="icon-plus"></i>
                    </span>
                </div>

                <div class="prod-thumbnail owl-dots">
                    @foreach ($photos as $key=>$photo)
                        <div class="owl-dot">
                            <img src="{{ asset('uploads/productgallary_image/'.$photo) }}" width="110"
                                height="110" alt="product-thumbnail" />
                        </div>
                    @endforeach

                </div>
            </div>
            <!-- End .product-single-gallery -->

            <div class="col-lg-7 col-md-6 product-single-details">
                <h1 class="product-title">{{ $product->title }}</h1>

                <div class="product-nav">
                    <div class="product-prev">
                        <a href="#">
                            <span class="product-link"></span>

                            <span class="product-popup">
                                <span class="box-content">
                                    <img alt="product" width="150" height="150"
                                        src="{{asset('single_vendor/assets/images/products/product-3.jpg')}}"
                                        style="padding-top: 0px;">

                                    <span>Circled Ultimate 3D Speaker</span>
                                </span>
                            </span>
                        </a>
                    </div>

                    <div class="product-next">
                        <a href="#">
                            <span class="product-link"></span>

                            <span class="product-popup">
                                <span class="box-content">
                                    <img alt="product" width="150" height="150"
                                        src="{{asset('single_vendor/assets/images/products/product-4.jpg')}}"
                                        style="padding-top: 0px;">

                                    <span>Blue Backpack for the Young</span>
                                </span>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="ratings-container">
                    <div class="product-ratings">
                        <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                        <span class="tooltiptext tooltip-top"></span>
                    </div><!-- End .product-ratings -->

                    <a href="#" class="rating-link">( 1 Reviews )</a>
                </div><!-- End .ratings-container -->

                <hr class="short-divider">

                <div class="price-box">
                    {{-- <span class="product-price">Tk.{{ $product->unit_price }}</span> --}}
                    @if ($product->unit_price != home_discounted_base_price($product))
                    <del class="old-price">Tk.{{ $product->unit_price }}</del>
                    @endif
                    {{-- <span class="product-price">Tk.{{ $product->discount }}</span> --}}
                    <span class="product-price">Tk.{{ home_discounted_base_price($product) }}</span>
                </div><!-- End .price-box -->

                <div class="product-desc">
                    <p>
                        {!!Str::limit($product->desc, 100)!!}
                    </p>
                </div><!-- End .product-desc -->

                <ul class="single-info-list">
                    <!---->
                    <li>
                        SKU:
                        <strong>{{ $product->sku }}</strong>
                    </li>

                    <li>
                        CATEGORY:
                        <strong>
                            @foreach ($product->productcategories as $category)
                                <a href="#" class="product-category">{{ $category->name }}</a>
                            @endforeach
                        </strong>
                    </li>

                    {{-- <li>
                        TAGs:
                        <strong><a href="#" class="product-category">Jeep</a></strong>,
                        <strong><a href="#" class="product-category">Nissan</a></strong>
                    </li> --}}
                    <li>
                        Brand:
                        @isset($product->brand)
                        <strong><a href="#" class="product-category">{{$product->brand->name}}</a></strong>
                        @endisset

                    </li>
                </ul>

                <div class="product-action">
                    <form id="option-choice-form">

                        {{-- Attribute --}}
                        <input type="hidden" name="id" value="{{ $product->id }}">

                        @if ($product->choice_options != null)
                        @foreach (json_decode($product->choice_options) as $key => $choice)
                            <div class="row no-gutters">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">{{ \App\Models\Product\Attribute::find($choice->attribute_id)->name }}:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="sismoo-radio-inline">
                                        @foreach ($choice->values as $key => $value)
                                        <label class="sismoo-megabox pl-0 mr-2">
                                            <input
                                                type="radio"
                                                name="attribute_id_{{ $choice->attribute_id }}"
                                                value="{{ $value }}"
                                                @if($key == 0) checked @endif
                                            >
                                            <span class="sismoo-megabox-elem rounded d-flex align-items-center justify-content-center py-2 px-3 mb-2">
                                                {{ $value }}
                                            </span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif
                        {{-- Color --}}
                        @if (count(json_decode($product->colors)) > 0)
                        <div class="row no-gutters">
                            <div class="col-sm-2">
                                <div class="opacity-50 my-2">{{ translate('Color')}}:</div>
                            </div>
                            <div class="col-sm-10">
                                <div class="sismoo-radio-inline">
                                    @foreach (json_decode($product->colors) as $key => $color)
                                    <label class="sismoo-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{ \App\Models\Product\Color::where('code', $color)->first()->name }}">
                                        <input
                                            type="radio"
                                            name="color"
                                            value="{{ \App\Models\Product\Color::where('code', $color)->first()->name }}"
                                            @if($key == 0) checked @endif
                                            >

                                        <span class="sismoo-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                            <span class="size-30px d-inline-block rounded" style="background: {{ $color }};"></span>
                                        </span>
                                    </label>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                       @endif


                        <div class="product-single-qty">
                            <input class="horizontal-quantity form-control" type="text" name="quantity"  value="{{ $product->min_qty }}" min="{{ $product->min_qty }}" max="10">
                        </div>
                        <input type="hidden" name="product_id" value="{{ $product->id }}" >
                        <input type="hidden" name="price" value="{{ $product->unit_price }}" >

                        {{-- @php
                            $colors = json_decode($product->colors);
                        @endphp
                        @foreach ($colors as $key=>$color)
                        <input type="text" name="color" value="{{ \App\Models\Product\Color::where('code', $color)->first()->name }}">
                        @endforeach --}}

                        @if (Auth::check() && !Auth::user()->addresses->isEmpty())
                        @php
                            $address = \App\Models\Address\Address::where('user_id',Auth::user()->id)->first();
                        @endphp
                        <input type="hidden" name="address_id" value="{{ $address->id }}" >

                        @endif

                        <!-- End .product-single-qty -->
                    </form>

                    <a href="javascript:void(0)" onclick="addToCart()" class="btn btn-dark add-cart mr-2" title="Add to Cart">Add to Cart</a>

                    <a href="{{ route('cart') }}" class="btn btn-gray view-cart">View cart</a>
                </div>
                <!-- End .product-action -->

                <hr class="divider mb-0 mt-0">

                <div class="product-single-share mb-2">
                    <label class="sr-only">Share:</label>

                    <div class="social-icons mr-2">
                        <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                            title="Facebook"></a>
                        <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                            title="Twitter"></a>
                        <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank"
                            title="Linkedin"></a>
                        <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank"
                            title="Google +"></a>
                        <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank"
                            title="Mail"></a>
                    </div><!-- End .social-icons -->

                    <a href="wishlist.html" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i
                            class="icon-wishlist-2"></i><span>Add to
                            Wishlist</span></a>
                </div><!-- End .product single-share -->
            </div><!-- End .product-single-details -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End .product-single-container -->

    <div class="product-single-tabs">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="product-tab-desc" data-toggle="tab"
                    href="#product-desc-content" role="tab" aria-controls="product-desc-content"
                    aria-selected="true">Description</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content"
                    role="tab" aria-controls="product-tags-content" aria-selected="false">Additional
                    Information</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="product-tab-reviews" data-toggle="tab"
                    href="#product-reviews-content" role="tab" aria-controls="product-reviews-content"
                    aria-selected="false">Reviews (1)</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                aria-labelledby="product-tab-desc">
                <div class="product-desc-content">
                    {!!$product->desc!!}
                </div><!-- End .product-desc-content -->
            </div><!-- End .tab-pane -->

            <div class="tab-pane fade" id="product-tags-content" role="tabpanel"
                aria-labelledby="product-tab-tags">
                <table class="table table-striped mt-2">
                    <tbody>
                        {{-- <tr>
                            <th>Weight</th>
                            <td>23 kg</td>
                        </tr>

                        <tr>
                            <th>Dimensions</th>
                            <td>12 × 24 × 35 cm</td>
                        </tr> --}}

                        <tr>
                            <th>Color</th>
                            <td>
                                @if (count(json_decode($product->colors)) != 0)
                                @foreach (json_decode($product->colors) as $key => $color)
                                {{ \App\Models\Product\Color::where('code', $color)->first()->name }},
                                @endforeach
                                @else
                                No Colors
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Size</th>
                            <td>
                                @if (count(json_decode($product->choice_options)) != 0)
                                @foreach (json_decode($product->choice_options) as $key => $choice)
                                @foreach ($choice->values as $key => $value)
                                {{$value}},
                                @endforeach
                                @endforeach
                                @else
                                No Size
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- End .tab-pane -->

            <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                aria-labelledby="product-tab-reviews">
                <div class="product-reviews-content">
                    <h3 class="reviews-title">1 review for Men Black Sports Shoes</h3>

                    <div class="comment-list">
                        <div class="comments">
                            <figure class="img-thumbnail">
                                <img src="{{asset('single_vendor/assets/images/blog/author.jpg')}}" alt="author" width="80"
                                    height="80">
                            </figure>

                            <div class="comment-block">
                                <div class="comment-header">
                                    <div class="comment-arrow"></div>

                                    <div class="ratings-container float-sm-right">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:60%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div><!-- End .product-ratings -->
                                    </div>

                                    <span class="comment-by">
                                        <strong>Joe Doe</strong> – April 12, 2018
                                    </span>
                                </div>

                                <div class="comment-content">
                                    <p>Excellent.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="add-product-review">
                        <h3 class="review-title">Add a review</h3>

                        <form action="#" class="comment-form m-0">
                            <div class="rating-form">
                                <label for="rating">Your rating <span class="required">*</span></label>
                                <span class="rating-stars">
                                    <a class="star-1" href="#">1</a>
                                    <a class="star-2" href="#">2</a>
                                    <a class="star-3" href="#">3</a>
                                    <a class="star-4" href="#">4</a>
                                    <a class="star-5" href="#">5</a>
                                </span>

                                <select name="rating" id="rating" required="" style="display: none;">
                                    <option value="">Rate…</option>
                                    <option value="5">Perfect</option>
                                    <option value="4">Good</option>
                                    <option value="3">Average</option>
                                    <option value="2">Not that bad</option>
                                    <option value="1">Very poor</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Your review <span class="required">*</span></label>
                                <textarea cols="5" rows="6" class="form-control form-control-sm"></textarea>
                            </div><!-- End .form-group -->


                            <div class="row">
                                <div class="col-md-6 col-xl-12">
                                    <div class="form-group">
                                        <label>Name <span class="required">*</span></label>
                                        <input type="text" class="form-control form-control-sm" required>
                                    </div><!-- End .form-group -->
                                </div>

                                <div class="col-md-6 col-xl-12">
                                    <div class="form-group">
                                        <label>Email <span class="required">*</span></label>
                                        <input type="text" class="form-control form-control-sm" required>
                                    </div><!-- End .form-group -->
                                </div>

                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                            id="save-name" />
                                        <label class="custom-control-label mb-0" for="save-name">Save my
                                            name, email, and website in this browser for the next time I
                                            comment.</label>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div><!-- End .add-product-review -->
                </div><!-- End .product-reviews-content -->
            </div><!-- End .tab-pane -->
        </div><!-- End .tab-content -->
    </div><!-- End .product-single-tabs -->

    <div class="products-section pt-0">
        <h2 class="section-title">Related Products</h2>

        <div class="products-slider owl-carousel owl-theme dots-top dots-small dots-simple">
            <div class="product-default inner-quickview inner-icon">
                <figure>
                    <a href="demo42-product.html">
                        <img src="{{asset('single_vendor/assets/images/demoes/demo42/product/product6-300x300.jpg')}}" width="300"
                            height="300" alt="product">
                    </a>
                    <div class="btn-icon-group">
                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                class="icon-shopping-cart"></i></a>
                    </div>
                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                        View</a>
                </figure>
                <div class="product-details">
                    <div class="category-wrap">
                        <div class="category-list">
                            <a href="#">Fluids &amp; Chemicals</a>,
                            <a href="#">Hot Deals</a>
                        </div>
                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                    </div>
                    <h3 class="product-title">
                        <a href="demo42-product.html">Product Short Name</a>
                    </h3>
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:80%"></span>
                            <!-- End .ratings -->
                            <span class="tooltiptext tooltip-top"></span>
                        </div><!-- End .product-ratings -->
                    </div><!-- End .product-container -->
                    <div class="price-box">
                        <span class="product-price">$299.00</span>
                    </div><!-- End .price-box -->
                </div><!-- End .product-details -->
            </div>

            <div class="product-default inner-quickview inner-icon">
                <figure>
                    <a href="demo42-product.html">
                        <img src="{{asset('single_vendor/assets/images/demoes/demo42/product/product11-300x300.jpg')}}" width="300"
                            height="300" alt="product">
                    </a>
                    <div class="btn-icon-group">
                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                class="icon-shopping-cart"></i></a>
                    </div>
                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                        View</a>
                </figure>
                <div class="product-details">
                    <div class="category-wrap">
                        <div class="category-list">
                            <a href="#">Sound &amp; Video</a>
                        </div>
                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                    </div>
                    <h3 class="product-title">
                        <a href="demo42-product.html">Product Short Name</a>
                    </h3>
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:80%"></span>
                            <!-- End .ratings -->
                            <span class="tooltiptext tooltip-top">4.00</span>
                        </div><!-- End .product-ratings -->
                    </div><!-- End .product-container -->
                    <div class="price-box">
                        <span class="product-price">$299.00</span>
                    </div><!-- End .price-box -->
                </div><!-- End .product-details -->
            </div>

            <div class="product-default inner-quickview inner-icon">
                <figure>
                    <a href="demo42-product.html">
                        <img src="{{asset('single_vendor/assets/images/demoes/demo42/product/product5-300x300.jpg')}}" width="300"
                            height="300" alt="product">
                    </a>
                    <div class="btn-icon-group">
                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                class="icon-shopping-cart"></i></a>
                    </div>
                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                        View</a>
                </figure>
                <div class="product-details">
                    <div class="category-wrap">
                        <div class="category-list">
                            <a href="#">Hot Deals</a>,
                            <a href="#">Steering Wheels</a>
                        </div>
                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                    </div>
                    <h3 class="product-title">
                        <a href="demo42-product.html">Product Short Name</a>
                    </h3>
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:80%"></span>
                            <!-- End .ratings -->
                            <span class="tooltiptext tooltip-top"></span>
                        </div><!-- End .product-ratings -->
                    </div><!-- End .product-container -->
                    <div class="price-box">
                        <span class="product-price">$55.00</span>
                    </div><!-- End .price-box -->
                </div><!-- End .product-details -->
            </div>

            <div class="product-default inner-quickview inner-icon">
                <figure>
                    <a href="demo42-product.html">
                        <img src="{{asset('single_vendor/assets/images/demoes/demo42/product/product7-300x300.jpg')}}" width="300"
                            height="300" alt="product">
                    </a>
                    <div class="label-group">
                        <span class="product-label label-hot">HOT</span>
                        <span class="product-label label-sale">-35%</span>
                    </div>
                    <div class="btn-icon-group">
                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                class="icon-shopping-cart"></i></a>
                    </div>
                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                        View</a>
                </figure>
                <div class="product-details">
                    <div class="category-wrap">
                        <div class="category-list">
                            <a href="#">Interior Accessories</a>
                        </div>
                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                    </div>
                    <h3 class="product-title">
                        <a href="demo42-product.html">Product Short Name</a>
                    </h3>
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:0%"></span>
                            <!-- End .ratings -->
                            <span class="tooltiptext tooltip-top"></span>
                        </div><!-- End .product-ratings -->
                    </div><!-- End .product-container -->
                    <div class="price-box">
                        <span class="product-price">$299.00</span>
                    </div><!-- End .price-box -->
                </div><!-- End .product-details -->
            </div>

            <div class="product-default inner-quickview inner-icon">
                <figure>
                    <a href="demo42-product.html">
                        <img src="{{asset('single_vendor/assets/images/demoes/demo42/product/product13-300x300.jpg')}}" width="300"
                            height="300" alt="product">
                    </a>
                    <div class="label-group">
                        <span class="product-label label-sale">-17%</span>
                    </div>
                    <div class="btn-icon-group">
                        <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                class="icon-shopping-cart"></i></a>
                    </div>
                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                        View</a>
                </figure>
                <div class="product-details">
                    <div class="category-wrap">
                        <div class="category-list">
                            <a href="#">Auto Parts</a>
                        </div>
                        <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                    </div>
                    <h3 class="product-title">
                        <a href="demo42-product.html">Product Short Name</a>
                    </h3>
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:80%"></span>
                            <!-- End .ratings -->
                            <span class="tooltiptext tooltip-top"></span>
                        </div><!-- End .product-ratings -->
                    </div><!-- End .product-container -->
                    <div class="price-box">
                        <del class="old-price">$59.00</del>
                        <span class="product-price">$49.00</span>
                    </div><!-- End .price-box -->
                </div><!-- End .product-details -->
            </div>
        </div><!-- End .products-slider -->
    </div><!-- End .products-section -->
</div>
</main>
@endsection
