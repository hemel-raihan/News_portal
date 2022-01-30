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
								<h1 class="page-title">Menu Builder ({{$menu->title}})</h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>
							<div class="ms-auto pageheader-btn">
								{{-- <a href="{{route('admin.menuitem.create',$menu->id)}}" class="btn btn-success btn-icon text-white">
									<span>
										<i class="fe fe-log-in"></i>
									</span> Create New MenuItem
								</a> --}}
								<a href="{{route('admin.frontmenus.index')}}" class="btn btn-danger btn-icon text-white me-2">
									<span>
										<i class="fas fa-arrow-circle-left"></i>
									</span> Back
								</a>

							</div>
						</div>
						<!-- PAGE-HEADER END -->

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12">
                                <div class="main-card mb-3 card">
									<div class="card-body">
										<h5 class="card-title">
											How To Use:
										</h5>
										<p>You can output a sidebar anywhere on your site by calling <code>menu('name')</code></p>
									</div>
								</div>
                            </div>
                        </div>

						<div class="row">
                            <div class="col-3">
                                <div class="main-card mb-3 card">
                                    <div class="expand" style="margin-left: 10%; margin-right: 10%; margin-top:10px;">

                                        <p style="background: #f3f8fb;">
                                            <a class="btn" data-bs-toggle="collapse" style="" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                                              Pages
                                            </a>
                                          </p>
                                          <div class="collapse" id="collapseExample1">
                                            <div class="card card-body">
                                                <div class="transfer-double-list-content">
                                                    <div class="transfer-double-list-main">
                                                        <ul class="transfer-double-group-list-ul transfer-double-group-list-ul-1636878492751">
                                                            @foreach($pages as $key => $page)
                                                            <li class="transfer-double-group-list-li transfer-double-group-list-li-1636878492751">
                                                                <div class="checkbox-group">
                                                                    <input type="checkbox" value="{{$page->title}}" data-src="{{$page->id}}" data-id="{{$page->slug}}" name="pagebox[]" class="checkbox-normal group-select-all-1636878492751" id="group_{{$key}}_1636878492751" /><label for="group_{{$key}}_1636878492751" class="group-name-1636878492751">{{$page->title}}</label>
                                                                </div>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>

                                                <button id="add_menu" class="btn btn-primary">Add to Menu</button>
                                            </div>
                                          </div>

                                          <p style="background: #f3f8fb;">
                                            <a class="btn" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                              Blog Categories
                                            </a>
                                          </p>
                                          <div class="collapse" id="collapseExample2">
                                            <div class="card card-body">
                                                <div class="transfer-double-list-content">
                                                    <div class="transfer-double-list-main">
                                                        <ul class="transfer-double-group-list-ul transfer-double-group-list-ul-1636878492751">
                                                            @foreach($categories as $key => $category)
                                                            <li class="transfer-double-group-list-li transfer-double-group-list-li-1636878492751">
                                                                <div class="checkbox-group">
                                                                    <input type="checkbox" value="{{$category->name}}" data-src="{{$category->id}}" data-id="{{$category->slug}}" name="categorybox[]" class="checkbox-normal group-select-all-1636878492751" id="group_{{$key}}_1636878492752" /><label for="group_{{$key}}_1636878492752" class="group-name-163687849275">{{$category->name}}</label>
                                                                </div>
                                                                @if($category->childrenRecursive->count()>0)


                                                                @include('backend.admin.frontmenu.child_categories', ['sub_category' => $category])


                                                                @endif
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>

                                                <button id="add_category" class="btn btn-primary">Add to Menu</button>
                                            </div>
                                          </div>


                                          <p style="background: #f3f8fb;">
                                            <a class="btn" data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample">
                                              Content Categories
                                            </a>
                                          </p>
                                          <div class="collapse" id="collapseExample3">
                                            <div class="card card-body">
                                                <div class="transfer-double-list-content">
                                                    <div class="transfer-double-list-main">
                                                        <ul class="transfer-double-group-list-ul transfer-double-group-list-ul-1636878492751">
                                                            @foreach($contentcategories as $key => $category)
                                                            <li class="transfer-double-group-list-li transfer-double-group-list-li-1636878492751">
                                                                <div class="checkbox-group">
                                                                    <input type="checkbox" value="{{$category->name}}" data-src="{{$category->id}}" data-id="{{$category->slug}}" name="contentcategorybox[]" class="checkbox-normal group-select-all-1636878492751" id="group_{{$key}}_1636878492753" /><label for="group_{{$key}}_1636878492753" class="group-name-163687849275">{{$category->name}}</label>

                                                                </div>
                                                                @if($category->childrenRecursive->count()>0)


                                                                @include('backend.admin.frontmenu.child_contentcategories', ['sub_category' => $category])


                                                                @endif
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>

                                                <button id="add_contentcategory" class="btn btn-primary">Add to Menu</button>
                                            </div>
                                          </div>


                                          {{-- <p style="background: #f3f8fb;">
                                            <a class="btn" data-bs-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample">
                                              Teams Categories
                                            </a>
                                          </p>
                                          <div class="collapse" id="collapseExample4">
                                            <div class="card card-body">
                                                <div class="transfer-double-list-content">
                                                    <div class="transfer-double-list-main">
                                                        <ul class="transfer-double-group-list-ul transfer-double-group-list-ul-1636878492751">
                                                            @foreach($teamcategories as $key => $category)
                                                            <li class="transfer-double-group-list-li transfer-double-group-list-li-1636878492751">
                                                                <div class="checkbox-group">
                                                                    <input type="checkbox" value="{{$category->name}}" data-src="{{$category->id}}" data-id="{{$category->slug}}" name="teamcategorybox[]" class="checkbox-normal group-select-all-1636878492751" id="group_{{$key}}_1636878492754" /><label for="group_{{$key}}_1636878492754" class="group-name-163687849275">{{$category->name}}</label>
                                                                </div>
                                                                @if($category->childrenRecursive->count()>0)


                                                                @include('backend.admin.frontmenu.child_teamcategories', ['sub_category' => $category])


                                                                @endif
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>

                                                <button id="add_teamcategory" class="btn btn-primary">Add to Menu</button>
                                            </div>
                                          </div> --}}


                                          <p style="background: #f3f8fb;">
                                            <a class="btn" data-bs-toggle="collapse" href="#collapseExample5" role="button" aria-expanded="false" aria-controls="collapseExample">
                                              Create Custom Menu
                                            </a>
                                          </p>
                                          <div class="collapse" id="collapseExample5">
                                            <div class="main-card mb-3 card">
                                                <h5 style="text-align: center; margin-top: 10px;" class="card-title">
                                                    Add Menu
                                                </h5>
                                                <form method="post" action="{{route('admin.menuitem.menustore',$menu->id)}}"  method="POST">
                                                    @csrf
                                                <label style="margin-left: 20px;" for="exampleInputname">Menu Title :</label>
                                                <input style="margin-left: 20px; width: 80%;" type="text" class="form-control" value="" name="title" id="title" placeholder="Menu Name">

                                                <label style="margin-left: 20px;" for="exampleInputname">Menu URL :</label>
                                                <input style="margin-left: 20px; width: 80%;" type="text" class="form-control" value="" name="url" id="menuslug" placeholder="Menu URL">

                                                <button style="width: 20%; margin-left: 40%; " type="submit"  class="btn btn-success mt-5 mb-5">Save</button>
                                                </form>
                                            </div>
                                          </div>

                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-3">
                                <form method="post" action="{{isset($menuitemm) ? route('admin.menuitem.update',['id'=>$menu->id,'menuId'=>$menuitemm->id]) : ''}}">
                                    @csrf
                                    @isset($menuitemm)
                                    @method('PUT')

                                    @endisset
                                <div class="main-card mb-3 card">
                                    <h5 style="text-align: center; margin-top: 10px;" class="card-title">
                                        Edit Menu
                                    </h5>
                                    <label style="margin-left: 20px;" for="exampleInputname">Menu Title :</label>
                                    <input style="margin-left: 20px; width: 80%;" type="text" class="form-control" value="{{$menuitemm->title ?? old('title')}}" name="title" id="menutitle" placeholder="Menu Name">

                                    <button style="width: 20%; margin-left: 40%; " type="submit" class="btn btn-success mt-5 mb-5">Edit</button>
                                </div>
                                </form>


                            </div> --}}


                            <div id="menuitem_edit" class="col-3">
                                    <div id="hemel">
                                        <div class="main-card mb-3 card">
                                            <h5 style="text-align: center; margin-top: 10px;" class="card-title">
                                                Edit Menu
                                            </h5>
                                            <label style="margin-left: 20px;" for="exampleInputname">Menu Title :</label>
                                            <input style="margin-left: 20px; width: 80%;" type="text" class="form-control" value="" name="title" id="menutitle" placeholder="Menu Name">

                                            <label style="margin-left: 20px;" for="exampleInputname">Menu URL :</label>
                                            <input style="margin-left: 20px; width: 80%;" type="text" class="form-control" value="" name="slug" id="slug" placeholder="Menu Slug">

                                            <button style="width: 20%; margin-left: 40%; " type="submit"  class="btn btn-success mt-5 mb-5">Edit</button>
                                        </div>
                                    </div>
                            </div>

							<div class="col-6">

								<div class="main-card mb-3 card">
									<div class="card-body menu-builder">
										<h5 class="card-title">
											Drag and Drop the sidebar Item below to re-arrange them.
										</h5>
                                        <form method="POST" action="{{route('admin.menuitem.store',$menu->id)}}" enctype="multipart/form-data">
                                            @csrf
										<div class="dd">
											<ol id="dd_handle" class="dd-list">
												@forelse ($menu->menuItems as $item)
													<li class="dd-item" data-id="{{$item->id}}">
                                                        <div class="pull-right item_actions">
                                                            {{-- <a href="{{route('admin.menuitem.edit',['id'=>$menu->id,'menuId'=>$item->id])}}" class="btn btn-success">
                                                                <i class="fa fa-edit"></i>
                                                            </a> --}}
                                                            <a onclick="Foo({{ $item->id}})" href="#" class="btn btn-success">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            {{-- @if($auth->hasPermission('app.front.menuitems.destroy')) --}}

                                                            <a class="btn btn-danger waves effect" href="{{route('admin.menuitem.destroy',['id'=>$menu->id,'menuId'=>$item->id])}}">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                                {{-- <form id="deleteform-{{$item->id}}" action="{{route('admin.menuitem.destroy',['id'=>$menu->id,'menuId'=>$item->id])}}" method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                                </form> --}}
                                                            {{-- @endif --}}
                                                        </div>

                                                        <div class="dd-handle">
                                                            @if($item->type == 'divider')
                                                            <strong> Divider: {{$item->divider_title }}</strong>
                                                            @else
                                                            <span id="span_title-{{$item->id}}"> {{$item->title }}</span>
                                                            @isset($item->url)
                                                            <small id="span_url-{{$item->id}}" class="url">{{$item->url}}</small>
                                                            <small id="span_slug-{{$item->id}}" class="url">0</small>
                                                            @else
                                                            <small id="span_slug-{{$item->id}}" class="url">{{$item->slug}}</small>
                                                            <small id="span_url-{{$item->id}}" class="url">0</small>
                                                            @endisset
                                                            @endif
                                                        </div>

                                                        {{-- @if(!$item->childs->isEmpty()) --}}
                                                        @if($item->childs->count()>0)
                                                        @include('backend.admin.frontmenu.child', ['itemm' => $item])
                                                        @endif
                                                        {{-- @endif --}}

                                                    </li>

                                                    @empty
                                                    <div class="text-center">
                                                        <strong>No menu item found.</strong>
                                                    </div>
                                                    @endforelse
											</ol>

                                            <button class="btn btn-primary" type="submit">Save Item</button>
										</div>
                                        </form>
									</div>
								</div>
							</div>
						</div>
                   <!-- ROW-1 OPEN -->

	<!-- ROW-1 CLOSED -->
