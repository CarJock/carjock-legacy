<div class="col-3">
    <div class="profile-img-box desktop-view">
        <div class="communityF-sec profile-link">
            <a class="<?php echo e(request()->is('account/profile') ? 'active' : ''); ?>" href="<?php echo e(route('frontend.account.profile')); ?>">
                <span>User Details</span>
                <img src="<?php echo e(asset('frontend/assets/images/filteroptionsarrow.png')); ?>">
            </a>
        </div>
       <hr>
       <div class="communityF-sec profile-link">
            <a class="<?php echo e(request()->is('account/profile/garage') ? 'active' : ''); ?>" href="<?php echo e(route('frontend.account.profile.garage')); ?>">
             <span>   My Garage </span>
                <img src="<?php echo e(asset('frontend/assets/images/filteroptionsarrow.png')); ?>">
            </a>
        </div>
       <hr>
       <div class="communityF-sec profile-link">
            <a class="<?php echo e(request()->is('account/profile/favourites') ? 'active' : ''); ?>" href="<?php echo e(route('frontend.account.profile.favourites')); ?>">
             <span>   Favorites</span>
                <img src="<?php echo e(asset('frontend/assets/images/filteroptionsarrow.png')); ?>">
            </a>
        </div>
       <hr>
        <div class="communityF-sec profile-link">
            <a class="<?php echo e(request()->is('account/profile/comparisions') ? 'active' : ''); ?>" href="<?php echo e(route('frontend.account.profile.comparisions')); ?>">
              <span>  Saved Comparisons </span>
                <img src="<?php echo e(asset('frontend/assets/images/filteroptionsarrow.png')); ?>">
            </a>
        </div>
       <hr>
       
        <div class="communityF-sec profile-link">
            <a class="<?php echo e(request()->is('account/profile/change-password') ? 'active' : ''); ?>" href="<?php echo e(route('frontend.account.profile.change-password')); ?>">
               <span> Change Password </span>

                <img src="<?php echo e(asset('frontend/assets/images/filteroptionsarrow.png')); ?>">
            </a>
        </div>
       <hr>
       <div class="communityF-sec profile-link">
            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="<?php echo e(route('logout')); ?>">
               <span> Log out </span>
                <img src="<?php echo e(asset('frontend/assets/images/filteroptionsarrow.png')); ?>">
            </a>
        </div>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
        </form>
    </div>


    <div class="mobile-sidebar mobile-view">
       <div class="sidebar-toggle" onclick="toggleSidebar()">
             <div class="bar"></div>
       </div>
       <div class="profile-img-box mobile-view">
          <div class="user-detail-sec profile-link active" data-profile="UserDetail"> User Details <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png"></div>
          <hr>
          <div class="gerage-sec profile-link" data-profile="Grage">Garage <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png"></div>
          <hr>
          <div class="fav-sec profile-link" data-profile="Favourite"> Favourites <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png"></div>
          <hr>
          <div class="communityF-sec profile-link" data-profile="SaveComparetions">Saved Comparison <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png"></div>
          <hr>
          
          <div class="communityF-sec profile-link" data-profile="changepass">Change Password <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png"></div>
          <hr>
          <div class="signout-sec profile-link" data-profile="SignOut">Sign Out <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png"></div>
          <hr>
       </div>
    </div>

    <div class="box">
    <?php $ads_img = \App\Models\Ads::getSingleAds(17);
        if (isset($ads_img->image) && $ads_img->image != "") {
            $ads_logs = new \App\Models\AdsLogs;
            $ads_logs->page_id = 17;
            $ads_logs->type = "view";
            $ads_logs->save();
    ?>
        <a href="<?php echo e($ads_img->link); ?>" target="_blank" onclick="adsClicks(8);">
           <img src="<?php echo e(url('storage/ads/'.$ads_img->image)); ?>" height="280" width="336">
        </a>
    <?php
        }
    ?>
    </div>
 </div>
<?php /**PATH /var/www/html/carjock/resources/views/frontend/auth/sidebar.blade.php ENDPATH**/ ?>