
    <div class="product-default inner-quickview inner-icon">
        <figure>
            <a href="{{route('product.details',$product->slug)}}">
                <img src="{{asset('uploads/productphoto/'.$product->image)}}"
                     alt="product">
            </a>
            <div class="btn-icon-group">
                <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" class="btn-icon  product-type-simple"><i
                        class="icon-shopping-cart"></i></a>
            </div>
            <div class="label-group">
                @if ($product->discount_type == 'Percent')
                <span class="product-label label-sale">-{{$product->discount_rate}}%</span>
                @endif

            </div>

        </figure>
        <div class="product-details">
            <div class="category-wrap">
                {{-- <div class="category-list">
                    <a href="#">Interior Accessories</a>
                </div> --}}
                <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
            </div>
            <h3 class="product-title">
                <a href="{{route('product.details',$product->slug)}}">{{$product->title}}</a>
            </h3>
            <div class="ratings-container">
                <div class="product-ratings">
                    <span class="ratings" style="width:0%"></span>
                    <!-- End .ratings -->
                    <span class="tooltiptext tooltip-top">0</span>
                </div><!-- End .product-ratings -->
            </div><!-- End .product-container -->
            <div class="price-box">
                @if($product->discount_rate == null)
                <span class="product-price">${{number_format(($product->unit_price),2,'.','')}}</span>
                @else
                <del class="old-price">${{number_format(($product->unit_price),2,'.','')}}</del>
                @php
                    if($product->discount_type == 'Flat')
                    {
                        $after_discount = $product->unit_price - $product->discount_rate;
                    }
                    else
                    {
                        $percant = ($product->unit_price * $product->discount_rate)/100;
                        $after_discount = $product->unit_price - $percant;
                    }
                @endphp
                <span class="product-price">${{number_format(($after_discount),2,'.','')}}</span>
                @endif
            </div><!-- End .price-box -->
        </div><!-- End .product-details -->
    </div>

