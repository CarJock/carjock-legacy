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
                        <h4 class="pb-2">Contact Us</h4>
                        <form method="POST" action="<?php echo e(route('admin.contact.update', $contacts->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <input type="Text" required class="form-control" value="<?php echo e($contacts->message); ?>"
                                    name="message">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="Text" required class="form-control" value="<?php echo e($contacts->phone); ?>"
                                    name="phone">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="Text" required class="form-control" value="<?php echo e($contacts->first_name); ?>"
                                    name="first_name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="Text" required class="form-control" value="<?php echo e($contacts->last_name); ?>"
                                    name="last_name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" required class="form-control" value="<?php echo e($contacts->email); ?>"
                                    name="email">
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/content-management/contact-us/edit.blade.php ENDPATH**/ ?>