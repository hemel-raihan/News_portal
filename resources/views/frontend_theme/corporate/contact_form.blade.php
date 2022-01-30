@extends('frontend_theme.corporate.front_layout.app')

@section('styles')

@endsection

@section('content')
<div class="center mb-5 dark">
    <h1 class="fw-bold display-4">Contact Us..</h1>
</div>
{{-- <div class="form-widget" data-loader="button" data-alert-type="inline"> --}}

    <form id="coming-soon-registration" class="mb-0" action="{{route('contact.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-process"></div>
        <div class="row form-section px-4 py-5 bg-white rounded shadow-lg">
            <div class="col-12 form-group">
                <label>Name:</label>
                <input type="text" name="name" id="landing-enquiry-name" class="form-control form-control-lg required" value="" placeholder="John Doe">
            </div>
            <div class="col-12 form-group">
                <label>Email:</label>
                <input type="email" name="email" id="landing-enquiry-email" class="form-control form-control-lg required" value="" placeholder="user@company.com">
            </div>
            <div class="col-12 form-group">
                <label>Phone:</label>
                <input type="tel" name="phone" id="landing-enquiry-phone" class="form-control form-control-lg required" value="" placeholder="123-45-678" maxlength="12">
            </div>
            <div class="col-12 form-group">
                <label>Message</label>
                <textarea name="msg" id="landing-enquiry-phone" class="form-control form-control-lg required" value="" placeholder="Write your message" ></textarea>
            </div>
            <div class="col-12 d-none">
                <input type="text" id="landing-enquiry-botcheck" name="landing-enquiry-botcheck" value="" />
            </div>
            <div class="col-12">
                <button type="submit" name="landing-enquiry-submit" class="btn w-100 text-white bg-color rounded-3 py-3 fw-semibold text-uppercase mt-2">Get Notified</button>
            </div>

            <input type="hidden" name="prefix" value="landing-enquiry-">
        </div>
    </br>
    </br>
        {{-- <div class="result-section center">
            <div class="form-result"></div>
            <a class="btn w-100 text-white btn-danger rounded-3 py-3 fw-semibold text-uppercase mt-3 button-back">Thank You.</a>
        </div> --}}
    </form>
{{-- </div> --}}
@endsection()

@section('scripts')

@endsection
