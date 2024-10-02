@extends('frontend.layouts.app')

@section('content')
<div class="mainBanner bannerheightadjust"
    style="background-image:url({{ url('storage/banners/'.$banner->image) }}); background-size: cover; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row">
            <div class="mainbanneroverlay">
                <h2>{{$banner->heading}}</h2>
                <div class="breadcrumb">
                <p style="color:#fff;">{{$banner->content}}</p>    
                </div>
            </div>
            <!-- <img src="{{ asset('frontend/assets/images/banner/redchevcaomparebanner.jpg') }}" alt=""> -->
        </div>
    </div>
</div>
<div class="compare-body">
    <div class="customize-container">
        <div class="row">
            <div class="col-12">
                <div class="notifyalertgreen">
                    Drag and drop to change order of vehicles.
                    {{-- <span class="closealertbar"><img src="{{ asset('frontend/assets/images/closealertbar.png') }}"
                    alt=""></span> --}}
                </div>
            </div>
        </div>
        <div class="row carcomparisonsection">
            <div class="col-md-9">
                @include('frontend.compare-layouts.select-comparisions')
                <div class="row carslidernavigation">
            <div class="col-12">
                <div class="testiArrows">
                    <div class="prev prev1"><i class="far fa-chevron-left"></i></div>
                    <div class="next next1"><i class="far fa-chevron-right"></i></div>
                </div>
            </div>
        </div>
            </div>
            <div class="col-md-3">
                <div class="selectcarcards">
                    <div class="top select-vehicle">
                        <div class="iconholderbtn">
                            <img src="{{ asset('frontend/assets/images/iconcarsselector.svg') }}" alt="">
                        </div>
                        <div class="note">
                            <span class="black">Select a Car</span>
                            <span class="maxallowed">Maximum 6 cars allowed</span>
                        </div>
                    </div>
                    <div class="bottom">
                        <p class="text-center">
                            <span class="text"><span class="main-total-comparisions">0 Cars Added</span></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row carslidernavigation">
            <div class="col-12">
                <div class="testiArrows">
                    <div class="prev prev1"><i class="far fa-chevron-left"></i></div>
                    <div class="next next1"><i class="far fa-chevron-right"></i></div>
                </div>
            </div>
        </div> -->
        <hr style="border-bottom: 1px solid #bcbcbc" />
        <div class="comaprisionblock">
            <div class="row foundcomparisionresult">
                <div class="col-md-3">
                    @include('frontend.compare-layouts.sidebar-filters')
                </div>
                <div class="col-md-9">
                    <div class="selectedcarsfeature">
                        <div class="addbanner text-center">
                        </div>
                    </div>
                    <div class="selectedcarsstrip resetfiltersettings" style="display:none">
                        <div class="col-auto">
                            <ul>

                            </ul>
                        </div>
                        <div class="col-auto class_flexauto_adj">
                            <div class="buttons">
                                <button type="button" id="reset-all-comparisions">New Comparison</button>
                                <button type="button" class="greenhightcomaprision">
                                    <input type="checkbox" style="display:none" /> Hightlight Differences
                                </button>
                                @if(Auth::check())
                                <button type="button" id="savecomparisions">Save</button>
                                @else
                                <button type="button"
                                    onclick="window.location.href = '{{route('frontend.login', ['redirect' => route('frontend.compare')])}}'">Login
                                    to save</button>
                                @endif
                                <button class="showsocial" type="button"><i class="fa fa-bookmark"></i> Share</button>

                                <div class="hidesocial">
                                    <span class="closesocial"><i class="fa fa-close"></i></span>
                                    <div class="sharethis-inline-share-buttons"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comparecartabsbar">
                        <div class="selector"></div>
                        <a href="#" data-scrolltoaccordion="featuresaccord" class="active">Vehicle</a>
                        <a href="#" data-scrolltoaccordion="powertrain">Powertrain</a>
                        <a href="#" data-scrolltoaccordion="highlightsaccord">Seating</a>
                        <a href="#" data-scrolltoaccordion="specificationaccord">Dimensions</a>
                        <a href="#" data-scrolltoaccordion="similaritiesaccord">Chassis</a>
                        <a href="#" data-scrolltoaccordion="differenceaccord">Accessories</a>
                    </div>
                    <div class="compareablecarslist " style="position:sticky;top:60px;z-index:999">
                        <div class="table-wrapper">
                            <div class="tablerow">
                                <div class="stickycol scrollcars carcomparisionlists compare_exclude"
                                    style="visibility: hidden !important;height: 0px;"></div>
                                <div class="tableinnercols carcomparisionlists" onscroll="OnScroll(this)">
                                
                                    <div class="tablecol"></div>
                                    <div style="border-left: 1px solid grey; padding-left: 5px" class="tablecol"></div>
                                    <div style="border-left: 1px solid grey; padding-left: 5px" class="tablecol"></div>
                                    <div style="border-left: 1px solid grey; padding-left: 5px" class="tablecol"></div>
                                    <div style="border-left: 1px solid grey; padding-left: 5px" class="tablecol"></div>
                                    <div style="border-left: 1px solid grey; padding-left: 5px" class="tablecol"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comparecaraccordians">
                        <div class="eachaccordian" data-accordsection="featuresaccord">
                            <div class="accordiantitle active">Vehicle</div>
                            <div class="accordiancontent active">
                                <div class="table-wrapper carlistscroller">
                                    <div class="tablerow">
                                        <div class="stickycol vehicle-epa-classification"><span
                                                class="compareheading">Vehicle
                                                Type</span> <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Car class/rating as defined by Environmental Protection Agency (EPA)"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols" >
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol dimension-invoice"><span
                                                class="compareheading">Invoice/MSRP</span> <span data-toggle="tooltip"
                                                title="" data-placement="right"
                                                data-original-title="The dealer price vs the manufacturer's suggested retail price"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol company-website"><span class="compareheading">Company
                                                Website</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Link to Manufacturers website"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="eachaccordian" data-accordsection="powertrain">
                            <div class="accordiantitle active">Powertrain</div>
                            <div class="accordiancontent active">
                                <div class="table-wrapper carlistscroller">
                                    <div class="tablerow">
                                        <div class="stickycol specifications-drive-train"><span
                                                class="compareheading">Drive
                                                Train</span> <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Where Power from the engine are provided to (Front, Rear, or All wheel drive)"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol specifications-fuel-economy-city"><span
                                                class="compareheading">Est. MPG - City</span> <span
                                                data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="City fuel consumption estimated by EnerGuide"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol specifications-fuel-economy-highway"><span
                                                class="compareheading">Est. MPG - Highway</span> <span
                                                data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Highway fuel consumption estimated by EnerGuide"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol specifications-fuelType"><span class="compareheading">Fuel
                                                Type</span> <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Examples: Gas, Electric, Hybrid, etc."><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol specifications-engineType"><span
                                                class="compareheading">Engine
                                                Type</span> <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Examples: Electric, 4 Cylinder, 6 Cylinder, etc."><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol specifications-displacements"><span
                                                class="compareheading">Displacement</span> <span data-toggle="tooltip"
                                                title="" data-placement="right"
                                                data-original-title="The total volume of all engine cylinders"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol specifications-horse-power"><span
                                                class="compareheading">Horse
                                                Power</span> <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Peak engine power at specific revolutions per minute"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol specifications-rpm"><span
                                                class="compareheading">RPM</span>
                                            <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="tooltip text comes here"><i
                                                    class="fa fa-info-circle"></i></span>
                                        </div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    {{-- <div class="tablerow">
                                    <div class="stickycol specifications-size"><span class="compareheading">Fuel System</span> <span data-toggle="tooltip" title="" data-placement="right" data-original-title="tooltip text comes here"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                    <div class="tablecol"></div>
                                    <div class="tablecol"></div>
                                    <div class="tablecol"></div>
                                    <div class="tablecol"></div>
                                    <div class="tablecol"></div>
                                    <div class="tablecol"></div>
                                    </div>
                                </div> --}}
                                    <div class="tablerow">
                                        <div class="stickycol specifications-torque"><span
                                                class="compareheading">Torque</span>
                                            <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Peak engine torque at specific revolutions per minute">
                                                <i class="fa fa-info-circle"></i></span>
                                        </div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol specifications-torque-rpm"><span
                                                class="compareheading">Torque
                                                RPM</span> <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="tooltip text comes here"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol specifications-battery-range"><span
                                                class="compareheading">Estimated Battery Range</span> <span
                                                data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Estimated electric-only driving range"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    {{-- <div class="tablerow">
                                    <div class="stickycol specifications-stock-number"><span class="compareheading">Stock Number</span> <span data-toggle="tooltip" title="" data-placement="right" data-original-title="tooltip text comes here"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                    <div class="tablecol"></div>
                                    <div class="tablecol"></div>
                                    <div class="tablecol"></div>
                                    <div class="tablecol"></div>
                                    <div class="tablecol"></div>
                                    <div class="tablecol"></div>
                                    </div>
                                </div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="eachaccordian" data-accordsection="highlightsaccord">
                            <div class="accordiantitle active">Seating</div>
                            <div class="accordiancontent active">
                                <div class="table-wrapper carlistscroller">
                                    <div class="tablerow">
                                        <div class="stickycol seating-leather-seats"><span
                                                class="compareheading">Leather
                                                Seats</span> <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Seating surfaces are covered in leather"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol seating-seat-memory"><span class="compareheading">Seat
                                                Memory</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Allows drivers to save multiple preset seat positions"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol seating-heated-front-seats"><span
                                                class="compareheading">Heated
                                                Front Seat(s)</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="tooltip text comes here"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol seating-cooled-front-seats"><span
                                                class="compareheading">Cooled
                                                Front Seat(s)</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Cool air flows through the seat cushion and/or backrest"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol seating-heated-rear-seats"><span
                                                class="compareheading">Heated
                                                Rear Seat(s)</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Rear passengers can also warm their seats"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="eachaccordian" data-accordsection="specificationaccord">
                            <div class="accordiantitle active">Dimensions</div>
                            <div class="accordiancontent active">
                                <div class="table-wrapper carlistscroller">
                                    <div class="tablerow">
                                        <div class="stickycol dimension-pasenger-capacity"><span
                                                class="compareheading">Max
                                                Passenger</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Number of seat belts available for occupants"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols ">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol dimension-front-head-room"><span
                                                class="compareheading">Front
                                                Head Room</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Maximum distance from the front seat cushion to the car roof"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol dimension-front-leg-room"><span
                                                class="compareheading">Front
                                                Leg Room</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Maximum distance from the hip point of the front seat to the point where the feet can be extended"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol dimension-front-shoulder-room"><span
                                                class="compareheading">Front
                                                Shoulder Room</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Distance from the driver’s door panel to the front passenger’s door panel"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol seating-front-hip-room"><span class="compareheading">Front
                                                Hip
                                                Room</span> <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Width of the front seat"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol seating-second-head-room"><span
                                                class="compareheading">Second
                                                Head Room</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Maximum distance from rear seat cushion to the car roof"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol seating-second-leg-room"><span
                                                class="compareheading">Second
                                                Leg Room</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Maximum distance from the hip point of the rear seat to the back of front seat"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol seating-second-shoulder-room"><span
                                                class="compareheading">Second
                                                Shoulder Room</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Distance from the left door panel to the right door panel in the second row"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol seating-second-hip-room"><span
                                                class="compareheading">Second
                                                Hip Room</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Width of the rear seat"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol seating-length"><span class="compareheading">Length,
                                                Overall</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Total length of the vehicle"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol seating-width"><span class="compareheading">Width,
                                                Overall</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Total width of the vehicle including side mirrors folded out"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol seating-height"><span class="compareheading">Height,
                                                Overall</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Total height of the vehicle"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol seating-track-width-front"><span
                                                class="compareheading">Track
                                                Width Front</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Center distance between the front wheels"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol seating-track-width-rear"><span
                                                class="compareheading">Track
                                                Width Rear</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Center distance between the rear wheels"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol seating-ground-clearance"><span class="compareheading">Min
                                                Ground Clearance</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Lowest point's distance from the ground"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol seating-cargo-volume"><span class="compareheading">Cargo
                                                Volume (Back seat down)</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Maximum cargo volume with rear seats down"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                    <div class="tablerow">
                                        <div class="stickycol seating-cargo-volume-trunk"><span
                                                class="compareheading">Cargo
                                                Volume Trunk</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Maximum cargo volume with rear seats up"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="eachaccordian" data-accordsection="similaritiesaccord">
                            <div class="accordiantitle active">Chassis</div>
                            <div class="accordiancontent active">
                                <div class="table-wrapper carlistscroller">
                                    <div class="tablerow">
                                        <div class="stickycol seating-curb-weight"><span class="compareheading">Base
                                                Curb
                                                Weight</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Vehicle's weight without occupants or cargo"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol chasis-dead-max-trailor"><span class="compareheading">Dead
                                                Weight Hitch - Max Trailer Wt.</span> <span data-toggle="tooltip"
                                                title="" data-placement="right"
                                                data-original-title="Maximum weight that can be towed without weight distribution"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol chasis-dead-max-tongue"><span class="compareheading">Dead
                                                Weight Hitch - Max Tongue Wt.</span> <span data-toggle="tooltip"
                                                title="" data-placement="right"
                                                data-original-title="Maximum tongue weight (weight loaded directly onto the hitch) that can be carried without weight distribution"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol chasis-wt-max-trailor"><span class="compareheading">Wt
                                                Distributing Hitch - Max Trailer Wt.</span> <span data-toggle="tooltip"
                                                title="" data-placement="right"
                                                data-original-title="Maximum weight that can be towed with weight distribution"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol chasis-wt-max-tongue"><span class="compareheading">Wt
                                                Distributing Hitch - Max Tongue Wt.</span> <span data-toggle="tooltip"
                                                title="" data-placement="right"
                                                data-original-title="Maximum tongue weight (weight loaded directly onto the hitch) that can be carried with weight distribution"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol fuel-tank-capacity"><span class="compareheading">Fuel Tank
                                                Capacity, Approx</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Maximum volume of fuel the tank can hold"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="eachaccordian" data-accordsection="differenceaccord">
                            <div class="accordiantitle active">Accessories</div>
                            <div class="accordiancontent active">
                                <div class="table-wrapper carlistscroller">
                                    <div class="tablerow">
                                        <div class="stickycol accessories-ac"><span class="compareheading">A/C</span>
                                            <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Air Conditioner"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-adjustable-steering-wheel"><span
                                                class="compareheading">Adjustable Steering Wheel</span> <span
                                                data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Steering wheel's height and angle can be adjusted"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-stereo"><span class="compareheading">AM/FM
                                                Stereo</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Includes AM/FM radio"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-auto-dimming-rearview-mirror"><span
                                                class="compareheading">Auto-Dimming Rearview Mirror</span> <span
                                                data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Mirror reduces glare from headlights automatically"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-automatic-parking"><span
                                                class="compareheading">Automatic Parking</span> <span
                                                data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Vehicle can park itself"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-back-up-camera"><span
                                                class="compareheading">Back-Up
                                                Camera</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Includes a screen that allows the driver to keep an eye on what is behind the vehicle while backing up"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-bluetooth-connection"><span
                                                class="compareheading">Bluetooth Connection</span> <span
                                                data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Able to connect to phone and other Bluetooth devices"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>


                                    <div class="tablerow">
                                        <div class="stickycol accessories-climate-control"><span
                                                class="compareheading">Climate
                                                Control</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Automatically maintains set temperature(s) inside the car"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-cruise-control"><span
                                                class="compareheading">Cruise
                                                Control</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Allows driver to maintain a constant speed without the need to press the gas or brake pedals"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-cruise-control-adaptive"><span
                                                class="compareheading">Cruise Control (Adaptive)</span> <span
                                                data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="tooltip text comes here"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-cruise-control-assist"><span
                                                class="compareheading">Cruise Control Steering Assist</span> <span
                                                data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Assisted steering to keep vehicle within the lane while using cruise control"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-headsup-display"><span
                                                class="compareheading">Heads-Up
                                                Display</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Displays vehicle information on the windshield"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>





















                                    <div class="tablerow">
                                        <div class="stickycol accessories-heated-mirrors"><span
                                                class="compareheading">Heated
                                                Mirrors</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Side mirrors contain heating elements to defrost or defog"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-keyless-entry"><span
                                                class="compareheading">Keyless
                                                Entry</span> <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Unlocks vehicle without the need to insert a physical key"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-keyless-start"><span
                                                class="compareheading">Keyless
                                                Start</span> <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Able to start the engine without a physical key"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-lane-departure-warning"><span
                                                class="compareheading">Lane Departure Warning</span> <span
                                                data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Alerts driver if vehicle drifts out of its lane"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-luggage-rack"><span
                                                class="compareheading">Luggage
                                                Rack</span> <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Includes frame for carrying luggage"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-navigation-system"><span
                                                class="compareheading">Navigation System</span> <span
                                                data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Includes manufacturer’s proprietary GPS system"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-panoramic-roof"><span
                                                class="compareheading">Panoramic
                                                Roof</span> <span data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="tooltip text comes here"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-power-door-locks"><span
                                                class="compareheading">Power
                                                Door Locks</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Locks and unlocks doors electronically"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-power-liftgate"><span
                                                class="compareheading">Power
                                                Liftgate</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Able to open and close the rear door electronically"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-rain-sensing-wipers"><span
                                                class="compareheading">Rain
                                                Sensing Wipers</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Windshield wipers speed adjusts automatically based on how hard it is raining"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-satellite-radio"><span
                                                class="compareheading">Satellite Radio</span> <span
                                                data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Includes satellite radio"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-security-system"><span
                                                class="compareheading">Security
                                                System</span> <span data-toggle="tooltip" title=""
                                                data-placement="right" data-original-title="Includes built-in security system"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-smart-device-integration"><span
                                                class="compareheading">Smart Device Integration</span> <span
                                                data-toggle="tooltip" title="" data-placement="right"
                                                data-original-title="Some car systems can be controlled by a smart device"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    <div class="tablerow">
                                        <div class="stickycol accessories-sun-moonroof"><span
                                                class="compareheading">Sun/Moonroof</span> <span data-toggle="tooltip"
                                                title="" data-placement="right"
                                                data-original-title="Rooftop window"><i
                                                    class="fa fa-info-circle"></i></span></div>
                                        <div class="tableinnercols">
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                            <div class="tablecol"></div>
                                        </div>
                                    </div>

                                    {{-- <div class="tablerow">
                                <div class="stickycol accessories-intermittent-wipers"><span class="compareheading">Intermittent Wipers</span> <span data-toggle="tooltip" title="" data-placement="right" data-original-title="tooltip text comes here"><i class="fa fa-info-circle"></i></span></div>
                                <div class="tableinnercols">
                                <div class="tablecol"></div>
                                <div class="tablecol"></div>
                                <div class="tablecol"></div>
                                <div class="tablecol"></div>
                                <div class="tablecol"></div>
                                <div class="tablecol"></div>
                                </div>
                            </div> --}}

                                    {{-- <div class="tablerow">
                                <div class="stickycol accessories-mp3"><span class="compareheading">MP3 Player</span> <span data-toggle="tooltip" title="" data-placement="right" data-original-title="tooltip text comes here"><i class="fa fa-info-circle"></i></span></div>
                                <div class="tableinnercols">
                                <div class="tablecol"></div>
                                <div class="tablecol"></div>
                                <div class="tablecol"></div>
                                <div class="tablecol"></div>
                                <div class="tablecol"></div>
                                <div class="tablecol"></div>
                                </div>
                            </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" style="margin-top:15%" id="reset-comparision-confirmation" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remove Comparisions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure to remove the previous comparisions?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="reset-all-comparisions-yes">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                @if(auth()->check())
                <button type="button" class="btn btn-primary" id="storesavedcomparisionAndReset">Save</button>
                @else
                <button type="button" class="btn btn-primary"
                    onclick="window.location.href = '{{route('frontend.login', ['redirect' => route('frontend.compare')])}}'">Login
                    to save</button>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" style="margin-top:15%" id="savecomparisionsmodal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Save Comparisions</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> --}}
            </div>
            <div class="modal-body">
                Do you want to save current comparisions?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="storesavedcomparisions">Yes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.select-vehicle {
    cursor: pointer;
}

