@extends('layouts.app')

@section('styles')

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

		<!--BOOTSTRAP-DATERANGEPICKER CSS-->
		<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">

		<!-- TIME PICKER CSS -->
		<link href="{{ asset('assets/plugins/time-picker/jquery.timepicker.css') }}" rel="stylesheet"/>

		<!-- INTERNAL Date Picker css -->
		<link href="{{ asset('assets/plugins/date-picker/date-picker.css') }}" rel="stylesheet" />

		<!-- INTERNAL Sumoselect css-->
		<link rel="stylesheet" href="{{ asset('assets/plugins/sumoselect/sumoselect.css') }}">

		<!-- INTERNAL Bootstrap DatePicker css-->
		<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">

@endsection

@section('content')



	<!-- PAGE-HEADER -->
	<div class="page-header">
		<div>
			<h1 class="page-title">Add Slider</h1>
		</div>
		{{-- <div class="ms-auto pageheader-btn">
			<a href="#" class="btn btn-success btn-icon text-white me-2">
				<span>
					<i class="fe fe-plus"></i>
				</span> Save
			</a>
			<a href="#" class="btn btn-danger btn-icon text-white">
				<span>
					<i class="fe fe-log-in"></i>
				</span> Save as Draft
			</a>
		</div> --}}
	</div>

	<!-- PAGE-HEADER END -->

	<!-- ROW-1 OPEN -->
	<div class="row">
		{{-- Left Side --}}
		<div class="col-lg-9 col-xl-9 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Add Slider</h3>
				</div>
				<form method="POST" action="{{isset($slider) ? route('admin.sliders.update',$slider->id) : route('admin.sliders.store')}}">
					@csrf
					@isset($slider)
					@method('PUT')
					@endisset
				<div class="card-body">
					<div class="form-group">
						<label for="exampleInputName">Slider Name</label>
						<input type="text" name="name" value="{{ $slider->name ?? old('name') }}" class="form-control" id="exampleInputName" placeholder="Slider Name">
					</div>
					 
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<input type="number" name="height" value="{{ $slider->height ?? old('height') }}" class="form-control" id="exampleInputHeight" placeholder="Height">
							</div>
						</div>
						
						<div id="width" class="col-md-3 answer">
							<div class="form-group">
								<input  type="number" name="width" value="{{ $slider->width ?? old('width') }}" class="form-control "  placeholder="Width">
							</div>
						</div>
						
						<div class="col-md-3">
							<div class="form-group">
								<input type="number" name="padding" value="{{ $slider->padding ?? old('padding') }}" class="form-control" id="exampleInputPadding" placeholder="Padding">
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<input type="number" name="margin" value="{{ $slider->margin ?? old('margin') }}" class="form-control" id="exampleInputMargin" placeholder="Margin">
							</div>
						</div>
						
					</div>
	
				</div>
				<div class="card-footer text-end">
					<button type="submit" class="btn btn-success mt-1">
						@isset($slider)
                        <i class="fa fa-arrow-circle-up"></i>
                        Update
                        @else
                        <i class="fe fe-plus"></i>
                        Create
                        @endisset
					</button>
					<a href="#" class="btn btn-danger mt-1">Cancel</a>
				</div>
                
			</div>
		</div>

		{{-- Right Side --}}
		<div class="col-lg-3 col-xl-3 col-md-12 col-sm-12" style="float: left">

			<div class="card">
				<div class="card-body">
					@isset($slider)
					<div class="form-group">
						<div class="form-label">Status</div>
						<label class="custom-switch">
							<input type="checkbox" name="status" {{$slider->status == 1 ? 'checked' : ''}} class="custom-switch-input ">
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
					
					{{-- check full width --}}
					@isset($slider)
					<div class="form-group">
						<div class="form-label">Full width</div>
						<label class="custom-switch">
							<input type="checkbox" name="fullwidth" {{$slider->fullwidth == 1 ? 'checked' : ''}}  class="custom-switch-input coupon_question">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

					@else

					<div class="form-group">
						<div class="form-label">Full width</div>
						<label class="custom-switch">
							<input type="checkbox" name="fullwidth" class="custom-switch-input coupon_question" onchange="valueChanged()">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

					@endisset
				</div>
				
			</div>

            </form>

		</div>
		
	</div>
	<!-- ROW-1 CLOSED -->
			

@endsection('content')

<script type="text/javascript">
    function valueChanged()
    {
        if($('.coupon_question').is(":checked"))   
            $(".answer").hide();
        else
            $(".answer").show();
    }
</script>

@section('scripts')

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
