@extends('frontend_theme.single_vendor.front_layout.user_panel')
@section('panel_content')
<div class="col-lg-9 order-lg-last order-1 tab-content">

    <div class=" " id="customer-dashboard">

    </div>

</div>
@endsection



@section('single_scripts')
    <script>
       
        $(document).ready(function(){
           
            $.post('{{ route('customer.dashboard-home') }}', {_token:'{{ csrf_token() }}'}, function(data){
                console.log('dashboard');
                $('#customer-dashboard').html(data);
            });

        });
   
    </script>
@endsection


{{-- @section('modal')
<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div id="order-details-modal-body">

            </div>
        </div>
    </div>
</div>
@endsection --}}