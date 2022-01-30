@extends('layouts.app')

@section('styles')

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">{{ isset($role) ? 'Edit ' : 'Create '}}Roles</h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>
							<div class="ms-auto pageheader-btn">
								<a href="{{route('admin.roles.index')}}" class="btn btn-primary btn-icon text-white me-2">
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


                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                <form method="POST" action="{{isset($role) ? route('admin.roles.update',$role->id) : route('admin.roles.store')}}">
                                 @csrf
                                 @isset($role)
                                 @method('PUT')
                                 @endisset
                                 <div class="card-body">
                                 <h5 class="card-title">Manage Roles</h5>
                                 <div class="form-group">
                                 <label for="name">Role Name</label>
                                 <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name ?? old('name') }}"  autofocus>
    
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
    
                                   </div>
    
                                   <div class="text-center"><strong>Manage Permission For Role</strong>
                                            @error('permissions')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
    
                                   <div class="form-group">
                                   <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input"
                                    id="select-all">
                                    <label for="select-all" class="custom-control-label">Select All</label>
                                   </div>
                                   </div>
    
                                @forelse($modules->chunk(2) as $key=>$chunks)
                                  <div class="form-row">
                                  @foreach($chunks as $key=>$module)
                                  <div class="col">
                                  <h5>Module : {{ $module->name}}</h5>
                                  @foreach($module->permissions as $key=> $permission)
                                  <div class="mb-3 ml-4">
                                  <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input"
                                    id="permission-{{$permission->id}}"
                                    name="permissions[]" value="{{$permission->id}}"
                                    @isset($role)
                                    @foreach($role->permissions as $rpermission)
                                    {{$permission->id == $rpermission->id ? 'checked' : ''}}
                                    @endforeach
                                    @endisset
                                    >
                                    <label for="permission-{{$permission->id}}" class="custom-control-label">{{$permission->name}}</label>
                                  </div>
                                  </div>
                                  @endforeach
                                  </div>
                                  @endforeach
                                  </div>
                                @empty
                                <div class="row">
                                <div class="col text-center">
                                <strong>No Module Found.</strong>
                                </div>
                                </div>
                                @endforelse
                        <button type="submit" class="btn btn-primary">
                        @isset($role)
                        <i class="fas fa-arrow-circle-up"></i>
                        Update
                        @else
                        <i class="fe fe-plus"></i>
                        Create
                        @endisset
                        </button>
    
                            </div>
    
                                </form>
                                </div>
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
