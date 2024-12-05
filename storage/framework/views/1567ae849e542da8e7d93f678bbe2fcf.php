<?php $__env->startSection('content'); ?>
    




    <div class="container">
        <div class="row">
            <div class="col-6 m-auto mt-5 pt-5">

                <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success alert-block">
                        <?php echo e($message); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="alert alert-danger alert-block"><?php echo e($error); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <h4 class="pb-2">Create New</h4>
                        <form method="POST" action="<?php echo e(route('admin.user.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" required class="form-control" placeholder="Name" name="name" value="<?php echo e(old('name')); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" required class="form-control" placeholder="Email" name="email" value="<?php echo e(old('email')); ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" required class="form-control" placeholder="Password" name="password">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" readonly class="form-control" name="role" value="admin">
                            </div>
                            
                            <div class=" mb-2 mt-3">
                                <label class="form-check-label" for="flexCheckDefault">
                                    User status
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="status" value="active" type="radio"
                                    id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="blocked"
                                    id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Block
                                </label>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/user-management/create.blade.php ENDPATH**/ ?>