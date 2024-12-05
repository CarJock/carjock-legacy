<?php $__env->startSection('content'); ?>
<div class="mainBanner bannerheightadjust" style="background-image:url(<?php echo e(asset('frontend/assets/images/bg.png')); ?>); background-size: cover; background-repeat: no-repeat;">
   <div class="container-fluid">
      <div class="row">
         <div class="mainbanneroverlay">
            <h2>MY PROFILE</h2>
            <div class="breadcrumb">
               <ul>
                  <li>Home</li>
                  <li><?php echo e($user->name); ?></li>
               </ul>
            </div>
         </div>
         <!-- <img src="<?php echo e(asset('frontend/assets/images/banner/redchevcaomparebanner.jpg')); ?>" alt=""> -->
      </div>
   </div>
</div>

<section class="profile">
   <div class="container">
        <div class="row">
            <?php echo $__env->make('frontend.auth.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
            <!--User-profile-->         
            <div class="col-9 profile-details" id="UserDetail" data-card="UserDetail">
                <div class="relatedCar text-center">
                    <h3><?php echo e($page_content->heading); ?></h3>
                    <p><?php echo e($page_content->content); ?></p>
                </div>
                <div class="row">
                    <?php if($vehicles->isNotEmpty()): ?>
                    <?php ($count = 1); ?>
                        <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php ($detail = json_decode($vehicle->data)); ?>
                            <?php echo $__env->make('frontend.vehicle', ['vehicle' => $vehicle, 'detail' => $detail, 'cols' => 'col-md-4'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <h2 class="text-center" style="font-size: 30px;margin:0 auto;padding-left:70px">No vehicles found.</h2>
                    <?php endif; ?>
                </div>
            </div> 

            <!--User-profile-End-->
           
        </div>
   </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/profile.css')); ?>" />
<style>
label.form-label {
   margin-top: 25px;
}
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', ['class' => 'login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/frontend/auth/favourites.blade.php ENDPATH**/ ?>