@endsection('content')



@section('dragscripts')

{{-- <script type="text/javascript">
    $('.dd').nestable({maxDepth: 3});
    $('.dd').on('change',function(e)
    {
        $.post("{{route('admin.menuitem.order',$menu->id)}}",{
            order:JSON.stringify($('.dd').nestable('serialize')),
            _token: '{{csrf_token()}}'
        },function(data){
            iziToast.success({
                title: 'Success',
                message: 'Successfully updatd Menu order',
            });
        })
    })

</script> --}}

<script type="text/javascript">
    $('.dd').nestable({maxDepth: 4});
    $('.dd').on('change',function(e)
    {
        $.post("{{route('admin.menuitem.order',$menu->id)}}",{
            order:JSON.stringify($('.dd').nestable('serialize')),
            _token: '{{csrf_token()}}'
        },function(data){
            iziToast.success({
                title: 'Success',
                message: 'Successfully updated Widget order',
            });
        })
    })

</script>


@endsection

@section('scripts')


{{-- <script>

function fetchportfolio()
        {
            $.ajax({
                type: "GET",
                url: "{{route('admin.menuitem.show')}}",
                dtaType: "json",
                success: function(response)
                {
                    $.each(response.menuitem, function(key, item){
                        $('#dd_handle').append(``);
                    });
                }
            });
        }


    $(document).ready(function(){

        fetchportfolio();


    });
</script> --}}


