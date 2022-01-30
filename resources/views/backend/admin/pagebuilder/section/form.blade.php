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
                    ul {
  list-style-type: none;
}

li {
  display: inline-block;
}

input[type="radio"][id^="cb"] {
  display: none;
}

label {
  border: 1px solid #fff;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

label::before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

label img {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked+label {
  border-color: #ddd;
}

:checked+label::before {
  content: "✓";
  background-color: greenyellow;
  transform: scale(1);
}

:checked+label img {
  transform: scale(0.9);
  box-shadow: 0 0 5px #333;
  z-index: -1;
}
                    </style>

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">{{ isset($pagebuilder) ? 'Edit ('.$pagebuilder->title.') ' : 'Create '}}Section </h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>
							<div class="ms-auto pageheader-btn">
								<a href="{{route('admin.custompage.builder',$page->id)}}" class="btn btn-primary btn-icon text-white me-2">
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
    <form method="POST" action="{{isset($pagebuilder) ? route('admin.pagebuilder.update',['id'=>$page->id,'pageId'=>$pagebuilder->id]) : route('admin.pagebuilder.store',$page->id)}}" enctype="multipart/form-data">
    @csrf
    @isset($pagebuilder)
    @method('PUT')
    @endisset
	<div class="row">
		{{-- Left Side --}}
		<div class="col-lg-9 col-xl-9 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Manage Page Section</h3>
				</div>

                <div class="card-body">
				{{-- <div class="form-group">
                    @isset($pagebuilder)
                    <label class="form-label" for="type">Select Layout Type</label>
					<select class="form-control form-select select2" data-bs-placeholder="Select Type" name="layout" id="type" >
                        <option value="">Select Layout</option>
						<option value="One Column" {{($pagebuilder->layout == 'One Column') ? 'selected' : ''}} >One Column</option>
						<option value="Two Column" {{($pagebuilder->layout == 'Two Column') ? 'selected' : ''}}>Two Column</option>
                        <option value="Three Column" {{($pagebuilder->layout == 'Three Column') ? 'selected' : ''}} >Three Column</option>
                        <option value="Four Column" {{($pagebuilder->layout == 'Four Column') ? 'selected' : ''}} >Four Column</option>
					</select>
                    @else
                    <label class="form-label" for="type">Select Layout Type</label>
					<select class="form-control form-select select2" data-bs-placeholder="Select Type" name="layout" id="type" >
                        <option value="">Select Layout</option>
						<option value="One Column">One Column</option>
						<option value="Two Column">Two Column</option>
                        <option value="Three Column">Three Column</option>
                        <option value="Four Column">Four Column</option>
					</select>
                    @endisset
				</div> --}}

                @isset($pagebuilder)
                <label class="form-label" for="type">Select Layout Type</label>
                <ul class="test">
                    <li><input type="radio" name="layout" value="One Column" {{($pagebuilder->layout == 'One Column') ? 'checked' : ''}} id="cb1" />
                        <label for="cb1"><svg width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path fill-rule="evenodd" clip-rule="evenodd" d="m39.0625 14h-30.0625v20.0938h30.0625zm-30.0625-2c-1.10457 0-2 .8954-2 2v20.0938c0 1.1045.89543 2 2 2h30.0625c1.1046 0 2-.8955 2-2v-20.0938c0-1.1046-.8954-2-2-2z"></path></svg></label>
                    </li>
                    <li><input type="radio" name="layout" value="Two Column" {{($pagebuilder->layout == 'Two Column') ? 'checked' : ''}} id="cb2" />
                        <label for="cb2"><svg width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path fill-rule="evenodd" clip-rule="evenodd" d="M39 12C40.1046 12 41 12.8954 41 14V34C41 35.1046 40.1046 36 39 36H9C7.89543 36 7 35.1046 7 34V14C7 12.8954 7.89543 12 9 12H39ZM39 34V14H25V34H39ZM23 34H9V14H23V34Z"></path></svg></label>
                    </li>
                    <li><input type="radio" name="layout" value="Two/One Column" {{($pagebuilder->layout == 'Two/One Column') ? 'checked' : ''}} id="cb3" />
                      <label for="cb3"><svg width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path fill-rule="evenodd" clip-rule="evenodd" d="M39 12C40.1046 12 41 12.8954 41 14V34C41 35.1046 40.1046 36 39 36H9C7.89543 36 7 35.1046 7 34V14C7 12.8954 7.89543 12 9 12H39ZM39 34V14H30V34H39ZM28 34H9V14H28V34Z"></path></svg></label>
                    </li>
                    <li><input type="radio" name="layout" value="One/Two Column" {{($pagebuilder->layout == 'One/Two Column') ? 'checked' : ''}} id="cb4" />
                      <label for="cb4"><svg width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path fill-rule="evenodd" clip-rule="evenodd" d="M39 12C40.1046 12 41 12.8954 41 14V34C41 35.1046 40.1046 36 39 36H9C7.89543 36 7 35.1046 7 34V14C7 12.8954 7.89543 12 9 12H39ZM39 34V14H20V34H39ZM18 34H9V14H18V34Z"></path></svg></label>
                    </li>
                    <li><input type="radio" name="layout" value="Three Column" {{($pagebuilder->layout == 'Three Column') ? 'checked' : ''}} id="cb5" />
                        <label for="cb5"><svg width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path fill-rule="evenodd" d="M41 14a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h30a2 2 0 0 0 2-2V14zM28.5 34h-9V14h9v20zm2 0V14H39v20h-8.5zm-13 0H9V14h8.5v20z"></path></svg></label>
                    </li>
                    <li><input type="radio" name="layout" value="One/Two/One Column" {{($pagebuilder->layout == 'One/Two/One Column') ? 'checked' : ''}} id="cb6" />
                        <label for="cb6"><svg width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path fill-rule="evenodd" d="M41 14a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h30a2 2 0 0 0 2-2V14zM31 34H17V14h14v20zm2 0V14h6v20h-6zm-18 0H9V14h6v20z"></path></svg></label>
                    </li>
                  </ul>
                @else
                <label class="form-label" for="type">Select Layout Type</label>
                <ul class="test">
                    <li><input type="radio" name="layout" value="One Column" id="cb1" />
                        <label for="cb1"><svg width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path fill-rule="evenodd" clip-rule="evenodd" d="m39.0625 14h-30.0625v20.0938h30.0625zm-30.0625-2c-1.10457 0-2 .8954-2 2v20.0938c0 1.1045.89543 2 2 2h30.0625c1.1046 0 2-.8955 2-2v-20.0938c0-1.1046-.8954-2-2-2z"></path></svg></label>
                    </li>
                    <li><input type="radio" name="layout" value="Two Column" id="cb2" />
                        <label for="cb2"><svg width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path fill-rule="evenodd" clip-rule="evenodd" d="M39 12C40.1046 12 41 12.8954 41 14V34C41 35.1046 40.1046 36 39 36H9C7.89543 36 7 35.1046 7 34V14C7 12.8954 7.89543 12 9 12H39ZM39 34V14H25V34H39ZM23 34H9V14H23V34Z"></path></svg></label>
                    </li>
                    <li><input type="radio" name="layout" value="Two/One Column" id="cb3" />
                      <label for="cb3"><svg width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path fill-rule="evenodd" clip-rule="evenodd" d="M39 12C40.1046 12 41 12.8954 41 14V34C41 35.1046 40.1046 36 39 36H9C7.89543 36 7 35.1046 7 34V14C7 12.8954 7.89543 12 9 12H39ZM39 34V14H30V34H39ZM28 34H9V14H28V34Z"></path></svg></label>
                    </li>
                    <li><input type="radio" name="layout" value="One/Two Column" id="cb4" />
                      <label for="cb4"><svg width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path fill-rule="evenodd" clip-rule="evenodd" d="M39 12C40.1046 12 41 12.8954 41 14V34C41 35.1046 40.1046 36 39 36H9C7.89543 36 7 35.1046 7 34V14C7 12.8954 7.89543 12 9 12H39ZM39 34V14H20V34H39ZM18 34H9V14H18V34Z"></path></svg></label>
                    </li>
                    <li><input type="radio" name="layout" value="Three Column" id="cb5" />
                        <label for="cb5"><svg width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path fill-rule="evenodd" d="M41 14a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h30a2 2 0 0 0 2-2V14zM28.5 34h-9V14h9v20zm2 0V14H39v20h-8.5zm-13 0H9V14h8.5v20z"></path></svg></label>
                    </li>
                    <li><input type="radio" name="layout" value="One/Two/One Column" id="cb6" />
                        <label for="cb6"><svg width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path fill-rule="evenodd" d="M41 14a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h30a2 2 0 0 0 2-2V14zM31 34H17V14h14v20zm2 0V14h6v20h-6zm-18 0H9V14h6v20z"></path></svg></label>
                    </li>
                  </ul>
                  @endisset

                <div class="form-group">
                    <label for="exampleInputname">Section Title</label>
                    <input type="text" class="form-control " value="{{$pagebuilder->title ?? old('title')}}" name="title" id="" placeholder="Section Title">
                </div>


                <div class="form-group">
                    <label for="exampleInputname">Padding</label>
                    <input type="text" class="form-control " value="{{$pagebuilder->padding ?? old('padding')}}" name="padding" id="" placeholder="section padding. ex: 10px,20px,30px">
                </div>

                <div class="form-group">
                    <label for="exampleInputname">Margin</label>
                    <input type="text" class="form-control " value="{{$pagebuilder->margin ?? old('margin')}}" name="margin" id="" placeholder="section margin. ex: 10px,20px,30px">
                </div>

                <div class="form-group">
                    <label for="exampleInputname">Border</label>
                    <input type="text" class="form-control " value="{{$pagebuilder->border ?? old('border')}}" name="border" id="" placeholder="section padding. ex: 1px,2px,3px">
                </div>

                <div class="form-group">
                    <label for="exampleInputname">Border Color</label>
                    <input type="text" class="form-control " value="{{$pagebuilder->bordercolor ?? old('bordercolor')}}" name="bordercolor" id="" placeholder="ex: black,red,white">
                </div>

                <div class="form-group">
                    @isset($pagebuilder)
                    <label class="form-label" for="type">Select Border Style</label>
					<select class="form-control form-select select2" data-bs-placeholder="Select Type" name="border_style" id="type" >
                        <option value="">Select Border Style</option>
                        <option value="None" {{($pagebuilder->border_style == 'None') ? 'selected' : ''}} >None</option>
						<option value="solid" {{($pagebuilder->border_style == 'solid') ? 'selected' : ''}} >Solid</option>
						<option value="dotted" {{($pagebuilder->border_style == 'dotted') ? 'selected' : ''}}>Dotted</option>
					</select>
                    @else
                    <label class="form-label" for="type">Select Border Style</label>
					<select class="form-control form-select select2" data-bs-placeholder="Select Type" name="border_style" id="type" >
                        <option value="">Select Border Style</option>
                        <option value="None">None</option>
						<option value="solid">Solid</option>
						<option value="dotted">Dotted</option>
					</select>
                    @endisset
				</div>

                <input type="radio" name="link" id="test2">
                <p for="css">Background Image</p>
                <input type="radio" name="link" id="test1">
                <p for="html">Background Color</p>


                <div class="form-group background_img" style="display:none">
                    <label class="form-label">Background Image</label>
                    <!-- <input id="demo" type="file" name="image" accept=".jpg, .png, image/jpeg, image/png" multiple="" class="ff_fileupload_hidden"> -->
                    <input type="file" data-height="100" class="dropify form-control" data-default-file="{{ isset($pagebuilder) ? asset('uploads/sectionpagephoto/'.$pagebuilder->background_img) : '' }}" name="background_img">
                </div>

                <div class="form-group background_color" style="display:none">
                    <label for="exampleInputname">Background Color</label>
                    <input type="text" class="form-control " value="{{$pagebuilder->background_color ?? old('background_color')}}" name="background_color" id="" placeholder="ex: #fffff">
                </div>


                </div>


				<div class="card-footer text-end">
					<button type="submit" class="btn btn-success mt-1">
                        @isset($pagebuilder)
                        <i class="fas fa-arrow-circle-up"></i>
                        Update
                        @else
                        <i class="fe fe-plus"></i>
                        Create
                        @endisset
                    </button>
					<a href="{{route('admin.custompage.builder',$page->id)}}" class="btn btn-danger mt-1">Cancel</a>
				</div>
			</div>
		</div>

        <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12" style="float: left">

			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Create Page</h3>
				</div>
				<div class="card-body">

					@isset($pagebuilder)
					<div class="form-group">
						<div class="form-label">Status</div>
						<label class="custom-switch">
							<input type="checkbox" name="status" {{$pagebuilder->status == true ? 'checked' : ''}} class="custom-switch-input ">
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


				</div>

			</div>
		</div>


	</div>
    </form>
	<!-- ROW-1 CLOSED -->
@endsection('content')

@section('scripts')

<script>
    // $(function(){
    //    $('.test .hemel').on('click',function(){
    //       $('.test .hemel').not(this).prop('checked',false);
    //    });
    // });

//     function uncheckall(){
//    $('.test .hemel').on('click',function(){
//       $('.test .hemel').not(this).prop('checked',false);
//    });
// });
    </script>

<script>
    $('.hemel').click(function(event){
        if(this.checked)
        {
            // $(':checkbox').each(function(){
            //     this.checked = true;
            // });
            $(':checkbox').not(this)(function(){
                this.checked = false;
            });
        }
        // else
        // {
        //     $(':checkbox').each(function(){
        //         this.checked = false;
        //     });
        // }
    });
 </script>


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


<script>
	function setWidget()
	{
		if($('select[name="type"]').val() === 'Blog Category')
		{
			$('#blog_category').removeClass('d-none');
            $('#category').removeClass('d-none');
            $('#recent_post').addClass('d-none');
			$('#popular_post').addClass('d-none');
            $('#text_widget').addClass('d-none');
            $('#image_widget').addClass('d-none');
		}
		else if($('select[name="type"]').val() === 'Recent Post')
		{
			$('#no_of_post').removeClass('d-none');
			$('#blog_category').addClass('d-none');
            $('#category').addClass('d-none');
			$('#popular_post').addClass('d-none');
            $('#text_widget').addClass('d-none');
            $('#image_widget').addClass('d-none');
		}
		else if($('select[name="type"]').val() === 'Popular Post')
		{
			$('#recent_post').addClass('d-none');
			$('#blog_category').addClass('d-none');
            $('#category').addClass('d-none');
			$('#popular_post').removeClass('d-none');
			$('#no_of_post').removeClass('d-none');
            $('#text_widget').addClass('d-none');
            $('#image_widget').addClass('d-none');
		}
        else if($('select[name="type"]').val() === 'Text Widget')
		{
			$('#recent_post').addClass('d-none');
			$('#no_of_post').addClass('d-none');
			$('#blog_category').addClass('d-none');
            $('#category').addClass('d-none');
			$('#popular_post').addClass('d-none');
            $('#text_widget').removeClass('d-none');
            $('#image_widget').addClass('d-none');
		}
        else if($('select[name="type"]').val() === 'Image Widget')
		{
			$('#recent_post').addClass('d-none');
			$('#blog_category').addClass('d-none');
            $('#category').addClass('d-none');
			$('#popular_post').addClass('d-none');
            $('#text_widget').removeClass('d-none');
            $('#no_of_post').addClass('d-none');
            $('#image_widget').removeClass('d-none');
		}
	}
	setWidget();
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
