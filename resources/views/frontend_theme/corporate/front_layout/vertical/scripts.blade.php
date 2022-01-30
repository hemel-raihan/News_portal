<!-- JavaScripts
	============================================= -->
	<script src="{{ asset('assets/frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('assets/frontend/js/plugins.min.js') }}"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{ asset('assets/frontend/js/functions.js') }}"></script>
    <script src="{{ asset('js/iziToast.js') }}"></script>
    @yield('scripts')
    @include('vendor.lara-izitoast.toast')
