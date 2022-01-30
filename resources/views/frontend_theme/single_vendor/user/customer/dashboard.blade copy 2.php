@extends('frontend_theme.single_vendor.front_layout.user_panel')
@section('panel_content')
<div class="col-lg-9 order-lg-last order-1 tab-content">
    <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
        <div class="dashboard-content">
            
            <div class="row pt-5 ">
                <div class="col-6 col-sm-3">
                    <div class="card shadow-lg border-0 rounded" style="color: #000000; ">
                        <div class="card-body">
                            <div class="text-center">
                                <h4>0 <span class="fw-700 text-primary">Products</span></h4>
                                <p>In your cart</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="card shadow-lg border-0 rounded" style="color: #000000; ">
                        <div class="card-body">
                            <div class="text-center">
                                <h4>0 <span class="fw-700 text-primary">Products</span></h4>
                                <p>In your cart</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="card shadow-lg border-0 rounded" style="color: #000000; ">
                        <div class="card-body">
                            <div class="text-center">
                                <h4>0 <span class="fw-700 text-primary">Products</span></h4>
                                <p>In your cart</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="card shadow-lg border-0 rounded" style="color: #000000; ">
                        <div class="card-body">
                            <div class="text-center">
                                <h4>0 <span class="fw-700 text-primary">Products</span></h4>
                                <p>In your cart</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End .col-sm-4 -->
            </div>



            <div class="mb-4"></div>

            <div class="row row-lg">
                <div class="col-6 col-md-4">
                    <div class="feature-box text-center pb-4">
                        <a href="#order" class="link-to-tab"><i
                                class="sicon-social-dropbox"></i></a>
                        <div class="feature-box-content">
                            <h3>ORDERS</h3>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4">
                    <div class="feature-box text-center pb-4">
                        <a href="#download" class="link-to-tab"><i
                                class="sicon-cloud-download"></i></a>
                        <div class=" feature-box-content">
                            <h3>DOWNLOADS</h3>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4">
                    <div class="feature-box text-center pb-4">
                        <a href="#address" class="link-to-tab"><i
                                class="sicon-location-pin"></i></a>
                        <div class="feature-box-content">
                            <h3>ADDRESSES</h3>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4">
                    <div class="feature-box text-center pb-4">
                        <a href="#edit" class="link-to-tab"><i class="icon-user-2"></i></a>
                        <div class="feature-box-content p-0">
                            <h3>ACCOUNT DETAILS</h3>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4">
                    <div class="feature-box text-center pb-4">
                        <a href="#wishlist"  class="link-to-tab"><i class="sicon-heart"></i></a>
                        <div class="feature-box-content">
                            <h3>WISHLIST</h3>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4">
                    <div class="feature-box text-center pb-4">
                        <a href="login.html"><i class="sicon-logout"></i></a>
                        <div class="feature-box-content">
                            <h3>LOGOUT</h3>
                        </div>
                    </div>
                </div>
            </div><!-- End .row -->
        </div>
    </div>
    <!-- End .tab-pane -->

    {{-- @php
        $orders = \App\Models\Order\Order::where('user_id', Auth::user()->id)->orderBy('code', 'desc')->get();
    @endphp --}}

    <div class="tab-pane fade" id="order" role="tabpanel">
        <div class="order-content">
            <h3 class="account-sub-title d-none d-md-block"><i
                    class="sicon-social-dropbox align-middle mr-3"></i>Orders</h3>
            <div class="order-table-container text-center">
                

                <table class="table sismoo-table mb-0" style="color: #000000!important;">
                    <thead>
                        <tr>
                            <th>{{ translate('Code')}}</th>
                            <th data-breakpoints="md">{{ translate('Date')}}</th>
                            <th>{{ translate('Amount')}}</th>
                            <th data-breakpoints="md">{{ translate('Delivery Status')}}</th>
                            <th data-breakpoints="md">{{ translate('Payment Status')}}</th>
                            <th class="text-right">{{ translate('Options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                            @if (count($order->orderDetails) > 0)
                                <tr>
                                    <td>
                                        <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</a>
                                    </td>
                                    <td>{{ date('d-m-Y', $order->date) }}</td>
                                    <td>
                                        {{ $order->grand_total }}
                                    </td>
                                    <td>
                                        {{ translate(ucfirst(str_replace('_', ' ', $order->delivery_status))) }}
                                        @if($order->delivery_viewed == 0)
                                            <span class="ml-2" style="color:green"><strong>*</strong></span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->payment_status == 'paid')
                                            <span class="badge badge-inline badge-success">{{translate('Paid')}}</span>
                                        @else
                                            <span class="badge badge-inline badge-danger">{{translate('Unpaid')}}</span>
                                        @endif
                                        @if($order->payment_status_viewed == 0)
                                            <span class="ml-2" style="color:green"><strong>*</strong></span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if ($order->orderDetails->first()->delivery_status == 'pending' && $order->payment_status == 'unpaid')
                                            <a href="javascript:void(0)" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="#" title="{{ translate('Cancel') }}">
                                               <i class="fa fa-trash"></i>
                                           </a>
                                        @endif
                                        <a href="javascript:void(0)" class="btn btn-soft-info btn-icon btn-circle btn-sm" onclick="show_purchase_history_details({{ $order->id }})" title="{{ translate('Order Details') }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="#" title="{{ translate('Download Invoice') }}">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="sismoo-pagination">
                    	{{ $orders->links() }}
              	</div>


                <hr class="mt-0 mb-3 pb-2" />

                <a href="category.html" class="btn btn-dark">Go Shop</a>
            </div>
        </div>
    </div>

    <!-- End .tab-pane -->
    <div class="tab-pane fade" id="wishlist" role="tabpanel">
        <div class="wishlist-content">
            <h3 class="account-sub-title d-none d-md-block"><i
                    class="sicon-social-dropbox align-middle mr-3"></i>Wishlist</h3>
            <div class="wishlist-table-container text-center">
                <table class="table table-wishlist text-left">
                    <thead>
                        <tr>
                            <th class="wishlist-id">Photo</th>
                            <th class="wishlist-date">Name</th>
                            <th class="wishlist-status">Price</th>
                            <th class="wishlist-price">Stock</th>
                            <th class="wishlist-action">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="product-row">
                            <td>
                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="assets/images/products/product-4.jpg" alt="product">
                                    </a>

                                    <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a>
                                </figure>
                            </td>
                            <td>
                                <h5 class="product-title">
                                    <a href="product.html">Men Watch</a>
                                </h5>
                            </td>
                            <td class="price-box">$17.90</td>
                            <td>
                                <span class="stock-status">In stock</span>
                            </td>
                            <td class="action">
                                <a href="ajax/product-quick-view.html" class="btn btn-quickview mt-1 mt-md-0"
                                    title="Quick View"><i class="fa fa-trash"></i></a>
                                <button class="btn btn-dark ">
                                    ADD TO CART
                                </button>
                            </td>
                        </tr>
                        <tr class="product-row">
                            <td>
                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="assets/images/products/product-4.jpg" alt="product">
                                    </a>

                                    <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a>
                                </figure>
                            </td>
                            <td>
                                <h5 class="product-title">
                                    <a href="product.html">Men Watch</a>
                                </h5>
                            </td>
                            <td class="price-box">$17.90</td>
                            <td>
                                <span class="stock-status">In stock</span>
                            </td>
                            <td class="action">
                                <a href="ajax/product-quick-view.html" class="btn btn-quickview mt-1 mt-md-0"
                                    title="Quick View"><i class="fa fa-trash"></i></a>
                                <button class="btn btn-dark ">
                                    ADD TO CART
                                </button>
                            </td>
                        </tr>
                        <tr class="product-row">
                            <td>
                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="assets/images/products/product-4.jpg" alt="product">
                                    </a>

                                    <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a>
                                </figure>
                            </td>
                            <td>
                                <h5 class="product-title">
                                    <a href="product.html">Men Watch</a>
                                </h5>
                            </td>
                            <td class="price-box">$17.90</td>
                            <td>
                                <span class="stock-status">In stock</span>
                            </td>
                            <td class="action">
                                <a href="ajax/product-quick-view.html" class="btn btn-quickview mt-1 mt-md-0"
                                    title="Quick View"><i class="fa fa-trash"></i></a>
                                <button class="btn btn-dark ">
                                    ADD TO CART
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr class="mt-0 mb-3 pb-2" />

                <a href="category.html" class="btn btn-dark">Go Shop</a>
            </div>
        </div>
    </div>
    <!-- End .tab-pane -->

    
    <!-- End .tab-pane -->

    <div class="tab-pane fade" id="download" role="tabpanel">
        <div class="download-content">
            <h3 class="account-sub-title d-none d-md-block"><i
                    class="sicon-cloud-download align-middle mr-3"></i>Downloads</h3>
            <div class="download-table-container">
                <p>No downloads available yet.</p> <a href="category.html"
                    class="btn btn-primary text-transform-none mb-2">GO SHOP</a>
            </div>
        </div>
    </div>
    <!-- End .tab-pane -->

    <div class="tab-pane fade" id="address" role="tabpanel">
        <h3 class="account-sub-title d-none d-md-block mb-1"><i
                class="sicon-location-pin align-middle mr-3"></i>Addresses</h3>
        <div class="addresses-content">
            <p class="mb-4">
                The following addresses will be used on the checkout page by
                default.
            </p>

            <div class="row">
                <div class="address col-md-6">
                    <div class="heading d-flex">
                        <h4 class="text-dark mb-0">Billing address</h4>
                    </div>

                    <div class="address-box">
                        You have not set up this type of address yet.
                    </div>

                    <a href="#billing" class="btn btn-default address-action link-to-tab">Add
                        Address</a>
                </div>

            </div>
        </div>
    </div>
    <!-- End .tab-pane -->

    <div class="tab-pane fade" id="edit" role="tabpanel">
        <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
                class="icon-user-2 align-middle mr-3 pr-1"></i>Account Details</h3>
        <div class="account-content">
            
            <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="change-password">
                    <div class="form-group">
                        <label for="name">Full Name<span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Full Name"
                            id="name" name="name" value="{{ Auth::user()->name }}" required />
                    </div>
                    
                    <div class="form-group mb-2">
                        <label for="phone">Phone<span class="required">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="Phone" required />
                    </div>
                    {{-- <div class="form-group mb-2">
                        <label for="acc-text">Photo<span class="required">*</span></label>
                        <input type="text" class="form-control" id="photo" name="photo"
                            placeholder="Photo" required />
                    </div> --}}

                    <button type="submit" class="btn btn-dark mr-0">
                        Save changes
                    </button>
                </div>
               
            </form>

            <form method="POST" action="{{ route('change.password') }}">
                @csrf 
                <div class="change-password">
                    <h3 class="text-uppercase mb-2">Password Change</h3>

                    <div class="form-group">
                        <label for="password">Current Password (leave blank to leave unchanged)</label>
                        <input id="password" type="password" class="form-control"  name="current_password" autocomplete="current-password"/>
                    </div>

                    <div class="form-group">
                        <label for="password">New Password (leave blank to leave unchanged)</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" autocomplete="current-password" />
                    </div>

                    <div class="form-group">
                        <label for="password">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_confirm_password" name="new_confirm_password" autocomplete="current-password"/>
                    </div>
                </div>

                <div class="form-footer mt-3 mb-0">
                    <button type="submit" class="btn btn-dark mr-0">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- End .tab-pane -->

    <div class="tab-pane fade" id="billing" role="tabpanel">
        <div class="address account-content mt-0 pt-2">
            <h4 class="title">Billing address</h4>

            <form class="mb-2" action="{{ route('customer.profile.address') }}" method="POST" enctype="multipart/form-data">
                @csrf
 
                <div class="form-group">
                    <label>Address <span class="required">*</span></label>
                    <input type="text" name="address" class="form-control" required />
                </div>

                <div class="select-custom">
                    <label>Country<span class="required">*</span></label>
                    <select name="country_id" class="form-control">
                        <option value="" selected="selected">Select Country</option>
                        @foreach (\App\Models\Address\Country::where('status',1)->get() as $country) 
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="select-custom">
                    <label>State<span class="required">*</span></label>
                    <select name="state_id" class="form-control">
                        <option value="" selected="selected">Select State</option>
                        @foreach (\App\Models\Address\State::where('country_id',18)->get() as $state) 
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="select-custom">
                    <label>City<span class="required">*</span></label>
                    <select name="city_id" class="form-control">
                        <option value="" selected="selected">Select City</option>
                        @foreach (\App\Models\Address\City::where('state_id',348)->get() as $city) 
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Postal Code<span class="required">*</span></label>
                    <input type="text" name="postal_code" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Phone<span class="required">*</span></label>
                    <input type="text" name="phone" class="form-control" required />
                </div>

                <div class="form-footer mb-0">
                    <div class="form-footer-right">
                        <button type="submit" class="btn btn-dark py-4">
                            Save Address
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End .tab-pane -->


    <!-- End .tab-pane -->
</div>
@endsection

{{-- @section('modal')
<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div id="order-details-modal-body">

            </div>
        </div>
    </div>
</div>
@endsection --}}