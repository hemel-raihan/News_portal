@extends('layouts.app')

@section('styles')

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">User Management</h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>

							<div class="ms-auto pageheader-btn">
                            @if($auth->hasPermission('app.users.create'))
								<a href="{{route('admin.users.create')}}" class="btn btn-primary btn-icon text-white me-2">
									<span>
										<i class="fe fe-plus"></i>
									</span> Create New User
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
								<div class="card custom-card">
									<div class="card-body">
										<div>
											<h3 class="card-title mb-1">All users</h3>
										</div>
										<div class="table-responsive">
											<table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
												<thead>
													<tr>
														<th>ID</th>
														<th>Name</th>
														<th>Email</th>
														<th>created At</th>
                                                        <th>Action</th>
													</tr>
												</thead>
												<tbody>
                                                    @foreach($users as $key=>$user)
													<tr>
														<td>{{$key}}</td>
														<td>{{$user->name}}</td>
														<td>{{$user->email}}</td>
														<td>{{$user->created_at->diffForHumans()}}</td>
                                                        <td>
                                                    @if($auth->hasPermission('app.users.edit'))

															<a href="{{route('admin.categories.edit',$user->id)}}" class="btn btn-success">
															<i class="fa fa-edit"></i>
															</a>

													@endif


                                                    @if($auth->hasPermission('app.users.destroy'))

															<button class="btn btn-danger waves effect" type="button"
															onclick="deletepost$user({{ $user->id}})" >
															<i class="fa fa-trash"></i>
															</button>
															<form id="deleteform-{{$user->id}}" action="{{route('admin.users.destroy',$user->id)}}" method="POST" style="display: none;">
															@csrf
															@method('DELETE')
															</form>

													@endif
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

@endsection('content')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function deletepost$user(id)

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

        <!-- Select2 js-->
		<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

@endsection
