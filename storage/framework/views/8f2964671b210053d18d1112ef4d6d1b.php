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
                        <h4 class="pb-2">Create New</h4>
                        <form method="POST" action="<?php echo e(route('admin.faqs.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label class="form-label">Question</label>
                                <input type="Text" required class="form-control" placeholder="Question" name="question">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea required class="form-control" placeholder="Description"
                                    name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="Text" required class="form-control" name="sort" value="<?php echo e($count+1); ?>" readonly>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/content-management/faqs/create.blade.php ENDPATH**/ ?>