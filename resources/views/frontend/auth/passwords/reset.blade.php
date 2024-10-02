@extends('frontend.layouts.app')

@section('content')

<section class="thankyou">


    <div class="forgot">
       <!--<div class="addbanner text-center">-->
       <!--   <img src="assets/images/adbanner920x90.svg" alt="">-->
       <!--</div>-->
    </div>
    <section class="second pb-4">
       <div class="container">
          <div class="row">
             <!--<div class="col-4">-->
             <!--   <img src="assets/images/Group 504.png" alt="">-->
             <!--</div>-->
             <div class="col-12">
                <h1>Create New Password</h1>
                <p>Please enter your new password</p>
                @if ($message = Session::get('message'))
                    <div class="alert alert-success alert-block">
                        {{ $message }}
                    </div>
                @endif
                <form method="POST" action="{{ route('frontend.password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input id="email" readonly hidden type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- parent --}}
                    <div class="form-group position-relative has-icon-right password-input-parent">
                        {{-- label --}}
                        {{-- <label for="password" class="input-label text-md-end">{{ __('New Password') }}</label> --}}
                        {{-- input --}}
                        <input id="password" type="password"
                            class="form-control form-control-lg sign-inputs reset-input "
                            name="password" required autocomplete="new-password" placeholder="New Passowrd">
                        @error('password')
                            <span class="invalid-feedback" style="font-size:15px;display:block" role="alert">
                                  <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                        <div class="form-control-icon form-control-icon-custom ">
                            <i class="bi bi-eye-slash" style="color: #017E41;" class="lock-icon" id="togglePassword"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-right mb-5">
                        {{-- <label for="password-confirm" class="input-label text-md-end">{{ __('Confirm Password') }}</label> --}}
            
            
                        <input id="password-confirm" type="password"
                            class="form-control form-control-lg sign-inputs reset-input "
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirm Password">
                        <div
                            class="form-control-icon mb-5 form-control-icon-custom @error('password-error') is-invalid-icon @enderror">
                            <i class="bi bi-eye-slash" style="color: #017E41;" class="lock-icon" id="confirmPass"></i>
                        </div>
            
                    </div>

                    <button type="submit" class="btn">
                        {{ __('Reset Password') }}
                    </button>
                </form>
             </div>
          </div>
       </div>
    </section>
 </section>
@endsection

@push('styles')
    <style>
        .thank{
    padding-top: 7%;
   
}
.thankyou .second img{
	padding-top: 10%;
}
/*.thankyou .second .col-7 {*/
/*    font-size: 35px;*/
/*    font-weight: 700;*/
/*    padding: 3% 66px 0px;*/
/*    text-align: center;*/
/*}*/

    .thankyou .second .col-12 {
    font-size: 35px;
    font-weight: 700;
    padding: 0% 66px 14%;
    text-align: center;
    margin-bottom: 60px;
}

   
	
    .thankyou .second .col-12 {
    font-size: 35px;
    font-weight: 700;
    padding: 3% 66px 0px;
    text-align: center;
    margin-bottom: 110px;
}

   
	
.thankyou .second h1 {
   border-bottom: 1px solid rgb(211, 205, 205);
   width: 95%;
    padding: 25px 0;
}
.thankyou .second p{
	padding-top: 20px;
} 
.thankyou .second .btn{
	background: #86c440;
	background: linear-gradient(-93deg,
			#86c440 0.00%,
			#239b62 100.00%);
	color: white;
	margin-top: 30px;
	text-align: center;
	display: flex;
	justify-content: center;
	align-items: center;
	padding: 10px;
	    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
    margin-top: 30px;
}
.thankyou .second .btn img{
	height: 30px;
	padding: 8px;
}
.forgot .second .btn{
	background: #86c440;
	background: linear-gradient(-93deg,
			#86c440 0.00%,
			#239b62 100.00%);
	color: white;
	margin-top: 10px;
	text-align: center;
	display: flex;
	justify-content: center;
	align-items: center;
	padding: 10px;
}
.forgot .second .btn img{
	height: 30px;
	padding: 8px;
}
.forgot{
    padding-top: 10%;
    display: block;
    margin: auto;
    width: 50%;
}
.forgot .second img{
	padding-top: 10%;
}
.form-control, input#exampleInputEmail1 {
	border: 1px solid rgb(211, 205, 205) !important;
	padding: 25px  !important;
    width: 100%;
	border-radius: 7px !important;
	margin-top: 10px;
}
.login .selectedcarsfeature_dis img{
	width: 50%;
	padding-top: 5%;
}
.login .log_new h1{
	font-size: 22px;
	border-bottom: 1px solid rgb(211, 205, 205);
   width: 90%;
    padding: 25px 0;
}
.log_new{

}
.log_new .btn{
	margin-top:20px;
	width: 60%;
	padding: 10px;
	background: transparent;
	border: 1px solid blue;
	color: blue;
}
.form-control, input#exampleInputEmail1 {
    width:50%;
    margin-left: 270px;
}
    </style>
@endpush
