<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div><a href="#">
                <img src="<?php echo e(asset('admin/assets/images/logo-icon.png')); ?>" class="logo-icon" alt="logo icon">
        </a></div>
        <div>
            <a href="<?php echo e(route('admin.dashboard')); ?>">
                <h4 class="logo-text"><img src="<?php echo e(asset('admin/assets/images/logo-text.png')); ?>" alt="Carjock"></h4></a>
        </div>
        <div class="toggle-icon ms-5"><i class="bi bi-chevron-double-left"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="<?php echo e(route('admin.dashboard')); ?>">
                <div class="parent-icon"><i class="bi bi-house-door"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <hr>
        <li>
            <a href="<?php echo e(route('admin.user.index')); ?>">
                <div class="parent-icon"><i class="bi bi-people"></i>
                </div>
                <div class="menu-title">User Management</div>
            </a>
        </li>
        <hr>
        <li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bi bi-credit-card-2-front"></i>
                    </div>
                    <div class="menu-title">Content Management</div>
                </a>
                <ul>
                    <li><a href="<?php echo e(route('admin.contents.index')); ?>"><i class="bi bi-arrow-right-short"></i>Home Page</a></li>
                    <li><a href="<?php echo e(route('admin.contents.edit', 5)); ?>"><i class="bi bi-arrow-right-short"></i>FAQs</a></li>
                    <li><a href="<?php echo e(route('admin.contents.edit', 6)); ?>"><i class="bi bi-arrow-right-short"></i>Footer</a></li>
                    <li><a href="<?php echo e(route('admin.contents.edit', 8)); ?>"><i class="bi bi-arrow-right-short"></i>Contact Us</a></li>
                    <li><a href="<?php echo e(route('admin.contents.edit', 9)); ?>"><i class="bi bi-arrow-right-short"></i>My Garage</a></li>
                    <li><a href="<?php echo e(route('admin.contents.edit', 10)); ?>"><i class="bi bi-arrow-right-short"></i>Favourites</a></li>
                    <li><a href="<?php echo e(route('admin.contents.edit', 11)); ?>"><i class="bi bi-arrow-right-short"></i>Save Comparisions</a></li>
                    <li><a href="<?php echo e(route('admin.contents.edit', 12)); ?>"><i class="bi bi-arrow-right-short"></i>About Us</a></li>
                    <li><a href="<?php echo e(route('admin.contents.edit', 13)); ?>"><i class="bi bi-arrow-right-short"></i>Disclaimer</a></li>
                    <li><a href="<?php echo e(route('admin.contents.edit', 14)); ?>"><i class="bi bi-arrow-right-short"></i>Privacy Policy</a></li>    
                    <li><a href="<?php echo e(route('admin.contents.edit', 15)); ?>"><i class="bi bi-arrow-right-short"></i>Terms & Conditions</a></li>
                    <li><a href="<?php echo e(route('admin.contents.edit', 16)); ?>"><i class="bi bi-arrow-right-short"></i>Change Password</a></li>
                    <li><a href="<?php echo e(route('admin.contents.edit', 17)); ?>"><i class="bi bi-arrow-right-short"></i>Thank you</a></li>
                </ul>
            </li>
        </li>
        <hr>
        <li>
            <a href="<?php echo e(route('admin.metaTags.index')); ?>">
                <div class="parent-icon"><i class="bi bi-file-earmark-break"></i>
                </div>
                <div class="menu-title">Meta Tags</div>
            </a>
        </li>
        <hr>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-credit-card-2-front"></i>
                </div>
                <div class="menu-title">Ads Management</div>
            </a>
            <ul>
                <li>
                    <a href="<?php echo e(route('admin.ads.index')); ?>">
                        <div class="parent-icon"><i class="bi bi-file-earmark-break"></i>
                        </div>
                        <div class="menu-title">Ads</div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.adslogs.index')); ?>">
                        <div class="parent-icon"><i class="bi bi-file-earmark-break"></i>
                        </div>
                        <div class="menu-title">Ads Logs</div>
                    </a>
                </li>
            </ul>
        </li>
        <hr>
        <li>
            <a href="<?php echo e(route('admin.banners.index')); ?>">
                <div class="parent-icon"><i class="bi bi-file-earmark-break"></i>
                </div>
                <div class="menu-title">Top Banners</div>
            </a>
        </li>
        <hr>
        <li>
            <a href="<?php echo e(route('admin.media.index')); ?>">
                <div class="parent-icon"><i class="bi bi-file-earmark-break"></i>
                </div>
                <div class="menu-title">Social Media links</div>
            </a>
        </li>
        <hr>
        <li>
            <a href="<?php echo e(route('admin.faqs.index')); ?>">
                <div class="parent-icon"><i class="bi bi-file-earmark-break"></i>
                </div>
                <div class="menu-title">FAQs</div>
            </a>
        </li><hr>
        <li>
            <a href="<?php echo e(route('admin.subscription.index')); ?>">
                <div class="parent-icon"><i class="bi bi-exclamation-triangle"></i>
                </div>
                <div class="menu-title">Subscriptions</div>
            </a>
        </li>
        <hr>
        <li>
            <a href="<?php echo e(route('admin.contact.index')); ?>">
                <div class="parent-icon"><i class="bi bi-file-earmark-break"></i>
                </div>
                <div class="menu-title">Contact Us</div>
            </a>
        </li>
        <hr>
        <li>
            <a href="<?php echo e(route('admin.vehicle-model.index')); ?>">
                <div class="parent-icon"><i class="bi bi-people"></i>
                </div>
                <div class="menu-title">Vehicle Manufacturers</div>
            </a>
        </li>
        <hr>

        <li>
            <a href="<?php echo e(route('admin.vehicles.index')); ?>">
                <div class="parent-icon"><i class="bi bi-file-earmark-break"></i>
                </div>
                <div class="menu-title">Featured Cars</div>
            </a>
        </li>
        <hr>
        
        
        <li>
            <a href="<?php echo e(route('admin.setting.show')); ?>">
                <div class="parent-icon"><i class="bi bi-gear"></i>
                </div>
                <div class="menu-title">Settings</div>
            </a>
        </li>
        


    </ul>
    <!--end navigation-->
</aside>
<?php /**PATH /var/www/html/carjock/resources/views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>