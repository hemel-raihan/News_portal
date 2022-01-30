@extends('frontend_theme.single_vendor.front_layout.app')
@section('single_styles')
<!-- Main CSS File -->
<link rel="stylesheet" href="{{ asset('single_vendor/assets/css/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('single_vendor/assets/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">

<link rel="stylesheet" href="{{ asset('single_vendor/assets/css/sismoo-core.css') }}">



<style>
    .card-body{
        min-height: auto !important;
    }
    .sismoo-table {
        opacity: 1;
        height: 0;
    }
    .wishlist-table-container .btn {
        font-size: 10px;
        padding: 0 19px !important;
    }
</style>
@endsection
@section('main-content')

<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">

            <h1>Customer Account</h1>
        </div>
    </div>

    <div class="container account-container custom-account-container">
        <div class="row">
            @include('frontend_theme.single_vendor.front_layout.user_sidenav')

            @yield('panel_content')
            <!-- End .tab-content -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->
</main>

<div class="mb-4"></div><!-- margin -->
</main>
@endsection

@section('modal')
<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div id="order-details-modal-body">

            </div>
        </div>
    </div>
</div>
@endsection

