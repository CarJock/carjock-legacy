<div class="row dragableslidingcars">
    <div class="col-md-4 carcard firstcomparision" style="display: none">
        <div class="carselector">
            <select class="carselectoroption" name="state"></select>
        </div>
        <div class="inner">
            <div class="imageholder">
                <img src="<?php echo e(asset('frontend/assets/images/comparision-placeholder.jpeg')); ?>" class="vehicle-image"
                    alt="comparision">
                <div class="iconholder">
                    <?php if(Auth::check()): ?>
                        <a class="favourite-vehicle" title="Add to favorite" href="javascript:;"><button><i
                                    class="fas fa-heart"></i></button></a>
                    <?php else: ?>
                        <a title="Add to favorite" href="javascript:;" data-toggle="modal"
                            data-target="#login-alert"><button><i class="fas fa-heart"></i></button></a>
                    <?php endif; ?>
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
                <?php $__currentLoopData = $garageVehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($vehicle->id); ?>"><?php echo e($vehicle->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="inner">
            <div class="imageholder">
                <img src="<?php echo e(asset('frontend/assets/images/comparision-placeholder.jpeg')); ?>" class="vehicle-image"
                    alt="comparision">
                <div class="iconholder">
                    <?php if(Auth::check()): ?>
                        <a class="favourite-vehicle" title="Add to favorite" href="javascript:;"><button><i
                                    class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:void(0)" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        <?php if(!isset($simple)): ?>
                            
                        <?php endif; ?>
                    <?php else: ?>
                        <a title="Add to favorite" href="javascript:;" data-toggle="modal"
                            data-target="#login-alert"><button><i class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:;" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        <?php if(!isset($simple)): ?>
                            
                        <?php endif; ?>
                    <?php endif; ?>
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
                <img src="<?php echo e(asset('frontend/assets/images/comparision-placeholder.jpeg')); ?>" class="vehicle-image"
                    alt="comparision">
                <div class="iconholder">
                    <?php if(Auth::check()): ?>
                        <a class="favourite-vehicle" title="Add to favorite" href="javascript:;"><button><i
                                    class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:void(0)" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        <?php if(!isset($simple)): ?>
                            
                        <?php endif; ?>
                    <?php else: ?>
                        <a title="Add to favorite" href="javascript:;" data-toggle="modal"
                            data-target="#login-alert"><button><i class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:;" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        <?php if(!isset($simple)): ?>
                            
                        <?php endif; ?>
                    <?php endif; ?>
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
                <img src="<?php echo e(asset('frontend/assets/images/comparision-placeholder.jpeg')); ?>" class="vehicle-image"
                    alt="comparision">
                <div class="iconholder">
                    <?php if(Auth::check()): ?>
                        <a class="favourite-vehicle" title="Add to favorite" href="javascript:;"><button><i
                                    class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:void(0)" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        <?php if(!isset($simple)): ?>
                            
                        <?php endif; ?>
                    <?php else: ?>
                        <a title="Add to favorite" href="javascript:;" data-toggle="modal"
                            data-target="#login-alert"><button><i class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:;" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        <?php if(!isset($simple)): ?>
                            
                        <?php endif; ?>
                    <?php endif; ?>
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
                <img src="<?php echo e(asset('frontend/assets/images/comparision-placeholder.jpeg')); ?>" class="vehicle-image"
                    alt="comparision">
                <div class="iconholder">
                    <?php if(Auth::check()): ?>
                        <a class="favourite-vehicle" title="Add to favorite" href="javascript:;"><button><i
                                    class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:void(0)" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        <?php if(!isset($simple)): ?>
                            
                        <?php endif; ?>
                    <?php else: ?>
                        <a title="Add to favorite" href="javascript:;" data-toggle="modal"
                            data-target="#login-alert"><button><i class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:;" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        <?php if(!isset($simple)): ?>
                            
                        <?php endif; ?>
                    <?php endif; ?>
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
                <img src="<?php echo e(asset('frontend/assets/images/comparision-placeholder.jpeg')); ?>" class="vehicle-image"
                    alt="comparision">
                <div class="iconholder">
                    <?php if(Auth::check()): ?>
                        <a class="favourite-vehicle" title="Add to favorite" href="javascript:;"><button><i
                                    class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:void(0)" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        <?php if(!isset($simple)): ?>
                            
                        <?php endif; ?>
                    <?php else: ?>
                        <a title="Add to favorite" href="javascript:;" data-toggle="modal"
                            data-target="#login-alert"><button><i class="fas fa-heart"></i></button></a>
                        <a title="Share" href="javascript:;" class="socialshare"><button><i
                                    class="fal fa-share-alt"></i></button></a>
                        <?php if(!isset($simple)): ?>
                            
                        <?php endif; ?>
                    <?php endif; ?>
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
<?php /**PATH /var/www/html/carjock/resources/views/frontend/compare-layouts/select-comparisions.blade.php ENDPATH**/ ?>