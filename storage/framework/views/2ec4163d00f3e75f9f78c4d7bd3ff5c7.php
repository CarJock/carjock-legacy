<div class="profile-img-box">
   <div class="top-sec">
      <div class="profile-image">
         <?php if($user->image): ?>
         <img src="<?php echo e(substr($user->image, 0, 4) == "http" ? $user->image : asset('storage/'.$user->image)); ?>"  style="border: 2px solid #86c440;border-radius: 50%;padding: 3px;width:150px;height:150px">
         <?php else: ?>
         <img src="<?php echo e(asset('frontend/assets/images/profile-img1.jpg')); ?>">
         <?php endif; ?>
      </div>
      <div class="user-email">
         <h4><?php echo e($user->name); ?></h4>
         <p><?php echo e($user->email); ?></p>
      </div>
   </div>
   <hr>
   <div class="bottom-sec">
      <a href="<?php echo e(route('frontend.account.profile.edit')); ?>">Edit Profile</a>
      <a href="<?php echo e(route('frontend.account.profile')); ?>">Profile</a>
      <a href="<?php echo e(route('frontend.account.comparisions')); ?>">My Comparisions</a>
      <a class="signout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="<?php echo e(route('logout')); ?>">
            Sign Out
         </a>
         <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
         <?php echo csrf_field(); ?>
      </form>
   </div>
</div><?php /**PATH /var/www/html/carjock/resources/views/frontend/auth/profile-sidebar.blade.php ENDPATH**/ ?>