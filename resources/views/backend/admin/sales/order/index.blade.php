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
								<h1 class="page-title">Order Management</h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>


						</div>
						<!-- PAGE-HEADER END -->

						<!-- Row -->
		<div class="row row-sm">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Order List</h3>
					</div>
                    <form class="" action="" id="" method="GET">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="delivery_status" class="form-control form-select select2" data-bs-placeholder="Select Sidebar">
                                    <option value="">Filter by Delivery Status</option>
                                    <option value="pending" @if ($delivery_status == 'pending') selected @endif>Pending</option>
                                    <option value="confirmed" @if ($delivery_status == 'confirmed') selected @endif>Confirmed</option>
                                    <option value="picked_up" @if ($delivery_status == 'picked_up') selected @endif>Picked Up</option>
                                    <option value="on_the_way" @if ($delivery_status == 'on_the_way') selected @endif>On The Way</option>
                                    <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>Delivered</option>
                                    <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>Cancel</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control" value="{{ $start_date }}" name="start_date">
                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control" value="{{ $end_date }}" name="end_date">
                            </div>
                        </div>

								<button type="submit" style="margin-left: 30px;" class="btn btn-primary btn-icon text-white ">
									 Filter
                                </button>

                    </div>

					<div class="card-body">
						<div class="table-responsive export-table">
							<table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
								<thead>
									<tr>
										<th class="border-bottom-0">Order Code</th>
										<th class="border-bottom-0">No. Of Products</th>
                                        <th class="border-bottom-0">Customer</th>
										<th class="border-bottom-0">Amount</th>
                                        <th class="border-bottom-0">Delivery Status</th>
                                        <th class="border-bottom-0" >Payment Status</th>
										<th class="border-bottom-0">Action</th>
									</tr>
								</thead>
								<tbody>
                                @foreach($orders as $order)
									<tr>
										<td>{{$order->code}}</td>
                                        <td>{{$order->orderDetails->count()}}</td>
                                        <td>{{$order->user->name}}</td>
										<td>{{$order->grand_total}}</td>
                                        <td>{{$order->delivery_status}}</td>
                                        <td>
                                            @if ($order->payment_status == 'paid')
                                                <span class="btn btn-green">Paid</span>
                                            @else
                                                <span class="btn btn-red">Unpaid</span>
                                            @endif
                                        </td>

										<td>


                                            <a href="{{route('admin.all_orders.show',$order->id)}}" class="btn btn-success">
                                            <i class="fa fa-eye"></i>
                                            </a>





                                        <button class="btn btn-danger waves effect" type="button"
                                            onclick="deletepost$order({{ $order->id}})" >
                                            <i class="fa fa-trash"></i>
                                            </button>
                                            <form id="deleteform-{{$order->id}}" action="{{route('admin.orders.destroy',$order->id)}}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                            </form>

                                            </td>

									</tr>
                                @endforeach

								</tbody>
							</table>
                            {{ $orders->links('vendor.pagination.custom') }}
						</div>
					</div>
                </form>
				</div>
			</div>
		</div>
		<!-- End Row -->

@endsection('content')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function deletepost$order(id)

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
