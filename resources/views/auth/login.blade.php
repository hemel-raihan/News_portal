{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


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
                        <h2 class="title">{{ __('Login') }}</h2>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <label for="email">{{ __('E-Mail Address') }}<span class="required">*</span></label>
                        <input id="email" type="email" class="form-input form-wide @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="password">{{ __('Password') }}<span class="required">*</span></label>
                        <input id="password" type="password" class="form-input form-wide @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="form-footer">
                            <div class="custom-control custom-checkbox mb-0">
                                <input type="checkbox" class="custom-control-input"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                <label class="custom-control-label mb-0" for="remember">{{ __('Remember Me') }}</label>
                            </div>

                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forget-password text-dark form-footer-right">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-dark btn-md w-100">
                            {{ __('Login') }}
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</main>
@endsection
