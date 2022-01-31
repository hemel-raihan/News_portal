@extends('frontend_theme.single_vendor.front_layout.app')

@section('single_styles')
<style>
    .brand-section {
        padding: 0.9rem 0rem;
    }

    /* product card */
    .brand-section .product-default {
        padding: 0 0.6rem;
    }

    .inner-icon figure {
        height: 210px;
    }

    .product-default figure img:first-child {
        height: 100%;
        width: 100%;
    }
    /* end product card */
</style>
@endsection

@section('main-content')
<main class="main">
    {{-- slider --}}
    @include('frontend_theme.single_vendor.partials.home-slider')

{{-- <section class="search-section" style="background-color: #f4f4f4;">
    <div class="container">
        <div class="search-name d-lg-flex align-items-center appear-animate"
            data-animation-name="fadeInUpShorter">
            <h2 class="search-title"><i class="icon-business-book"></i>Add A Vehicle To
                Find Exact Fit Parts:</h2>
            <h4 class="search-info">Shop for your specific vehicle to find parts that fit.
            </h4>
        </div>
        <div class="row search-form appear-animate" data-animation-name="fadeInUpShorter">
            <div class="col-md-6 col-lg-3">
                <div class="select-custom">
                    <select class="form-control mb-0">
                        <option>By make</option>
                        <option>Dolor</option>
                        <option>Ipsum</option>
                        <option>Lorem</option>
                        <option>Sit</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="select-custom">
                    <select class="form-control mb-0">
                        <option>By model</option>
                        <option>Engine</option>
                        <option>Motor</option>
                        <option>Sound</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="select-custom">
                    <select class="form-control mb-0">
                        <option>By product-year</option>
                        <option>2018</option>
                        <option>2019</option>
                        <option>2020</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-lg-2">
                <a href="demo42-shop.html"
                    class="btn btn-borders btn-rounded btn-outline-primary ls-25 btn-block">Find
                    Auto Parts</a>
            </div>
        </div>
    </div>
</section> --}}
@foreach (\App\Models\Program\Program::all() as $program)
@php
    //$program = \App\Models\Program\Program::find(5);
    $today = date("Y/m/d");
    $to_day=date("Y-m-d",strtotime($today));
    $mytime = Carbon\Carbon::now();
    $start = Carbon\Carbon::parse($mytime)->format('h:i a');

    $from_datee=date("Y-m-d",strtotime($program->start_date));
    $from_time=date("h:i a",strtotime($program->start_time));
    $to_datee=date("Y-m-d",strtotime($program->end_date));
    $to_time=date("h:i a",strtotime($program->end_time));
@endphp
@if($to_day >= $from_datee && $to_day <= $to_datee)
@if ($start >= $from_time && $start <= $to_time)
<iframe id="hem" height="400" width="400" src="{{asset('uploads/video/'.$program->video.'#t=10')}}"></iframe>
{{-- <video>
    <source src="{{asset('uploads/video/'.$program->video.'#t=10,20')}}" type="video/mp4">
</video> --}}
@endif
@endif
@endforeach


{{--Home Flashdeal section --}}
<div id="home_flashdeal_section">

</div>

{{--Home Category section --}}
<div id="home_category_section">

</div>

{{--Home Hot Deals section --}}
<div id="home_hot_deal_section">

</div>

{{-- Best Selling  --}}
<div id="section_best_selling">

</div>

{{--Home special offer section --}}
<div id="home_specialoffer_section">

</div>

{{--Home featured section --}}
<div id="home_brand_featured">

</div>

{{--Home brand section --}}
<div id="home_brand_section">

</div>
{{--Home call section --}}
<div id="home_call_section">

</div>
{{--Home recently product section --}}
<div id="home_recent_section">

</div>


@include('frontend_theme.single_vendor.partials.home-sub_cat')

</main>

@endsection

@section('single_scripts')

<script>
    $(document).ready(function(){
        $("#hem")[0].src += "?autoplay=1";
    });
</script>

<script>
    $(document).ready(function(){
        $.post('{{ route('home.section.category') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#home_category_section').html(data);
                // Now we can call the owlCarousel
                var owl = $(".owl-carousel");
                owl.owlCarousel({'loop': false,'dots': false,'nav': true,'margin': 20,'responsive': {
                        '0': {
                            'items': 2
                        },
                        '576': {
                            'items': 4
                        },
                        '991': {
                            'items': 6
                        }
                    }
                });
        });
        $.post('{{ route('home.section.flashdeal') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#home_flashdeal_section').html(data);
                // Now we can call the owlCarousel
                var owl = $(".owl-carousel");
                owl.owlCarousel({'loop': false,'dots': false,'nav': true,'margin': 20,'responsive': {
                        '0': {
                            'items': 2
                        },
                        '576': {
                            'items': 4
                        },
                        '991': {
                            'items': 6
                        }
                    }
                });
        });

        $.post('{{ route('home.section.hot-deal') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#home_hot_deal_section').html(data);
            // Now we can call the owlCarousel
            var owl = $(".owl-carousel");
            owl.owlCarousel({'loop': false,'dots': false,'nav': true,'margin': 20,'responsive': {
                    '0': {
                        'items': 2
                    },
                    '576': {
                        'items': 4
                    },
                    '991': {
                        'items': 6
                    }
                }
            });
        });

        $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#section_best_selling').html(data);
            // Now we can call the owlCarousel
            var owl = $(".owl-carousel");
            owl.owlCarousel({'loop': false,'dots': false,'nav': true,'margin': 20,'responsive': {
                    '0': {
                        'items': 2
                    },
                    '576': {
                        'items': 4
                    },
                    '991': {
                        'items': 6
                    }
                }
            });
        });

        $.post('{{ route('home.section.specialoffer') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#home_specialoffer_section').html(data);
            // Now we can call the owlCarousel
            var owl = $(".owl-carousel");
            owl.owlCarousel({'loop': false,'dots': false,'nav': true,'margin': 20,'responsive': {
                    '0': {
                        'items': 1
                    },
                    '576': {
                        'items': 1
                    },
                    '991': {
                        'items': 1
                    }
                }
            });
        });
        $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#home_brand_featured').html(data);
            // Now we can call the owlCarousel
            var owl = $(".owl-carousel");
            owl.owlCarousel({'loop': false,'dots': false,'nav': true,'margin': 20,'responsive': {
                    '0': {
                        'items': 2
                    },
                    '576': {
                        'items': 4
                    },
                    '991': {
                        'items': 6
                    }
                }
            });
        });

        $.post('{{ route('home.section.brand') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#home_brand_section').html(data);
            // Now we can call the owlCarousel
            var owl = $(".owl-carousel");
            owl.owlCarousel({'loop': false,'dots': false,'nav': true,'margin': 20,'responsive': {
                    '0': {
                        'items': 2
                    },
                    '576': {
                        'items': 4
                    },
                    '991': {
                        'items': 6
                    }
                }
            });
        });
        $.post('{{ route('home.section.call') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#home_call_section').html(data);
        });
        $.post('{{ route('home.section.recent') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#home_recent_section').html(data);
            // Now we can call the owlCarousel
            var owl = $(".owl-carousel");
            owl.owlCarousel({'loop': false,'dots': false,'nav': true,'margin': 20,'responsive': {
                    '0': {
                        'items': 2
                    },
                    '576': {
                        'items': 4
                    },
                    '991': {
                        'items': 6
                    }
                }
            });
        });


    });
</script>
@endsection
