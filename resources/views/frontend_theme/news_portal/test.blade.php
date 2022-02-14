<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/logo.png') }}" />

    <!-- BOOTSTRAP CSS -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- STYLE CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/dark-style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />



    <!-- SIDE-MENU CSS -->
    <link href="{{ asset('assets/css/sidemenu.css') }}" rel="stylesheet" id="sidemenu-theme">

    <!-- P-scroll bar css-->
    <link href="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('assets/plugins/icons/icons.css') }}" rel="stylesheet"/>

    <!-- SIDEBAR CSS -->
    <link href="{{ asset('assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet"/>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">


    @yield('styles')

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/colors/color1.css') }}"/>
    <title>Document</title>
</head>
<body>
    <form method="POST" id="fileUploadForm" action="{{ route('admin.programs.store')}}" enctype="multipart/form-data">
        @csrf

    <div class="form-group video">
        <label class="form-label">Video</label>
        <input type="file" data-height="100"  class="dropify form-control"  name="video">
    </div>

    <div class="form-group">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
        </div>
    </div>

    <div class="card-footer text-end">
        <button type="submit" class="btn btn-success mt-1">
            <i class="fe fe-plus"></i>
            Create
        </button>
    </div>
    </form>




        <!-- BACK-TO-TOP -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

		<!-- JQUERY JS -->
		<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

		<!-- BOOTSTRAP JS -->
		<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!-- INPUT MASK JS-->
		<script src="{{ asset('assets/plugins/input-mask/jquery.mask.min.js') }}"></script>

        <!-- SIDE-MENU JS -->
		<script src="{{ asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>

		<!-- SIDEBAR JS -->
		<script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>

		<!-- Perfect SCROLLBAR JS-->
		<script src="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
		<script src="{{ asset('assets/plugins/p-scroll/pscroll.js') }}"></script>
		<script src="{{ asset('assets/plugins/p-scroll/pscroll-1.js') }}"></script>



        <script src="{{ asset('js/iziToast.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
        @yield('scripts')


		<!-- CUSTOM JS-->
		<script src="{{ asset('assets/js/custom.js') }}"></script>

        @include('vendor.lara-izitoast.toast')

<script>
    $(function () {
        $(document).ready(function () {

            $('#fileUploadForm').ajaxForm({
                beforeSend: function () {
                    var percentage = '0';
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    var percentage = percentComplete;

                    $('.progress .progress-bar').css("width", percentage+'%', function() {
                      return $(this).attr("aria-valuenow", percentage) + "%";
                    })
                },
                complete: function (xhr) {
                    console.log('File has uploaded');
                }
            });
        });
    });
</script>

<!-- CUSTOM JS-->
<script src="{{ asset('assets/js/custom.js') }}"></script>

@include('vendor.lara-izitoast.toast')
</body>
</html>
