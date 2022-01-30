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



        {{-- <!-- FILE UPLODE CSS -->
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

        <!-- WYSIWYG EDITOR CSS -->
        <link href="{{ asset('assets/plugins/wysiwyag/richtext.css') }}" rel="stylesheet"/>

        <!-- SUMMERNOTE CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">

        <!-- INTERNAL Quill css -->
        <link href="{{ asset('assets/plugins/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/quill/quill.bubble.css') }}" rel="stylesheet"> --}}

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">{{ isset($product) ? 'Edit ' : 'Create '}}Products</h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>
							<div class="ms-auto pageheader-btn">
								<a href="{{route('admin.products.index')}}" class="btn btn-primary btn-icon text-white me-2">
									<span>
										{{-- <i class="fe fe-minus"></i> --}}
									</span> Back To List
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
    <form method="POST" id="choice_form" action="{{isset($product) ? route('admin.products.update',$product->id) : route('admin.products.store')}}" enctype="multipart/form-data">
    @csrf
    @isset($product)
    @method('PUT')
    @endisset
	<div class="row">
		{{-- Left Side --}}
		<div class="col-lg-9 col-xl-9 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Create Product</h3>
				</div>
				<div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

					<div class="form-group">
						<label for="exampleInputname">Product Title</label>
						<input type="text" class="form-control @error('title') is-invalid @enderror" value="{{$product->title ?? old('title')}}" name="title" id="posttitle" placeholder="Product Name">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
					</div>

                    @isset($editbrands)

                    <div class="form-group">
						<label class="form-label">Brand</label>
						<select name="brand_id" class="form-control form-select select2" data-bs-placeholder="Select Brand">
							<option value="">Select brand_id</option>
                            <option value="0" {{($product->brand_id == 0) ? 'selected' : ''}}>None</option>
                            @foreach ($editbrands as $editbrand)
                            <option value="{{$editbrand->id}}" {{($product->brand_id == $editbrand->id) ? 'selected' : ''}}>{{$editbrand->name}}</option>
                            @endforeach
						</select>
					</div>

                    @else

                    <div class="form-group">
						<label class="form-label">Brand</label>
						<select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror form-select select2" data-bs-placeholder="Select Brand">
							<option value="">Select Brand</option>
                            <option value="0">None</option>
                            @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
						</select>
                        @error('brand_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>

                    @endisset

                    <div class="form-group">
						<label for="exampleInputname">Unit</label>
						<input type="text" class="form-control" value="{{$product->unit ?? old('unit')}}" name="unit" id="" placeholder="Unit(e.g kg,pc etc)">
					</div>

                    <div class="form-group">
						<label for="exampleInputname">Maximum Purchase Quantity</label>
						<input type="text" class="form-control" value="{{$product->purchase_qty ?? old('purchase_qty') }}" name="purchase_qty" id="" >
					</div>

                    <div class="form-group">
						<label for="exampleInputname">Low Stock Quantity Warning</label>
						<input type="text" class="form-control" value="{{isset($product->low_stock_qty) ?? old('low_stock_qty')}}" name="low_stock_qty" id="" >
					</div>

                    {{-- @isset($post)
                    <div class="form-group">
						<label for="exampleInputname">Post Slug</label>
						<input type="text" class="form-control" value="{{$post->slug ?? old('slug')}}" name="slug" id="postslug" placeholder="Post Slug">
					</div>
                    @endisset --}}

                    <input type="radio" name="link" checked id="test2">
                    <label for="css">Feature Image</label>
                    <input type="radio" name="link" id="test1">
                    <label for="html">Youtube Link</label>


                    <div class="form-group youtube" style="display:none">
						<label for="exampleInputname">Youtube Link</label>
						<input type="text" class="form-control" value="{{$product->youtube_link ?? old('youtube_link')}}" name="youtube_link" id="youtube_link" placeholder="Youtube Video Link">
					</div>
                    {{-- <input type="text" id="profile-photo">
                    <button onclick="filemanager.selectFile('profile-photo')">Choose</button> --}}
					<div class="form-group featur">
						<label class="form-label">Feature Image</label>
						<!-- <input id="demo" type="file" name="image" accept=".jpg, .png, image/jpeg, image/png" multiple="" class="ff_fileupload_hidden"> -->
                        <input type="file" data-height="100" class="dropify form-control" data-default-file="{{ isset($product) ? asset('uploads/productphoto/'.$product->image) : '' }}" name="image">
					</div>

					<div class="form-group">
						<label class="form-label">Gallary Image</label>
						<!-- <input id="demo" type="file" name="image" accept=".jpg, .png, image/jpeg, image/png" multiple="" class="ff_fileupload_hidden"> -->
                        <input type="file" data-height="100" class="dropify form-control" data-default-file="{{ isset($product) ? asset('uploads/productgallary_image/'.$product->gallaryimage) : '' }}" multiple name="gallaryimage[]">
					</div>

                    {{-- <div class="col-md-8">
                        <select class="form-control sismoo-selectpicker" data-live-search="true" data-selected-text-format="count" name="colors[]" id="colors" multiple disabled>
                            @foreach (\App\Models\Product\Color::orderBy('name', 'asc')->get() as $key => $color)
                            <option  value="{{ $color->code }}" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:{{ $color->code }}'></span><span>{{ $color->name }}</span></span>"></option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="form-group">
						<label class="form-label">Colors</label>
						{{-- <select name="colors[]" id="colors" class="custom-multiselect"  multiple="multiple" > --}}
                            <select name="colors[]" multiple="multiple" id="colors" class="testselect2">
                            <option value="0">None</option>
                            @foreach (\App\Models\Product\Color::orderBy('name', 'asc')->get() as $key => $color)
                            <option value="{{$color->code}}" style="background: white; color: {{$color->code}};">{{$color->name}}</option>
                            @endforeach
						</select>
                        @error('brand_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="form-group row">
                            <label class="col-md-12 form-label">Multiple Select:</label>
                            <div class="col-md-12">
                                <select multiple="multiple" class="testselect2">
                                    <option selected value="volvo">Volvo</option>
                                    <option value="saab">Saab</option>
                                    <option value="mercedes">Mercedes</option>
                                    <option value="audi">Audi</option>
                                </select>
                            </div>
                        </div>

                        <label class="sismoo-switch sismoo-switch-success mb-0">
                            <input value="1" type="checkbox" id="colors_active" name="colors_active">
                            <span></span>
                        </label>
					</div>

                    <div class="sku_combination" id="sku_combination">

                    </div>


                    <div class="form-group">
						<label for="exampleInputname">Unit Price</label>
						<input type="text" class="form-control" value="{{isset($product->unit_price) ?? old('unit_price') }}" name="unit_price" id="">
					</div>

                    <div class="form-group">
						<label for="exampleInputname">Discount Start Date</label>
						<input type="date" class="form-control" value="{{$product->discount_startdate ?? old('discount_startdate') }}" name="discount_startdate" id="">
					</div>

                    <div class="form-group">
						<label for="exampleInputname">Discount End Date</label>
						<input type="date" class="form-control" value="{{$product->discount_enddate ?? old('discount_enddate') }}" name="discount_enddate" id="">
					</div>

                    @isset($product)
                    <label class="form-label" for="type">Select Discount Type</label>
					<select class="form-control form-select select2" data-bs-placeholder="Select Type" name="discount_type" id="type" required >
						<option value="Flat" {{($product->discount_type == 'Flat') ? 'selected' : ''}} >Flat</option>
						<option value="Percent" {{($product->discount_type == 'Percent') ? 'selected' : ''}}>Percent</option>
					</select>
                    @else
                    <label class="form-label" for="type">Select Discount Type</label>
					<select class="form-control form-select select2" data-bs-placeholder="Select Type" name="discount_type" id="type" required >
						<option value="Flat">Flat</option>
						<option value="Percent">Percent</option>
					</select>
                    @endisset

                    <div class="form-group">
						<label for="exampleInputname">Discount</label>
						<input type="text" class="form-control" value="{{isset($product->discount_rate) ? old('discount_rate') : 0}}" name="discount_rate" id="">
					</div>

                    <div class="form-group">
						<label for="exampleInputname">Quantity</label>
						<input type="text" class="form-control" value="{{isset($product->quantity) ? old('quantity') : 0}}" name="quantity" id="">
					</div>

                    <div class="form-group">
						<label for="exampleInputname">SKU</label>
						<input type="text" class="form-control" value="{{isset($product->sku) ? old('sku') : ''}}" name="sku" id="">
					</div>

					<div class="form-group">
						<label for="exampleInputContent">Post Description</label>
						<div class="ql-wrapper ql-wrapper-demo bg-light">
							<!-- <div id="quillEditor">

							</div> -->
                            {{-- <textarea style="height: 200px;" class="form-control" id="" name="body">{{$post->body ?? old('body')}}</textarea> --}}

                            <textarea name="desc" class="my-editor form-control" id="editor" style="height: 200px;" cols="30" rows="10">{!!$product->desc ?? old('desc')!!}</textarea>

                            {{-- <div id="toolbar-container"></div>
                            <div id="editor" style="height: 300px">

                            </div> --}}
						</div>
					</div>

                    <div class="form-group">
						<label for="exampleInputname">Meta Title</label>
						<input type="text" class="form-control" value="{{isset($product->meta_title) ? old('meta_title') : ''}}" name="meta_title" id="">
					</div>

                    <div class="form-group">
						<label for="exampleInputname">Meta Description</label>
                        <textarea name="meta_desc" class="my-editor form-control" id="" style="height: 200px;" cols="30" rows="10">{{isset($product->meta_desc) ? old('meta_desc') : ''}}</textarea>
					</div>


				</div>
				<div class="card-footer text-end">
					<button type="submit" class="btn btn-success mt-1">
                        @isset($product)
                        <i class="fas fa-arrow-circle-up"></i>
                        Update
                        @else
                        <i class="fe fe-plus"></i>
                        Create
                        @endisset
                    </button>
					<a href="{{route('admin.products.index')}}" class="btn btn-danger mt-1">Cancel</a>
				</div>
			</div>
		</div>

		{{-- Right Side --}}
		<div class="col-lg-3 col-xl-3 col-md-12 col-sm-12" style="float: left">

			<div class="card shadow-none border">
				<div class="card-header">
					<h5 class="card-title">Parent Category</h5>
				</div>
				<div class="card-body" style="padding:2px;">
					<div class="transfer">
						<div class="transfer-double" id="transfer_double_languageInput">
							<div class="transfer-double-header"></div>
							<div class="transfer-double-content clearfix">

								<div class="transfer-double-list transfer-double-list-1636878492751 tab-content-first-1636878492751 tab-content-active">
									{{-- <div class="transfer-double-list-header">
										<div class="transfer-double-list-search"><input class="transfer-double-list-search-input" type="text" id="groupListSearch_1636878492751" placeholder="Search" value="" /></div>
									</div> --}}

                                    @isset($product)

                                    <div class="transfer-double-list-content">
										<div class="transfer-double-list-main">

											<ul class="transfer-double-group-list-ul transfer-double-group-list-ul-1636878492751">

                                            @foreach($categories as $key => $categoryy)

												<li class="transfer-double-group-list-li transfer-double-group-list-li-1636878492751">
													<div class="checkbox-group">

														<input type="checkbox" name="categories[]" value="{{$categoryy->id}}" @foreach($product->productcategories as $category) {{$categoryy->id == $category->id ? 'checked' : ''}} @endforeach class="checkbox-normal group-select-all-1636878492751" id="group_{{$key}}_1636878492751" /><label for="group_{{$key}}_1636878492751" class="group-name-1636878492751">{{$categoryy->name}}</label>

													</div>
                                                    @if($categoryy->childrenRecursive->count()>0)


													  @include('backend.admin.product.post.child_category_edit', ['sub_category' => $categoryy,'post' => $product])


                                                    @endif


												</li>
                                            @endforeach

											</ul>
										</div>
									</div>


                                    @else

									<div class="transfer-double-list-content">
										<div class="transfer-double-list-main">

											<ul class="transfer-double-group-list-ul transfer-double-group-list-ul-1636878492751">

                                            @foreach($categories as $key => $category)

                                            @if($category->status == true)

												<li class="transfer-double-group-list-li transfer-double-group-list-li-1636878492751">
													<div class="checkbox-group">
														<input type="checkbox" name="categories[]" value="{{$category->id}}" class="checkbox-normal group-select-all-1636878492751" id="group_{{$key}}_1636878492751" /><label for="group_{{$key}}_1636878492751" class="group-name-1636878492751">{{$category->name}}</label>
													</div>
                                                    @if($category->childrenRecursive->count()>0)


													  @include('backend.admin.product.post.child_categories', ['sub_category' => $category])


                                                    @endif


												</li>

                                            @endif
                                            @endforeach


											</ul>
										</div>
									</div>

                                    @endisset

								</div>

							</div>
							{{-- <div class="transfer-double-footer"></div> --}}
						</div>
					</div>
				</div>

			</div>


            <div class="card">
				<div class="card-header">
					<h3 class="card-title">Shippig Configuration</h3>
				</div>
				<div class="card-body">
                    @isset($product)
					<div class="form-group">
						<div class="form-label">Free Shipping</div>
						<label class="custom-switch">
							<input type="checkbox" name="Free_Shipping" {{$product->shipping == null ? 'checked' : ''}} class="custom-switch-input ">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

                    @else

                    <div class="form-group">
						<div class="form-label">Free Shipping</div>
						<label class="custom-switch">
							<input type="checkbox" name="Free_Shipping" id="Free_Shipping" checked class="custom-switch-input ">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

                    <div class="form-group">
						<div class="form-label">Flat Rate</div>
						<label class="custom-switch">
							<input type="checkbox" name="Flat_Rate" id="Flat_Rate" class="custom-switch-input ">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

                    <div class="form-group" id="Shipping_Cost" style="display:none">
						<label for="exampleInputname">Shipping Cost</label>
						<input type="text" class="form-control" value="{{isset($product->shipping) ? old('shipping') : 0}}" name="shipping" id="">
					</div>

                    <div class="form-group">
						<label for="exampleInputname">Estimated Shipping Time</label>
						<input type="text" class="form-control" value="{{isset($product->estimate_shipping_time) ? old('estimate_shipping_time') : ''}}" name="estimate_shipping_time" placeholder="Shipping Days" id="">
					</div>

                    @endisset

				</div>

			</div>


            <div class="card">
				<div class="card-header">
					<h3 class="card-title">Cash On Delivery</h3>
				</div>
				<div class="card-body">
                    @isset($product)
					<div class="form-group">
						<div class="form-label">Status</div>
						<label class="custom-switch">
							<input type="checkbox" name="cash_on_delivery" {{$product->cash_on_delivery == true ? 'checked' : ''}} class="custom-switch-input ">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

                    @else

                    <div class="form-group">
						<div class="form-label">Status</div>
						<label class="custom-switch">
							<input type="checkbox" name="cash_on_delivery" class="custom-switch-input ">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

                    @endisset

				</div>
			</div>


            <div class="card">
				<div class="card-header">
					<h3 class="card-title">Today's Deal</h3>
				</div>
				<div class="card-body">
                    @isset($product)
					<div class="form-group">
						<div class="form-label">Status</div>
						<label class="custom-switch">
							<input type="checkbox" name="todays_deal" {{$product->todays_deal == true ? 'checked' : ''}} class="custom-switch-input ">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

                    @else

                    <div class="form-group">
						<div class="form-label">Status</div>
						<label class="custom-switch">
							<input type="checkbox" name="todays_deal" class="custom-switch-input ">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

                    @endisset

				</div>
			</div>


            <div class="card">
				<div class="card-header">
					<h3 class="card-title">VAT & TAX</h3>
				</div>
                <div class="card-body">
                    @isset($product)
                    <label class="form-label" for="type">Select Tax Type</label>
					<select class="form-control form-select select2" data-bs-placeholder="Select Type" name="tax_type" id="">
						<option value="Flat" {{($product->tax_type == 'Flat') ? 'selected' : ''}} >Flat</option>
						<option value="Percent" {{($product->tax_type == 'Percent') ? 'selected' : ''}}>Percent</option>
					</select>
                    @else
                    <label class="form-label" for="type">Select Discount Type</label>
					<select class="form-control form-select select2" data-bs-placeholder="Select Type" name="tax_type" id="">
						<option value="Flat">Flat</option>
						<option value="Percent">Percent</option>
					</select>
                    @endisset

                    <div class="form-group">
						<label for="exampleInputname">Tax Amount</label>
						<input type="text" class="form-control" value="{{isset($product->tax) ? old('tax') : 0}}" name="tax" id="">
					</div>

                </div>
			</div>


			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Create Page</h3>
				</div>
				<div class="card-body">
                    @isset($product)
					<div class="form-group">
						<div class="form-label">Status</div>
						<label class="custom-switch">
							<input type="checkbox" name="status" {{$product->status == true ? 'checked' : ''}} class="custom-switch-input ">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

                    @else

                    <div class="form-group">
						<div class="form-label">Status</div>
						<label class="custom-switch">
							<input type="checkbox" name="status" class="custom-switch-input ">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

                    @endisset

					@isset($editsidebars)

                    <div class="form-group">
						<label class="form-label">Left Sidebar</label>
						<select name="leftsidebar_id" class="form-control form-select select2" data-bs-placeholder="Select Sidebar">
							<option value="">Select Left Sidebar</option>
                            <option value="0" {{($product->leftsidebar_id == 0) ? 'selected' : ''}}>None</option>
                            @foreach ($editsidebars as $editsidebar)
                            @if($editsidebar->type == 'Left Side Bar')
                            <option value="{{$editsidebar->id}}" {{($product->leftsidebar_id == $editsidebar->id) ? 'selected' : ''}}>{{$editsidebar->title}}</option>
                            @endif
                            @endforeach
						</select>
					</div>


					<div class="form-group">
						<label class="form-label">Right Sidebar</label>
						<select name="rightsidebar_id" class="form-control form-select select2" data-bs-placeholder="Select Sidebar">
							<option value="">Select Right Sidebar</option>
                            <option value="0" {{($product->rightsidebar_id == 0) ? 'selected' : ''}} >None</option>
                            @foreach ($editsidebars as $editsidebar)
                            @if($editsidebar->type == 'Right Side Bar')
							<option value="{{$editsidebar->id}}" {{($product->rightsidebar_id == $editsidebar->id) ? 'selected' : ''}} >{{$editsidebar->title}}</option>
                            @endif
                            @endforeach
						</select>
					</div>

                    @else

                    <div class="form-group">
						<label class="form-label">Left Sidebar</label>
						<select name="leftsidebar_id" class="form-control @error('leftsidebar_id') is-invalid @enderror form-select select2" data-bs-placeholder="Select Sidebar">
							<option value="">Select Left Sidebar</option>
                            <option value="0">None</option>
                            @foreach ($sidebars as $sidebar)
                            @if($sidebar->type == 'Left Side Bar')
                            <option value="{{$sidebar->id}}">{{$sidebar->title}}</option>
                            @endif
                            @endforeach
						</select>
                        @error('leftsidebar_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>


					<div class="form-group">
						<label class="form-label">Right Sidebar</label>
						<select name="rightsidebar_id" class="form-control @error('rightsidebar_id') is-invalid @enderror form-select select2" data-bs-placeholder="Select Sidebar">
							<option value="">Select Right Sidebar</option>
                            <option value="0">None</option>
                            @foreach ($sidebars as $sidebar)
                            @if($sidebar->type == 'Right Side Bar')
							<option value="{{$sidebar->id}}">{{$sidebar->title}}</option>
                            @endif
                            @endforeach
						</select>
                        @error('rightsidebar_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>

                    @endisset

                    <div class="form-group">
						<label class="form-label">File</label>
						<input type="file" name="files" class="dropify" data-default-file="{{ isset($product) ? asset('uploads/productfiles/'.$product->files) : ''}}" data-bs-height="180"  />

					</div>

				</div>

			</div>
		</div>

	</div>
    </form>

	<!-- ROW-1 CLOSED -->
@endsection('content')

@section('scripts')

<script>

$('input[name="colors_active"]').on('change', function() {
        if(!$('input[name="colors_active"]').is(':checked')) {
            $('#colors').prop('disabled', true);
            SISMOO.plugins.bootstrapSelect('refresh');
        }
        else {
            $('#colors').prop('disabled', false);
            SISMOO.plugins.bootstrapSelect('refresh');
        }
        update_sku();
    });

// $('#colors_active').change(
//     function(){
//         if ($(this).is(':checked')){
//             $('#colors').prop('disabled',true);
//         }
//         else {
//             $('#colors').prop('disabled',false);
//         }
//     });



    $('#colors').on('change', function() {
        update_sku();
    });


    function update_sku(){
        $.ajax({
           type:"POST",
           url:'{{ route('admin.products.sku_combination') }}',
           data:$('#choice_form').serialize(),
           success: function(data) {
               console.log(data);
                $('#sku_combination').html(data);
                // SISMOO.uploader.previewGenerate();
                // SISMOO.plugins.fooTable();
                if (data.length > 1) {
                   $('#show-hide-div').hide();
                }
                else {
                    $('#show-hide-div').show();
                }
           }
       });
    }

    </script>

    {{-- <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> --}}

    <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>

<script>
	window.onload = function () {
		CKEDITOR.replace('editor', {
	        filebrowserBrowseUrl: filemanager.ckBrowseUrl,
            //filebrowserImageBrowseUrl: 'admin/filemanager/ckeditor',
            //filebrowserBrowseUrl: '/admin/filemanager',
	    });
	}

    $('select').selectpicker();
</script>


{{-- <script src="{{asset('ckeditor/ckeditor.js')}}"></script> --}}

{{-- <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/decoupled-document/ckeditor.js"></script> --}}

{{-- <script>
    DecoupledEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            const toolbarContainer = document.querySelector( '#toolbar-container' );

            toolbarContainer.appendChild( editor.ui.view.toolbar.element );
        } )
        .catch( error => {
            console.error( error );
        } );
</script> --}}



<script>
$(document).ready(function() {
    $("input[id$='test1']").click(function() {
        var link = $(this).val();

        $("div.youtube").show();
        $("div.featur").hide();
    });

    $("input[id$='test2']").click(function() {
        var link = $(this).val();

        $("div.youtube").hide();
        $("div.featur").show();
    });
});
</script>


<script>
    $('#Flat_Rate').click(function() {
        if (this.checked) {
            $('#Free_Shipping').prop("checked", false);
            $('#Shipping_Cost').show();
        } else
        {
            $('#Free_Shipping').prop("checked", true);
            $('#Shipping_Cost').hide();
        }

   });
   $('#Free_Shipping').click(function() {
        if (this.checked) {
            $('#Flat_Rate').prop("checked", false);
            $('#Shipping_Cost').hide();
        } else
        $('#Flat_Rate').prop("checked", true);

   });
</script>

     {{-- <script>

function myFunction() {
    var title = document.getElementById('posttitle').value;
  document.getElementById("postslug").value = title;
}
//         document.getElementById('postslug').addEventListener('click', FILLSLUG);

// function FILLSLUG() {

//     var title = document.getElementById('posttitle');
//     var slug = document.getElementById('postslug');

//     slug.value = title.value;

// };
    </script> --}}


        <!-- <script>
            $('#select-all').click(function(event){
                if(this.checked)
                {
                    $(':checkbox').each(function(){
                        this.checked = true;
                    });
                }
                else
                {
                    $(':checkbox').each(function(){
                        this.checked = false;
                    });
                }
            });
         </script> -->

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
