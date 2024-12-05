<?php $__env->startSection('content'); ?>
<div class="mainBanner bannerheightadjust"
    style="background-image:url(<?php echo e(url('storage/banners/'.$banner->image)); ?>); background-size: cover; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row">
            <div class="mainbanneroverlay">
                <h2><?php echo e($banner->heading); ?></h2>
                <div class="breadcrumb">
                    <ul>
                        <li>Home</li>
                        <li>Login</li>
                    </ul>
                </div>
            </div>
            <!-- <img src="<?php echo e(asset('frontend/assets/images/banner/redchevcaomparebanner.jpg')); ?>" alt=""> -->
        </div>
    </div>
</div>
</section>



<section class="log_new">
    <div class="container-fluid">
        
    <div class="row">
        <div class="col-12 left-sec">
            <div class="login-form">
                <h2 class="text-center"><?php echo e($banner->heading); ?></h2>
                <hr>
                <?php if($message = Session::get('message')): ?>
                    <div class="alert alert-danger alert-block">
                        <?php echo e($message); ?>

                    </div>
                <?php endif; ?>
                <a href="<?php echo e(route('frontend.facebook.login')); ?>" style="max-width: 35%">
                    <img src="<?php echo e(URL('continue_with_fb.png')); ?>" alt="Facebook Login">
                </a>

                
                <div class="divider d-flex align-items-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0">Or</p>
                </div>
                <?php if(request()->has('redirect')): ?>
                <form action="<?php echo e(route('frontend.login', ['redirect' => route('frontend.compare')])); ?>" method="POST">
                    <?php else: ?>
                    <form action="<?php echo e(route('frontend.login')); ?>" method="POST">
                        <?php endif; ?>
                        <?php echo csrf_field(); ?>
                        

            <div class="form-outline mb-4">
                <input type="text"
                    class="form-control <?php echo e($errors->has('username') || $errors->has('email') ? ' is-invalid' : ''); ?>"
                    name="login" value="<?php echo e(old('username') ?: old('email')); ?>" autocomplete="email" autofocus
                    placeholder="Email">

                <?php if($errors->has('username') || $errors->has('email')): ?>
                <span class="invalid-feedback">
                    <strong><?php echo e($errors->first('username') ?: $errors->first('email')); ?></strong>
                </span>
                <?php endif; ?>
            </div>

            <div class="form-outline mb-3">
                <label class="form-label" for="form3Example4">Password</label>
                <input type="password" id="form3Example4"
                    class="form-control form-control-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Password"
                    name="password" required autocomplete="current-password" />
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
            <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                <div class="form-check mb-0">
                    <input class="form-check-input me-2" type="checkbox" name="remember" id="remember"
                        <?php echo e(old('remember') ? 'checked' : ''); ?> />
                    <label class="form-check-label" for="form2Example3">
                        Remember me
                    </label>
                </div>
                <a href="<?php echo e(route('frontend.password.request')); ?>" class="text-body">Forgot password?</a>
            </div>
            <div class=" text-lg-start mt-4 pt-2">
                <button type="submit" class="register-btn">Login</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="<?php echo e(route('frontend.register')); ?>"
                        class="link-danger">Register</a></p>
            </div>
            <!-- <button type="button" class="register-btn">Login <img src="assets/images/right-arrow.png" alt="">
                      </button> -->
            </form>
        </div>
    </div>
    </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/login.css')); ?>" />
<style>
section.log_new {
    background-color: #F0F0F0;
    padding-top: 50px;
}

section.log_new .col-6.right-sec {
    background: #f5f5f5;
    padding: 10rem 5rem 4rem;
}

section.log_new .col-6.left-sec {
    padding: 10rem 5rem 4rem;
    text-align: center;
}

.login-form,
.register-form {
    display: block;
    width: 55%;
    background: #Fff;
    padding: 40px 65px;
    margin: 30px auto 50px;
    border-radius: 10px;
    box-shadow: 1px 2px 16px #E3E3E3;
    text-align: center;
}

.login-form h2 {
    font-size: 26px;
    color: #141414;
    font-weight: 500;
}

a.btn.button_facebook_cus {
    position: relative
}

a.btn.button_facebook_cus::before {
    content: "";
    background-image: url({{ asset('frontend/assets/images/facebook.png')
}
}

);
background-position: center;
background-size: contain;
position: absolute;
width: 35px;
top: 5px;
left: 30px;
height: 32px;
background-repeat: no-repeat;
}

.login-form button {
    position: relative;
}

.register-form h2 {
    font-size: 26px;
    color: #141414;
    font-weight: 500;
}

a.btn.button_facebook_cus {
    margin-top: 20px;
    width: 60%;
    padding: 10px;
    background: transparent;
    border: 1px solid blue;
    color: blue;
}

.log_new .btn {
    margin-top: 20px;
    width: 100%;
    padding: 10px;
    background: transparent;
    border: 1px solid blue;
    color: blue;
}

input#exampleInputEmail1 {
    border: 1px solid rgb(211, 205, 205);
    padding: 25px;
    width: 100%;
    border-radius: 7px;
    margin-top: 10px;
}

button.register-btn {
    background-image: linear-gradient(to left, #86c440, #6cbb4b, #54b155, #3ca65c, #239b62);
    color: #fff;
    font-size: 16px;
    padding: 11px 20px;
    border-radius: 4px;
    margin-top: 20px;
}

button.register-btn img {
    width: 11px;
    margin-left: 10px;
}

section.log_new .addbanner img {
    width: 800px;
    text-align: center;
    display: block;
    margin: 0px auto 40px;
}

section.log_new textarea,
section.log_new input[type] {
    border: 1px solid #C3C3C3;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    padding: 25px 20px;
}

section.log_new label {
    margin-bottom: 8px;
    margin-top: 5px;
    margin-left: 9px;
}

input.form-check-input.me-2 {
    margin-top: 1px;
}

.divider:after,
.divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
}

.h-custom {
    height: calc(100% - 73px);
}

@media (max-width: 450px) {
    .h-custom {
        height: 100%;
    }

}





select#parent_selector {
    border: 1px solid #C3C3C3;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    padding: 25px 20px;

}
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', ['class' => 'login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/frontend/auth/login-register.blade.php ENDPATH**/ ?>