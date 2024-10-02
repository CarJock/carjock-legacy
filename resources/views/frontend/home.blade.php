@extends('frontend.layouts.app')

@section('content')
<div class="mainBanner home" style="background-image: url({{ url('storage/banners/'.$banner->image) }});">
   <div class="container-fluid">
      <div class="row">
         <!-- <img src="{{ asset('frontend/assets/images/banner/mainbanner.png') }}" alt=""> -->
         <div class="mainbanneroverlay">
            <!--<span>FIND Your New Vehicle With</span>-->
            <h1>{{$banner->heading}}</h1>
            <div class="breadcrumb">
               <p>{{$banner->content}}</p>
            </div>
         </div>
      </div>
   </div>
</div>

@include('frontend.filter')


<!--<section class="filterMain">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <ul class="mainTabs">
               <li data-targetit="box-customSearch" class="current"><a href="javascript:;">Custom Search</a></li>
               <li data-targetit="box-vehicleMake"><a href="javascript:;">Vehicle Make</a></li>
            </ul>
            <div class="tabBoxMain">
               <div class="box-customSearch showfirst">
                  <div class="">
                     <form action="{{route('frontend.search')}}" method="get" class="row">
                        <div class="col-md-3">
                           <label>Year</label>
                           <select name="year" class="search-field">
                              <option value="">Select Year</option>
                              @foreach($years as $year)
                              <option value="{{$year}}">{{$year}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-3">
                           <label>Make</label>
                           <select name="make" class="search-field" id="search-make">
                              <option value="">Select Make</option>
                              {{-- @foreach ($makes as $make)
                              <option value="{{ $make->name }}">{{ $make->name }}</option>
                              @endforeach --}}
                           </select>
                        </div>
                        <div class="col-md-3">
                           <label>Model</label>
                           <select name="model" class="search-field" id="search-model">
                             <option value="">Select Model</option>
                             {{-- @foreach ($models as $model)
                             <option value="{{ $model->name }}">{{ $model->name }}</option>
                             @endforeach --}}
                          </select>
                        </div>
                        <div class="col-md-3">
                           <button type="submit">
                              <i class="far fa-search"></i> Find Listing
                           </button>
                           <div class="dropdown">
                              <p onclick="myFunction()" class="dropbtn"><img src="{{ asset('frontend/assets/images/noun-filter-5440366.png') }}" alt=""> Advanced Filter</p>
                           </div>
                        </div>

                        <div class="dorpdown-style">
                           <div id="myDropdown" class="advance-filter-con">
                           <div class="row">
                              {{-- <form action="{{route('frontend.search')}}" method="get" class="row"> --}}
                                 <div class="col-md-3">
                                    <select name="fuel_type" id="">
                                      <option value="">Select Fuel Type</option>
                                      @foreach ($fuels as $fuel)
                                      <option value="{{ $fuel->name }}">{{ $fuel->name }}</option>
                                      @endforeach
                                   </select>
                                 </div>
                                 <div class="col-md-3">
                                    <select name="engine_type" id="">
                                      <option value="">Select Cylinder</option>
                                      @foreach ($engines as $engine)
                                      <option value="{{ $engine->name }}">{{ $engine->name }}</option>
                                      @endforeach
                                   </select>
                                 </div>
                                 <div class="col-md-3">
                                    <select name="fuel_economy" id="">
                                      <option value="">Select Fuel Economy</option>
                                      @foreach ($economy as $eco)
                                      @php($high_low = json_decode($eco->economy))
                                          @if(isset($high_low->city->low) && isset($high_low->city->high))
                                             <option value="">{{ 'High : ' . $high_low->city->high . ' - Low : ' . $high_low->city->low. ' ' . $high_low->unit }}</option>
                                          @endif
                                      @endforeach
                                   </select>
                                 </div>
                                 <div class="col-md-3">
                                    <select name="fuel_capacity" id="">
                                      <option value="">Select Fuel Capacity</option>
                                      @foreach ($capacity as $cap)
                                      @php($high_low = json_decode($cap->capacity))
                                          @if(isset($high_low->high) && isset($high_low->low))
                                             <option value="">{{ 'High : ' . $high_low->high . ' - Low : ' . $high_low->low . ' ' . $high_low->unit }}</option>
                                          @endif
                                      @endforeach
                                   </select>
                                 </div>
                                 <div class="row feature-sec mt-3 mx-2" style=" width: 100%;">
                                    <div class="col-md-12 mb-2" style="align-items: center;display: flex;">
                                       <h3>Filter By Features</h3>
                                    </div>
                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Automatic Parking">
                                             <span class="checkmark"></span>
                                             <span class="text">Automatic Parking</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Smart Device Integration">
                                             <span class="checkmark"></span>
                                             <span class="text">Smart Device Integration</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Passenger Capacity">
                                             <span class="checkmark"></span>
                                             <span class="text">Passenger Capacity</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Length, Overall">
                                             <span class="checkmark"></span>
                                             <span class="text">Length, Overall</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Width, Max w/o mirrors">
                                             <span class="checkmark"></span>
                                             <span class="text">Width, Max w/o mirrors</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Heigh, Overall">
                                             <span class="checkmark"></span>
                                             <span class="text">Heigh, Overall</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Sun/Moonroof">
                                             <span class="checkmark"></span>
                                             <span class="text">Sun/Moonroof</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="drivetrain">
                                             <span class="checkmark"></span>
                                             <span class="text">Drivetrain</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="cylinders">
                                             <span class="checkmark"></span>
                                             <span class="text">Engine Type</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="displacement">
                                             <span class="checkmark"></span>
                                             <span class="text">Displacement</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="horsepower">
                                             <span class="checkmark"></span>
                                             <span class="text">SAE Net Horsepower @ RPM</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="netTorque">
                                             <span class="checkmark"></span>
                                             <span class="text">SAE Net Torque @ RPM</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Estimated Battery Range">
                                             <span class="checkmark"></span>
                                             <span class="text">Estimated Battery Range</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="drivetrain">
                                             <span class="checkmark"></span>
                                             <span class="text">All Wheel Drive</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Plug-In Electric/Gas">
                                             <span class="checkmark"></span>
                                             <span class="text">Plug-In Electric/Gas</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="EPA Classification">
                                             <span class="checkmark"></span>
                                             <span class="text">EPA Classification</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Climate Control">
                                             <span class="checkmark"></span>
                                             <span class="text">Climate Control</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="A/C">
                                             <span class="checkmark"></span>
                                             <span class="text">Air Conditioning</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Security System">
                                             <span class="checkmark"></span>
                                             <span class="text">Security System</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Cruise Control">
                                             <span class="checkmark"></span>
                                             <span class="text">Cruise Control</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Keyless Entry">
                                             <span class="checkmark"></span>
                                             <span class="text">Keyless Entry</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Power Door Locks">
                                             <span class="checkmark"></span>
                                             <span class="text">Power Door Locks</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Heated Mirrors">
                                             <span class="checkmark"></span>
                                             <span class="text">Heated Mirrors</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Navigation System">
                                             <span class="checkmark"></span>
                                             <span class="text">Navigation System</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Adjustable Steering Wheel">
                                             <span class="checkmark"></span>
                                             <span class="text">Adjustable Steering Wheel</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Intermittent Wipers">
                                             <span class="checkmark"></span>
                                             <span class="text">Intermittent Wipers</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Satellite Radio">
                                             <span class="checkmark"></span>
                                             <span class="text">Satellite Radio</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="MP3 Player">
                                             <span class="checkmark"></span>
                                             <span class="text">MP3 Player</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Rain Sensing Wipers">
                                             <span class="checkmark"></span>
                                             <span class="text">Rain Sensing Wipers</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Auto-Dimming Rearview Mirror">
                                             <span class="checkmark"></span>
                                             <span class="text">Auto-Dimming Rearview Mirror</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Bluetooth Connection">
                                             <span class="checkmark"></span>
                                             <span class="text">Bluetooth Connection</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Back-Up Camera">
                                             <span class="checkmark"></span>
                                             <span class="text">Back-Up Camera</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Luggage Rack">
                                             <span class="checkmark"></span>
                                             <span class="text">Luggage Rack</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Power Liftgate">
                                             <span class="checkmark"></span>
                                             <span class="text">Power Liftgate</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Keyless Start">
                                             <span class="checkmark"></span>
                                             <span class="text">Keyless Start</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Heads-Up Display">
                                             <span class="checkmark"></span>
                                             <span class="text">Heads-Up Display</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Automatic Parking">
                                             <span class="checkmark"></span>
                                             <span class="text">Automatic Parking</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Smart Device Integration">
                                             <span class="checkmark"></span>
                                             <span class="text">Smart Device Integration</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Cruise Control Steering Assist">
                                             <span class="checkmark"></span>
                                             <span class="text">Cruise Control Steering Assist</span>
                                          </span>
                                       </label>
                                    </div>

                                    <div class="col-md-3" style="align-items: center;display: flex;">
                                       <label>
                                          <span class="checkboxholder" for="highlightdifference">
                                             <input type="checkbox" name="search[]" value="Lane Departure Warning">
                                             <span class="checkmark"></span>
                                             <span class="text">Lane Departure Warning</span>
                                          </span>
                                       </label>
                                    </div>

                                 </div>

                              {{-- </form> --}}
                           </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>

               <div class="box-vehicleMake">
                  <div class="">
                     <form action="{{route('frontend.search')}}" method="get" class="row">
                        <div class="col-md-6">
                           <label>Search Vehcile</label>
                           <input type="text" name="custom_search" style="border:1px solid;height:57px;border-radius:5px" class="field-style field-split align-left form-control" placeholder="Search for vehicle" />
                        </div>
                        <div class="col-md-3">
                           <label>Make</label>
                           <select name="make" id="">
                              <option value="">Select Make</option>
                              {{-- @foreach ($makes as $make)
                              <option value="{{ $make->name }}">{{ $make->name }}</option>
                              @endforeach --}}
                           </select>
                        </div>
                        <div class="col-md-3">
                           <button type="submit"><i class="far fa-search"></i> Find Listing</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>


         </div>


      </div>
   </div>
</section>-->

<section class="secVehicleType">
   <div class="secVehicleTypeWrap">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <h3>{{$content[0]->short_heading}}</h3>
               <h2>{{$content[0]->heading}}</h2>
               <p>{{$content[0]->content}}</p>
               <ul class="index-slider">
                  <li>
                     <a href="{{url('search/?order_by=pricing_asc&search%5Bbody_type%5D=Sport+Utility')}}">
                        <img src="{{ asset('frontend/assets/images/suv.png') }}" alt="">
                        <h4>SUV</h4>
                     </a>
                  </li>

                  <li>
                     <a href="{{url('search/?order_by=pricing_asc&search%5Bbody_type%5D=Crew+Cab+Chassis-Cab%7CShort+Bed%7CStandard+Bed%7CLong+Bed%7CCrew+Cab+Pickup%7CExtended+Cab+Chassis-Cab%7CRegular+Cab+Chassis-Cab')}}">
                        <img src="{{ asset('frontend/assets/images/pickup.png') }}" alt="">
                        <h4>Pickup</h4>
                     </a>
                  </li>

                  <li>
                     <a href="{{url('search/?order_by=pricing_asc&search%5Bbody_type%5D=Specialty+Vehicle')}}">
                        <img src="{{ asset('frontend/assets/images/spec-veh.png') }}" alt="">
                        <h4>Specialty Vehicle</h4>
                     </a>
                  </li>

                  <li>
                     <a href="{{url('search/?order_by=pricing_asc&search%5Bbody_type%5D=4dr+Car')}}">
                        <img src="{{ asset('frontend/assets/images/sedan.png') }}" alt="">
                        <h4>Sedan</h4>
                     </a>
                  </li>

                  <li>
                     <a href="{{url('search/?order_by=pricing_asc&search%5Bbody_type%5D=Full-size+Cargo+Van%7CFull-size+Passenger+Van')}}">
                        <img src="{{ asset('frontend/assets/images/van.png') }}" alt="">
                        <h4>Van</h4>
                     </a>
                  </li>

                  {{-- <li>
                     <a href="{{url('search/?order_by=pricing_asc&search%5Bbody_type%5D=4dr+Car')}}">
                        <img src="{{ asset('frontend/assets/images/electric car.png') }}" alt="">
                        <h4>Electric Car</h4>
                     </a>
                  </li> --}}

                  <li>
                     <a href="{{url('search/?order_by=pricing_asc&search%5Bbody_type%5D=2dr+Car')}}">
                        <img src="{{ asset('frontend/assets/images/coup.png') }}" alt="">
                        <h4>Coup</h4>
                     </a>
                  </li>
               </ul>
            </div><!-- // COl // -->
         </div><!-- // Row // -->
         <div class="row">
            <div class="col-md-12">
               <div class="testiArrows">
                  <div class="prev prev0"><i class="far fa-chevron-left"></i></div>
                  <div class="next next0"><i class="far fa-chevron-right"></i></div>
               </div>
            </div><!--// Col // -->
         </div><!-- // Row // -->
      </div><!-- // Container-fluid // -->
   </div>
</section>

<section class="featureSec">
   <div class="featureSecWrap">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="featureDesTop text-center">
                  <h4>{{$content[1]->short_heading}}</h4>
                  <h3>{{$content[1]->heading}}</h3>
                  <p>{{$content[1]->content}}</p>
               </div>
            </div><!-- // COl // -->
         </div><!-- // Row // -->

         <div class="row">
            @foreach($featured_vehicles as $vehicle)
            @php($detail = json_decode($vehicle->data))
            @include('frontend.vehicle', ['vehicle' => $vehicle, 'detail' => $detail, 'simple' => true])
            @endforeach
         </div><!-- // Row // -->

         <div class="container">
            <div class="row new_insert_img text-center">
               <div class="col-12">
                  @foreach($ads as $ad)
                     @if($ad->slot == 1)
                        <a href="{{$ad->link}}" target="_blank" onclick="adsClicks(1, 1);">
                           <img src="{{ url('storage/ads/'.$ad->image) }}" alt="" width="728" height="90">
                        </a>
                     @endif
                  @endforeach
               </div>
            </div>
         </div>

         <div class="row mTop-60">
            @foreach($featured_vehicle_one as $vehicle)
            @php($detail = json_decode($vehicle->data))
            @include('frontend.vehicle', ['vehicle' => $vehicle, 'detail' => $detail, 'simple' => true])
            @endforeach
         </div><!-- // Row // -->

         {{-- <div class="row">
            <div class="col-md-12">
               <div class="viewMoreBtn">
                  <a href="javascript:;">View All Listing <i class="far fa-chevron-double-right"></i></a>
               </div>
            </div><!-- // Col // -->
         </div><!-- // Row // -->
         --}}

      </div><!-- // Container-Fluid // -->
   </div>
</section>

<!--<section class="ctaBanner">-->
<!--   <div class="ctaWrapper">-->
<!--      <div class="row ">-->
<!--         <div class="col-md-6">-->
<!--            <h3>FEEL THE BEST EXPERIENCE WITH<br><span>CARJOCK</span></h3>-->
<!--            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore</p>-->
<!--            <div class="row align-items-center mbottom-20 mtop-20">-->
<!--               <div class="col-md-2">-->
<!--                  <div class="carImg">-->
<!--                     <img src="{{ asset('frontend/assets/images/car-icon.png') }}" alt="">-->
<!--                  </div>-->
<!--               </div>-->
<!--               <div class="col-md-10">-->
<!--                  <h4>200 + Cars Models</h4>-->
<!--                  <p>Lorem ipsum dolor sit amet, consectetur</p>-->
<!--               </div>-->
<!--            </div>-->
<!--            <div class="row align-items-center mbottom-20 mtop-20">-->
<!--               <div class="col-md-2">-->
<!--                  <div class="carImg">-->
<!--                     <img src="{{ asset('frontend/assets/images/car-icon.png') }}" alt="">-->
<!--                  </div>-->
<!--               </div>-->
<!--               <div class="col-md-10">-->
<!--                  <h4>300 + Filters & More</h4>-->
<!--                  <p>Lorem ipsum dolor sit amet, consectetur</p>-->
<!--               </div>-->
<!--            </div>-->
<!--         </div>-->
<!--         <div class="col-md-6"><img src="{{ asset('frontend/assets/images/car-1.png') }}" alt=""></div> COl // -->
<!--      </div>-->
<!--   </div>-->
<!--</section>-->

{{-- @if($featured_vehicle_carosal->isNotEmpty())
<section class="featureSec popularSec">
   <div class="featureSecWrap">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="featureDesTop text-center">
                  <h4>CARJOCK</h4>
                  <h3>POPULAR LISTINGS</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore<br> magna aliqua enim ad minim veniam, quis nostrud</p>
               </div>
            </div><!-- // COl // -->
         </div><!-- // Row // -->

         <div class="row popularSlider">
            @foreach($featured_vehicle_carosal as $vehicle)
                  @php($detail = json_decode($vehicle->data))
                  @include('frontend.vehicle', ['vehicle' => $vehicle, 'detail' => $detail])
            @endforeach
         </div><!-- // Row // -->

         <div class="row">
            <div class="col-md-12">
               <div class="testiArrows">
                  <div class="prev prev1"><i class="far fa-chevron-left"></i></div>
                  <div class="next next1"><i class="far fa-chevron-right"></i></div>
               </div>
            </div><!--// Col // -->
         </div><!-- // Row // -->

      </div><!-- // Container-Fluid // -->
   </div>
</section>
@endif --}}

<!--<section class="testimonialsSec">-->
<!--   <div class="testimonialsWrapper">-->
<!--      <div class="container-fluid">-->
<!--         <div class="row">-->
<!--            <div class="col-md-12 text-center">-->
<!--               <h3>OUR LATEST</h3>-->
<!--               <h4>TESTIMONIALS</h4>-->
<!--               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam, quis nostrud</p>-->
<!--            </div>-->
<!--         </div>-->
<!--         <div class="row">-->
<!--            <div class="col-md-12">-->
<!--               <ul class="slider-for">-->
<!--                  <li>-->
<!--                     <p>We are the largest website that deals with buying & selling cars in the world, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                     <p>We are the largest website that deals with buying & selling cars in the world, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                     <p>We are the largest website that deals with buying & selling cars in the world, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                     <p>We are the largest website that deals with buying & selling cars in the world, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                     <p>We are the largest website that deals with buying & selling cars in the world, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>-->
<!--                  </li>-->
<!--               </ul>-->

<!--            </div>-->
<!--         </div>-->
<!--         <div class="row justify-content-center">-->
<!--            <div class="col-md-9">-->
<!--               <ul class="slider-nav">-->
<!--                  <li><img src="{{ asset('frontend/assets/images/client-1.png') }}" alt=""></li>-->
<!--                  <li><img src="{{ asset('frontend/assets/images/client-2.png') }}" alt=""></li>-->
<!--                  <li><img src="{{ asset('frontend/assets/images/client-3.png') }}" alt=""></li>-->
<!--                  <li><img src="{{ asset('frontend/assets/images/client-1.png') }}" alt=""></li>-->
<!--                  <li><img src="{{ asset('frontend/assets/images/client-2.png') }}" alt=""></li>-->
<!--                  <li><img src="{{ asset('frontend/assets/images/client-3.png') }}" alt=""></li>-->
<!--               </ul>-->
<!--            </div>-->
<!--         </div>-->
<!--         <div class="row">-->
<!--            <div class="col-md-12">-->
<!--               <div class="testiArrows">-->
<!--                  <div class="prev"><i class="far fa-chevron-left"></i></div>-->
<!--                  <div class="next"><i class="far fa-chevron-right"></i></div>-->
<!--               </div>-->
<!--            </div><-->
<!--         </div>-->
<!--      </div>-->
<!--   </div>-->
<!--</section>-->

<!--<section class="ourClients">-->
<!--   <div class="container-fluid">-->
<!--      <div class="row align-items-end">-->
<!--         <div class="col-md-4">-->
<!--            <ul>-->
<!--               <li><img src="{{ asset('frontend/assets/images/model-1.svg') }}" alt=""></li>-->
<!--               <li><img src="{{ asset('frontend/assets/images/model-2.svg') }}" alt=""></li>-->
<!--            </ul>-->
<!--         </div>-->
<!--         <div class="col-md-4"><img src="{{ asset('frontend/assets/images/car-2.png') }}" alt=""></div>-->
<!--         <div class="col-md-4">-->
<!--            <ul>-->
<!--               <li><img src="{{ asset('frontend/assets/images/model-1.svg') }}" alt=""></li>-->
<!--               <li><img src="{{ asset('frontend/assets/images/model-2.svg') }}" alt=""></li>-->
<!--            </ul>-->
<!--         </div>-->
<!--      </div>-->
<!--   </div>-->
<!--</section>-->

<section class="blogSection">

    <div class="container-fluid">
        <div class="container">
           <div class="row text-center">
              <div class="col-md-12">
                  <!-- <h3>{{$content[2]->heading}}</h3>
                  <p>{{$content[2]->content}}</p>
                  <br><br><br><br> -->
                  <h4>{{$content[3]->short_heading}}</h4>
                  <h3>{{$content[3]->heading}}</h3>
                  <p>{{$content[3]->content}}</p>
              </div><!-- // Col // -->
           </div><!-- // Row // -->

         <div class="row">
            <div class="col-md-8">
            @if(isset($posts[0]))
               <div class="blogBox">
                  <div class="blogImgHolder">
                     <img src="{{ asset('blogs/wp-content/uploads/' . $posts[0]->thumbnail_url) }}" alt="" width="770" height="341">
                     <div class="categoryHolder">
                        <h5>{{ $posts[0]->category_name }}</h5>
                     </div>
                  </div>
                  <div class="blogDesHolder">
                     <div class="blogTitleHolder">
                        <h6>{!! date('d/m/Y', strtotime($posts[0]->post_date)) !!}, POSTED BY <span>{{ $posts[0]->display_name }}</span></h6>
                        <h2>{{ $posts[0]->post_title }}</h2>
                     </div>

                     <div class="blogTxtHolder">
                        <p>{{ $posts[0]->post_content }}</p>
                        <p><a href="https://devopra.xyz/blogs/{{ $posts[0]->post_name }}">See blog detail <i class="fas fa-chevron-circle-right"></i></a></p>
                     </div>
            @endif
                  </div>
               </div>
               <div class="row">
               @if(isset($posts[1]))
                     <div class="col-md-6">
                        <div class="blogBox">
                           <div class="blogImgHolder">
                              <img src="{{ asset('blogs/wp-content/uploads/' . $posts[1]->thumbnail_url) }}" width="370" height="338">
                     <div class="categoryHolder">
                        <h5>{{ $posts[1]->category_name }}</h5>
                     </div>
                  </div>
                  <div class="blogDesHolder">
                     <div class="blogTitleHolder">
                        <h6>{!! date('d/m/Y', strtotime($posts[1]->post_date)) !!}, POSTED BY <span>{{ $posts[1]->display_name }}</span></h6>
                        <h2>{{ $posts[1]->post_title }}</h2>
                     </div>

                     <div class="blogTxtHolder">
                        <p>{{ $posts[1]->post_content }}</p>
                        <p><a href="https://devopra.xyz/blogs/{{ $posts[1]->post_name }}">See blog detail <i class="fas fa-chevron-circle-right"></i></a></p>
                     </div>
                           </div>
                        </div>
                  @endif
                     </div><!-- // Col // -->
                     <div class="col-md-6">
                        <div class="blogBox blogBoxOnlyImg">
                           <div class="blogImgHolder">
                              @foreach($ads as $adz)
                                 @if($adz->slot == 2)
                                    <a href="{{$adz->link}}" target="_blank" onclick="adsClicks(1, 2);">
                                       <img src="{{ url('storage/ads/'.$adz->image) }}" alt="" height="280" width="336">
                                    </a>
                                 @endif
                              @endforeach
                           </div>
                        </div>
                     </div><!-- // Col // -->
               </div><!-- // Row // -->
            </div><!-- // Col // -->
            <div class="col-md-4">
            @if(isset($posts[2]))
               <div class="blogBox">
                  <div class="blogImgHolder">
                     <img src="{{ asset('blogs/wp-content/uploads/' . $posts[2]->thumbnail_url) }}" width="370" height="182">
                     <div class="categoryHolder">
                        <h5>{{ $posts[2]->category_name }}</h5>
                     </div>
                  </div>
                  <div class="blogDesHolder">
                     <div class="blogTitleHolder">
                        <h6>{!! date('d/m/Y', strtotime($posts[2]->post_date)) !!}, POSTED BY <span>{{ $posts[2]->display_name }}</span></h6>
                        <h2>{{ $posts[2]->post_title }}</h2>
                     </div>

                     <div class="blogTxtHolder">
                        <p>{{ $posts[2]->post_content }}</p>
                        <p><a href="https://devopra.xyz/blogs/{{ $posts[2]->post_name }}">See blog detail <i class="fas fa-chevron-circle-right"></i></a></p>
                     </div>
            @endif

                  </div>
               </div>
               <div class="blogBox">
               @if(isset($posts[3]))
                  <div class="blogImgHolder">
                     <img src="{{ asset('blogs/wp-content/uploads/' . $posts[3]->thumbnail_url) }}" alt="">
                     <div class="categoryHolder">
                        <h5>{{ $posts[3]->category_name }}</h5>
                     </div>
                  </div>
                  <div class="blogDesHolder">
                     <div class="blogTitleHolder">
                        <h6>{!! date('d/m/Y', strtotime($posts[3]->post_date)) !!}, POSTED BY <span>{{ $posts[3]->display_name }}</span></h6>
                        <h2>{{ $posts[3]->post_title }}</h2>
                     </div>

                     <div class="blogTxtHolder">
                        <p>{{ $posts[3]->post_content }}</p>
                        <p><a href="https://devopra.xyz/blogs/{{ $posts[3]->post_name }}">See blog detail <i class="fas fa-chevron-circle-right"></i></a></p>
                     </div>
               @endif

                  </div>
               </div>
            </div><!-- // COl // -->
         </div><!-- // Row // -->

         <!--<div class="row">-->
         <!--   <div class="col-md-12">-->
         <!--      <div class="viewMoreBtn">-->
         <!--         <a href="javascript:;">View All Listing <i class="far fa-chevron-double-right"></i></a>-->
         <!--      </div>-->
         <!--   </div>-->
         <!--</div>-->

      </div><!-- // Container // -->
   </div><!-- // Container-Fluid // -->

</section>


@endsection

@push('styles')
<style>
   section.filterMain .tabBoxMain button {
      width: 100%
   }

   .box-vehicleMake form.row {
      width: 113%;
   }

   section.filterMain .tabBoxMain .box-vehicleMake button {
      width: 60%
   }

   .advance-filter-con input[type="range"] {
      /* removing default appearance */
      -webkit-appearance: none;
      appearance: none;
      /* creating a custom design */
      width: 70%;
      cursor: pointer;
      outline: none;
      border-radius: 15px;
      /*  overflow: hidden;  remove this line*/

      /* New additions */
      height: 13px;
      background: #ccc;
   }

   .advance-filter-con input[type="range"]::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      height: 25px;
      width: 20px;
      background: linear-gradient(to right, rgb(134, 196, 64) 7900%, rgb(204, 204, 204) 7900%);
      border: none;
      border-radius: 5px;
   }

   /* Thumb: Firefox */
   .advance-filter-con input[type="range"]::-moz-range-thumb {
      height: 25px;
      width: 20px;
      background: linear-gradient(to right, rgb(134, 196, 64) 7900%, rgb(204, 204, 204) 7900%);
      border: none;
      transition: .2s ease-in-out;
      border-radius: 5px;
   }

   .fa-info-circle:before {
      font-size: 13px;
   }


   /*tool tips*/


   /*tool tips End*/
