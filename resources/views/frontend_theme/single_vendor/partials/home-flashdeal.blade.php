@php
    $flash_deal = \App\Models\Product\Flashdeal::where('status', 1)->first();
    $today = date("Y/m/d");
    $to_day=date("Y-m-d",strtotime($today));
    $from_datee=date("Y-m-d",strtotime($flash_deal->start_date));
    $to_datee=date("Y-m-d",strtotime($flash_deal->end_date));
@endphp
@if($to_day >= $from_datee && $to_day <= $to_datee)
<section class="brand-section appear-animate" style="background-color: #f4f4f4;">
    <div class="container">
        <h2 class="title title-underline pb-1 appear-animate" data-animation-name="fadeInLeftShorter">Flash Deals</h2>
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

        @foreach ($flash_deal->products as $key => $flash_deal_product)
            @include('frontend_theme.single_vendor.partials.product_box_3',['flash_deal_product'=>$flash_deal_product])
        @endforeach


        </div>
    </div>
</section>
@else
asd
@endif
