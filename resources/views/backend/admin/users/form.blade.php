@extends('layouts.app')

@section('styles')

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">{{ isset($user) ? 'Edit ' : 'Create '}}Users</h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>
							<div class="ms-auto pageheader-btn">
								<a href="{{route('admin.users.index')}}" class="btn btn-primary btn-icon text-white me-2">
									<span>
										{{-- <i class="fe fe-minus"></i> --}}
									</span> Back To Userlist
								</a>
								{{-- <a href="#" class="btn btn-success btn-icon text-white">
									<span>
										<i class="fe fe-log-in"></i>
									</span> Export
								</a> --}}
							</div>
						</div>
						<!-- PAGE-HEADER END -->
                    <div class="row">
                        <div class="col-12">
                        <form method="POST" action="{{isset($user) ? route('admin.users.update',$user->id) : route('admin.users.store')}}">
                        @csrf
                        @isset($user)
                        @method('PUT')
                        @endisset
                        <div class="row">
							<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Manage Users</h4>
									</div>
									<div class="card-body">

											<div class="">
                                            <div class="form-group">
													<label for="exampleInputname" class="form-label">User Name</label>
													<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="exampleInputname" value="{{$user->name ?? old('name')}}" placeholder="Enter user name">
                                                    @error('name')
                                                           <span class="invalid-feedback" user="alert">
                                                               <strong>{{ $message }}</strong>
                                                           </span>
                                                       @enderror
												</div>
												<div class="form-group">
													<label for="exampleInputEmail1" class="form-label">Email address</label>
													<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="exampleInputEmail1" value="{{$user->email ?? old('email')}}" placeholder="Enter email">
                                                    @error('email')
                                                           <span class="invalid-feedback" user="alert">
                                                               <strong>{{ $message }}</strong>
                                                           </span>
                                                       @enderror
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1" class="form-label">Password</label>
													<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="exampleInputPassword1" placeholder="Password">
                                                    @error('password')
                                                           <span class="invalid-feedback" user="alert">
                                                               <strong>{{ $message }}</strong>
                                                           </span>
                                                       @enderror
												</div>
                                                <div class="form-group">
													<label for="exampleInputPassword1" class="form-label">Confirm Password</label>
													<input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="exampleInputPassword1" placeholder="retype-Password">
                                                    @error('password')
                                                           <span class="invalid-feedback" user="alert">
                                                               <strong>{{ $message }}</strong>
                                                           </span>
                                                       @enderror
												</div>

											</div>

										<!-- </form> -->
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Horizontal Form</h4>
									</div>
									<div class="card-body">
										<!-- <form class="form-horizontal"> -->
                                        <label for="role">Select Role</label>
                                            <select id="role"  class="js-example-basic-single form-control @error('role') is-invalid @enderror" name="role_id">
                                                @foreach ($roles as $role )
                                                    <option value="{{ $role->id }}" @isset($user) {{$user->role->id == $role->id ? 'selected' : ''}} @endisset>{{$role->name}}</option>
                                                @endforeach
                                            </select>

                                                       @error('role')
                                                           <span class="invalid-feedback" user="alert">
                                                               <strong>{{ $message }}</strong>
                                                           </span>
                                                       @enderror

                                            <button type="submit" class="btn btn-primary mt-4 mb-0">
                                            @isset($user)
                                            <i class="fas fa-arrow-circle-up"></i>
                                            Update
                                            @else
                                            <i class="fe fe-plus"></i>
                                            Create
                                            @endisset
                                            </button>

									</div>
								</div>
							</div>
						</div>
                        </form>
                        </div>
</div>
@endsection('content')

@section('scripts')

        <!-- Select2 js-->
		<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

        <script>
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
         </script>

@endsection
