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
         <div class="col-3">
            @include('frontend.auth.profile-sidebar')
            <div class="box">
                  <img src="{{ asset('frontend/assets/images/sidebarads336x280.png') }}">
               </div>
         </div>
         
         <div class="col-9">
            <div class="row">
               <div class="relatedCar text-center">
                  <h3>MY GARAGE</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore<br> magna aliqua enim ad minim veniam, quis nostrud</p>
               </div>
            </div>
            <div class="row">
               @if($vehicles->isNotEmpty())
                  @foreach ($vehicles as $vehicle)
                     @php($detail = json_decode($vehicle->data))
                     @include('frontend.vehicle', ['vehicle' => $vehicle, 'detail' => $detail, 'cols' => 'col-md-4'])
                  @endforeach
               @else
                  <h2 style="font-size: 30px;margin:0 auto">No vehicles saved.</h2>
               @endif
               <div class="img_box">
                  <img src="{{ asset('frontend/assets/images/Group 454.png') }}">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/profile.css') }}" />
@endpush