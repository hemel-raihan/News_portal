@extends('layouts.app')

@section('styles')

        <!-- INTERNAL SELECT2 CSS -->
        <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
		<!-- DATA TABLE CSS -->
		<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}"  rel="stylesheet">
		<link href="{{ asset('assets/plugins/datatable/responsive.bootstrap5.css') }}" rel="stylesheet" />

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">Pricing Management</h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>

							<div class="ms-auto pageheader-btn">
                            @if($auth->hasPermission('app.price.categories.create'))
								<a href="{{route('admin.pricecategories.create')}}" class="btn btn-primary btn-icon text-white me-2">
									<span>
										<i class="fe fe-plus"></i>
									</span> Create New Category
								</a>
                                @endif

								{{-- <a href="#" class="btn btn-success btn-icon text-white">
									<span>
										<i class="fe fe-log-in"></i>
									</span> Export
								</a> --}}
							</div>
						</div>
						<!-- PAGE-HEADER END -->

						<!-- Row -->
		<div class="row row-sm">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">All Categories</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive export-table">
							<table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
								<thead>
									<tr>
										<th class="border-bottom-0">Name</th>
										<th class="border-bottom-0">Category</th>
										<th class="border-bottom-0">Status</th>
										<th class="border-bottom-0">Action</th>

									</tr>
								</thead>
								<tbody>
                                @foreach($categories as $category)
									<tr>
										<td>{{$category->name}}</td>
										<td>
                                            @if($category->parent_id == 0)
                                            <a class="btn btn-info">Main-Category</a>
                                            @else
                                            <a class="btn btn-primary">Sub-Category</a>
                                            @endif
                                        </td>
										<td>
                                            @if($category->status == true)
                                            <a href="{{route('admin.price.category.approve',$category->id)}}" class="btn btn-info">Active</a>
                                            @else
                                            <a href="{{route('admin.price.category.approve',$category->id)}}" class="btn btn-primary">InActive</a>
                                            @endif
                                        </td>

										<td>
                                            @if($auth->hasPermission('app.price.categories.edit'))
                                            <a href="{{route('admin.pricecategories.edit',$category->id)}}" class="btn btn-success">
                                            <i class="fa fa-edit"></i>
                                            </a>
                                            @endif


                                        @if($auth->hasPermission('app.price.categories.destroy'))

                                        <button class="btn btn-danger waves effect" type="button"
                                            onclick="deletepost$category({{ $category->id}})" >
                                            <i class="fa fa-trash"></i>
                                            </button>
                                            <form id="deleteform-{{$category->id}}" action="{{route('admin.pricecategories.destroy',$category->id)}}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                            </form>
                                        @endif
                                            </td>

									</tr>
                                @endforeach

								</tbody>
							</table>
                            {{-- {{ $categories->links('vendor.pagination.custom') }} --}}
                            @include('vendor.pagination.custom',['paginator'=>$categories])
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Row -->

@endsection('content')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function deletepost$category(id)

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

@section('scripts')

{{-- <script>
     function categorystatus(id) {
            $.ajax({
                type: "GET",
                url: "{{route('admin.price.category.approve')}}",
                dtaType: "json",
                data: {'user_id': id},
                success: function(data)
                {
                    alert(data.success)
                }
            });
        }


</script> --}}

<!-- DATA TABLE JS-->
        <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
		<script src="{{ asset('assets/js/table-data.js') }}"></script>

       <!-- CHARTJS JS -->
		<script src="{{ asset('assets/plugins/chart/Chart.bundle.js')}}"></script>
		<script src="{{ asset('assets/plugins/chart/utils.js')}}"></script>

        <!-- INTERNAL SELECT2 JS -->
        <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
		<script src="{{ asset('assets/js/select2.js') }}"></script>

@endsection
