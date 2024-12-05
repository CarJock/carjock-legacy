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
         <?php echo $__env->make('frontend.auth.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
           
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
.content {
  background-color: $white;
  display: flex;
  justify-content: center;
  width: 60px;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
position: absolute;
    cursor: pointer;
    top: 0px;
    left: 17px;
    right: -15px;
    bottom: 0px;
    background-color: #918f8f;
    transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: .4s;
}

input:checked + .slider {
  background-color:#7abe44;
}


input:checked + .slider:before {
  transform: translateX(26px);
}

.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

label.toggle-label {
    width: 220px;
    margin: 25px 0px;
        font-size: 16px;
    font-family: 'Poppins';
}
ul.index-slider.slick-initialized.slick-slider img:hover {
    transform: scale(1.2);
}
ul.index-slider.slick-initialized.slick-slider img{
transition: 0.6s ease all;
}

</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', ['class' => 'login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/frontend/auth/account.blade.php ENDPATH**/ ?>