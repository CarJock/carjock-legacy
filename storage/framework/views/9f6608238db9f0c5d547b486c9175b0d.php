<?php $__env->startSection('content'); ?>
<div class="mainBanner bannerheightadjust"
    style="background-image:url(<?php echo e(asset('frontend/assets/images/image\ \(4\).png')); ?>); background-size: cover; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row">
            <div class="mainbanneroverlay">
                <h2>Register</h2>
                <div class="breadcrumb">
                    <ul>
                        <li>Home</li>
                        <li>Register</li>
                    </ul>
                </div>
            </div>
            <!-- <img src="<?php echo e(asset('frontend/assets/images/banner/redchevcaomparebanner.jpg')); ?>" alt=""> -->
        </div>
    </div>
</div>
</section>



<section class="log_new pb-5 pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 right-sec">
                <div class="register-form" style="background: #fff !important">
                    <h2 class="text-center">Register</h2>
                    <hr>
                    <div style="text-align: center;">
                        <a class="" href="<?php echo e(route('frontend.facebook.login')); ?>" style="max-width: 35%; display: inline-block;">
                            <img src="<?php echo e(URL('continue_with_fb.png')); ?>" alt="Facebook Login">
                        </a>
                    </div>
                    
                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0">Or</p>
                    </div>
                    <form action="<?php echo e(route('frontend.register')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <!-- Name input -->
                        <div class="mb-4">
                            <label class="" for="firstName">First Name*</label>
                            <input type="text" id="firstName" placeholder="First Name"
                                   class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="first_name"
                                   value="<?php echo e(old('first_name')); ?>" required autofocus />
                            <?php $__errorArgs = ['first_name'];
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

                        <div class="mb-4">
                            <label class="" for="lastName">Last Name*</label>
                            <input type="text" id="lastName" placeholder="Last Name"
                                   class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="last_name"
                                   value="<?php echo e(old('last_name')); ?>" required />
                            <?php $__errorArgs = ['last_name'];
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

                        <div class="mb-4">
                            <label class="" for="username">Username (If not entered, system will generate)</label>
                            <input type="text" id="username" placeholder="Username"
                                   class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="username"
                                   value="<?php echo e(old('username')); ?>" />
                            <?php $__errorArgs = ['username'];
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

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="registerEmail">Email Address*</label>
                            <input type="email" id="registerEmail" placeholder="Email"
                                   class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                   value="<?php echo e(old('email')); ?>" required autocomplete="email" />
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

                        <!-- Location input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="Country">Location*</label>
                            <select name="country" class="form-control" required>
                                <option value="">Location</option>
                                <option value="usa">USA</option>
                                <option value="canada">CANADA</option>
                                <option value="japan">JAPAN</option>
                            </select>
                            <?php $__errorArgs = ['country'];
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

                        <!-- City input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="city">City*</label>
                            <input type="text" id="city" placeholder="City"
                                   class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="city"
                                   value="<?php echo e(old('city')); ?>" required autocomplete="city" />
                            <?php $__errorArgs = ['city'];
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

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="registerPassword">Password</label>
                            <input type="password" id="registerPassword" placeholder="*****"
                                   class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required
                                   autocomplete="new-password" />
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

                        <!-- Confirm Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="registerRepeatPassword">Confirm password</label>
                            <input type="password" id="registerRepeatPassword" placeholder="*****"
                                   class="form-control" name="password_confirmation" required autocomplete="new-password" />
                        </div>

                        <!-- Checkbox -->
                        <div class="form-check d-flex mb-4">
                            <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked
                                   aria-describedby="registerCheckHelpText" />
                            <label class="form-check-label mt-2 ml-2" for="registerCheck">
                                I agree to the <a style="text-decoration: underline" href="<?php echo e(route('frontend.term-conditions')); ?>">Terms & Policy</a>
                            </label>
                        </div>
                        <button type="submit" class="register-btn">Register</button>
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
.mainbanneroverlay .breadcrumb {
    width: 400px;
    margin: 0 auto
}

.mainbanneroverlay {
    top: 35%
}

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
    width: 50%;
    background: #Fff;
    padding: 40px 65px;
    margin: 30px auto 50px;
    border-radius: 10px;
    box-shadow: 1px 2px 16px #E3E3E3;
    /* text-align: center; */
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
    background-image: url(<?php echo e(asset('frontend/assets/images/facebook.png')); ?>);
background-position: center;
background-size: contain;
position: absolute;
width: 35px;
top: 5px;
left: 30px;
height: 32px;
background-repeat: no-repeat;
}

a.btn.button_facebook_cus {
    margin-top: 20px;
    width: 60%;
    padding: 10px;
    background: transparent;
    border: 1px solid blue;
    color: blue;
}

.login-form button {
    position: relative;
}

.register-form h2 {
    font-size: 26px;
    color: #141414;
    font-weight: 500;
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

select {
    border: 1px solid #C3C3C3;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    height: 50px !important;
    width: 100%
}

select {
    -moz-appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background: transparent;
    background-image: url({{ asset('frontend/assets/images/arrowdn.png')
}
}

);
background-repeat: no-repeat;
background-position-x: 95%;
background-position-y: 21px;
background-size: inherit;
cursor:pointer;
}
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', ['class' => 'login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/frontend/auth/register.blade.php ENDPATH**/ ?>