@extends('frontend.layouts.app', ['class' => 'login'])

@section('content')
<div class="mainBanner bannerheightadjust" style="background-image:url({{ asset('frontend/assets/images/bg.png') }}); background-size: cover; background-repeat: no-repeat;">
    <div class="container-fluid">
       <div class="row">
          <div class="mainbanneroverlay">
             <h2>Edit Profile</h2>
             <div class="breadcrumb">
                <ul>
                   <li>Home</li>
                   <li>Edit Profile</li>
                </ul>
             </div>
          </div>
          <!-- <img src="assets/images/banner/redchevcaomparebanner.jpg" alt=""> -->
       </div>
    </div>
</div>
<section class="profile">
    <div class="container">
       <div class="row">
          <div class="col-3">
             <div class="profile-img-box">
                <div class="top-sec">
                   <div class="profile-image">
                     @if($user->image)
                     <img src="{{ substr($user->image, 0, 4) == "http" ? $user->image : asset('storage/'.$user->image) }}"  style="border: 2px solid #86c440;border-radius: 50%;padding: 3px;width:150px;height:150px">
                     @else
                     <img src="{{ asset('frontend/assets/images/placeholder-user.jpg') }}">
                     @endif
                   </div>
                   <div class="user-email">
                      <h4>{{ $user->name }}</h4>
                      <p>{{ $user->email }}</p>
                   </div>
                </div>
                <hr>
                <div class="bottom-sec">
                  <a href="{{route('frontend.account.comparisions')}}">My Comparisions</a>
                  
                   <a class="signout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}">
                        Sign Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                  </form>
                </div>
             </div>
             <div class="box">
                <img src="{{ asset('frontend/assets/images/sidebarads336x280.png') }}">
             </div>
          </div>
          <div class="col-9">
             <div class="hendsec">
                <h2>Edit Profile</h2>
                <p>lorem dolor sit amet dolor ispum Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam sit rerum hic aliquid, architect</p>
             </div>
            @if ($message = Session::get('message'))
                <div class="alert alert-success alert-block">
                    {{ $message }}
                </div>
            @endif
            <form class="profile-edit-form" action="{{route('frontend.account.profile.update')}}" method="POST" enctype="multipart/form-data">
               @csrf 
               <div class="row">
                     <div class="col-md-12">
                     <label class="form-label" for="registerUsername">Profile Picture*</label>
                     <input type="file" name="image" class="form-control" />
                     @error('image')
                       <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                       </span>
                    @enderror
                    </div>
                   <div class="col-md-6">
                      <label class="form-label" for="registerUsername">First Name*</label>
                      <input type="text" name="firstname" class="form-control" placeholder="Firstname" value="{{ old('firstname') ?? ($user->firstname ?? $user->name) }}"/>
                      @error('firstname')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                     </div>
                   <div class="col-md-6">
                      <label class="form-label" for="registerUsername">Old Password*</label>
                      <input type="password" name="old_password" class="form-control" placeholder="" />
                      @error('old_password')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                     @if ($error = Session::get('error'))
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $error }}</strong>
                           </span>
                     @endif
                     </div>
                   <div class="col-md-6">
                      <label class="form-label" for="registerUsername">Last Name*</label>
                      <input type="text" name="lastname" class="form-control" placeholder="Lastname" value="{{ old('lastname') ?? $user->lastname }}"/>
                      @error('lastname')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                     </div>
                   <div class="col-md-6">
                      <label class="form-label" for="registerUsername">New Password</label>
                      <input type="password" name="password" class="form-control" placeholder="" />
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                     </div>
                   <div class="col-md-6">
                      <label class="form-label" for="registerEmail">Email Address*</label>
                      <input type="email" disabled name="email" id="registerEmail" class="form-control" value="{{ old('email') ?? $user->email }}" placeholder="Your Email" />
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                     </div>
                   <div class="col-md-6">
                      <label class="form-label" for="registerUsername">Confirm Password</label>
                      <input type="password" name="password_confirmation" class="form-control" placeholder="" />
                      @error('password_confirmation')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                     </div>
                </div>
                <div class="row">
                   <div class="col-md-12">
                      <button type="submit" class="save-btn">Save <img src="{{ asset('frontend/assets/images/right-arrow.png') }}" alt=""></button>
                      {{-- <button type="button" class="cancel-btn">Cancel <img src="{{ asset('frontend/assets/images/right-arrow.png') }}" alt=""></button> --}}
                   </div>
                </div>
             </form>
          </div>
       </div>
    </div>
</div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/edit-profile.css') }}" />
<style>
   .invalid-feedback{display:block}
</style>
@endpush