{{-- <script>
    $(function(){
     /* $.ajaxSetup({
        headers: { 'X-CSRF-Token' : '{{csrf_token()}}'}
      })*/
      $('#ajaxinsert').submit(function(e){
        e.preventDefault();

        var data = $(this).serialize();
        var url = '{{url('admin/menuitem/menustore')}}'
        console.log(data);

        $.ajax({
          url: url,
          method: 'POST',
          data: data,
          success: function(response){
            if(response.success){
              alert(response.success);
            }
            fetchportfolio();
          },
          error: function(error){
            console.log(error)
          }

        })
      })
    })
  </script> --}}


{{-- <script type="text/javascript">


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnsubmit").click(function(e){
        //e.preventDefault();

        var title = $("#title").val();
        var slug = $("#menuslug").val();
        //var url = '{{ route("admin.menuitem.menustore") }}';

        $.ajax({
              url: "{{route('hemel')}}",
              type: "POST",
              data: {
                  _token: $("#csrf").val(),
                  type: 1,
                  title: title,
                  slug: slug,
                  menu_id: $menu->id,
              },
              cache: false,
              success: function(dataResult){
                  console.log(dataResult);
                  var dataResult = JSON.parse(dataResult);
                  if(dataResult.statusCode==200){
                    alert('ass');
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }

              }
          });

        // $.ajax({
        //    url: '{{ route("admin.menuitem.menustore") }}',
        //    //_token: '{{csrf_token()}}'
        //    method:'POST',
        //    data:{
        //     _token: $("#csrf").val(),
        //           title: title,
        //           slug: slug,
        //           id: $menu->id
        //         },
        //    success:function(response){
        //     //   if(response.success){
        //     //       alert(response.message) //Message come from controller
        //     //   }else{
        //     //       alert("Error")
        //     //   }
        //     alert('asd');
        //    },
        //    error:function(error){
        //       console.log(error)
        //    }
        // });
	});

