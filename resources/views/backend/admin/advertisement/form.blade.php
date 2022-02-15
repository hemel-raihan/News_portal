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
								<h1 class="page-title">{{ isset($advertisement) ? 'Edit ' : 'Create '}}Advertisement</h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>
							<div class="ms-auto pageheader-btn">
								<a href="{{route('admin.advertisements.index')}}" class="btn btn-primary btn-icon text-white me-2">
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
    <form method="POST" action="{{isset($advertisement) ? route('admin.advertisements.update',$advertisement->id) : route('admin.advertisements.store')}}" enctype="multipart/form-data">
    @csrf
    @isset($advertisement)
    @method('PUT')
    @endisset
	<div class="row">
		{{-- Left Side --}}
		<div class="col-lg-9 col-xl-9 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Create Advertisement</h3>
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
						<label for="exampleInputname">Title</label>
						<input type="text" class="form-control @error('title') is-invalid @enderror" value="{{$advertisement->title ?? old('title')}}" name="title" placeholder="Advertisement Title">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
					</div>

                    <div class="form-group">
						<label for="exampleInputname">URL</label>
						<input type="text" class="form-control @error('url') is-invalid @enderror" value="{{$advertisement->url ?? old('url')}}" name="url" placeholder="Advertisement URL">
					</div>

                    <div class="form-group">
                        @isset($advertisement)
                        <label class="form-label" for="type">Select Widget Type</label>
                        <select class="form-control form-select select2" data-bs-placeholder="Select Type" name="position" id="type" required onChange="setWidget()">
                            <option value="">Select Postion</option>
                            <option value="Top-Middle" {{($advertisement->position == 'Top-Middle') ? 'selected' : ''}} >Top-Middle</option>
                            <option value="Body-Position-1" {{($advertisement->position == 'Body-Position-1') ? 'selected' : ''}}>Body-Position-1</option>
                            <option value="Body-Position-2" {{($advertisement->position == 'Body-Position-2') ? 'selected' : ''}} >Body-Position-2</option>
                            <option value="Body-Position-3" {{($advertisement->position == 'Body-Position-3') ? 'selected' : ''}} >Body-Position-3</option>
                            <option value="Category-Position-1" {{($advertisement->position == 'Category-Position-1') ? 'selected' : ''}} >Body-Position-1(category-page)</option>
                            <option value="Single-Position-1" {{($advertisement->position == 'Single-Position-1') ? 'selected' : ''}} >Body-Position-1(single-page)</option>
                        </select>
                        @else
                        <label class="form-label" for="type">Select Position</label>
                        <select class="form-control form-select select2" data-bs-placeholder="Select Type" name="position" id="type" required onChange="setWidget()">
                            <option value="">Select Postion</option>
                            <option value="Top-Middle">Top-Middle</option>
                            <option value="Body-Position-1">Body-Position-1</option>
                            <option value="Body-Position-2">Body-Position-2</option>
                            <option value="Body-Position-3">Body-Position-3</option>
                            <option value="Category-Position-1">Body-Position-1(category-page)</option>
                            <option value="Single-Position-1">Body-Position-1(single-page)</option>
                        </select>
                        @endisset
                    </div>

					<div class="form-group">
						<label for="exampleInputContent">Post Description</label>
						<div class="ql-wrapper ql-wrapper-demo bg-light">
                            <textarea name="text_add" class="my-editor form-control" id="editor" style="height: 200px;" cols="30" rows="10">{!!$advertisement->text_add ?? old('text_add')!!}</textarea>
						</div>
					</div>



				</div>
				<div class="card-footer text-end">
					<button type="submit" class="btn btn-success mt-1">
                        @isset($advertisement)
                        <i class="fas fa-arrow-circle-up"></i>
                        Update
                        @else
                        <i class="fe fe-plus"></i>
                        Create
                        @endisset
                    </button>
					<a href="{{route('admin.advertisements.index')}}" class="btn btn-danger mt-1">Cancel</a>
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
                    @isset($advertisement)
					<div class="form-group">
						<div class="form-label">Status</div>
						<label class="custom-switch">
							<input type="checkbox" name="status" {{$advertisement->status == true ? 'checked' : ''}} class="custom-switch-input ">
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

                    <div class="form-group">
						<label for="exampleInputname">Start Date</label>
						<input type="date" class="form-control" value="{{$advertisement->start_date ?? old('start_date') }}" name="start_date" id="">
					</div>

                    {{-- <div class="form-group">
						<label for="exampleInputname">Start Time</label>
						<input type="time" class="form-control" value="{{$advertisement->start_time ?? old('start_time') }}" name="start_time" id="">
					</div> --}}

                    <div class="form-group">
						<label for="exampleInputname">End Date</label>
						<input type="date" class="form-control" value="{{$advertisement->end_date ?? old('end_date') }}" name="end_date" id="">
					</div>

                    {{-- <div class="form-group">
						<label for="exampleInputname">End Time</label>
						<input type="time" class="form-control" value="{{$advertisement->end_time ?? old('end_time') }}" name="end_time" id="">
					</div> --}}

                    <div class="form-group featur">
						<label class="form-label">Banner</label>
						<!-- <input id="demo" type="file" name="image" accept=".jpg, .png, image/jpeg, image/png" multiple="" class="ff_fileupload_hidden"> -->
                        <input type="file"  class="dropify form-control" data-default-file="{{ isset($advertisement) ? asset('uploads/advertisement/'.$advertisement->banner) : '' }}" name="banner">
					</div>

				</div>

			</div>
		</div>

	</div>
    </form>
	<!-- ROW-1 CLOSED -->
@endsection('content')

@section('scripts')



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
