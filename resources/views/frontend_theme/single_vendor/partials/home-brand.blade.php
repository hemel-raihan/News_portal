<section class="brand-section appear-animate" style="background-color: #f4f4f4;">
    <div class="container">
        <h2 class="title title-underline pb-1 appear-animate" data-animation-name="fadeInLeftShorter">Shop
            By
            Brand</h2>
        <div class="owl-carousel owl-theme nav-big nav-outer appear-animate" data-owl-options="{
                    'loop': false,
                    'dots': false,
                    'nav': true,
                    'margin': 20,
                    'responsive': {
                        '0': {
                            'items': 1
                        },
                        '750': {
                            'items': 2
                        }
                    }
                }">

            @foreach (\App\Models\Product\Product::where(['status'=>1])->get() as $product)
                @if ($product->brand_id !=null)     
                
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('product.details',$product->slug) }}">
                            <img src="{{ asset('uploads/productphoto/'.$product->image) }}" width="300" height="300" alt="product">
                        </a>
                        <div class="btn-icon-group">
                            <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" class="btn-icon  product-type-simple"><i
                                    class="icon-shopping-cart"></i></a>
                        </div>
                        
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
                                {{-- @foreach ($product-> as $category) --}}
                                <a href="#">{{ $product->brand->name }}</a>
                                {{-- @endforeach --}}
                            </div>
                            <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i
                                    class="icon-heart"></i></a>
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
                        </div>
                        <div class="price-box">
                            @if ($product->unit_price != home_discounted_base_price($product))
                            <del class="old-price">Tk.{{ $product->unit_price }}</del>
                            @endif
                            {{-- <span class="product-price">Tk.{{ $product->discount }}</span> --}}
                            <span class="product-price">Tk.{{ home_discounted_base_price($product) }}</span>
                        </div>
                    </div>
                </div>

                @endif
            @endforeach
        </div>
    </div>
</section>