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
         <div class="col-3">
            <?php echo $__env->make('frontend.auth.profile-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="box">
                  <img src="<?php echo e(asset('frontend/assets/images/sidebarads336x280.png')); ?>">
               </div>
         </div>
         
         <div class="col-9">
            <div class="row">
               <div class="relatedCar text-center">
                  <h3>MY GARAGE</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore<br> magna aliqua enim ad minim veniam, quis nostrud</p>
               </div>
            </div>
            <div class="row">
               <?php if($vehicles->isNotEmpty()): ?>
                  <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php ($detail = json_decode($vehicle->data)); ?>
                     <?php echo $__env->make('frontend.vehicle', ['vehicle' => $vehicle, 'detail' => $detail, 'cols' => 'col-md-4'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php else: ?>
                  <h2 style="font-size: 30px;margin:0 auto">No vehicles saved.</h2>
               <?php endif; ?>
               <div class="img_box">
                  <img src="<?php echo e(asset('frontend/assets/images/Group 454.png')); ?>">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/profile.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', ['class' => 'login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/frontend/auth/profile.blade.php ENDPATH**/ ?>