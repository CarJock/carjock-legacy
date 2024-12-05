<?php $__env->startSection('content'); ?>
<div class="mainBanner bannerheightadjust" style="background-image:url(<?php echo e(asset('frontend/assets/images/bg.png')); ?>); background-size: cover; background-repeat: no-repeat;">
    <div class="container-fluid">
       <div class="row">
          <div class="mainbanneroverlay">
             <h2>Edit Profile</h2>
             <div class="breadcrumb">
                <ul>
                   <li>Home</li>
                   <li>Edit Profile</li>
                </ul>
             </div>
          </div>
          <!-- <img src="assets/images/banner/redchevcaomparebanner.jpg" alt=""> -->
       </div>
    </div>
</div>
<section class="profile">
    <div class="container">
       <div class="row">
          <div class="col-3">
             <div class="profile-img-box">
                <div class="top-sec">
                   <div class="profile-image">
                     <?php if($user->image): ?>
                     <img src="<?php echo e(substr($user->image, 0, 4) == "http" ? $user->image : asset('storage/'.$user->image)); ?>"  style="border: 2px solid #86c440;border-radius: 50%;padding: 3px;width:150px;height:150px">
                     <?php else: ?>
                     <img src="<?php echo e(asset('frontend/assets/images/placeholder-user.jpg')); ?>">
                     <?php endif; ?>
                   </div>
                   <div class="user-email">
                      <h4><?php echo e($user->name); ?></h4>
                      <p><?php echo e($user->email); ?></p>
                   </div>
                </div>
                <hr>
                <div class="bottom-sec">
                  <a href="<?php echo e(route('frontend.account.comparisions')); ?>">My Comparisions</a>
                  
                   <a class="signout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="<?php echo e(route('logout')); ?>">
                        Sign Out
                    </a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                        <?php echo csrf_field(); ?>
                  </form>
                </div>
             </div>
             <div class="box">
                <img src="<?php echo e(asset('frontend/assets/images/sidebarads336x280.png')); ?>">
             </div>
          </div>
          <div class="col-9">
             <div class="hendsec">
                <h2>Edit Profile</h2>
                <p>lorem dolor sit amet dolor ispum Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam sit rerum hic aliquid, architect</p>
             </div>
            <?php if($message = Session::get('message')): ?>
                <div class="alert alert-success alert-block">
                    <?php echo e($message); ?>

                </div>
            <?php endif; ?>
            <form class="profile-edit-form" action="<?php echo e(route('frontend.account.profile.update')); ?>" method="POST" enctype="multipart/form-data">
               <?php echo csrf_field(); ?> 
               <div class="row">
                     <div class="col-md-12">
                     <label class="form-label" for="registerUsername">Profile Picture*</label>
                     <input type="file" name="image" class="form-control" />
                     <?php $__errorArgs = ['image'];
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
                    </div>
                   <div class="col-md-6">
                      <label class="form-label" for="registerUsername">First Name*</label>
                      <input type="text" name="firstname" class="form-control" placeholder="Firstname" value="<?php echo e(old('firstname') ?? ($user->firstname ?? $user->name)); ?>"/>
                      <?php $__errorArgs = ['firstname'];
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
                     </div>
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
                           <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($error); ?></strong>
                           </span>
                     <?php endif; ?>
                     </div>
                   <div class="col-md-6">
                      <label class="form-label" for="registerUsername">Last Name*</label>
                      <input type="text" name="lastname" class="form-control" placeholder="Lastname" value="<?php echo e(old('lastname') ?? $user->lastname); ?>"/>
                      <?php $__errorArgs = ['lastname'];
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
                     </div>
                   <div class="col-md-6">
                      <label class="form-label" for="registerUsername">New Password</label>
                      <input type="password" name="password" class="form-control" placeholder="" />
                      <?php $__errorArgs = ['password'];
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
                     </div>
                   <div class="col-md-6">
                      <label class="form-label" for="registerEmail">Email Address*</label>
                      <input type="email" disabled name="email" id="registerEmail" class="form-control" value="<?php echo e(old('email') ?? $user->email); ?>" placeholder="Your Email" />
                      <?php $__errorArgs = ['email'];
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
                     </div>
                   <div class="col-md-6">
                      <label class="form-label" for="registerUsername">Confirm Password</label>
                      <input type="password" name="password_confirmation" class="form-control" placeholder="" />
                      <?php $__errorArgs = ['password_confirmation'];
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
                     </div>
                </div>
                <div class="row">
                   <div class="col-md-12">
                      <button type="submit" class="save-btn">Save <img src="<?php echo e(asset('frontend/assets/images/right-arrow.png')); ?>" alt=""></button>
                      
                   </div>
                </div>
             </form>
          </div>
       </div>
    </div>
</div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/edit-profile.css')); ?>" />
<style>
   .invalid-feedback{display:block}
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', ['class' => 'login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/frontend/auth/edit-profile.blade.php ENDPATH**/ ?>