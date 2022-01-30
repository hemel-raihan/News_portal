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
			<h1 class="page-title">All Slide</h1>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Pages</a></li>
				<li class="breadcrumb-item active" aria-current="page">Pages</li>
			</ol>
		</div>

		<div class="ms-auto pageheader-btn">
			<a href="{{ route('admin.notices.create') }}" class="btn btn-primary btn-icon text-white me-2">
				<span>
					<i class="fe fe-plus"></i>
				</span> Create New Slide
			</a>
		</div>
		
	</div>
	<!-- PAGE-HEADER END -->

		<!-- Row -->
		<div class="row row-sm">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">All Slide</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive export-table">
							<table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
								<thead>
									<tr>
										<th class="border-bottom-0">ID</th>
										<th class="border-bottom-0">Title</th>
										<th class="border-bottom-0">Status</th>
										<th class="border-bottom-0">Action</th>
									
									</tr>
								</thead>
								<tbody>
									@foreach ($notices as $key=>$notice)
									<tr>
										<td>{{ $key+1 }}</td>
										<td>{{ $notice->title }}</td>
										<td>
											@if($notice->status == 1)
                                            <a href="{{route('admin.notice.status',$notice->id)}}" class="btn btn-info">Active</a>
                                            @else
                                            <a href="{{route('admin.notice.status',$notice->id)}}" class="btn btn-primary">InActive</a>
                                            @endif
										</td>
										<td>
											<a class="btn btn-sm btn-primary" href="{{ route('admin.notices.edit',$notice->id) }}"><i class="fa fa-edit"></i> Edit</a>
											
											<button class="btn btn-danger waves effect" type="button" onclick="deletepost$notice({{ $notice->id}})" >
												<i class="fa fa-trash"></i>
                                            </button>
                                            <form id="deleteform-{{$notice->id}}" action="{{route('admin.notices.destroy',$notice->id)}}" method="POST" style="display: none;">
												@csrf
												@method('DELETE')
                                            </form>
										</td>
									
									</tr>
									@endforeach


								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Row -->

@endsection('content')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function deletepost$notice(id)

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
