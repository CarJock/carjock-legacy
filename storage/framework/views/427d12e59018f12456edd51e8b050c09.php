<?php $__env->startSection('content'); ?>


<section id="vehicle-detail-loading" class="detail-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2><?php echo e($vehicle->name); ?></h2>
                <h3>$<?php echo e(number_format(($detail->style->basePrice->msrp), 2)); ?></h3>
                <p></p>
            </div>
            <div class="col-md-4">
                <div class="icon">
                    <a title="Share" href="javascript:void(0)" class="showsocial"><img
                            src="<?php echo e(asset('frontend/assets/images/share-icon.png')); ?>" alt=""></a>

                    <?php if(Auth::check()): ?>
                    <a title="Save" onclick="makeFavourite(<?php echo e($vehicle->id); ?>, <?php echo e(auth()->user()->id); ?>)"
                        href="javascript:void(0)"
                        style="color: <?php echo e(auth()->user()->vehicles()->where('vehicle_id', $vehicle->id)->count() > 0 ? 'red' : '#fff'); ?>"
                        class="favourite-vehicle detail">
                        <?php if(auth()->user()->vehicles()->where('vehicle_id', $vehicle->id)->count() > 0): ?>
                        <img src="<?php echo e(asset('frontend/assets/images/heart-icon-filled.png')); ?>" alt="">
                        <?php else: ?>
                        <img src="<?php echo e(asset('frontend/assets/images/heart-icon.png')); ?>" alt="">

                        <?php endif; ?>
                    </a>
                    <?php else: ?>
                    <a title="Save" href="javascript:void(0)" data-toggle="modal" data-target="#login-alert"><img
                            src="<?php echo e(asset('frontend/assets/images/heart-icon.png')); ?>" alt=""></a>
                    <?php endif; ?>
                    <a title="compare" data-vehicle-id="<?php echo e($vehicle->id); ?>" href="javascript:;"
                        class="compareIconinCarDetailPage btnCompare2"><i class="fal fa-retweet"></i></a>

                </div>
                <div class="hidesocial">
                    <span class="closesocial"><i class="fa fa-close"></i></span>
                    <div class="sharethis-inline-share-buttons"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="tab-main-sec">
    <div class="container">
        <div class="">
            <div class="tabs-sec">
                <div class="row foundcomparisionresult">
                    <div class="col-md-12">
                        <div class="comparecartabsbar">
                            <div class="selector"></div>
                            <a href="#" data-scrolltoaccordion="featuresaccord" class="active">All Overview</a>
                            <a href="#" data-scrolltoaccordion="featuresaccord">Vehicle</a>
                            <a href="#" data-scrolltoaccordion="powertrain">Powertrain</a>
                            <a href="#" data-scrolltoaccordion="highlightsaccord">Seating</a>
                            <a href="#" data-scrolltoaccordion="specificationaccord">Dimensions</a>
                            <a href="#" data-scrolltoaccordion="similaritiesaccord">Chassis</a>
                            <a href="#" data-scrolltoaccordion="differenceaccord">Accessories</a>
                        </div>
                        <div class="comparecaraccordians tab-content mt-5">
                            

                    <div class="product-left mb-5" data-accordsection="alloverview">
                        <?php if($images->count() > 0): ?>
                        <div class="swiper-container product-slider mb-3">
                            <div class="swiper-wrapper">
                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                    <a href="<?php echo e(asset($image->image)); ?>" data-fancybox="images" data-caption="Image 2">
                                        <img src="<?php echo e(asset($image->image)); ?>" alt="">
                                    </a>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <div class="swiper-container product-thumbs">
                            <div class="swiper-wrapper">
                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo e(asset($image->image)); ?>" alt="img-fluid">
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                        <?php endif; ?>
                    </div>

                    <?php if(App\Models\Setting::where('meta_key', 'vehicle_detail_icons')->where('meta_value',
                    'on')->first()): ?>
                    <div class="car-icon-box">
                        <ul class="index-sliderzz">
                            <li>
                                <a href="#">
                                    <div><img src="<?php echo e(asset('frontend/assets/images/icons-05-03.png')); ?>" alt=""></div>
                                    <h5> Horsepower</h5>
                                    <p><?php echo e($vehicle->horsepower); ?></p>
                                </a>
                            </li>
                            <li>
                                <a href="#">

                                    <div>
                                        <?php if($vehicle->battery_range): ?>
                                        <img src="<?php echo e(asset('frontend/assets/images/battery.png')); ?>" alt="">
                                        <?php else: ?>
                                        <img src="<?php echo e(asset('frontend/assets/images/icons-05-02.png')); ?>" alt="">
                                        <?php endif; ?>
                                    </div>
                                    <h5>Mileage</h5>
                                    <p><?php echo e(($vehicle->battery_range) ? $vehicle->battery_range . ' MPC' : $vehicle->mpg_city . ' MPG'); ?>

                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div> <img src="<?php echo e(asset('frontend/assets/images/icons-05-04.png')); ?>" alt="">
                                    </div>
                                    <h5>DriveTrain</h5>
                                    <p><?php echo e($detail->style->drivetrain); ?></p>
                                </a>
                            </li>
                            <!--<li>-->
                            <!--   <a href="#">-->
                            <!--      <img src="assets/images/petrol.png" alt="">-->
                            <!--      <h5>Fuel Type</h5>-->
                            <!--      <p>Petrol</p>-->
                            <!--   </a>-->
                            <!--</li>-->
                            <li class="new_part">
                                <a href="#">
                                    <div> <img src="<?php echo e(asset('frontend/assets/images/icons-05-01.png')); ?>" alt="">
                                    </div>
                                    <h5>Seating Capacity</h5>
                                    <p><?php echo e($vehicle->seating); ?> Passengers</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <div class="eachaccordian" data-accordsection="featuresaccord">
                        <div class="accordiantitle active">Vehicle</div>
                        <div class="accordiancontent active">
                            <div class="table-wrapper carlistscroller">
                                <div class="tablerow">
                                    <div class="stickycol vehicle-epa-classification"><span
                                            class="compareheading">Vehicle Type</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="Car class/rating as defined by Environmental Protection Agency (EPA)"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
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
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol company-website"><span class="compareheading">Company
                                            Website</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Link to Manufacturers website"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
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
                                    <div class="stickycol specifications-drive-train"><span class="compareheading">Drive
                                            Train</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Where Power from the engine are provided to (Front, Rear, or All wheel drive)"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol specifications-fuel-economy-city"><span
                                            class="compareheading">Est. MPG - City</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="City fuel consumption estimated by EnerGuide"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol specifications-fuel-economy-highway"><span
                                            class="compareheading">Est. MPG - Highway</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="Highway fuel consumption estimated by EnerGuide"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
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
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol specifications-engineType"><span class="compareheading">Engine
                                            Type</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Examples: Electric, 4 Cylinder, 6 Cylinder, etc."><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
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
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol specifications-horse-power"><span class="compareheading">Horse
                                            Power</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Peak engine power at specific revolutions per minute"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol specifications-rpm"><span class="compareheading">RPM</span>
                                        <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="tooltip text comes here"><i
                                                class="fa fa-info-circle"></i></span>
                                    </div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol specifications-torque"><span
                                            class="compareheading">Torque</span> <span data-toggle="tooltip" title=""
                                            data-placement="right" data-original-title="Peak engine torque at specific revolutions per minute"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol specifications-torque-rpm"><span class="compareheading">Torque
                                            RPM</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="tooltip text comes here"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="eachaccordian" data-accordsection="highlightsaccord">
                        <div class="accordiantitle active">Seating</div>
                        <div class="accordiancontent active">
                            <div class="table-wrapper carlistscroller">
                                <div class="tablerow">
                                    <div class="stickycol seating-leather-seats"><span class="compareheading">Leather
                                            Seats</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Seating surfaces are covered in leather"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol seating-seat-memory"><span class="compareheading">Seat
                                            Memory</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Allows drivers to save multiple preset seat positions"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol seating-heated-front-seats"><span
                                            class="compareheading">Heated Front Seat(s)</span> <span
                                            data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title=""><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol seating-cooled-front-seats"><span
                                            class="compareheading">Cooled Front Seat(s)</span> <span
                                            data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Cool air flows through the seat cushion and/or backrest"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol seating-heated-rear-seats"><span class="compareheading">Heated
                                            Rear Seat(s)</span> <span data-toggle="tooltip" title=""
                                            data-placement="right" data-original-title="Rear passengers can also warm their seats"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
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
                                    <div class="stickycol dimension-pasenger-capacity"><span class="compareheading">Max
                                            Passenger</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Number of seat belts available for occupants"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol dimension-front-head-room"><span class="compareheading">Front
                                            Head Room</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Maximum distance from the front seat cushion to the car roof"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol dimension-front-leg-room"><span class="compareheading">Front
                                            Leg Room</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Maximum distance from the hip point of the front seat to the point where the feet can be extended"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol dimension-front-shoulder-room"><span
                                            class="compareheading">Front Shoulder Room</span> <span
                                            data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Distance from the driver’s door panel to the front passenger’s door panel"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol seating-front-hip-room"><span class="compareheading">Front Hip
                                            Room</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Width of the front seat"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol seating-second-head-room"><span class="compareheading">Second
                                            Head Room</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Maximum distance from rear seat cushion to the car roof"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol seating-second-leg-room"><span class="compareheading">Second
                                            Leg Room</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Maximum distance from the hip point of the rear seat to the back of front seat"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol seating-second-shoulder-room"><span
                                            class="compareheading">Second Shoulder Room</span> <span
                                            data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Distance from the left door panel to the right door panel in the second row"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol seating-second-hip-room"><span class="compareheading">Second
                                            Hip Room</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Width of the rear seat"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol seating-length"><span class="compareheading">Length,
                                            Overall</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Total length of the vehicle"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol seating-width"><span class="compareheading">Width,
                                            Overall</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Total width of the vehicle including side mirrors folded out"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol seating-height"><span class="compareheading">Height,
                                            Overall</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Total height of the vehicle"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol seating-track-width-front"><span class="compareheading">Track
                                            Width Front</span> <span data-toggle="tooltip" title=""
                                            data-placement="right" data-original-title="Center distance between the front wheels"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol seating-track-width-rear"><span class="compareheading">Track
                                            Width Rear</span> <span data-toggle="tooltip" title=""
                                            data-placement="right" data-original-title="Center distance between the rear wheels"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
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
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol seating-cargo-volume"><span class="compareheading">Cargo
                                            Volume (Back seat down)</span> <span data-toggle="tooltip" title=""
                                            data-placement="right" data-original-title="Maximum cargo volume with rear seats down"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>
                                <div class="tablerow">
                                    <div class="stickycol seating-cargo-volume-trunk"><span class="compareheading">Cargo
                                            Volume Trunk</span> <span data-toggle="tooltip" title=""
                                            data-placement="right" data-original-title="Maximum cargo volume with rear seats up"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
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
                                    <div class="stickycol seating-curb-weight"><span class="compareheading">Base Curb
                                            Weight</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Vehicle's weight without occupants or cargo"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol chasis-dead-max-trailor"><span class="compareheading">Dead
                                            Weight Hitch - Max Trailer Wt.</span> <span data-toggle="tooltip" title=""
                                            data-placement="right" data-original-title="Maximum weight that can be towed without weight distribution"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol chasis-dead-max-tongue"><span class="compareheading">Dead
                                            Weight Hitch - Max Tongue Wt.</span> <span data-toggle="tooltip" title=""
                                            data-placement="right" data-original-title="Maximum tongue weight (weight loaded directly onto the hitch) that can be carried without weight distribution"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
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
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol fuel-tank-capacity"><span class="compareheading">Fuel Tank
                                            Capacity</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Maximum volume of fuel the tank can hold
 A/C: Air Conditioner"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
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
                                    <div class="stickycol accessories-ac"><span class="compareheading">A/C</span> <span
                                            data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="tooltip text comes here"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-adjustable-steering-wheel">
                                        <span class="compareheading">Adjustable Steering Wheel</span>
                                        <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Steering wheel's height and angle can be adjusted">
                                            <i class="fa fa-info-circle"></i>
                                        </span>
                                    </div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-stereo">
                                        <span class="compareheading">AM/FM Stereo</span>
                                        <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Includes AM/FM radio">
                                            <i class="fa fa-info-circle"></i>
                                        </span>
                                    </div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol auto-dimming-rearview-mirror">
                                        <span class="compareheading">Auto-Dimming Rearview Mirror</span>
                                        <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Mirror reduces glare from headlights automatically">
                                            <i style="margin-right: 31px" class="fa fa-info-circle"></i>
                                        </span>
                                    </div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-automatic-parking"><span
                                            class="compareheading">Automatic Parking</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="Vehicle can park itself"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-back-up-camera"><span
                                            class="compareheading">Back-Up Camera</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="Includes a screen that allows the driver to keep an eye on what is behind the vehicle while backing up"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
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
                                    </div>
                                </div>


                                <div class="tablerow">
                                    <div class="stickycol accessories-climate-control"><span
                                            class="compareheading">Climate Control</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="Automatically maintains set temperature(s) inside the car"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-cruise-control"><span
                                            class="compareheading">Cruise Control</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="Allows driver to maintain a constant speed without the need to press the gas or brake pedals"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
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
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-headsup-display"><span
                                            class="compareheading">Heads-Up Display</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="Displays vehicle information on the windshield"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-heated-mirrors"><span
                                            class="compareheading">Heated Mirrors</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="Side mirrors contain heating elements to defrost or defog"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-keyless-entry"><span
                                            class="compareheading">Keyless Entry</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="Unlocks vehicle without the need to insert a physical key"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-keyless-start"><span
                                            class="compareheading">Keyless Start</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="Able to start the engine without a physical key"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
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
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-luggage-rack"><span class="compareheading">Luggage
                                            Rack</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Includes frame for carrying luggage"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-navigation-system"><span
                                            class="compareheading">Navigation System</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="Includes manufacturer’s proprietary GPS system"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-panoramic-roof"><span
                                            class="compareheading">Panoramic Roof</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="tooltip text comes here"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-power-door-locks"><span
                                            class="compareheading">Power Door Locks</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="Locks and unlocks doors electronically"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-power-liftgate"><span class="compareheading">Power
                                            Liftgate</span> <span data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Able to open and close the rear door electronically"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-rain-sensing-wipers"><span
                                            class="compareheading">Rain Sensing Wipers</span> <span
                                            data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Windshield wipers speed adjusts automatically based on how hard it is raining"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-satellite-radio"><span
                                            class="compareheading">Satellite Radio</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="Includes satellite radio"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-security-system"><span
                                            class="compareheading">Security System</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="Includes built-in security system"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-smart-device-integration"><span
                                            class="compareheading">Smart Device Integration</span> <span
                                            data-toggle="tooltip" title="" data-placement="right"
                                            data-original-title="Some car systems can be controlled by a smart device