.compareablecarslist .tableinnercols .tablecol {
    border: none;
    font-size: 14px;
    height: 60px;
    text-align: left
}

.carcomparisonsection .dragableslidingcars .carcard .inner .content .title {
    text-align: center;
    font-size: 15px;
    height: 33px
}

.compareablecarslist .tableinnercols {
    overflow-x: auto
}

.compareablecarslist .tableinnercols::-webkit-scrollbar {
    height: 8px;
    background: #fff;
}

.compareablecarslist .tableinnercols::-webkit-scrollbar-thumb {
    background: #86c440;
    border-radius: 40px;
}

.compareablecarslist .tableinnercols::-webkit-scrollbar-track {
    background: #fff;
    border-radius: 40px;
}





.customize-container {
    padding: 25px 15px
}

.notifyalertgreen {
    margin-bottom: 30px;
    padding: 5px 30px
}

.mainbanneroverlay .breadcrumb {
    margin: 0 auto
}

.compareablecarslist .tableinnercols .tablecol {
    line-height: 15px
}

.carcomparisionlists {
    visibility: hidden
}

.compare_exclude {
    visibility: hidden !important;
}

.carcomparisonsection .dragableslidingcars .carcard .inner {
    min-height: 370px
}

.comparecaraccordians .eachaccordian .accordiantitle {
    background-position: 2% center;
    padding: 19px 70px
}