</script> --}}


<script>
    function Foo(id) {
        var span_Text = document.getElementById("span_title-"+id).innerText;
        var span_Slug = document.getElementById("span_slug-"+id).innerText;
        var span_Url = document.getElementById("span_url-"+id).innerText;
        if(span_Slug == 0)
        {
            var value = span_Url;
            var name = 'url';
        }
        if(span_Url == 0)
        {
            var value = span_Slug;
            var name = 'slug';
        }
        var idd = id;
        var url = '{{ route("admin.menuitem.update", ":id") }}';
        url = url.replace(':id', id);


            $('#menuitem_edit').empty().append(`<form method="post" action="`+url+`">
                                    @csrf
                                    @method('PUT')
                                <div class="main-card mb-3 card">
                                    <h5 style="text-align: center; margin-top: 10px;" class="card-title">
                                        Edit Menu
                                    </h5>
                                    <label style="margin-left: 20px;" for="exampleInputname">Menu Title :</label>
                                    <input style="margin-left: 20px; width: 80%;" type="text" class="form-control" value="`+span_Text+`" name="title" id="menutitle" placeholder="Menu Name">

                                    <label style="margin-left: 20px;" for="exampleInputname">Menu URL :</label>

                                    <input style="margin-left: 20px; width: 80%;" type="text" class="form-control" value="`+value+`" name="`+name+`" id="`+name+`" placeholder="Menu Slug">

                                    <button style="width: 20%; margin-left: 40%; " type="submit" class="btn btn-success mt-5 mb-5">Edit</button>
                                </div>
                                </form>`);


    }

