<?php $__env->startSection('content'); ?>
    




    <div class="container">
        <div class="row">
            <div class="col-6 m-auto mt-5 pt-5">

                <?php if($message = Session::get('message')): ?>
                    <div class="alert alert-danger alert-block">
                        <?php echo e($message); ?>

                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <h4 class="pb-2">Create New</h4>
                        <form method="POST" action="<?php echo e(route('admin.ads.store')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <select name="page_id" required class="form-control" id="ads_page_id">
                                    <option value="">Select Page</option>
                                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e(old('page_id') == $page->id ? 'selected' : ''); ?> value="<?php echo e($page->id); ?>"><?php echo e($page->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="slot" class="form-control" id="ads_slot_id">
                                    <option value="">Select Slot</option>
                                    <option value="1">featured vehicles</option>
                                    <option value="2">news from blog</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Link</label>
                                <input type="text" required name="link" class="form-control" value="<?php echo e(old('link')); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Start Date</label>
                                <input type="text" required name="start_date" id="start_date" class="form-control" value="<?php echo e(old('start_date')); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">End Date</label>
                                <input type="text" required id ="end_date" name="end_date" class="form-control" value="<?php echo e(old('end_date')); ?>">
                            </div>
                            <div class="mb-3">
                                <select name="start_time" class="form-control">
                                    <option value="">Select Start Time</option>
                                    <?php for($i = 1; $i <= 24; $i++): ?>
                                        <option <?php echo e(old('start_time') == $i ? 'selected' : ''); ?> value="<?php echo e($i); ?>"><?php echo sprintf('%02d', $i) . ":00" ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="end_time" class="form-control">
                                    <option value="">Select End Time</option>
                                    <?php for($i = 1; $i <= 24; $i++): ?>
                                        <option <?php echo e(old('end_time') == $i ? 'selected' : ''); ?> value="<?php echo e($i); ?>"><?php echo sprintf('%02d', $i) . ":00" ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image <b id="ads_size"></b></label>
                                <input type="file" class="form-control" name="image" accept="image/*" id="ads_img"/>
                            </div>
                            <div class="mb-3">
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option <?php echo e(old('status') == 'active' ? 'selected' : ''); ?> value="active">Active</option>
                                    <option <?php echo e(old('status') == 'inactive' ? 'selected' : ''); ?> value="inactive">Inactive</option>
                                </select>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/ads/create.blade.php ENDPATH**/ ?>