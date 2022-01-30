@extends('layouts.app')

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- FILE UPLODE CSS -->
        <link href="{{ asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css"/>
		<!-- INTERNAL Fancy File Upload css -->
		<link href="{{ asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
        <!-- WYSIWYG EDITOR CSS -->
        <link href="{{ asset('assets/plugins/wysiwyag/richtext.css') }}" rel="stylesheet"/>

        <!-- SUMMERNOTE CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">

        <!-- INTERNAL Quill css -->
        <link href="{{ asset('assets/plugins/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/quill/quill.bubble.css') }}" rel="stylesheet">
        <!-- INTERNAL SELECT2 CSS -->
        <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>

		<!-- INTERNAL Jquerytransfer css-->
		<link rel="stylesheet" href="{{ asset('assets/plugins/jQuerytransfer/jquery.transfer.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/plugins/jQuerytransfer/icon_font/icon_font.css') }}">


		<!-- MULTI SELECT CSS -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/multipleselect/multiple-select.css') }}">

		<!--INTERNAL IntlTelInput css-->
		<link rel="stylesheet" href="{{ asset('assets/plugins/intl-tel-input-master/intlTelInput.css') }}">

		<!-- INTERNAL multi css-->
		<link rel="stylesheet" href="{{ asset('assets/plugins/multi/multi.min.css') }}">






		        <!-- FILE UPLODE CSS -->
				<link href="{{ asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css"/>

				<!-- SELECT2 CSS -->
				<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>

				<!-- INTERNAL Fancy File Upload css -->
				<link href="{{ asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />

				<!--BOOTSTRAP-DATERANGEPICKER CSS-->
				<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">

				<!-- TIME PICKER CSS -->
				<link href="{{ asset('assets/plugins/time-picker/jquery.timepicker.css') }}" rel="stylesheet"/>

				<!-- INTERNAL Date Picker css -->
				<link href="{{ asset('assets/plugins/date-picker/date-picker.css') }}" rel="stylesheet" />

				<!-- INTERNAL Sumoselect css-->
				<link rel="stylesheet" href="{{ asset('assets/plugins/sumoselect/sumoselect.css') }}">

				<!-- INTERNAL Jquerytransfer css-->
				<link rel="stylesheet" href="{{ asset('assets/plugins/jQuerytransfer/jquery.transfer.css') }}">
				<link rel="stylesheet" href="{{ asset('assets/plugins/jQuerytransfer/icon_font/icon_font.css') }}">

				<!-- INTERNAL Bootstrap DatePicker css-->
				<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">

				<!-- MULTI SELECT CSS -->
				<link rel="stylesheet" href="{{ asset('assets/plugins/multipleselect/multiple-select.css') }}">

				<!--INTERNAL IntlTelInput css-->
				<link rel="stylesheet" href="{{ asset('assets/plugins/intl-tel-input-master/intlTelInput.css') }}">

				<!-- INTERNAL multi css-->
				<link rel="stylesheet" href="{{ asset('assets/plugins/multi/multi.min.css') }}">

                <style>
                    #preview {
  display:inline-block;
  position:absolute;
  margin-left:20px;
}
                    </style>

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">Order Details</h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>
							<div class="ms-auto pageheader-btn">
								<a href="{{route('admin.all_orders.index')}}" class="btn btn-primary btn-icon text-white me-2">
									<span>
										{{-- <i class="fe fe-minus"></i> --}}
									</span> Back To OrderList
								</a>
								{{-- <a href="#" class="btn btn-success btn-icon text-white">
									<span>
										<i class="fe fe-log-in"></i>
									</span> Export
								</a> --}}
							</div>
						</div>
						<!-- PAGE-HEADER END -->

                   <!-- ROW-1 OPEN -->
                @php
                   $delivery_status = $order->delivery_status;
                   $payment_status = $order->payment_status;
                @endphp

	<div class="row">
		{{-- Left Side --}}
		<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
			<div class="card">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card-header">
                            <h3 class="card-title">Create Blog Category</h3>
                        </div>
                        <div class="card-body">
                            <p>Delivery boy selecting part is comming soon...</p>
                            {{-- <div class="col-md-3 ml-auto">
                                <label for="assign_deliver_boy">asd</label>
                                @if($delivery_status == 'pending' || $delivery_status == 'confirmed' || $delivery_status == 'picked_up')
                                <select class="form-control sismoo-selectpicker" data-live-search="true" data-minimum-results-for-search="Infinity" id="assign_deliver_boy">
                                    <option value="">{{translate('Select Delivery Boy')}}</option>
                                    @foreach($delivery_boys as $delivery_boy)
                                    <option value="{{ $delivery_boy->id }}" @if($order->assign_delivery_boy == $delivery_boy->id) selected @endif>
                                        {{ $delivery_boy->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @else
                                    <input type="text" class="form-control" value="{{ optional($order->delivery_boy)->name }}" disabled>
                                @endif
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card-header">
                            <h3 class="card-title">Payment Status</h3>
                        </div>
                        <div class="card-body">

                            <select name="delivery_status" class="form-control form-select select2" id="update_payment_status" data-bs-placeholder="Select Sidebar">
                                <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>{{translate('Unpaid')}}</option>
                                <option value="paid" @if ($payment_status == 'paid') selected @endif>{{translate('Paid')}}</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card-header">
                            <h3 class="card-title">Delivery Status</h3>
                        </div>
                        <div class="card-body">

                            <select name="delivery_status" class="form-control form-select select2" id="update_delivery_status" data-bs-placeholder="Select Sidebar">
                                <option value="pending" @if ($delivery_status == 'pending') selected @endif>Pending</option>
                                <option value="confirmed" @if ($delivery_status == 'confirmed') selected @endif>Confirmed</option>
                                <option value="picked_up" @if ($delivery_status == 'picked_up') selected @endif>Picked Up</option>
                                <option value="on_the_way" @if ($delivery_status == 'on_the_way') selected @endif>On The Way</option>
                                <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>Delivered</option>
                                <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>Cancel</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card-header">
                            <h3 class="card-title">Tracking Code (Optional)</h3>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="update_tracking_code" value="{{ $order->tracking_code }}">
                        </div>


                            <table>
                                <tbody>
                                    <tr>
                                        <td class="text-main text-bold">Order #</td>
                                        <td class="text-right text-info text-bold">	{{ $order->code }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-main text-bold">Order Status</td>
                                        <td class="text-right">
                                            @if($delivery_status == 'delivered')
                                            <span class="badge badge-inline badge-success">{{ $delivery_status }}</span>
                                            @else
                                            <span class="badge badge-inline badge-info">{{ $delivery_status}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-main text-bold">Order Date</td>
                                        <td class="text-right">{{ date('d-m-Y h:i A', $order->date) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-main text-bold">
                                            Total amount
                                        </td>
                                        <td class="text-right">
                                            ৳ {{ $order->grand_total }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-main text-bold">Payment method</td>
                                        <td class="text-right">{{ $order->payment_type }}</td>
                                    </tr>
                                </tbody>
                            </table>

                    </div>
                </div>

            </br>
                <hr>
            </br>
                <div class="row">
                    <div class="card-body">
						<div class="table-responsive export-table">
							<table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
								<thead>
									<tr>
										<th class="border-bottom-0">Photo</th>
										<th class="border-bottom-0">Description</th>
                                        <th class="border-bottom-0">Delivery Type</th>
										<th class="border-bottom-0">Qty</th>
                                        <th class="border-bottom-0">Price</th>
										<th class="border-bottom-0">Total</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach ($order->orderDetails as $key => $orderDetail)
									<tr>
										<td class="text-center"><a href="{{ route('product.details', $orderDetail->product->slug) }}" target="_blank"><img height="50" src="{{ asset('uploads/productphoto/'.$orderDetail->product->image) }}"></a></td>
                                        <td class="text-center"> <strong><a href="{{ route('product.details', $orderDetail->product->slug) }}" target="_blank" class="text-muted">{{ $orderDetail->product->title }}</a></strong>
                                            <small>{{ $orderDetail->variation }}</small></td>
                                        <td class="text-center">@if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
                                            Home Delivery</td>
                                            @else
                                           Pickup Point
                                            @endif
										<td class="text-center">{{ $orderDetail->quantity }}</td>
                                        <td class="text-center">৳ {{ $orderDetail->price/$orderDetail->quantity}}</td>
                                        <td class="text-center">৳ {{ $orderDetail->price }}</td>
									</tr>
                                    @endforeach
								</tbody>
							</table>
						</div>
					</div>
                    <div class="col-3">
                        <div class="clearfix float-right">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong class="text-muted">Sub Total :</strong>
                                        </td>
                                        <td>
                                            ৳ {{ $order->orderDetails->sum('price') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong class="text-muted">Tax :</strong>
                                        </td>
                                        <td>
                                            ৳ {{$order->orderDetails->sum('tax') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong class="text-muted">Shipping :</strong>
                                        </td>
                                        <td>
                                            ৳ {{$order->orderDetails->sum('shipping_cost') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong class="text-muted">Coupon :</strong>
                                        </td>
                                        <td>
                                            ৳ {{ $order->coupon_discount }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong class="text-muted">TOTAL :</strong>
                                        </td>
                                        <td class="text-muted h5">
                                            ৳ {{ $order->grand_total }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- <div class=" no-print">
                                <a href="#" type="button" class="btn btn-icon btn-green"><i class="las la-print"></i></a>
                            </div> --}}
                            </div>
                    </div>

                </div>

			</div>
		</div>


	</div>
	<!-- ROW-1 CLOSED -->
@endsection('content')

@section('scripts')

<script>
    $('#update_delivery_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_delivery_status').val();
            $.post('{{ route('admin.orders.update_delivery_status') }}', {
                _token:'{{ @csrf_token() }}',
                order_id:order_id,
                status:status
            }, function(data){
                iziToast.success({
                title: 'Success',
                message: 'Delivery status has been updated',
                 });
            });
        });

        $('#update_payment_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_payment_status').val();
            $.post('{{ route('admin.orders.update_payment_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                iziToast.success({
                title: 'Success',
                message: 'Payment status has been updated',
                 });
            });
        });

</script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        <!-- CHARTJS JS -->
        <script src="{{ asset('assets/plugins/chart/Chart.bundle.js')}}"></script>
		<script src="{{ asset('assets/plugins/chart/utils.js')}}"></script>

        <!-- INTERNAL SELECT2 JS -->
        <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
		<script src="{{ asset('assets/js/select2.js') }}"></script>
		<!-- FILE UPLOADES JS -->
		<script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
		<script src="{{ asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

		<!-- INTERNAL File-Uploads Js-->
		<script src="{{ asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
        <script src="{{ asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
        <script src="{{ asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
        <script src="{{ asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
        <script src="{{ asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>

		<!-- WYSIWYG Editor JS -->
		<script src="{{ asset('assets/plugins/wysiwyag/jquery.richtext.js') }}"></script>
		<script src="{{ asset('assets/plugins/wysiwyag/wysiwyag.js') }}"></script>

		<!-- INTERNAL multi js-->
		<script src="{{ asset('assets/plugins/multi/multi.min.js') }}"></script>

				<!-- MULTI SELECT JS-->
				<script src="{{ asset('assets/plugins/multipleselect/multiple-select.js') }}"></script>
				<script src="{{ asset('assets/plugins/multipleselect/multi-select.js') }}"></script>

						<!-- FORMELEMENTS JS -->
		<script src="{{ asset('assets/js/formelementadvnced.js') }}"></script>
		<script src="{{ asset('assets/js/form-elements.js') }}"></script>


		<!-- INTERNAL jquery transfer js-->
		<script src="{{ asset('assets/plugins/jQuerytransfer/jquery.transfer.js') }}"></script>

		<!-- SUMMERNOTE JS -->
		<script src="{{ asset('assets/plugins/summernote/summernote-bs4.js') }}"></script>

		<!-- FORMEDITOR JS -->
		<script src="{{ asset('assets/plugins/quill/quill.min.js') }}"></script>
		<script src="{{ asset('assets/js/form-editor2.js') }}"></script>

@endsection