Sun/Moonroof: Rooftop window"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                <div class="tablerow">
                                    <div class="stickycol accessories-sun-moonroof"><span
                                            class="compareheading">Sun/Moonroof</span> <span data-toggle="tooltip"
                                            title="" data-placement="right"
                                            data-original-title="tooltip text comes here"><i
                                                class="fa fa-info-circle"></i></span></div>
                                    <div class="tableinnercols">
                                        <div class="tablecol"></div>
                                    </div>
                                </div>

                                

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>


<?php if($related): ?>
<section class="featureSec popularSec">
    <div class="featureSecWrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="featureDesTop text-center">
                        <h3>RELATED CARS</h3>
                        <p>Explore these vehicles that share similar features and characteristics. Whether you're considering alternatives or simply want to broaden your options, <br>  these related cars might just hold the key to your perfect ride.</p>
                    </div>
                </div>
            </div>

            <div class="row popularSlider">
                <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php ($detail = json_decode($vehicle->data)); ?>
                <?php echo $__env->make('frontend.vehicle', ['vehicle' => $vehicle, 'detail' => $detail, 'cols' => $related->count() <
                    4 ? 'col-md-12' : 'col-md-3' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </div>
                    <!-- // Row // -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="testiArrows">
                                <div class="prev prev1"><i class="far fa-chevron-left"></i></div>
                                <div class="next next1"><i class="far fa-chevron-right"></i></div>
                            </div>
                        </div>
                        <!--// Col // -->
                    </div><!-- // Row // -->

            </div><!-- // Container-Fluid // -->
        </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://unpkg.com/swiper@6.5.4/swiper-bundle.min.css">
<link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/vehicle-detail.css')); ?>" />
<style>
/*.tableinnercols{border: 1px solid;border-radius: 0;border-left: 0;}*/
.tablecol .fa-check {
    color: #86c440
}

section.detail-sec h3 {
    font-size: 26px;
}

.car-icon-box .slick-slider .slick-track,
.slick-slider .slick-list {
    width: 100% !important;
    margin: 0
}

.car-icon-box li.slick-slide.slick-active {
    width: 25% !important
}

.tablerow .stickycol {
    height: 57px;
    /* background: #fff; */
    padding-left: 10px
}

.tableinnercols {
    border-radius: 0;
}

.tableinnercols .tablecol {
    height: 57px;
}

.comparecaraccordians .eachaccordian .accordiancontent .horsepowermeter .overlaymeter::before {
    background: #86c440
}

.car-icon-box a {
    cursor: default;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/js/swiper.min.js"></script>
<script>
$(document).ready(function () {
    // Hide navigation buttons if there are fewer than 5 thumbnails
    if ($(".product-thumbs .swiper-slide").length <= 5) {
        $(".swiper-button-next").hide();
        $(".swiper-button-prev").hide();
    }

    // Initialize the main product slider
    var productSlider = new Swiper('.product-slider', {
        spaceBetween: 0,
        centeredSlides: false,
        loop: false,
        direction: 'horizontal',
        slidesPerView: 1,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        resizeObserver: true,
    });

    // Initialize the thumbnail slider
    var productThumbs = new Swiper('.product-thumbs', {
        spaceBetween: 10,  // Adjust as needed
        centeredSlides: true,
        slidesPerView: 5,  // Show 5 thumbnails at a time on desktop
        direction: 'horizontal',
        slideToClickedSlide: true,
        loop: false,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        observer: true,
    });

    // Link the two sliders
    productSlider.controller.control = productThumbs;
    productThumbs.controller.control = productSlider;

    // Initialize fancybox for image display
    $("[data-fancybox='images']").fancybox({
        buttons: ["slideShow", "fullScreen", "thumbs", "close"],
    });
});

function price_format(number, decimals) {
    number = parseFloat(number); // Convert to a floating-point number
    if (isNaN(number)) return '0.00'; // Handle invalid numbers gracefully
    return number
        .toFixed(decimals) // Ensure the specified number of decimal places
        .replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Add commas as thousands separators
}


$.get("<?php echo e(route('frontend.vehicle', $id)); ?>", function(data, status) {
    $('.tableinnercols').each(function() {
        $(this).children().eq(0).show();
        $(this).children().eq(0).text('-');
    });

    
    let vehicle = data.vehicle;
    let vehicleDetail = data.detail

    $('.stickycol.specifications-body').next().children().eq(0).text(vehicleDetail?.body_type);
    $('.stickycol.specifications-trim').next().children().eq(0).text(vehicleDetail.style?.trim ?? vehicleDetail.style?.nameWoTrim);
    $('.stickycol.specifications-cylinders').next().children().eq(0).text(vehicleDetail.engine?.cylinders);
    $('.stickycol.specifications-drive-train').next().children().eq(0).text(vehicleDetail.style?.drivetrain);
    $('.stickycol.specifications-fuel-economy-city').next().children().eq(0).text(vehicleDetail.engine.fuelEconomy? vehicleDetail.engine.fuelEconomy?.city?.low : '-');
    $('.stickycol.specifications-fuel-economy-highway').next().children().eq(0).text(vehicleDetail.engine.fuelEconomy ? vehicleDetail.engine.fuelEconomy.hwy?.low : '-');
    $('.stickycol.specifications-fuelType').next().children().eq(0).text(vehicle.fuel_type ?? vehicleDetail.engine?.fuelType?._);
    $('.stickycol.specifications-engineType').next().children().eq(0).text(vehicle.engine_type ?? vehicleDetail.engine?.engineType?._);
    $('.stickycol.specifications-torque').next().children().eq(0).text(vehicleDetail.engine?.netTorque?.value);
    $('.stickycol.specifications-size').next().children().eq(0).text(vehicleDetail.engine.fuelCapacity ? (vehicleDetail.engine?.fuelCapacity?.high + vehicleDetail.engine?.fuelCapacity?.unit) : '-');
    $('.stickycol.specifications-stock-number').next().children().eq(0).text(vehicleDetail.style?.acode?._);
    $('.stickycol.specifications-displacements').next().children().eq(0).text(vehicleDetail.engine.displacement ? (vehicleDetail.engine?.displacement?.value?._ + vehicleDetail.engine?.displacement?.value?.unit) : '-');

    $('.stickycol.specifications-battery-range').next().children().eq(0).text(vehicle.battery_range ?? '-');

    //horse power
    $('.stickycol.specifications-horse-power').next().children().eq(0).text(vehicleDetail?.engine?.horsepower?.value);
    // $('.stickycol.specifications-horse-power').next().children().eq(0).find('.horsepowermeter').children().css('width', 100+'%');

    // RPM
    if(vehicleDetail.engine?.horsepower.rpm){
        $('.stickycol.specifications-rpm').next().children().eq(0).text(vehicleDetail.engine?.horsepower?.rpm);
        // $('.stickycol.specifications-rpm').next().children().eq(0).find('.horsepowermeter').children().css('width', 100+'%');
    } else {
        $('.stickycol.specifications-rpm').next().children().eq(0).html('<span>-</span>')
    }

    if(vehicleDetail.engine?.netTorque.rpm){
        $('.stickycol.specifications-torque-rpm').next().children().eq(0).text(vehicleDetail.engine?.netTorque?.rpm);
        // $('.stickycol.specifications-torque-rpm').next().children().eq(0).find('.horsepowermeter').children().css('width', 100+'%');
    } else {
        $('.stickycol.specifications-torque-rpm').next().children().eq(0).html('<span>-</span>')
    }
    $('.stickycol.dimension-invoice').next().children().eq(0).text('$'+price_format((vehicleDetail?.basePrice?.invoice?.low), 2) + ' / $' + price_format((vehicleDetail?.basePrice?.msrp?.low), 2));

    if (vehicle.link_url) {
    // Add "https://" if the link doesn't already have a protocol
        if (!/^https?:\/\//i.test(vehicle.link_url)) {
            vehicle.link_url = 'https://' + vehicle.link_url;
        }

        $('.stickycol.company-website').next().children().eq(0).html(
            '<a href="' + vehicle.link_url + '" target="_blank" rel="noopener noreferrer">' + vehicle.link_url + '</a>'
        );
    } else {
        $('.stickycol.company-website').next().children().eq(0).text('-');
    }


    //Loop to get Generaic Equipment Definations
    if(vehicleDetail.genericEquipment){
        for(let i = 0; i < vehicleDetail.genericEquipment.length; i++){
            if(Object.hasOwn(vehicleDetail.genericEquipment[i], 'definition')){
                if(Object.hasOwn(vehicleDetail.genericEquipment[i].definition, 'category')){
                    //List Down all properties
                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Leather Seats')
                        $('.stickycol.seating-leather-seats').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Seat Memory')
                        $('.stickycol.seating-seat-memory').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');
                    
                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Heated Front Seat(s)')
                        $('.stickycol.seating-heated-front-seats').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Heated Rear Seat(s)')
                        $('.stickycol.seating-heated-rear-seats').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Cooled Front Seat(s)')
                        $('.stickycol.seating-cooled-front-seats').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'AM/FM Stereo')
                        $('.stickycol.dimension-stereo').next().children().eq(0).text(vehicleDetail.genericEquipment[i].definition?.header?._);

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Climate Control')
                        $('.stickycol.accessories-climate-control').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'A/C')
                        $('.stickycol.accessories-ac').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Adjustable Steering Wheel')
                        $('.stickycol.accessories-adjustable-steering-wheel').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'AM/FM Stereo')
                        $('.stickycol.accessories-stereo').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');               

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Security System')
                        $('.stickycol.accessories-security-system').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Cruise Control')
                        $('.stickycol.accessories-cruise-control').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Adaptive Cruise Control')
                        $('.stickycol.accessories-cruise-control-adaptive').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Cruise Control Steering Assist')
                        $('.stickycol.accessories-cruise-control-assist').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Keyless Entry')
                        $('.stickycol.accessories-keyless-entry').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Power Door Locks')
                        $('.stickycol.accessories-power-door-locks').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Heated Mirrors')
                        $('.stickycol.accessories-heated-mirrors').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Sun/Moonroof')
                        $('.stickycol.accessories-sun-moonroof').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Intermittent Wipers')
                        $('.stickycol.accessories-intermittent-wipers').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'MP3 Player')
                        $('.stickycol.accessories-mp3').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Auto-Dimming Rearview Mirror')
                        $('.stickycol.accessories-auto-dimming-rearview-mirror').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Luggage Rack')
                        $('.stickycol.accessories-luggage-rack').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');
                    
                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Navigation System')
                        $('.stickycol.accessories-navigation-system').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');
                      
                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Panoramic Roof')
                        $('.stickycol.accessories-panoramic-roof').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');
                      
                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Rain Sensing Wipers')
                        $('.stickycol.accessories-rain-sensing-wipers').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');
                    
                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Satellite Radio')
                        $('.stickycol.accessories-satellite-radio').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');
                      
                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Bluetooth Connection')
                        $('.stickycol.accessories-bluetooth-connection').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Back-Up Camera')
                        $('.stickycol.accessories-back-up-camera').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Keyless Start')
                        $('.stickycol.accessories-keyless-start').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Lane Departure Warning')
                        $('.stickycol.accessories-lane-departure-warning').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Cruise Control Steering Assist')
                        $('.stickycol.accessories-cruise-control-steering-assist').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Smart Device Integration')
                        $('.stickycol.accessories-smart-device-integration').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');
                    
                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Automatic Parking')
                        $('.stickycol.accessories-automatic-parking').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicleDetail.genericEquipment[i].definition.category._ == 'Hands-Free Liftgate')
                        $('.stickycol.accessories-power-liftgate').next().children().eq(0).html(vehicleDetail.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');


                }
            }
        }
    }


    //Loop to get Technical Specification Definations
    if(vehicleDetail.technicalSpecification){
        for(let i = 0; i < vehicleDetail.technicalSpecification.length; i++){
            if(Object.hasOwn(vehicleDetail.technicalSpecification[i], 'definition')){
                if(Object.hasOwn(vehicleDetail.technicalSpecification[i].definition, 'title')){
                    //List Down All properties
                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'EPA Classification')
                        $('.stickycol.vehicle-epa-classification').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Passenger Capacity') {
                        $('.stickycol.dimension-pasenger-capacity').next().find('.tablecol').text(vehicleDetail.technicalSpecification[i]?.value?.value);
                    }

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Front Head Room')
                        $('.stickycol.dimension-front-head-room').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Front Leg Room')
                        $('.stickycol.dimension-front-leg-room').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'AM/FM Stereo')
                        $('.stickycol.dimension-stereo').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Front Shoulder Room')
                        $('.stickycol.dimension-front-shoulder-room').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);
                        
                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Front Hip Room')
                        $('.stickycol.seating-front-hip-room').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Second Head Room')
                        $('.stickycol.seating-second-head-room').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Second Leg Room')
                        $('.stickycol.seating-second-leg-room').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Second Shoulder Room')
                        $('.stickycol.seating-second-shoulder-room').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Second Hip Room')
                        $('.stickycol.seating-second-hip-room').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Length, Overall')
                        $('.stickycol.seating-length').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Width, Max w/o mirrors')
                        $('.stickycol.seating-width').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Height, Overall')
                        $('.stickycol.seating-height').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Track Width, Front')
                        $('.stickycol.seating-track-width-front').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Track Width, Rear')
                        $('.stickycol.seating-track-width-rear').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Ground Clearance')
                        $('.stickycol.seating-ground-clearance').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Payload Capacity')
                        $('.stickycol.seating-payload-capacity').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Cargo Volume with Rear Seat Up')
                        $('.stickycol.seating-cargo-volume').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Base Curb Weight')
                        $('.stickycol.seating-curb-weight').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);
                
                    
                    
                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Dead Weight Hitch - Max Trailer Wt.')
                        $('.stickycol.chasis-dead-max-trailor').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Dead Weight Hitch - Max Tongue Wt.')
                        $('.stickycol.chasis-dead-max-tongue').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Wt Distributing Hitch - Max Trailer Wt')
                        $('.stickycol.chasis-wt-max-trailor').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);

                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Wt Distributing Hitch - Max Tongue Wt.')
                        $('.stickycol.chasis-wt-max-tongue').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);
                
                    if(vehicleDetail.technicalSpecification[i].definition.title._ == 'Fuel Tank Capacity')
                        $('.stickycol.fuel-tank-capacity').next().children().eq(0).text(vehicleDetail.technicalSpecification[i]?.value?.value);
                

                        
                }
            }
        }
    }
});

// if ($(".product-left").length) {}

// $(document).ready(function() {});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\nitin\OneDrive\Desktop\carjock-legacy\resources\views/frontend/vehicle-detail.blade.php ENDPATH**/ ?>