</script>

<script>

    function Foo_child(id) {
        var span_Text = document.getElementById("titlee-"+id).innerText;
        var span_Slug = document.getElementById("slug-"+id).innerText;
        var span_Url = document.getElementById("url-"+id).innerText;
        if(span_Slug == 0)
        {
            var value = span_Url;
            var name = 'url';
        }
        if(span_Url == 0)
        {
            var value = span_Slug;
            var name = 'slug';
        }
        var url = '{{ route("admin.menuitem.update", ":id") }}';
        url = url.replace(':id', id);


            $('#menuitem_edit').empty().append(`<form method="post" action="`+url+`">
                                    @csrf
                                    @method('PUT')
                                <div class="main-card mb-3 card">
                                    <h5 style="text-align: center; margin-top: 10px;" class="card-title">
                                        Edit Menu
                                    </h5>
                                    <label style="margin-left: 20px;" for="exampleInputname">Menu Title :</label>
                                    <input style="margin-left: 20px; width: 80%;" type="text" class="form-control" value="`+span_Text+`" name="title" id="menutitle" placeholder="Menu Name">

                                    <label style="margin-left: 20px;" for="exampleInputname">Menu URL :</label>
                                    <input style="margin-left: 20px; width: 80%;" type="text" class="form-control" value="`+value+`" name="`+name+`" id="`+name+`" placeholder="Menu Slug">

                                    <button style="width: 20%; margin-left: 40%; " type="submit" class="btn btn-success mt-5 mb-5">Edit</button>
                                </div>
                                </form>`);


    }
    </script>

<script>
        $('#add_menu').click(function () {
        var checkboxes = document.getElementsByName('pagebox[]');
for (var i=0, n=checkboxes.length;i<n;i++)
{
    if (checkboxes[i].checked)
    {

        $('#dd_handle').append(`<li class="dd-item" <?php foreach ($menu->menuItems as $item): ?> data-id="<?php echo $item["id"] ?>" <?php endforeach; ?> ><div class="pull-right item_actions"><a <?php foreach ($menu->menuItems as $item): ?> href="<?php route('admin.menuitem.destroy',['id'=>$menu->id,'menuId'=>$item->id]) ?>  <?php endforeach; ?>  " class="btn btn-danger waves effect" >
                                                                <i class="fa fa-trash"></i>
                                                            </a></div><div class="dd-handle"><span>`+checkboxes[i].value+`</span> <input type="hidden" name="title[]" value="`+checkboxes[i].value+`"> <input type="hidden" name="id[]" value="`+checkboxes[i].getAttribute('data-src')+`"> <input type="hidden" name="slug[]" value="`+checkboxes[i].getAttribute('data-id')+`"> </div></li>`);

                iziToast.success({
                title: 'Success',
                message: 'Successfully add menu in the list',
            });
    }
}
});

