<div class="row dragableslidingcars">
    <div class="col-md-4 carcard firstcomparision" style="display: none">
        <div class="carselector">
            <select class="carselectoroption" name="state"></select>
        </div>
        <div class="inner">
            <div class="imageholder">
                <img src="{{ asset('frontend/assets/images/comparision-placeholder.jpeg') }}" class="vehicle-image"
                    alt="comparision">
                <div class="iconholder">
                    @if (Auth::check())
                        <a class="favourite-vehicle" title="Add to favorite" href="javascript:;"><button><i
                                    class="fas fa-heart"></i></button></a>
                    @else
                        <a title="Add to favorite" href="javascript:;" data-toggle="modal"
                            data-target="#login-alert"><button><i class="fas fa-heart"></i></button></a>
                    @endif
                    <a title="Share" href="javascript:;" class="socialshare"><button><i
                                class="fal fa-share-alt"></i></button></a>

                </div>
                <div class="hidesocial socialshare-detail">
                    <span class="closesocial"><i class="fa fa-close"></i></span>
                    <div class="">
                        <div class="social-share-links">
                            <a target="_blank">
                                <div class="facebook" style="display: inline-block;">
                                    <img alt="facebook sharing button"
                                        src="https://platform-cdn.sharethis.com/img/facebook.svg">
                                </div>
                            </a>
                            <a target="_blank">
                                <div class="twitter">
                                    <img style="width:16px" alt="twitter sharing button"
                                        src="https://platform-cdn.sharethis.com/img/twitter.svg">

                                </div>
                            </a>
                            <a target="_blank">
                                <div class="email">
                                    <img alt="email sharing button"
                                        src="https://platform-cdn.sharethis.com/img/email.svg">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="ranktag">1st</div>
                <div class="title"><br /><br /></div>
                <div class="footer">
                    <button class="vehicleprofile" type="button">Vehicle Profile</button>
                    <button class="vehicledelete" type="button"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 carcard secondcomparision" style="display: none">
        <div class="carselector">
            <select class="carselectoroption" name="state">
                <option value="0">Select Vehicle</option>
                @foreach ($garageVehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="inner">
            <div class="imageholder">
                <img src="{{ asset('frontend/assets/images/comparision-placeholder.jpeg') }}" class="vehicle-image"
                    alt="comparision">
                <div class="iconholder">
                    @if (Auth::check())
                        <a class="favourite-vehicle" title="Add to favorite" href="javascript:;"><button><i
                                    class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:void(0)" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        @if (!isset($simple))
                            {{-- <li><a title="Compare" style="padding:0;background:none" href="javascript:void(0)" onclick="makeCompare({{$vehicle->id}}, {{ auth()->user()->id }})"><img width="40" src="{{ asset('frontend/assets/images/chain-icon.png') }}" alt=""></a></li> --}}
                        @endif
                    @else
                        <a title="Add to favorite" href="javascript:;" data-toggle="modal"
                            data-target="#login-alert"><button><i class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:;" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        @if (!isset($simple))
                            {{-- <li><a title="Compare" style="padding:0;background:none" href="javascript:void(0)" data-toggle="modal" data-target="#login-alert"><img width="40" src="{{ asset('frontend/assets/images/chain-icon.png') }}" alt=""></a></li> --}}
                        @endif
                    @endif
                </div>
                <div class="hidesocial socialshare-detail">
                    <span class="closesocial"><i class="fa fa-close"></i></span>
                    <div class="">
                        <div class="social-share-links">
                            <a target="_blank">
                                <div class="facebook" style="display: inline-block;">
                                    <img alt="facebook sharing button"
                                        src="https://platform-cdn.sharethis.com/img/facebook.svg">
                                </div>
                            </a>
                            <a target="_blank">
                                <div class="twitter">
                                    <img style="width:16px" alt="twitter sharing button"
                                        src="https://platform-cdn.sharethis.com/img/twitter.svg">

                                </div>
                            </a>
                            <a target="_blank">
                                <div class="email">
                                    <img alt="email sharing button"
                                        src="https://platform-cdn.sharethis.com/img/email.svg">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="ranktag">2nd</div>
                <div class="title"><br /><br /></div>
                <div class="footer">
                    <button class="vehicleprofile" type="button">Vehicle Profile</button>
                    <button class="vehicledelete" type="button"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 carcard thirdcomparision" style="display: none">
        <div class="carselector">
            <select class="carselectoroption" name="state"></select>
        </div>
        <div class="inner">
            <div class="imageholder">
                <img src="{{ asset('frontend/assets/images/comparision-placeholder.jpeg') }}" class="vehicle-image"
                    alt="comparision">
                <div class="iconholder">
                    @if (Auth::check())
                        <a class="favourite-vehicle" title="Add to favorite" href="javascript:;"><button><i
                                    class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:void(0)" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        @if (!isset($simple))
                            {{-- <li><a title="Compare" style="padding:0;background:none" href="javascript:void(0)" onclick="makeCompare({{$vehicle->id}}, {{ auth()->user()->id }})"><img width="40" src="{{ asset('frontend/assets/images/chain-icon.png') }}" alt=""></a></li> --}}
                        @endif
                    @else
                        <a title="Add to favorite" href="javascript:;" data-toggle="modal"
                            data-target="#login-alert"><button><i class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:;" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        @if (!isset($simple))
                            {{-- <li><a title="Compare" style="padding:0;background:none" href="javascript:void(0)" data-toggle="modal" data-target="#login-alert"><img width="40" src="{{ asset('frontend/assets/images/chain-icon.png') }}" alt=""></a></li> --}}
                        @endif
                    @endif
                </div>
                <div class="hidesocial socialshare-detail">
                    <span class="closesocial"><i class="fa fa-close"></i></span>
                    <div class="">
                        <div class="social-share-links">
                            <a target="_blank">
                                <div class="facebook" style="display: inline-block;">
                                    <img alt="facebook sharing button"
                                        src="https://platform-cdn.sharethis.com/img/facebook.svg">
                                </div>
                            </a>
                            <a target="_blank">
                                <div class="twitter">
                                    <img style="width:16px" alt="twitter sharing button"
                                        src="https://platform-cdn.sharethis.com/img/twitter.svg">

                                </div>
                            </a>
                            <a target="_blank">
                                <div class="email">
                                    <img alt="email sharing button"
                                        src="https://platform-cdn.sharethis.com/img/email.svg">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="ranktag">3rd</div>
                <div class="title"><br /><br /></div>
                <div class="footer">
                    <button class="vehicleprofile" type="button">Vehicle Profile</button>
                    <button class="vehicledelete" type="button"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 carcard fourthcomparision" style="display: none">
        <div class="carselector">
            <select class="carselectoroption" name="state"></select>
        </div>
        <div class="inner">
            <div class="imageholder">
                <img src="{{ asset('frontend/assets/images/comparision-placeholder.jpeg') }}" class="vehicle-image"
                    alt="comparision">
                <div class="iconholder">
                    @if (Auth::check())
                        <a class="favourite-vehicle" title="Add to favorite" href="javascript:;"><button><i
                                    class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:void(0)" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        @if (!isset($simple))
                            {{-- <li><a title="Compare" style="padding:0;background:none" href="javascript:void(0)" onclick="makeCompare({{$vehicle->id}}, {{ auth()->user()->id }})"><img width="40" src="{{ asset('frontend/assets/images/chain-icon.png') }}" alt=""></a></li> --}}
                        @endif
                    @else
                        <a title="Add to favorite" href="javascript:;" data-toggle="modal"
                            data-target="#login-alert"><button><i class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:;" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        @if (!isset($simple))
                            {{-- <li><a title="Compare" style="padding:0;background:none" href="javascript:void(0)" data-toggle="modal" data-target="#login-alert"><img width="40" src="{{ asset('frontend/assets/images/chain-icon.png') }}" alt=""></a></li> --}}
                        @endif
                    @endif
                </div>
                <div class="hidesocial socialshare-detail">
                    <span class="closesocial"><i class="fa fa-close"></i></span>
                    <div class="">
                        <div class="social-share-links">
                            <a target="_blank">
                                <div class="facebook" style="display: inline-block;">
                                    <img alt="facebook sharing button"
                                        src="https://platform-cdn.sharethis.com/img/facebook.svg">
                                </div>
                            </a>
                            <a target="_blank">
                                <div class="twitter">
                                    <img style="width:16px" alt="twitter sharing button"
                                        src="https://platform-cdn.sharethis.com/img/twitter.svg">

                                </div>
                            </a>
                            <a target="_blank">
                                <div class="email">
                                    <img alt="email sharing button"
                                        src="https://platform-cdn.sharethis.com/img/email.svg">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="ranktag">4th</div>
                <div class="title"><br /><br /></div>
                <div class="footer">
                    <button class="vehicleprofile" type="button">Vehicle Profile</button>
                    <button class="vehicledelete" type="button"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 carcard fifthcomparision" style="display: none">
        <div class="carselector">
            <select class="carselectoroption" name="state"></select>
        </div>
        <div class="inner">
            <div class="imageholder">
                <img src="{{ asset('frontend/assets/images/comparision-placeholder.jpeg') }}" class="vehicle-image"
                    alt="comparision">
                <div class="iconholder">
                    @if (Auth::check())
                        <a class="favourite-vehicle" title="Add to favorite" href="javascript:;"><button><i
                                    class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:void(0)" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        @if (!isset($simple))
                            {{-- <li><a title="Compare" style="padding:0;background:none" href="javascript:void(0)" onclick="makeCompare({{$vehicle->id}}, {{ auth()->user()->id }})"><img width="40" src="{{ asset('frontend/assets/images/chain-icon.png') }}" alt=""></a></li> --}}
                        @endif
                    @else
                        <a title="Add to favorite" href="javascript:;" data-toggle="modal"
                            data-target="#login-alert"><button><i class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:;" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        @if (!isset($simple))
                            {{-- <li><a title="Compare" style="padding:0;background:none" href="javascript:void(0)" data-toggle="modal" data-target="#login-alert"><img width="40" src="{{ asset('frontend/assets/images/chain-icon.png') }}" alt=""></a></li> --}}
                        @endif
                    @endif
                </div>
                <div class="hidesocial socialshare-detail">
                    <span class="closesocial"><i class="fa fa-close"></i></span>
                    <div class="">
                        <div class="social-share-links">
                            <a target="_blank">
                                <div class="facebook" style="display: inline-block;">
                                    <img alt="facebook sharing button"
                                        src="https://platform-cdn.sharethis.com/img/facebook.svg">
                                </div>
                            </a>
                            <a target="_blank">
                                <div class="twitter">
                                    <img style="width:16px" alt="twitter sharing button"
                                        src="https://platform-cdn.sharethis.com/img/twitter.svg">

                                </div>
                            </a>
                            <a target="_blank">
                                <div class="email">
                                    <img alt="email sharing button"
                                        src="https://platform-cdn.sharethis.com/img/email.svg">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="ranktag">5th</div>
                <div class="title"><br /><br /></div>
                <div class="footer">
                    <button class="vehicleprofile" type="button">Vehicle Profile</button>
                    <button class="vehicledelete" type="button"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 carcard sixthcomparision" style="display: none">
        <div class="carselector">
            <select class="carselectoroption" name="state"></select>
        </div>
        <div class="inner">
            <div class="imageholder">
                <img src="{{ asset('frontend/assets/images/comparision-placeholder.jpeg') }}" class="vehicle-image"
                    alt="comparision">
                <div class="iconholder">
                    @if (Auth::check())
                        <a class="favourite-vehicle" title="Add to favorite" href="javascript:;"><button><i
                                    class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:void(0)" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        @if (!isset($simple))
                            {{-- <li><a title="Compare" style="padding:0;background:none" href="javascript:void(0)" onclick="makeCompare({{$vehicle->id}}, {{ auth()->user()->id }})"><img width="40" src="{{ asset('frontend/assets/images/chain-icon.png') }}" alt=""></a></li> --}}
                        @endif
                    @else
                        <a title="Add to favorite" href="javascript:;" data-toggle="modal"
                            data-target="#login-alert"><button><i class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:;" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        @if (!isset($simple))
                            {{-- <li><a title="Compare" style="padding:0;background:none" href="javascript:void(0)" data-toggle="modal" data-target="#login-alert"><img width="40" src="{{ asset('frontend/assets/images/chain-icon.png') }}" alt=""></a></li> --}}
                        @endif
                    @endif
                </div>
                <div class="hidesocial socialshare-detail">
                    <span class="closesocial"><i class="fa fa-close"></i></span>
                    <div class="">
                        <div class="social-share-links">
                            <a target="_blank">
                                <div class="facebook" style="display: inline-block;">
                                    <img alt="facebook sharing button"
                                        src="https://platform-cdn.sharethis.com/img/facebook.svg">
                                </div>
                            </a>
                            <a target="_blank">
                                <div class="twitter">
                                    <img style="width:16px" alt="twitter sharing button"
                                        src="https://platform-cdn.sharethis.com/img/twitter.svg">

                                </div>
                            </a>
                            <a target="_blank">
                                <div class="email">
                                    <img alt="email sharing button"
                                        src="https://platform-cdn.sharethis.com/img/email.svg">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="ranktag">6th</div>
                <div class="title"><br /><br /></div>
                <div class="footer">
                    <button class="vehicleprofile" type="button">Vehicle Profile</button>
                    <button class="vehicledelete" type="button"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