.compareablecarslist .tableinnercols {
    background: #fff;
    padding: 0 10px;
    height: 70px;
    margin-top: 15px;
    margin-bottom: 15px;
    overflow-y: hidden;
    border-radius: 0
}

.tablecol .fa-check {
    color: #86c440
}

.tablerow .stickycol {
    height: 70px;
    background: #fff;
    padding-left: 10px
}

.tableinnercols {
    border-radius: 0;
}

.tableinnercols .tablecol {
    height: 70px;
}
/* .tablecol {
    width: 230px !important;
} */
.comparecaraccordians .eachaccordian .accordiancontent .horsepowermeter .overlaymeter::before {
    background: #86c440
}

.comparecaraccordians .eachaccordian .accordiancontent .table-wrapper {
    overflow-x: hidden
}

.specifications-rpm,
.specifications-horse-power,
.specifications-torque-rpm,
.specifications-torque {
    z-index: 99;
}

.carslidernavigation .testiArrows {
    padding: 15px 0 15px 0
}

.selectcarcards .top {
    padding: 84px 30px 84px
}

.selectcarcards .bottom p .text {
    margin: 0 auto
}

.greenhightcomaprision.active {
    color: #86C440;
    background: #fff
}

.ranktag {
    position: absolute;
    left: -5px;
    background: none !important;
    color: grey !important;
    font-weight: 600;
    top: 75px;
}