$('#add_category').click(function(){

var categoryboxes = document.getElementsByName('categorybox[]');

for (var i=0, n=categoryboxes.length;i<n;i++)
{
    if (categoryboxes[i].checked)
    {
        $('#dd_handle').append(`<li class="dd-item" <?php foreach ($menu->menuItems as $item): ?> data-id="<?php echo $item["id"] ?>" <?php endforeach; ?> ><div class="pull-right item_actions"><a <?php foreach ($menu->menuItems as $item): ?> href="<?php route('admin.menuitem.destroy',['id'=>$menu->id,'menuId'=>$item->id]) ?>  <?php endforeach; ?>  " class="btn btn-danger waves effect" >
                                                                <i class="fa fa-trash"></i>
                                                            </a></div><div class="dd-handle"><span>`+categoryboxes[i].value+`</span> <input type="hidden" name="title[]" value="`+categoryboxes[i].value+`"> <input type="hidden" name="id[]" value="`+categoryboxes[i].getAttribute('data-src')+`"> <input type="hidden" name="slug[]" value="`+categoryboxes[i].getAttribute('data-id')+`"> </div></li>`);

                                                            iziToast.success({
                title: 'Success',
                message: 'Successfully add menu in the list',
            });
    }
}
});


$('#add_contentcategory').click(function(){

var contentcategoryboxes = document.getElementsByName('contentcategorybox[]');
for (var i=0, n=contentcategoryboxes.length;i<n;i++)
{
    if (contentcategoryboxes[i].checked)
    {

            //console.log(contentcategoryboxes[i].getAttribute('data-id'));



        $('#dd_handle').append(`<li class="dd-item" <?php foreach ($menu->menuItems as $item): ?> data-id="<?php echo $item["id"] ?>" <?php endforeach; ?> ><div class="pull-right item_actions"><a <?php foreach ($menu->menuItems as $item): ?> href="<?php route('admin.menuitem.destroy',['id'=>$menu->id,'menuId'=>$item->id]) ?>  <?php endforeach; ?>  " class="btn btn-danger waves effect" >
                                                                <i class="fa fa-trash"></i>
                                                            </a></div><div class="dd-handle"><span>`+contentcategoryboxes[i].value+`</span> <input type="hidden" name="title[]" value="`+contentcategoryboxes[i].value+`"> <input type="hidden" name="id[]" value="`+contentcategoryboxes[i].getAttribute('data-src')+`"> <input type="hidden" name="slug[]" value="`+contentcategoryboxes[i].getAttribute('data-id')+`"> </div></li>`);

                iziToast.success({
                title: 'Success',
                message: 'Successfully add menu in the list',
            });
    }
}
});


$('#add_teamcategory').click(function(){

var teamcategoryboxes = document.getElementsByName('teamcategorybox[]');
for (var i=0, n=teamcategoryboxes.length;i<n;i++)
{
    if (teamcategoryboxes[i].checked)
    {

        $('#dd_handle').append(`<li class="dd-item" <?php foreach ($menu->menuItems as $item): ?> data-id="<?php echo $item["id"] ?>" <?php endforeach; ?> ><div class="pull-right item_actions"><a <?php foreach ($menu->menuItems as $item): ?> href="<?php route('admin.menuitem.destroy',['id'=>$menu->id,'menuId'=>$item->id]) ?>  <?php endforeach; ?>  " class="btn btn-danger waves effect" >
                                                                <i class="fa fa-trash"></i>
                                                            </a></div><div class="dd-handle"><span>`+teamcategoryboxes[i].value+`</span> <input type="hidden" name="title[]" value="`+teamcategoryboxes[i].value+`"> <input type="hidden" name="id[]" value="`+teamcategoryboxes[i].getAttribute('data-src')+`"> <input type="hidden" name="slug[]" value="`+teamcategoryboxes[i].getAttribute('data-id')+`"> </div></li>`);

                                                            iziToast.success({
                title: 'Success',
                message: 'Successfully add menu in the list',
            });
    }
}
});



</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function deletepost$menuitem(id)

    {
        Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
   event.preventDefault();
   document.getElementById('deleteform-'+id).submit();
  }
})
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
