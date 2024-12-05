<header class="top-header">
    <nav class="navbar navbar-expand w-100">
        <div class="mobile-toggle-icon d-xl-none">
            <i class="bi bi-list"></i>
        </div>
        <div class="top-navbar-right ms-3">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown dropdown-large">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                        <div class="user-setting d-flex align-items-center gap-1">
                            <img src="<?php echo e(asset('admin/assets/images/avatars/profile1.png')); ?>" alt="" class="rounded-circle" width="40" height="40">
                            <div class="user-name d-none d-sm-block"><?php echo e(Auth::user()->name); ?>

                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex align-items-center">
                                    
                                    <div class="ms-3">
                                        <h6 class="mb-0 dropdown-user-name"><?php echo e(Auth::user()->name); ?></h6>
                                        <small
                                            class="mb-0 dropdown-user-designation text-secondary"><?php echo e(Auth::user()->email); ?></small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item"
                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                                href="<?php echo e(route('logout')); ?>">
                                <div class="d-flex align-items-center">
                                    <div class="setting-icon"><i class="bi bi-lock-fill"></i></div>
                                    <div class="setting-text ms-3"><span>Logout</span></div>
                                </div>
                            </a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
<?php /**PATH /var/www/html/carjock/resources/views/admin/layouts/header.blade.php ENDPATH**/ ?>