.hidesocial {
    width: 16% !important;
    padding: 8px 10px !important;
    margin-top: 0px !important;
    border-radius: 5px;
    background: #caeeb5 !important;
}

.social-share-links>a>div {
    border-radius: 50%;
    width: 35px;
    height: 35px;
}

#st-1 .st-btn>img {
    display: inline-block;
    height: 27px !important;
    width: 14px !important;
    position: relative;
    top: 0px !important;
    vertical-align: middle !important;
}

#st-1 .st-btn {

    height: 26px !important;
    line-height: 0px !important;
    margin-right: 8px !important;
    padding: 0 9px !important;
    position: relative;
    text-align: center;
    top: 0;
    vertical-align: top;
    white-space: nowrap;
}
.closesocial {
    top: 1px !important;
    right: 5px !important;
}
.class_flexauto_adj{
    flex:auto;
}
.row.carslidernavigation {
    position: absolute;
    bottom: 0px;
    width: 100%;
}
.row.dragableslidingcars {
    padding-bottom: 100px;
}
</style>
@endpush

@push('script')
<script type="text/javascript">
sortable('.dragableslidingcars', {
    forcePlaceholderSize: true,
    //connectWith: '.js-connected',
    //handle: '.handle',
    items: '.carcard',
    placeholderClass: 'border border-green bg-white mb1 col-4',
});

function getNumberWithOrdinal(n) {
    var s = ["th", "st", "nd", "rd"],
        v = n % 100;
    return n + (s[(v - 20) % 10] || s[v] || s[0]);
}
sortable('.dragableslidingcars')[0].addEventListener('sortupdate', function(e) {
    var draggablelist = document.querySelector('.dragableslidingcars');
    var draggablelistranktag = draggablelist.querySelectorAll('.ranktag');
    draggablelistranktag.forEach(function(elem, indexnum) {
        elem.innerHTML = getNumberWithOrdinal(indexnum + 1);
    })

    $.each($('.carselectoroption').trigger('change'));
});
</script>
@endpush