<?php $__env->startSection('content'); ?>

<section class="thankyou">


   <div class="forgot">
      <!--<div class="addbanner text-center">-->
      <!--   <img src="assets/images/adbanner920x90.svg" alt="">-->
      <!--</div>-->
   </div>
   <section class="second pb-4">
      <div class="container">
        
            <!--<div class="col-4">-->
            <!--   <img src="assets/images/Group 504.png" alt="">-->
            <!--</div>-->
            <div class="col-12">
               <h1>Forgot Password?</h1>
               <p>Don't worry; it happens to the best of us. If you've forgotten your password, we're here to help you get back on track.</p>
               <p>Please enter your registered email address below, and we'll send you instructions on how to reset your password. Once you receive the email, follow the steps to create a new password and regain access to your account.</p>
                <p>Remember to check your spam folder if you don't receive the email within a few minutes. </p>
                <p>Thank you for choosing CarJock. We're here to make your experience as smooth as possible.</p>
               <p>Email</p>
               <form method="POST" action="<?php echo e(route('frontend.password.email')); ?>">
                  <?php echo csrf_field(); ?>
                  <input type="email" id="exampleInputEmail1" placeholder="e.g./ name@domain.com" class="form-control <?php $__errorArgs = ['email'];
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
                     <span class="invalid-feedback" style="font-size:15px" role="alert">
                           <strong><?php echo e($message); ?></strong>
                     </span>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  <button type="submit" class="btn">Reset Password</button>
               </form>
            </div>
       
      </div>
   </section>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .thank {
    padding-top: 7%;
}

.thankyou .second img {
    padding-top: 10%;
}

.thankyou .second .col-12 {
    font-size: 35px;
    font-weight: 700;
    padding: 0% 66px 14%;
    text-align: center;
    margin-bottom: 60px;
}

.thankyou .second .col-12 {
    font-size: 35px;
    font-weight: 700;
    padding: 3% 66px 0px;
    text-align: center;
    margin-bottom: 110px;
}

.thankyou .second h1 {
    border-bottom: 1px solid rgb(211, 205, 205);
    width: 95%;
    padding: 25px 0;
}

.thankyou .second p {
    padding-top: 20px;
}

.thankyou .second .btn {
    background: #86c440;
    background: linear-gradient(-93deg, #86c440 0.00%, #239b62 100.00%);
    color: white;
    margin-top: 30px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
    margin: 0 auto;
}

.thankyou .second .btn img {
    height: 30px;
    padding: 8px;
}

.forgot .second .btn {
    background: #86c440;
    background: linear-gradient(-93deg, #86c440 0.00%, #239b62 100.00%);
    color: white;
    margin-top: 10px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
}

.forgot .second .btn img {
    height: 30px;
    padding: 8px;
}

.forgot {
    padding-top: 10%;
    display: block;
    margin: auto;
    width: 50%;
}

.forgot .second img {
    padding-top: 10%;
}

.form-control, input#exampleInputEmail1 {
    border: 1px solid rgb(211, 205, 205) !important;
    padding: 25px !important;
    width: 100%;
    border-radius: 7px !important;
    margin-top: 10px;
}

.login .selectedcarsfeature_dis img {
    width: 50%;
    padding-top: 5%;
}

.login .log_new h1 {
    font-size: 22px;
    border-bottom: 1px solid rgb(211, 205, 205);
    width: 90%;
    padding: 25px 0;
}

.log_new .btn {
    margin-top: 20px;
    width: 60%;
    padding: 10px;
    background: transparent;
    border: 1px solid blue;
    color: blue;
}

.form-control, input#exampleInputEmail1 {
    width: 50%;
    margin: 20px auto;
}

@media screen and (max-width: 767px){
    .form-control, input#exampleInputEmail1{ width: 100%;}
    .thankyou .second .col-12{padding: 13% 20px 0px !important;    margin-bottom: 40px;}
}

    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/frontend/auth/passwords/email.blade.php ENDPATH**/ ?>