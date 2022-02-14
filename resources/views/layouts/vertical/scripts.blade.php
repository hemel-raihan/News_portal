
 {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script> --}}
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



@yield('scripts')
		<!-- CUSTOM JS-->
		<script src="{{ asset('assets/js/custom.js') }}"></script>

        @include('vendor.lara-izitoast.toast')







