<div class="modal-body p-4 c-scrollbar-light">
    <div class="row">
        <div class="col-lg-6">
            <a href="{{ route('product.details',$product->slug) }}">
                <img src="{{ asset('uploads/productphoto/'.$product->image) }}" width="300" height="300" alt="product">
            </a>
        </div>
        <div class="col-lg-6">
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


                    {{-- <div class="product-single-qty">
                        <input class="horizontal-quantity form-control" type="text" name="quantity"  value="{{ $product->min_qty }}" min="{{ $product->min_qty }}" max="10">
                    </div> --}}

                    <div class="product-single-qty pb-2">
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                            <span class="input-group-btn input-group-prepend">
                                <button class="btn btn-outline btn-down-icon bootstrap-touchspin-down" type="button"></button>
                            </span>
                            <input class="horizontal-quantity form-control" type="text" name="quantity" value="{{ $product->min_qty }}" min="{{ $product->min_qty }}" max="10">
                            <span class="input-group-btn input-group-append">
                                <button class="btn btn-outline btn-up-icon bootstrap-touchspin-up" type="button"></button>
                            </span>
                        </div>
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

                <a href="javascript:void(0)" onclick="addToCart({{ $product->id }})" class="btn btn-dark add-cart mr-2" title="Add to Cart">Add to Cart</a>

                <a href="{{ route('cart') }}" class="btn btn-gray view-cart">View cart</a>
            </div>
        </div>
    </div>
</div>