    <div class="{{ isset($cols) ? $cols : 'col-md-3'}} mb-5">
        <div class="featureBox">
            <div class="imgBox" id="favourite-{{$vehicle->id}}"><a href="{{route('frontend.vehicle', $vehicle->id)}}">
                    @if($vehicle->image && (file_exists($vehicle->image) || file_exists('/'.$vehicle->image)))
                    <img src="{{ asset($vehicle->image) }}" alt="{{$vehicle->name}}">
                    {{-- <img src="{{ asset('frontend/assets/images/comparision-placeholder.jpeg') }}" alt=""> --}}

                    @else
                    <img src="{{ asset('frontend/assets/images/comparision-placeholder.jpeg') }}" alt="">
                    @endif </a>
                <ul>
                    @if (Auth::check())
                    <li><a style="color: {{ auth()->user()->vehicles()->where('vehicle_id', $vehicle->id)->count() > 0 ? 'red' : '#fff' }}" class="favourite-vehicle" title="Add to favorite" href="javascript:;" onclick="makeFavourite({{$vehicle->id}}, {{auth()->user()->id}})"><i class="fas fa-heart"></i></a></li>
                    <li><a title="Share" href="javascript:void(0)" class="socialshare"><i class="fal fa-share-alt"></i></a></li>
                    {{-- @if(!isset($simple)) --}}
                    <li><a title="compare" data-vehicle-id="{{ $vehicle->id }}" href="javascript:;" class="btnCompareFeaturedLogedIn"><i class="fal fa-retweet"></i></a></li>
                    {{-- <li><a title="Compare" style="padding:0;background:none" href="javascript:void(0)" onclick="makeCompare({{$vehicle->id}}, {{ auth()->user()->id }})"><img width="40" src="{{ asset('frontend/assets/images/chain-icon.png') }}" alt=""></a></li> --}}
                    {{-- @endif --}}
                    @else
                    <li><a title="Add to favorite" href="javascript:;" data-toggle="modal" data-target="#login-alert"><i class="fas fa-heart"></i></a></li>
                    <li><a title="Share" href="javascript:;" class="socialshare"><i class="fal fa-share-alt"></i></a></li>
                    <li><a title="compare" data-vehicle-id="{{ $vehicle->id }}" href="javascript:;" class="btnCompare2"><i class="fal fa-retweet"></i></a></li>
                    @if(!isset($simple))
                    {{-- <li><a title="Compare" style="padding:0;background:none" href="javascript:void(0)" data-toggle="modal" data-target="#login-alert"><img width="40" src="{{ asset('frontend/assets/images/chain-icon.png') }}" alt=""></a></li> --}}
                    @endif
                    @endif
                </ul>
                <div class="hidesocial socialshare-detail">
                    <span class="closesocial"><i class="fa fa-close"></i></span>
                    <div class="">
                        @php($pageUrl = route('frontend.vehicle', $vehicle->id))
                        @php($facebookShareUrl = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($pageUrl))
                        @php($twitterShareUrl = "https://twitter.com/intent/tweet?url=" . urlencode($pageUrl))
                        @php($emailShareUrl = "mailto:?subject=Check%20out%20this%20vehicle&body=" . urlencode($pageUrl))
                        <div class="social-share-links">
                            <a href="{{ $facebookShareUrl }}" target="_blank">
                                <div class="facebook" style="display: inline-block;">
                                    <img alt="facebook sharing button" src="https://platform-cdn.sharethis.com/img/facebook.svg">
                                </div>
                            </a>
                            <a href="{{ $twitterShareUrl }}" target="_blank">
                                <div class="twitter">
                                    <img alt="twitter sharing button" src="https://platform-cdn.sharethis.com/img/twitter.svg">

                                </div>
                            </a>
                            <a href="{{ $emailShareUrl }}" target="_blank">
                                <div class="email">
                                    <img alt="email sharing button" src="https://platform-cdn.sharethis.com/img/email.svg">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{route('frontend.vehicle', $vehicle->id)}}">
                <div style="height:90px;" class="boxInfo">
                    <h5>${{ number_format(($detail->style->basePrice->msrp), 2) }}</h5>
                    <h6>{{ strlen($vehicle->name) > 35 ? substr($vehicle->name, 0, 35) . '...' : $vehicle->name }}</h6>
                </div>

                @if(isset($simple))
                <div class="vehicleSpec">
                    <ul>
                        <li class="first"><img src="{{ asset('frontend/assets/images/engine.png') }}" alt="">{{ $vehicle->horsepower }} Horsepower</li>
                        <li>
                            @if($vehicle->battery_range)
                            <img src="{{ asset('frontend/assets/images/battery.png') }}" alt="">
                            @else
                            <img src="{{ asset('frontend/assets/images/fuel-pump.png') }}" alt="">
                            @endif
                            {{ ($vehicle->battery_range) ? $vehicle->battery_range. ' MPC' : $vehicle->mpg_city . ' MPG' }}
                        </li>
                        <li><img src="{{ asset('frontend/assets/images/all-wheel-drive.png') }}" alt="">{{ isset($detail->style->drivetrain) ? $detail->style->drivetrain : ''; }}</li>
                        <li class="last"><img src="{{ asset('frontend/assets/images/seats.png') }}" alt="">{{ $vehicle->seating }} Passengers</li>

                    </ul>
                </div>
                @else
                <div class="vehicleSpec">
                    <ul>
                        <li class="first"><img src="{{ asset('frontend/assets/images/engine.png') }}" alt="">{{ $vehicle->horsepower }} Horsepower</li>
                        <li>
                            @if($vehicle->battery_range)
                            <img src="{{ asset('frontend/assets/images/battery.png') }}" alt="">
                            @else
                            <img src="{{ asset('frontend/assets/images/fuel-pump.png') }}" alt="">
                            @endif
                            {{ ($vehicle->battery_range) ? $vehicle->battery_range. ' MPC' : $vehicle->mpg_city . ' MPG'  }}
                        </li>
                        <li><img src="{{ asset('frontend/assets/images/all-wheel-drive.png') }}" alt="">{{ isset($detail->style->drivetrain) ? $detail->style->drivetrain : ''; }}</li>
                        <li class="last"><img src="{{ asset('frontend/assets/images/seats.png') }}" alt="">{{ $vehicle->seating }} Passengers</li>
                    </ul>
                </div>
                @endif
            </a>
        </div>
    </div><!-- // Col // -->
