<section class="category-section container">
    <div class="d-lg-flex align-items-center appear-animate" data-animation-name="fadeInLeftShorter">
        <h2 class="title title-underline divider">Shop Categories</h2>
        <a href="demo42-shop.html" class="sicon-title">VIEW CATEGORIES<i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="owl-carousel owl-theme appear-animate" data-owl-options="{
            'loop': false,
            'dots': false,
            'nav': true,
            'responsive': {
                '0': {
                    'items': 2
                },
                '576': {
                    'items': 3
                },
                '991': {
                    'items': 4
                }
            }
        }">

        @foreach (\App\Models\Product\Productcategory::where(['status'=>1])->get() as $key=>$category)
        <div class="product-category">
            <a href="{{route('shops',$category->id)}}">
                <figure>
                    <img src="{{ asset('uploads/productcategory_photo/'.$category->image) }}" alt="category" width="250"
                        height="250">
                </figure>
            </a>
            <div class="category-content">
                <h3 class="category-title">{{ $category->name }}</h3>
              
            </div>
        </div>  
        @endforeach

        
    </div>
</section>