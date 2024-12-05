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
                <div class="container mt-4">
                    <?php if($message = Session::get('message')): ?>
                        <div class="alert alert-success alert-block">
                            <?php echo e($message); ?>

                        </div>
                    <?php endif; ?>

                    <form class="profile-edit-form" action="<?php echo e(route('frontend.account.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?> 
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="registerUsername">Old Password*</label>
                                <input type="password" name="old_password" class="form-control" placeholder="" />
                                <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <?php if($error = Session::get('error')): ?>
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong><?php echo e($error); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label" for="registerUsername">New Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" />
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label" for="registerUsername">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="" />
                                <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
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
<?php echo $__env->make('frontend.layouts.app', ['class' => 'login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/frontend/auth/change-password.blade.php ENDPATH**/ ?>