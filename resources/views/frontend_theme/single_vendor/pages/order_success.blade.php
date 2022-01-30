@extends('frontend_theme.single_vendor.front_layout.app')
@section('single_styles')
<!-- Main CSS File -->
<link rel="stylesheet" href="{{ asset('single_vendor/assets/css/style.min.css') }}">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('main-content')
<main class="main main-test">
    <div class="container checkout-container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li>
                <a href="cart.html">Shopping Cart</a>
            </li>
            <li>
                <a href="checkout.html">Checkout</a>
            </li>
            <li class="active">
                <a href="#">Order Complete</a>
            </li>
        </ul>

        <div class="text-center py-4 mb-4">
            <i class="fa fa-check-circle fa-3x text-success mb-3"></i>
            <h1 class="h3 mb-3 fw-600">Thank You for Your Order!</h1>
        </div>

        @php
            $first_order = $combined_order->orders->first();
        @endphp

        <div class="row">
            <div class="col-lg-8 offset-lg-2" >
                <div class="mb-4  p-4 rounded shadow-lg" style="color: #000000;">
                    <h5 class="fw-600 mb-3 pb-2">{{ translate('Order Summary')}}</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Order date')}}:</td>
                                    <td>{{ date('d-m-Y H:i A', $first_order->date) }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Name')}}:</td>
                                    <td>{{ json_decode($first_order->shipping_address)->name }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Email')}}:</td>
                                    <td>{{ json_decode($first_order->shipping_address)->email }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Shipping address')}}:</td>
                                    <td>{{ json_decode($first_order->shipping_address)->address }}, {{ json_decode($first_order->shipping_address)->city }}, {{ json_decode($first_order->shipping_address)->country }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Order status')}}:</td>
                                    <td>{{ translate(ucfirst(str_replace('_', ' ', $first_order->delivery_status))) }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Total order amount')}}:</td>
                                    <td>{{ $combined_order->grand_total }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Shipping')}}:</td>
                                    <td>{{ translate('Flat shipping rate')}}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Payment method')}}:</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $first_order->payment_type)) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                @foreach ($combined_order->orders as $order)
                        <div class="card shadow-sm border-0 rounded" style="color: #000000;">
                            <div class="card-body">
                                <div class="text-center py-4 mb-4">
                                    <h2 class="h5">{{ translate('Order Code:')}} <span class="fw-700 text-primary">{{ $order->code }}</span></h2>
                                </div>
                                <div>
                                    <h5 class="fw-600 mb-3 pb-2">{{ translate('Order Details')}}</h5>
                                    <div>
                                        <table class="table table-responsive-md">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th width="30%">{{ translate('Product')}}</th>
                                                    <th>{{ translate('Variation')}}</th>
                                                    <th>{{ translate('Quantity')}}</th>
                                                    <th>{{ translate('Delivery Type')}}</th>
                                                    <th class="text-right">{{ translate('Price')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->orderDetails as $key => $orderDetail)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>
                                                            @if ($orderDetail->product != null)
                                                                <a href="{{ route('product.details',$orderDetail->product->slug) }}" target="_blank" class="text-reset">
                                                                    {{ $orderDetail->product->title }}
                                                                    {{-- @php
                                                                        if($orderDetail->combo_id != null) {
                                                                            $combo = \App\Models\ComboProduct::findOrFail($orderDetail->combo_id);

                                                                            echo '('.$combo->combo_title.')';
                                                                        }
                                                                    @endphp --}}
                                                                </a>
                                                            @else
                                                                <strong>{{  translate('Product Unavailable') }}</strong>
                                                            @endif
                                                           
                                                        </td>
                                                        <td>
                                                            {{ $orderDetail->variation }}
                                                        </td>
                                                        <td>
                                                            {{ $orderDetail->quantity }}
                                                        </td>
                                                        <td>
                                                            @if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
                                                                {{  translate('Home Delivery') }}
                                                            @elseif ($orderDetail->shipping_type == 'pickup_point')
                                                                @if ($orderDetail->pickup_point != null)
                                                                    {{ $orderDetail->pickup_point->name }} ({{ translate('Pickip Point') }})
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td class="text-right">{{ $orderDetail->price }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-5 col-md-6 ml-auto mr-0">
                                            <table class="table ">
                                                <tbody>
                                                    <tr>
                                                        <th>{{ translate('Subtotal')}}</th>
                                                        <td class="text-right">
                                                            <span class="fw-600">{{ $order->orderDetails->sum('price') }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ translate('Shipping')}}</th>
                                                        <td class="text-right">
                                                            <span class="font-italic">{{ $order->orderDetails->sum('shipping_cost') }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ translate('Tax')}}</th>
                                                        <td class="text-right">
                                                            <span class="font-italic">{{ $order->orderDetails->sum('tax') }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ translate('Coupon Discount')}}</th>
                                                        <td class="text-right">
                                                            <span class="font-italic">{{ $order->coupon_discount }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-600">{{ translate('Total')}}</span></th>
                                                        <td class="text-right">
                                                            <strong><span>{{ $order->grand_total }}</span></strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                <!-- End .col-lg-4 -->
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-lg-8 offset-lg-2" >
                <div class="mb-4  p-4 rounded shadow-lg">
                    <div class="order-summary">
                        <h3>YOUR ORDER</h3>

                        <table class="table table-mini-cart">
                            <thead>
                                <tr>
                                    <th colspan="2">Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="product-col">
                                        <h3 class="product-title">
                                            Circled Ultimate 3D Speaker ×
                                            <span class="product-qty">4</span>
                                        </h3>
                                    </td>

                                    <td class="price-col">
                                        <span>$1,040.00</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="product-col">
                                        <h3 class="product-title">
                                            Fashion Computer Bag ×
                                            <span class="product-qty">2</span>
                                        </h3>
                                    </td>

                                    <td class="price-col">
                                        <span>$418.00</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <td>
                                        <h4>Subtotal</h4>
                                    </td>

                                    <td class="price-col">
                                        <span>$1,458.00</span>
                                    </td>
                                </tr>
                                <tr class="order-shipping">
                                    <td class="text-left" colspan="2">
                                        <h4 class="m-b-sm">Shipping</h4>

                                        <div class="form-group form-group-custom-control">
                                            <div class="custom-control custom-radio d-flex">
                                                <input type="radio" class="custom-control-input" name="radio" checked />
                                                <label class="custom-control-label">Local Pickup</label>
                                            </div>
                                            <!-- End .custom-checkbox -->
                                        </div>
                                        <!-- End .form-group -->

                                        <div class="form-group form-group-custom-control mb-0">
                                            <div class="custom-control custom-radio d-flex mb-0">
                                                <input type="radio" name="radio" class="custom-control-input">
                                                <label class="custom-control-label">Flat Rate</label>
                                            </div>
                                            <!-- End .custom-checkbox -->
                                        </div>
                                        <!-- End .form-group -->
                                    </td>

                                </tr>

                                <tr class="order-total">
                                    <td>
                                        <h4>Total</h4>
                                    </td>
                                    <td>
                                        <b class="total-price"><span>$1,603.80</span></b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="payment-methods">
                            <h4 class="">Payment methods</h4>
                            <div class="info-box with-icon p-0">
                                <p>
                                    Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.
                                </p>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark btn-place-order" form="checkout-form">
                            Place order
                        </button>
                    </div>
                    <!-- End .cart-summary -->
                </div>
                <!-- End .col-lg-4 -->
            </div>
        </div> --}}
        <!-- End .row -->
    </div>
    <!-- End .container -->
</main>
@endsection

@section('single_scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@endsection