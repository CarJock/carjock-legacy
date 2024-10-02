@extends('admin.layouts.app')

@section('login')


<!--start content-->
<main class="authentication-content">
    <div class="container-fluid">
        <div class="authentication-card">
        <div class="card shadow rounded-0 overflow-hidden">
            <div class="row g-0">
            <div class="col-lg-6 d-flex align-items-center border-end">
                <img src="{{ asset('admin/assets/images/login-bg.png') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card-body p-4 p-sm-5">
                <h5 class="card-title">Forgot Password?</h5>
                <p class="card-text mb-5">Don't worry; it happens to the best of us. If you've forgotten your password, we're here to help you get back on track.</p>
                <p>Please enter your registered email address below, and we'll send you instructions on how to reset your password. Once you receive the email, follow the steps to create a new password and regain access to your account.</p>
                <p>Remember to check your spam folder if you don't receive the email within a few minutes. </p>
                <p>Thank you for choosing CarJock. We're here to make your experience as smooth as possible.</p>
                <form class="form-body" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="inputEmailid" class="form-label">Email id</label>
                            <input type="email" class="form-control form-control-lg radius-30 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12">
                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-lg btn-primary radius-30">Send</button>
                                        <a href="{{route('login')}}" class="btn btn-lg btn-light radius-30">Back to Login</a>
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
        
       <!--end page main-->
@endsection
