<div>
    <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
            class="icon-user-2 align-middle mr-3 pr-1"></i>Account Details</h3>
    <div class="account-content">
        
        <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="change-password">
                <div class="form-group">
                    <label for="name">Full Name<span class="required">*</span></label>
                    <input type="text" class="form-control" placeholder="Full Name"
                        id="name" name="name" value="{{ Auth::user()->name }}" required />
                </div>
                
                <div class="form-group mb-2">
                    <label for="phone">Phone<span class="required">*</span></label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        placeholder="Phone" required />
                </div>
                {{-- <div class="form-group mb-2">
                    <label for="acc-text">Photo<span class="required">*</span></label>
                    <input type="text" class="form-control" id="photo" name="photo"
                        placeholder="Photo" required />
                </div> --}}

                <button type="submit" class="btn btn-dark mr-0">
                    Save changes
                </button>
            </div>
           
        </form>

        <form method="POST" action="{{ route('change.password') }}">
            @csrf 
            <div class="change-password">
                <h3 class="text-uppercase mb-2">Password Change</h3>

                <div class="form-group">
                    <label for="password">Current Password (leave blank to leave unchanged)</label>
                    <input id="password" type="password" class="form-control"  name="current_password" autocomplete="current-password"/>
                </div>

                <div class="form-group">
                    <label for="password">New Password (leave blank to leave unchanged)</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" autocomplete="current-password" />
                </div>

                <div class="form-group">
                    <label for="password">Confirm New Password</label>
                    <input type="password" class="form-control" id="new_confirm_password" name="new_confirm_password" autocomplete="current-password"/>
                </div>
            </div>

            <div class="form-footer mt-3 mb-0">
                <button type="submit" class="btn btn-dark mr-0">
                    Save changes
                </button>
            </div>
        </form>
    </div>
</div>