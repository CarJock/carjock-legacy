<?php $__env->startSection('login'); ?>


<!--start content-->
<main class="authentication-content">
    <div class="container-fluid">
        <div class="authentication-card">
        <div class="card shadow rounded-0 overflow-hidden">
            <div class="row g-0">
            <div class="col-lg-6 d-flex align-items-center border-end">
                <img src="<?php echo e(asset('admin/assets/images/login-bg.png')); ?>" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6">
                <?php if(session('status')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>
                <div class="card-body p-4 p-sm-5">
                <h5 class="card-title">Forgot Password?</h5>
                <p class="card-text mb-5">Don't worry; it happens to the best of us. If you've forgotten your password, we're here to help you get back on track.</p>
                <p>Please enter your registered email address below, and we'll send you instructions on how to reset your password. Once you receive the email, follow the steps to create a new password and regain access to your account.</p>
                <p>Remember to check your spam folder if you don't receive the email within a few minutes. </p>
                <p>Thank you for choosing CarJock. We're here to make your experience as smooth as possible.</p>
                <form class="form-body" method="POST" action="<?php echo e(route('password.email')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="inputEmailid" class="form-label">Email id</label>
                            <input type="email" class="form-control form-control-lg radius-30 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
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
                        <div class="col-12">
                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-lg btn-primary radius-30">Send</button>
                                        <a href="<?php echo e(route('login')); ?>" class="btn btn-lg btn-light radius-30">Back to Login</a>
                        </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</main>
        
       <!--end page main-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/auth/passwords/email.blade.php ENDPATH**/ ?>