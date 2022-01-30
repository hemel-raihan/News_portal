<div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
    <h2 class="text-uppercase">
        @if (Auth::check())
            {{ Auth::user()->name }}
        @endif
    </h2>
    <ul class="nav nav-tabs list flex-column mb-0" role="tablist">
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" data-href="#"  onclick="customer_dashboard()" >Dashboard</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" data-href="#"  onclick="customer_orders()" >Orders</a>
            {{-- <a class="nav-link" href="{{ route('customer.orders') }}" >Orders</a> --}}
        </li>

        <li class="nav-item">
            {{-- <a class="nav-link" href="{{ route('download.index') }}">Downloads</a> --}}
            <a class="nav-link" href="javascript:void(0)" data-href="#"  onclick="customer_downloads()" >Downloads</a>

        </li>

        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" data-href="#"  onclick="customer_address()">Addresses</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" data-href="#" onclick="customer_account_details()">Account
                details</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" data-href="#" onclick="customer_wishlist()">Wishlist</a>
        </li>
       
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
        </li>
    </ul>
</div>