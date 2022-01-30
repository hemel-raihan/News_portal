@php
if(auth()->user() != null) {
    $user_id = Auth::user()->id;
    $cart = \App\Models\Cart\Cart::where('user_id', $user_id)->get();
} else {
    $temp_user_id = Session()->get('temp_user_id');
    if($temp_user_id) {
        $cart = \App\Models\Cart\Cart::where('temp_user_id', $temp_user_id)->get();
    }
}

@endphp

@if(isset($cart) && count($cart) > 0)
<div class="dropdown cart-dropdown">
    <a href="javascript:void(0)" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
        <i class="icon-cart-thick"></i>
        <span class="cart-count badge-circle cart-count">{{ count($cart) }}</span>
    </a>

    <div class="cart-overlay"></div>

    <div class="dropdown-menu mobile-cart">
        <a href="#" title="Close (Esc)" class="btn-close">×</a>

        <div class="dropdownmenu-wrapper custom-scrollbar">
            <div class="dropdown-cart-header">Shopping Cart</div>
            <!-- End .dropdown-cart-header -->

            <div class="dropdown-cart-products">
                @php
                $total = 0;
                @endphp
                @foreach ($cart as $cartItem)
                    @php
                        $product = \App\Models\Product\Product::find($cartItem['product_id']);
                        $total = $total + $cartItem['price'] * $cartItem['quantity'];
                    @endphp
                    <div class="product">
                        <div class="product-details">
                            <h4 class="product-title">
                                <a href="#">{{ $product->title }}</a>
                            </h4>

                            <span class="cart-product-info">
                                <span class="cart-product-qty">{{ $cartItem->quantity }}</span>
                                × tk.{{ $cartItem->price }}
                            </span>
                        </div>
                        <!-- End .product-details -->

                        <figure class="product-image-container">
                            <a href="demo42-product.html" class="product-image">
                                <img src="{{ asset('uploads/productphoto/'.$product->image) }}" alt="product"
                                    width="80" height="80">
                            </a>
                            <a href="javascript:void(0)" class="btn-remove" onclick="removeFromCart({{ $cartItem['id'] }})" title="Remove Product"><span>×</span></a>
                        </figure>
                    </div>
                @endforeach
                <!-- End .product -->
            </div><!-- End .cart-product -->

            <div class="dropdown-cart-total">
                <span>SUBTOTAL:</span>

                <span class="cart-total-price float-right">Tk.{{ $total }}</span>
            </div><!-- End .dropdown-cart-total -->

            <div class="dropdown-cart-action">
                <a href="{{ route('cart') }}" class="btn btn-gray btn-block view-cart">View
                    Cart</a>
                <a href="{{ route('checkout') }}" class="btn btn-dark btn-block">Checkout</a>
            </div><!-- End .dropdown-cart-total -->
        </div><!-- End .dropdownmenu-wrapper -->
    </div><!-- End .dropdown-menu -->
</div>

@else

{{-- else --}}
<div class="dropdown cart-dropdown">
    <a href="javascript:void(0)" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
        <i class="icon-cart-thick"></i>
        <span class="cart-count badge-circle">0</span>
    </a>

    <div class="cart-overlay"></div>

    <div class="dropdown-menu mobile-cart">
        <a href="#" title="Close (Esc)" class="btn-close">×</a>

        <div class="dropdownmenu-wrapper custom-scrollbar">
            <div class="dropdown-cart-header">Shopping Cart</div>
            <!-- End .dropdown-cart-header -->

            <div class="dropdown-cart-products">
                <p>Your Cart Is Empty !</p>
            </div><!-- End .cart-product -->

            <div class="dropdown-cart-action mt-5">
                <a href="{{ route('home') }}" class="btn btn-dark btn-block">Continue Shopping</a>
            </div><!-- End .dropdown-cart-total -->
        </div><!-- End .dropdownmenu-wrapper -->
    </div><!-- End .dropdown-menu -->
</div>

@endif