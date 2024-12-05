<?php $__env->startSection('content'); ?>
    




    <div class="container">
        <div class="row">
            <div class="col-6 m-auto mt-5 pt-5">

                <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success alert-block">
                        <?php echo e($message); ?>

                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <h4 class="pb-2"><?php echo e($user->name); ?></h4>
                        <form method="POST" action="<?php echo e(route('admin.user.update', $user->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="Text" required class="form-control" value="<?php echo e($user->name); ?>"
                                    name="name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="email" required class="form-control" value="<?php echo e($user->email); ?>"
                                    name="email">
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

                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/user-management/edit.blade.php ENDPATH**/ ?>