@extends('frontend.layouts.app', ['class' => 'login'])

@section('content')
<div class="preloader">
<div class="loaderWrapper">
   <div class="loader">
       <div class="bar"></div>
       <div class="bar"></div>
       <div class="bar"></div>
     </div>
</div>
</div>
<div class="mainBanner bannerheightadjust" style="background-image:url({{ asset('frontend/assets/images/bg.png') }}); background-size: cover; background-repeat: no-repeat;">
   <div class="container-fluid">
      <div class="row">
         <div class="mainbanneroverlay">
            <h2>MY COMPARISIONS</h2>
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

         <div class="col-9 profile-details" id="SaveComparetions" data-card="SaveComparetions" style="display: block;">
            <div class="row">
               <div class="relatedCar text-center new_sec_add">
                  <h3>{{$page_content->heading}}</h3>
                  <div class="inline-sec flex">
                  <p>{{$page_content->content}}</p>
               </div>
                  <div id="tab2" class="tab-content mb-3" style="display: block">
                     @if($garage->count() < 3)
                        <form action="#" method="post" class="row">
                           <div class="col-md-4">
                              <label>Year</label>
                              <select id="garage-year" name="year" class="search-field">
                                 <option value="">Select Year</option>
                                 @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label>Make</label>
                              <select name="make" class="search-field" id="search-make">
                                 <option value="0">Select Make</option>
                              </select>
                           </div>
                           <div  class="col-md-4">
                              <label>Model</label>
                              <select name="model" class="search-field" id="search-model">
                                 <option value="0">Select Model</option>
                              </select>
                           </div>
                        </form>
                     @else
                     <div class="limiterror"><div class="alert alert-danger alert-block">You can only add 3 vehicles in the garage.</div></div>
                     @endif
                     </div>
                     <!--<button class="btn btn-primary new_sec_check" onclick="showTab('tab2')">Update</button>-->
                     <div class="limiterror"></div>
                     <div id="live-vehicles"></div>

                     @if($garage->isNotEmpty())
                     <hr>

                     <div id="tab1" class="tab-content active">

                           @foreach ($garage as $vehicle)
                           <div class="row hello_check">
                              <h1 class="col-8">
                                <a href="{{route('frontend.vehicle', $vehicle->id)}}">
                                    {{$vehicle->name}}
                                </a>
                              </h1>

                              <div class="flex">
                                 <a href="{{route('frontend.compare', ['comparisions' => $vehicle->id])}}">
                                    <button type="submit" class="btn btn-primary check_four mr-2">Compare</button>
                                 </a>
                                 <a onclick="deleteGarage('{{ $vehicle->id }}', '{{route('frontend.account.garage.delete', $vehicle->id)}}')" data-link="{{route('frontend.account.garage.delete', $vehicle->id)}}" href="javascript:;">
                                    <button type="submit" class="btn btn-primary check_two mr-2">Delete</button>
                                 </a>
                              </div>
                           </div>
                           @endforeach

                     </div>
                     @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<div class="modal fade" style="margin-top:15%" id="delete-comparision-confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Remove Comparisions</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
           </div>
           <div class="modal-body">
           Are you sure to delete this vehicle from garage?
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
               <a id="confirmationlink" href="" class="btn btn-primary">Yes</a>
           </div>
       </div>
   </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/profile.css') }}" />
<style>
select
{
  -moz-appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background: transparent;
    background-image: url('{{asset('frontend/assets/images/arrowdn.png')}}');
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: 24px;
    background-size: inherit;
    cursor:pointer;
    width: 100%;
    height: 58px !important;
    border: 1px solid gray;
    border-radius: 5px;
    padding: 0 15px;
    font-size: 16px;
    color: #979797;
}
.preloader{
   display: none;
}

.loaderWrapper {
  position: fixed;
  top: 0;
  width: 100%;
  height: 100%;
  background: #ffffff80;
  z-index: 1000;
  pointer-events: none;
  display: flex;
  justify-content: center;
  align-items: center;
}

.loader {
  display: flex;
  flex-direction: row;
  align-items: center;
  z-index: 999;
}
.loader .bar {
  width: 10px;
  height: 5px;
  background: #49a94d;
  margin: 2px;
  animation: bar 1s infinite linear;
}
.loader .bar:nth-child(1) {
  animation-delay: 0s;
}
.loader .bar:nth-child(2) {
  animation-delay: 0.25s;
}
.loader .bar:nth-child(3) {
  animation-delay: 0.5s;
}

