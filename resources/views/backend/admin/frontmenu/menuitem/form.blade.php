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
								<h1 class="page-title">{{ isset($frontmenuitem) ? 'Edit ' : 'Create '}}Widget ({{$menu->title}})</h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>
							<div class="ms-auto pageheader-btn">
								<a href="{{route('admin.widget.builder',$menu->id)}}" class="btn btn-primary btn-icon text-white me-2">
									<span>
										{{-- <i class="fe fe-minus"></i> --}}
									</span> Back To WidgetList
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
    <form method="POST" action="{{isset($frontmenuitem) ? route('admin.menuitem.update',['id'=>$menu->id,'menuId'=>$frontmenuitem->id]) : route('admin.menuitem.store',$menu->id)}}" enctype="multipart/form-data">
    @csrf
    @isset($frontmenuitem)
    @method('PUT')
    @endisset
	<div class="row">
        <div class="col-md-8">
            <div class="main-card mb-3 card">


                

                <div class="card-body">
                <h5 class="card-title">Manage Menu Item</h5>

                <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control form-select select2" onchange="setItemType()" name="type" id="type">
                        <option value="item" @isset($menuItem) {{$menuItem->type == 'item' ? 'selected' : ''}} @endisset >Menu Item</option>
                        <option value="divider" @isset($menuItem) {{$menuItem->type == 'divider' ? 'selected' : ''}} @endisset >Divider</option>
                    </select>
                </div>

                <div id="divider_fields">

                    <div class="form-group">
                        <label for="divider_title">Title Of the Divider</label>
                        <input id="divider_title" type="text" class="form-control @error('divider_title') is-invalid @enderror" name="divider_title" value="{{ $menuItem->divider_title ?? old('divider_title') }}"  autofocus>

                                   @error('divider_title')
                                       <span class="invalid-feedback" page="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                            </div>


                </div>


                <div id="item_fields">

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $menuItem->title ?? old('title') }}"  autofocus>

                                   @error('title')
                                       <span class="invalid-feedback" page="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                            </div>

                            <div class="form-group">
                                <label for="url">Url for the menu item</label>
                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ $menuItem->url ?? old('url') }}"  autofocus>

                                           @error('url')
                                               <span class="invalid-feedback" page="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="target">Open In</label>
                                        <select @error('target') is-invalid @enderror class="form-control form-select select2" name="target" id="target">
                                            <option value="_self" @isset($menuItem) {{$menuItem->target == '_self' ? 'selected' : ''}} @endisset >Same Tab/Window</option>
                                            <option value="_blank" @isset($menuItem) {{$menuItem->target == '_blank' ? 'selected' : ''}} @endisset>New Tab/Window</option>
                                        </select>
                                        @error('target')
                                               <span class="invalid-feedback" page="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                    </div>
                                  </div>


                            <button type="submit" class="btn btn-primary">
                                @isset($frontmenuitem)
                                <i class="fas fa-arrow-circle-up"></i>
                                Update
                                @else
                                <i class="fas fa-plus-circle"></i>
                                Create
                                @endisset
                                </button>

                </div>
            </div>
        </div>
    </div>
    </form>
	<!-- ROW-1 CLOSED -->
@endsection('content')

@section('scripts')


<script>
    function setItemType()
    {
        if($('select[name="type"]').val() === 'divider')
        {
            $('#divider_fields').removeClass('d-none');  // d-none => display none
            $('#item_fields').addClass('d-none');         // d-none => display add
        }
        else
        {
            $('#divider_fields').addClass('d-none');  // d-none => display none
            $('#item_fields').removeClass('d-none');
        }
    }
    setItemType();
</script>

<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
	window.onload = function () {
		CKEDITOR.replace('ckeditor', {
	        filebrowserBrowseUrl: filemanager.ckBrowseUrl,
	    });
	}
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
