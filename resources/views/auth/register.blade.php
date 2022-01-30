@extends('frontend_theme.single_vendor.front_layout.app')
@section('main-content')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="demo4.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="category.html">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            My Account
                        </li>
                    </ol>
                </div>
            </nav>

            <h1>My Account</h1>
        </div>
    </div>

    <div class="container login-container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row">

                    <div class="col-md-6 offset-md-3 mt-5">
                        <div class="heading mb-1">
                            <h2 class="title">{{ __('Register') }}</h2>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <label for="name">Name
                                <span class="required">*</span>
                            </label>
                            <input id="name" type="text" class="form-input form-wide @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus  />

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <label for="email">
                                Email address
                                <span class="required">*</span>
                            </label>
                            <input id="email" type="email" class="form-input form-wide @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" />

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <label for="password">
                               Password
                                <span class="required">*</span>
                            </label>
                            <input id="password" type="password" class="form-input form-wide @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <label for="password-confirm">
                              Confirm-Password
                                <span class="required">*</span>
                            </label>
                            <input id="password-confirm" type="password" class="form-input form-wide" name="password_confirmation" required autocomplete="new-password"/>

                            <div class="form-footer mb-2">
                                <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