@keyframes bar {
  0% {
    transform: scaleY(1) scaleX(0.5);
  }
  50% {
    transform: scaleY(10) scaleX(1);
  }
  100% {
    transform: scaleY(1) scaleX(0.5);
  }
}

@keyframes fadeLoader {
  to {
    opacity: 0;
  }
}
</style>
@endpush

@push('script')
   <script>
      function deleteGarage(id, link){
         $('#confirmationlink').attr('href', link);
         $('#delete-comparision-confirmation').modal('toggle');
      }
   </script>
   <script>
      $(".search-field").change(function() {
         console.log($(this).attr('name'));
         $('.preloader').css('display', 'block');
         $.get("{{ url('ajax/query/chromedata') }}", {
            type : $(this).attr('name'),
            value : $(this).val(),
            year : $('#garage-year').val() ?? 0
         }, function(data) {
            $('.preloader').css('display', 'none');
            if(data.type == 'division'){
               $('#search-make').children().remove();
               $('#search-model').html('<option value="0">Select Model</option>');
               $('#search-make').append('<option value="0">Select Make</option>');
               data.data.forEach((make) => {
                  $('#search-make').append('<option value="'+make.id+'">'+make._+'</option>');
               });
            }

            if(data.type == 'model'){
               $('#search-model').children().remove();
               $('#search-model').append('<option  value="0">Select Model</option>');
               data.data.forEach((model) => {
                  $('#search-model').append('<option value="'+model.id+'">'+model._+'</option>');
               });
            }

            if(data.type == 'vehicle'){
               var vehicles = '<div class="row">';
               data.data.forEach((vehicle) => {
                  var vehicle_data = JSON.parse(vehicle.data);
                  vehicles += '<div class="col-md-4 mb-5">';
                     vehicles += '<div class="featureBox">';
                        vehicles += '<div class="imgBox">';
                           vehicles += '<img src="/' + vehicle.image + '" alt="">';
                           vehicles += '</div>';
                              vehicles += '<div style="height:90px;" class="boxInfo">';
                                 vehicles += '<h5>'+ priceWithCommas(vehicle.pricing) +'</h5>';
                                 vehicles += '<h6>' + vehicle.name + '</h6>';
                              vehicles += '</div>';
                              vehicles += '<div class="vehicleSpec">';
                                 vehicles += '<ul>';
                                    vehicles += '<li class="first"><img src="{{ asset("frontend/assets/images/engine.png") }}" alt=""> ' + (vehicle_data?.engine.length > 0 ? vehicle_data.engine[0]?.horsepower?.value : vehicle_data?.engine.horsepower?.value) + ' Horsepower</li>';
                                    vehicles += '<li><img src="{{ asset("frontend/assets/images/fuel-pump.png") }}" alt=""> '+vehicle.mpg_city+' MPG</li>';
                                    vehicles += '<li><img src="{{ asset("frontend/assets/images/all-wheel-drive.png") }}" alt="">'+vehicle_data.style?.drivetrain+'</li>';
                                    vehicles += '<li class="last"><img src="{{ asset("frontend/assets/images/seats.png") }}" alt="">'+vehicle.seating+' Passengers</li>';
                                 vehicles += '</ul>';
                              vehicles += '</div><div id="garage-'+vehicle.id+'"><button onclick="addToGarage('+vehicle.id+')" class="btn btn-primary text-center mt-4" style="margin: 0 auto;width: 100%;">Add</button></div>';
                        vehicles += '</div>';
                     vehicles += '</div>';
               });
               vehicles+= '</div>';
               $('#live-vehicles').html(vehicles);
            }
         })
      });

      function addToGarage(vehicle_id) {
         if (!vehicle_id) return false;

         $.ajaxSetup({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });

         $.post(favourite_url, { vehicle_id: vehicle_id, type: 'garage' }, function (result) {
            if (result.success && result.success == 'Vehicle added in the garage successfully.'){
                  location.reload();
            } else if(result.error){
                  $('.limiterror').html('<div class="alert alert-danger alert-block">'+result.error+'</div>');
            }
         });
      }
   </script>
@endpush
