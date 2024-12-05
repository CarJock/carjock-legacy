<!--User-profile-->
<style>
    .custom-file-upload {
        cursor: pointer;
        background-color: #007bff;
        color: #fff;
        border-radius: 5px;
        position: absolute;
        top: 0px;
        left: 0px;
        border: none !important;
        padding-top: 8px;
        padding-bottom: 8px !important;
        padding-right: 4px;
    }

    .custom-file-upload:hover {
        background-color: #0056b3;
    }
</style>
<div class="col-9 profile-details" id="UserDetail" data-card="UserDetail">
    <div class="top-sec">
        <div class="profile-image">
            <?php if($user->image): ?>
                <img src="<?php echo e(substr($user->image, 0, 4) == 'http' ? $user->image : asset('storage/' . $user->image)); ?>"
                    style="border: 2px solid #86c440;border-radius: 50%;padding: 3px;width:150px;height:150px">
            <?php else: ?>
                <img src="<?php echo e(asset('frontend/assets/images/placeholder-user.jpg')); ?>"
                    style="border: 2px solid #86c440;border-radius: 50%;padding: 3px;width:150px;height:150px">
            <?php endif; ?>
        </div>
        <div class="user-email" style="margin-top: 13px">
            <h4><?php echo e($user->username); ?></h4>
            
        </div>
    </div>
    <div class="container mt-4">
        <?php if($message = Session::get('message')): ?>
            <div class="alert alert-success alert-block">
                <?php echo e($message); ?>

            </div>
        <?php endif; ?>
        <form class="profile-edit-form" action="<?php echo e(route('frontend.account.profile.update')); ?>" method="POST"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="registerUsername">Profile Picture*</label>
                    <div class="form-control position-relative">
                        <input class="mb_setting_format"
                            style="position: absolute; top: 4px; left: 36px; width: 369px ; border: none !important"
                            type="file" name="image" id="imageInput" />
                        <label for="imageInput" class="custom-file-upload">Upload a picture</label>
                    </div>
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
                    <label class="form-label" for="registerUsername">Username*</label>
                    <input type="text" name="username" class="form-control" placeholder="Username"
                        value="<?php echo e(old('username') ?? ($user->username ?? $user->username)); ?>" />
                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="registerUsername">First Name*</label>
                    <input type="text" name="firstname" class="form-control" placeholder="Firstname"
                        value="<?php echo e(old('firstname') ?? ($user->firstname ?? $user->name)); ?>" />
                    <?php $__errorArgs = ['firstname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="registerUsername">Last Name*</label>
                    <input type="text" name="lastname" class="form-control" placeholder="Lastname"
                        value="<?php echo e(old('lastname') ?? $user->lastname); ?>" />
                    <?php $__errorArgs = ['lastname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="registerEmail">Email Address*</label>
                    <input type="email" disabled name="email" id="registerEmail" class="form-control"
                        value="<?php echo e(old('email') ?? $user->email); ?>" placeholder="Your Email" />
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="country">Country*</label>
                    <select name="country" id="country" class="form-control">
                        <option value="">Select your country</option>
                        <option value="usa" <?php echo e((old('country') ?? $user->country) == 'usa' ? 'selected' : ''); ?>>
                            United States</option>
                        <option value="canada" <?php echo e((old('country') ?? $user->country) == 'canada' ? 'selected' : ''); ?>>
                            Canada</option>
                        <option value="japan" <?php echo e((old('country') ?? $user->country) == 'japan' ? 'selected' : ''); ?>>
                            Japan</option>
                        <!-- Add more country options as needed -->
                    </select>
                    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="city">City*</label>
                    <input type="text" name="city" id="city" class="form-control"
                        value="<?php echo e(old('city') ?? $user->city); ?>" placeholder="Enter your city" />
                    <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>





                <div class="col-md-6">
                    <label class="form-label" for="registerEmail">Subscribe for Newsletter*</label>
                    <div class="content">
                        <label class="switch">
                            <input type="checkbox" name="is_subscribed"
                                <?php echo e(old('is_subscribed') == 'on' ? 'checked="checked"' : ($user->is_subscribed == 1 ? 'checked="checked"' : '')); ?>">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>


            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--User-profile-End-->
<?php /**PATH /var/www/html/carjock/resources/views/frontend/auth/edit.blade.php ENDPATH**/ ?>