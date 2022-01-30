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

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">{{ isset($custompage) ? 'Edit ' : 'Create '}}Page</h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>
							<div class="ms-auto pageheader-btn">
								<a href="{{route('admin.custompages.index')}}" class="btn btn-primary btn-icon text-white me-2">
									<span>
										{{-- <i class="fe fe-minus"></i> --}}
									</span> Back To PagetList
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
    <form method="POST" action="{{isset($custompage) ? route('admin.custompages.update',$custompage->id) : route('admin.custompages.store')}}" enctype="multipart/form-data">
    @csrf
    @isset($custompage)
    @method('PUT')
    @endisset
	<div class="row">
		{{-- Left Side --}}
		<div class="col-lg-9 col-xl-9 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Create New Page</h3>
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
						<label for="exampleInputname">Page Name</label>
						<input type="text" class="form-control @error('title') is-invalid @enderror" value="{{$custompage->name ?? old('name')}}" name="name" id="" placeholder="Page Name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
					</div>

                    @isset($custompage)
                    <div class="form-group">
						<label class="form-label">Page Type</label>
						<select name="type" class="form-control form-select select2" data-bs-placeholder="Select Type">
							<option value="">Select Page Type</option>
							<option value="Main-Page" {{($custompage->type == 'Main-Page') ? 'selected' : ''}}  >Main Page</option>
							<option value="Single-Page" {{($custompage->type == 'Single-Page') ? 'selected' : ''}}>Single Page</option>
						</select>
					</div>

                    @else

					<div class="form-group">
						<label class="form-label">Page Type</label>
						<select name="type" class="form-control form-select select2" data-bs-placeholder="Select Type">
							<option value="">Select Page Type</option>
							<option value="Main-Page">Main Page</option>
							<option value="Single-Page">Single Page</option>
						</select>
					</div>

                    @endisset

                    <input type="radio" name="link" id="test2">
                    <label for="css">Background Image</label>
                    <input type="radio" name="link" id="test1">
                    <label for="html">Background Color</label>

                    <div class="form-group background_color" style="display:none">
						<label for="exampleInputname">Background Color Code</label>
						<input type="text" class="form-control @error('background_color') is-invalid @enderror" value="{{$custompage->background_color ?? old('background_color')}}" name="background_color" id="" placeholder="ex. #ffffff">
                        @error('background_color')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
					</div>

                    <div class="form-group background_img" style="display:none">
						<label class="form-label">Background Image</label>
						<!-- <input id="demo" type="file" name="image" accept=".jpg, .png, image/jpeg, image/png" multiple="" class="ff_fileupload_hidden"> -->
                        <input type="file" data-height="100" class="dropify form-control" data-default-file="{{ isset($custompage) ? asset('uploads/custompagephoto/'.$custompage->background_img) : '' }}" name="background_img">
					</div>


                    @isset($custompage)
                    <div class="form-group">
						<label class="form-label">Container</label>
						<select name="container" class="form-control form-select select2" data-bs-placeholder="Select Container">
							<option value="">Select Container Type</option>
							<option value="container-lg" {{($custompage->container == 'container-lg') ? 'selected' : ''}}  >Full width</option>
							<option value="container-sm" {{($custompage->container == 'container-sm') ? 'selected' : ''}}>Box Layout</option>
						</select>
					</div>

                    @else

					<div class="form-group">
						<label class="form-label">Container</label>
						<select name="container" class="form-control form-select select2" data-bs-placeholder="Select Container">
							<option value="">Select Page Type</option>
							<option value="container-lg">Full width</option>
							<option value="container-sm">Box Layout</option>
						</select>
					</div>

                    @endisset

				</div>



				<div class="card-footer text-end">
					<button type="submit" class="btn btn-success mt-1">
                        @isset($custompage)
                        <i class="fas fa-arrow-circle-up"></i>
                        Update
                        @else
                        <i class="fe fe-plus"></i>
                        Create
                        @endisset
                    </button>
					<a href="{{route('admin.sidebars.index')}}" class="btn btn-danger mt-1">Cancel</a>
				</div>
			</div>
		</div>

		{{-- Right Side --}}
		<div class="col-lg-3 col-xl-3 col-md-12 col-sm-12" style="float: left">

			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Create Page</h3>
				</div>
				<div class="card-body">

					@isset($custompage)
					<div class="form-group">
						<div class="form-label">Status</div>
						<label class="custom-switch">
							<input type="checkbox" name="status" {{$custompage->status == true ? 'checked' : ''}} class="custom-switch-input ">
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



                    @isset($custompage)
					<div class="form-group">
						<div class="form-label">Transparent</div>
						<label class="custom-switch">
							<input type="checkbox" name="transparent" {{$custompage->transparent == true ? 'checked' : ''}} class="custom-switch-input ">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

                    @else

                    <div class="form-group">
						<div class="form-label">Transparent</div>
						<label class="custom-switch">
							<input type="checkbox" name="transparent" class="custom-switch-input ">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

                    @endisset


                    @isset($editsidebars)

                    <div class="form-group">
						<label class="form-label">Left Sidebar</label>
						<select name="leftsidebar_id" class="form-control form-select select2" data-bs-placeholder="Select Sidebar">
							<option value="">Select Left Sidebar</option>
                            <option value="0" {{($custompage->leftsidebar_id == 0) ? 'selected' : ''}}>None</option>
                            @foreach ($editsidebars as $editsidebar)
                            @if($editsidebar->type == 'Left Side Bar')
                            <option value="{{$editsidebar->id}}" {{($custompage->leftsidebar_id == $editsidebar->id) ? 'selected' : ''}}>{{$editsidebar->title}}</option>
                            @endif
                            @endforeach
						</select>
					</div>


					<div class="form-group">
						<label class="form-label">Right Sidebar</label>
						<select name="rightsidebar_id" class="form-control form-select select2" data-bs-placeholder="Select Sidebar">
							<option value="">Select Right Sidebar</option>
                            <option value="0" {{($custompage->rightsidebar_id == 0) ? 'selected' : ''}} >None</option>
                            @foreach ($editsidebars as $editsidebar)
                            @if($editsidebar->type == 'Right Side Bar')
							<option value="{{$editsidebar->id}}" {{($custompage->rightsidebar_id == $editsidebar->id) ? 'selected' : ''}} >{{$editsidebar->title}}</option>
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


				</div>

			</div>
		</div>

	</div>
    </form>
	<!-- ROW-1 CLOSED -->
@endsection('content')

@section('scripts')


<script>
    $(document).ready(function() {
        $("input[id$='test1']").click(function() {
            var link = $(this).val();

            $("div.background_color").show();
            $("div.background_img").hide();
        });

        $("input[id$='test2']").click(function() {
            var link = $(this).val();

            $("div.background_color").hide();
            $("div.background_img").show();
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
