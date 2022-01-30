@extends('frontend_theme.single_vendor.front_layout.app')

{{-- @section('single_styles')

@endsection --}}

@section('main-content')
<main class="main"  >
<div class="container" id="cart-summary">
    <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
        <li class="active">
            <a href="#">Shopping Cart</a>
        </li>
        <li>
            <a href="#">Checkout</a>
        </li>
        <li class="disabled">
            <a href="#">Order Complete</a>
        </li>
    </ul>

    <div class="row">
        <div class="col-lg-8">
            <div class="cart-table-container">
                <table class="table table-cart">
                    <thead>
                        <tr>
                            <th class="thumbnail-col"></th>
                            <th class="product-col">Product</th>
                            <th class="price-col">Price</th>
                            <th class="qty-col">Quantity</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( $carts && count($carts) > 0 )

                        @php
                        $total = 0;
                        @endphp

                        @foreach ($carts as $key => $cartItem)

                        @php
                            $product = \App\Models\Product\Product::find($cartItem['product_id']);
                            $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                            $total = $total + ($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity'];
                            $product_name_with_choice = $product->title;
                            if ($cartItem['variation'] != null) {
                                $product_name_with_choice = $product->title.' - '.$cartItem['variation'];
                            }
                        @endphp


                        <tr class="product-row" >
                            <td>
                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="{{ asset('uploads/productphoto/'.$product->image) }}" alt="product">
                                    </a>

                                    <a href="javascript:void(0)" class="btn-remove icon-cancel" onclick="removeFromCartView(event, {{ $cartItem['id'] }})" title="Remove Product"></a>
                                </figure>
                            </td>
                            <td class="product-col">
                                <h5 class="product-title">
                                    <a href="#">{{ $product->title }}</a>
                                </h5>
                            </td>
                            <td>{{ $cartItem['price'] }}</td>
                            <td>
                                <div class="product-single-qty">
                                    {{-- <input class="horizontal-quantity form-control" type="text" value="{{ $cartItem['quantity'] }} "> --}}
                                    <input class="horizontal-quantity form-control" type="text" value="{{ $cartItem['quantity'] }}" name="quantity[{{ $cartItem['id'] }}]" onchange="updateQuantity({{ $cartItem['id'] }}, this)">
                                    {{-- <input type="number" name="quantity[{{ $cartItem['id'] }}]" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="{{ $cartItem['quantity'] }}" min="{{ $product->min_qty }}" max="{{ $product_stock->qty }}" onchange="updateQuantity({{ $cartItem['id'] }}, this)">
                                                        <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                            <i class="las la-plus"></i>
                                                        </button> --}}
                                </div><!-- End .product-single-qty -->
                            </td>
                            <td class="text-right"><span class="subtotal-price">{{ ($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity'] }}</span></td>
                        </tr>
                        @endforeach
                        @else

                        <tr class="product-row">
                            
                            <td class="product-col" colspan="5">
                                <h5 class=" text-center">
                                    Your Cart is Empty !
                                </h5>
                            </td>
                     
                        </tr>
                        @endif
                    </tbody>


                    <tfoot>
                        <tr>
                            <td colspan="5" class="clearfix">
                                <div class="float-left">
                                    <div class="cart-discount">
                                        <form action="#">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Coupon Code" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm" type="submit">Apply
                                                        Coupon</button>
                                                </div>
                                            </div><!-- End .input-group -->
                                        </form>
                                    </div>
                                </div><!-- End .float-left -->

                                <div class="float-right">
                                    <button type="submit" class="btn btn-shop btn-update-cart">
                                        Update Cart
                                    </button>
                                </div><!-- End .float-right -->
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- End .cart-table-container -->
        </div><!-- End .col-lg-8 -->

        <div class="col-lg-4">
            <div class="cart-summary">
                <h3>CART TOTALS</h3>

                <table class="table table-totals">
                    <tbody>
                     

                        
                    </tbody>

                    <tfoot>
                        <tr>
                            <td>Total</td>
                            @if( $carts && count($carts) > 0 )
                            <td>{{ $total }}</td>
                            @else
                            <td></td>
                            @endif

                        </tr>
                    </tfoot>
                </table>

                <div class="checkout-methods">
                    <a href="{{ route('checkout') }}" class="btn btn-block btn-dark">Proceed to Checkout
                        <i class="fa fa-arrow-right"></i></a>
                </div>
            </div><!-- End .cart-summary -->
        </div><!-- End .col-lg-4 -->
    </div><!-- End .row -->
</div>

<!-- End .container -->
</main>

<div class="mb-6"></div>
@endsection

@section('single_scripts')
    <script>
        function removeFromCartView(event, key){
            event.preventDefault();
            removeFromCart(key);
        }

        //Update cart
        function updateQuantity(key, element){
            $.post('{{ route('cart.updateQuantity') }}', {
                _token : '{{ csrf_token() }}',
                id       :  key,
                quantity :  element.value
            }, function(data){
                updateNavCart(data.nav_cart_view,data.cart_count);
                $('#cart-summary').html(data.cart_view);
            });
        }
    </script>
@endsection