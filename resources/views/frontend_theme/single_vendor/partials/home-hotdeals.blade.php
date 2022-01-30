<section class="brand-section appear-animate" style="background-color: #f4f4f4;">
    <div class="container">
        <h2 class="title title-underline pb-1 appear-animate" data-animation-name="fadeInLeftShorter">Hot Deals</h2>
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

                @foreach (\App\Models\Product\Product::where(['status'=>1,'todays_deal'=>1])->get() as $product)
                    @include('frontend_theme.single_vendor.partials.product_box_1',['product'=>$product])
                @endforeach
                
        </div>
    </div>
</section>