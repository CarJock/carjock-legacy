<?php $__env->startSection('content'); ?>
    




    <div class="container">
        <div class="row">
            <div class="col-6 m-auto mt-5 pt-5">

                <?php if($message = Session::get('message')): ?>
                    <div class="alert alert-success alert-block">
                        <?php echo e($message); ?>

                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <h4 class="pb-2">Social Media Links</h4>
                        <form method="POST" action="<?php echo e(route('admin.media.update', $social->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label class="form-label">Platform</label>
                                <input type="text" class="form-control" value="<?php echo e($social->social_name); ?>"
                                    name="social_name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Url</label>
                                <input type="text" class="form-control" value="<?php echo e($social->social_link); ?>"
                                    name="social_link">
                            </div>
                            <div class="mb-3">
                            <label class="form-label">Sort Order</label>
                                <select name="sort" class="form-control">
                                    <option value="">Select Sort</option>
                                    <?php for($i = 1; $i <= $count; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php echo e($social->sort == $i ? 'selected="selected"' : ''); ?>><?php echo e($i); ?></option>
                                    <?php endfor; ?>
                                </select>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/content-management/social-media-links/edit.blade.php ENDPATH**/ ?>