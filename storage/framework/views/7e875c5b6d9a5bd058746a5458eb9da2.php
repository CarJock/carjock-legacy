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
                        <h4 class="pb-2"><?php echo e($vehicle->name); ?></h4>
                        <form method="POST" action="<?php echo e(route('admin.vehicles.update', $vehicle->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="Text" disabled required class="form-control" value="<?php echo e($vehicle->name); ?>"
                                    name="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Body Type</label>
                                <input type="Text" disabled required class="form-control"
                                    value="<?php echo e($vehicle->body_type); ?>" name="">
                            </div>
                            

                            <div class=" mb-2 mt-3">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Feature This
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" name="feature" value="yes" type="radio"
                                    name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="feature" value="no"
                                    name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    No
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/featured-cars/edit.blade.php ENDPATH**/ ?>