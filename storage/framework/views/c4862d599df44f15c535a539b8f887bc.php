<header>
	<div class="main-header">
		<div class="container-fluid">
			<div class="menu-Bar">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<ul class="accoutNav mobile">
							<li>
								<a href="#"></a>
							</li>
							<li>
								<a href="<?php echo e(route('frontend.compare')); ?>"><img src="<?php echo e(asset('frontend/assets/images/profile.png')); ?>" alt="Profile">
									<span class="total-comparisions">0</span>
							</a></li>
							<?php if(Auth::check()): ?>
							<li><a href="<?php echo e(route('frontend.account.profile')); ?>"><i class="fal fa-user"></i><?php echo e(auth()->user()->username); ?></a></li>
							<?php else: ?>
							<li><a href="<?php echo e(route('frontend.account')); ?>"><i class="fal fa-user"></i></a></li>
							<?php endif; ?>

						</ul>
			<div class="row align-items-center">
				<div class="col-md-3 text-left">
					<a href="<?php echo e(url('/')); ?>" class="logo">
						<img src="<?php echo e(asset('frontend/assets/images/logo.png')); ?>" alt="">
					</a>
				</div>
				<div class="col-md-9 text-center">
					<div class="menuWrap">
						<ul class="menu">
							<li class="<?php echo e(request()->is('/') ? 'active' : ''); ?>"><a href="<?php echo e(route('frontend.home')); ?>">Find Your Next Car</a></li>
							<li class="<?php echo e(request()->is('compare') ? 'active' : ''); ?>"><a href="<?php echo e(route('frontend.compare')); ?>">Compare Vehicles </a></li>
							<li class="<?php echo e(request()->is('blogs') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/')); ?>/blogs">Blogs</a>
                            </li>
						</ul>
						<ul class="accoutNav desktop">
							<li>
								<a href="#"></a>
							</li>
							<li>
								<a href="<?php echo e(route('frontend.compare')); ?>"><img src="<?php echo e(asset('frontend/assets/images/profile.png')); ?>" alt="Profile">
									<span class="total-comparisions">0</span>
							</a></li>
							<?php if(Auth::check()): ?>
							<li><a href="<?php echo e(route('frontend.account.profile')); ?>"><i class="fal fa-user"></i><?php echo e(auth()->user()->username); ?></a></li>
							<?php else: ?>
							<li><a href="<?php echo e(route('frontend.account')); ?>"><i class="fal fa-user"></i>Login</a></li>
							<?php endif; ?>

						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<?php /**PATH /var/www/html/carjock/resources/views/frontend/layouts/header.blade.php ENDPATH**/ ?>