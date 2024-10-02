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
                <div class="row">
                    @if($vehicles->isNotEmpty())
                    @php($count = 1)
                        @foreach ($vehicles as $vehicle)
                            @php($detail = json_decode($vehicle->data))
                            @include('frontend.vehicle', ['vehicle' => $vehicle, 'detail' => $detail, 'cols' => 'col-md-4'])
                        @endforeach
                    @else
                    <h2 class="text-center" style="font-size: 30px;margin:0 auto;padding-left:70px">No vehicles found.</h2>
                    @endif
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