</style>
@endpush

@push('script')
<script>
   $('.sliderbar').on('input change', function() {
      const sliderEl = $(this);
      const tempSliderValue = $(this).val();
      const sliderValue = $(this).parent().find('.value').text((parseInt(tempSliderValue) === 0 ? 'All' : parseInt(tempSliderValue) + '+'));
      const progress = (tempSliderValue / sliderEl.attr('max')) * 100;
      sliderEl.attr('style', `background: linear-gradient(to right, rgb(204, 204, 204) ${progress}%, rgb(122 204 30 / 54%) ${progress}%)`);
   });

   $('.sliderbarleft').on('input change', function() {
      const sliderEl = $(this);
      const tempSliderValue = $(this).val();
      const minValue = parseInt(sliderEl.attr('min')); // Get the minimum value
      const range = parseInt(sliderEl.attr('max')) - minValue;
      //const sliderValue = $(this).parent().find('.value').text('<'+parseInt(tempSliderValue));
      const sliderValue = $(this).parent().find('.value').text(parseInt(tempSliderValue) === 250 || parseInt(tempSliderValue) === 100 ? 'All' : '<' + parseInt(tempSliderValue));
      const progress = ((tempSliderValue - minValue) / range) * 100;
      sliderEl.attr('style', `background: linear-gradient(to right, rgb(122 204 30 / 54%) ${progress}%, rgb(204, 204, 204) ${progress}%)`);
   });

   $(".search-field").change(function() {
      console.log($(this).attr('name'));
      $.get("{{ url('ajax/query') }}", {
         type: $(this).attr('name'),
         value: $(this).val()
      }, function(data) {
         if (data.type == 'division') {
            $('#search-make').children().remove();
            $('#search-make').append('<option value="0">Select Make</option>');
            data.data.forEach((make) => {
               $('#search-make').append('<option value="' + make.name + '">' + make.name + '</option>');
            });
         }

         if (data.type == 'model') {
            $('#search-model').children().remove();
            $('#search-model').append('<option value="0">Select Model</option>');
            data.data.forEach((model) => {
               $('#search-model').append('<option value="' + model.name + '">' + model.name + '</option>');
            });
         }
      })
   });

   function handleDollarSign() {
      var myValue = document.getElementById("dollarSign").value;

      if (myValue.indexOf("$") != 0) {
         myValue = "$" + myValue;
      }

      document.getElementById("dollarSign").value = myValue;
   }

   $(document).ready(function() {
      $(document).on('click', ".btnCompare", function() {
         vehicleID = $(this).data('vehicle-id')
         SaveDataToLocalStorageWithoutKey(vehicleID)
      })
   });

</script>

@endpush
