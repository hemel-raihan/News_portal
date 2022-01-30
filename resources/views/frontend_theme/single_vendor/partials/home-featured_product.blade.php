<section class="brand-section appear-animate" style="background-color: #f4f4f4;">
    <div class="container">
        <h2 class="title title-underline pb-1 appear-animate" data-animation-name="fadeInLeftShorter">Featured Product</h2>
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

                @php
                  $products=\App\Models\Product\Product::where(['status'=>1, 'featured'=>1])->get();
                @endphp

                @if (count($products)>0)
                @foreach ($products as $product)
                        @include('frontend_theme.single_vendor.partials.product_box_1',['product'=>$product])
                @endforeach
                @endif
                
        </div>
    </div>
</section>