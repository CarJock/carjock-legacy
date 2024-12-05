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
                        <h4 class="pb-2"><?php echo e(str_replace('frontend.', '', $metatags->route_name)); ?></h4>
                        <form method="POST" action="<?php echo e(route('admin.metaTags.update', $metatags->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="Text" class="form-control" value="<?php echo e($metatags->title); ?>"
                                    name="title">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control"
                                    name="description" rows="3"><?php echo e($metatags->description); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keywords</label>
                                <textarea class="form-control"
                                    name="keywords" rows="3"><?php echo e($metatags->keywords); ?></textarea>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/meta-tags/edit.blade.php ENDPATH**/ ?>