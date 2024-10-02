@extends('admin.layouts.app')

@section('login')
<main class="authentication-content">
    <div class="container-fluid">
        <div class="authentication-card">
            <div class="card shadow rounded-0 overflow-hidden">
                <div class="row g-0">
                    <div class="col-lg-6 ">
                        <img src="{{ asset('admin/assets/images/login-bg.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6">
                        <div class="card-body px-4 pt-4">
                        @if ($message = Session::get('message'))
                            <div class="alert alert-danger alert-block">
                                {{ $message }}
                            </div>
                        @endif
                            <h5 class="card-title">{{ __('Login') }}</h5>
                            <p class="card-text mb-5">Login your account to access portal</p>
                            <form class="form-body" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="login-separater text-center mb-4"> <span>SIGN IN WITH EMAIL</span>
                                    <hr>
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Email Address</label>
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i
                                                    class="bi bi-envelope-fill"></i></div>
                                            <input type="email"
                                                class="form-control radius-30 ps-5 @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                                placeholder="Email Address">
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i
                                                    class="bi bi-lock-fill"></i></div>
                                            <input type="password"
                                                class="form-control radius-30 ps-5 @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password"
                                                placeholder="Enter Password">
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="flexSwitchCheckChecked">{{ __('Remember Me') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end"> <a
                                            href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit"
                                                class="btn btn-primary radius-30">{{ __('Login') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection