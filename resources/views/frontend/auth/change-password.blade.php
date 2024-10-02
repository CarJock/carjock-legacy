@extends('frontend.layouts.app', ['class' => 'login'])

@section('content')
<div class="mainBanner bannerheightadjust" style="background-image:url({{ asset('frontend/assets/images/bg.png') }}); background-size: cover; background-repeat: no-repeat;">
   <div class="container-fluid">
      <div class="row">
         <div class="mainbanneroverlay">
            <h2>MY PROFILE</h2>
            <div class="breadcrumb">
               <ul>
                  <li>Home</li>
                  <li>{{ $user->name }}</li>
               </ul>
            </div>
         </div>
         <!-- <img src="{{ asset('frontend/assets/images/banner/redchevcaomparebanner.jpg') }}" alt=""> -->
      </div>
   </div>
</div>

<section class="profile">
   <div class="container">
        <div class="row">
            @include('frontend.auth.sidebar') 
            <!--User-profile-->         
            <div class="col-9 profile-details" id="UserDetail" data-card="UserDetail">
                <div class="relatedCar text-center">
                    <h3>{{$page_content->heading}}</h3>
                    <p>{{$page_content->content}}</p>
                 </div>
                <div class="container mt-4">
                    @if ($message = Session::get('message'))
                        <div class="alert alert-success alert-block">
                            {{ $message }}
                        </div>
                    @endif

                    <form class="profile-edit-form" action="{{route('frontend.account.profile.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="registerUsername">Old Password*</label>
                                <input type="password" name="old_password" class="form-control" placeholder="" />
                                @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if ($error = Session::get('error'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $error }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label" for="registerUsername">New Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" />
                                @error('password')
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label" for="registerUsername">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="" />
                                @error('password_confirmation')
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 

            <!--User-profile-End-->
           
        </div>
   </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/profile.css') }}" />
<style>
label.form-label {
   margin-top: 25px;
}
</style>
@endpush