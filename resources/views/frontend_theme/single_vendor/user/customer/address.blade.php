<div >
    <h3 class="account-sub-title d-none d-md-block mb-1"><i
            class="sicon-location-pin align-middle mr-3"></i>Addresses</h3>
    <div class="addresses-content">
        <p class="mb-4">
            The following addresses will be used on the checkout page by
            default.
        </p>
    </div>
</div>



<div >
    <div class="address account-content mt-0 pt-2">
        <h4 class="title">Billing address</h4>

        <form class="mb-2" action="{{ route('customer.profile.address') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Address <span class="required">*</span></label>
                <input type="text" name="address" class="form-control" required />
            </div>

            <div class="select-custom">
                <label>Country<span class="required">*</span></label>
                <select name="country_id" class="form-control">
                    <option value="" selected="selected">Select Country</option>
                    @foreach (\App\Models\Address\Country::where('status',1)->get() as $country) 
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="select-custom">
                <label>State<span class="required">*</span></label>
                <select name="state_id" class="form-control">
                    <option value="" selected="selected">Select State</option>
                    @foreach (\App\Models\Address\State::where('country_id',18)->get() as $state) 
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="select-custom">
                <label>City<span class="required">*</span></label>
                <select name="city_id" class="form-control">
                    <option value="" selected="selected">Select City</option>
                    @foreach (\App\Models\Address\City::where('state_id',348)->get() as $city) 
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Postal Code<span class="required">*</span></label>
                <input type="text" name="postal_code" class="form-control" required />
            </div>

            <div class="form-group">
                <label>Phone<span class="required">*</span></label>
                <input type="text" name="phone" class="form-control" required />
            </div>

            <div class="form-footer mb-0">
                <div class="form-footer-right">
                    <button type="submit" class="btn btn-dark py-4">
                        Save Address
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>