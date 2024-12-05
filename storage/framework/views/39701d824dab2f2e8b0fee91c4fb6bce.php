    <div class="<?php echo e(isset($cols) ? $cols : 'col-md-3'); ?> mb-5">
        <div class="featureBox">
            <div class="imgBox" id="favourite-<?php echo e($vehicle->id); ?>"><a href="<?php echo e(route('frontend.vehicle', $vehicle->id)); ?>">
                    <?php if($vehicle->image && (file_exists($vehicle->image) || file_exists('/'.$vehicle->image))): ?>
                    <img src="<?php echo e(asset($vehicle->image)); ?>" alt="<?php echo e($vehicle->name); ?>">
                    

                    <?php else: ?>
                    <img src="<?php echo e(asset('frontend/assets/images/comparision-placeholder.jpeg')); ?>" alt="">
                    <?php endif; ?> </a>
                <ul>
                    <?php if(Auth::check()): ?>
                    <li><a style="color: <?php echo e(auth()->user()->vehicles()->where('vehicle_id', $vehicle->id)->count() > 0 ? 'red' : '#fff'); ?>" class="favourite-vehicle" title="Add to favorite" href="javascript:;" onclick="makeFavourite(<?php echo e($vehicle->id); ?>, <?php echo e(auth()->user()->id); ?>)"><i class="fas fa-heart"></i></a></li>
                    <li><a title="Share" href="javascript:void(0)" class="socialshare"><i class="fal fa-share-alt"></i></a></li>
                    
                    <li><a title="compare" data-vehicle-id="<?php echo e($vehicle->id); ?>" href="javascript:;" class="btnCompareFeaturedLogedIn"><i class="fal fa-retweet"></i></a></li>
                    
                    
                    <?php else: ?>
                    <li><a title="Add to favorite" href="javascript:;" data-toggle="modal" data-target="#login-alert"><i class="fas fa-heart"></i></a></li>
                    <li><a title="Share" href="javascript:;" class="socialshare"><i class="fal fa-share-alt"></i></a></li>
                    <li><a title="compare" data-vehicle-id="<?php echo e($vehicle->id); ?>" href="javascript:;" class="btnCompare2"><i class="fal fa-retweet"></i></a></li>
                    <?php if(!isset($simple)): ?>
                    
                    <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <div class="hidesocial socialshare-detail">
                    <span class="closesocial"><i class="fa fa-close"></i></span>
                    <div class="">
                        <?php ($pageUrl = route('frontend.vehicle', $vehicle->id)); ?>
                        <?php ($facebookShareUrl = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($pageUrl)); ?>
                        <?php ($twitterShareUrl = "https://twitter.com/intent/tweet?url=" . urlencode($pageUrl)); ?>
                        <?php ($emailShareUrl = "mailto:?subject=Check%20out%20this%20vehicle&body=" . urlencode($pageUrl)); ?>
                        <div class="social-share-links">
                            <a href="<?php echo e($facebookShareUrl); ?>" target="_blank">
                                <div class="facebook" style="display: inline-block;">
                                    <img alt="facebook sharing button" src="https://platform-cdn.sharethis.com/img/facebook.svg">
                                </div>
                            </a>
                            <a href="<?php echo e($twitterShareUrl); ?>" target="_blank">
                                <div class="twitter">
                                    <img alt="twitter sharing button" src="https://platform-cdn.sharethis.com/img/twitter.svg">

                                </div>
                            </a>
                            <a href="<?php echo e($emailShareUrl); ?>" target="_blank">
                                <div class="email">
                                    <img alt="email sharing button" src="https://platform-cdn.sharethis.com/img/email.svg">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <a href="<?php echo e(route('frontend.vehicle', $vehicle->id)); ?>">
                <div style="height:90px;" class="boxInfo">
                    <h5>$<?php echo e(number_format(($detail->style->basePrice->msrp), 2)); ?></h5>
                    <h6><?php echo e(strlen($vehicle->name) > 35 ? substr($vehicle->name, 0, 35) . '...' : $vehicle->name); ?></h6>
                </div>

                <?php if(isset($simple)): ?>
                <div class="vehicleSpec">
                    <ul>
                        <li class="first"><img src="<?php echo e(asset('frontend/assets/images/engine.png')); ?>" alt=""><?php echo e($vehicle->horsepower); ?> Horsepower</li>
                        <li>
                            <?php if($vehicle->battery_range): ?>
                            <img src="<?php echo e(asset('frontend/assets/images/battery.png')); ?>" alt="">
                            <?php else: ?>
                            <img src="<?php echo e(asset('frontend/assets/images/fuel-pump.png')); ?>" alt="">
                            <?php endif; ?>
                            <?php echo e(($vehicle->battery_range) ? $vehicle->battery_range. ' MPC' : $vehicle->mpg_city . ' MPG'); ?>

                        </li>
                        <li><img src="<?php echo e(asset('frontend/assets/images/all-wheel-drive.png')); ?>" alt=""><?php echo e(isset($detail->style->drivetrain) ? $detail->style->drivetrain : ''); ?></li>
                        <li class="last"><img src="<?php echo e(asset('frontend/assets/images/seats.png')); ?>" alt=""><?php echo e($vehicle->seating); ?> Passengers</li>

                    </ul>
                </div>
                <?php else: ?>
                <div class="vehicleSpec">
                    <ul>
                        <li class="first"><img src="<?php echo e(asset('frontend/assets/images/engine.png')); ?>" alt=""><?php echo e($vehicle->horsepower); ?> Horsepower</li>
                        <li>
                            <?php if($vehicle->battery_range): ?>
                            <img src="<?php echo e(asset('frontend/assets/images/battery.png')); ?>" alt="">
                            <?php else: ?>
                            <img src="<?php echo e(asset('frontend/assets/images/fuel-pump.png')); ?>" alt="">
                            <?php endif; ?>
                            <?php echo e(($vehicle->battery_range) ? $vehicle->battery_range. ' MPC' : $vehicle->mpg_city . ' MPG'); ?>

                        </li>
                        <li><img src="<?php echo e(asset('frontend/assets/images/all-wheel-drive.png')); ?>" alt=""><?php echo e(isset($detail->style->drivetrain) ? $detail->style->drivetrain : ''); ?></li>
                        <li class="last"><img src="<?php echo e(asset('frontend/assets/images/seats.png')); ?>" alt=""><?php echo e($vehicle->seating); ?> Passengers</li>
                    </ul>
                </div>
                <?php endif; ?>
            </a>
        </div>
    </div><!-- // Col // -->
<?php /**PATH /var/www/html/carjock/resources/views/frontend/vehicle.blade.php ENDPATH**/ ?>