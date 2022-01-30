@extends('layouts.app')

@section('styles')

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">Roles Management</h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>
							<div class="ms-auto pageheader-btn">
								<a href="{{route('admin.roles.create')}}" class="btn btn-primary btn-icon text-white me-2">
									<span>
										<i class="fe fe-plus"></i>
									</span> Add Role
								</a>
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
											<h3 class="card-title mb-1">All Roles</h3>
										</div>
										<div class="table-responsive">
											<table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
												<thead>
													<tr>
														<th>ID</th>
														<th>Name</th>
														<th>Permission</th>
														<th>Updated At</th>
                                                        <th>Action</th>
													</tr>
												</thead>
												<tbody>
                                                    @foreach($roles as $key=>$role)
													<tr>
														<td>{{$key}}</td>
														<td>{{$role->name}}</td>
														<td> @if($role->permissions->count() > 0 )
                                                            <span class="badge bg-success  me-1 mb-1 mt-1">{{$role->permissions->count()}}</span>
                                                            @else
                                                            <span class="badge bg-danger  me-1 mb-1 mt-1">No Permission Found :(</span>
                                                            @endif
                                                        </td>
														<td>{{$role->updated_at->diffForHumans()}}</td>
                                                        <td>
                                                            {{-- @if($auth->hasPermission('app.roles.edit')) --}}
                                                    <a href="{{route('admin.roles.edit',$role->id)}}" class="btn btn-success">

                                                       <span>Edit</span>
                                                    </a>
                                                    {{-- @endif --}}


                                                    {{-- @if($auth->hasPermission('app.roles.destroy')) --}}

                                                    <button class="btn btn-danger waves effect" type="button"
                                                        onclick="deletepost$role({{ $role->id}})" >
                                                        <span class="material-icons">delete</span>
                                                        </button>
                                                        <form id="deleteform-{{$role->id}}" action="{{route('admin.roles.destroy',$role->id)}}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                        </form>
                                                        {{-- @endif --}}
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
    function deletepost$role(id)

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
