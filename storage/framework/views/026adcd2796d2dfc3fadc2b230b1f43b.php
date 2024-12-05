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
                        <h4 class="pb-2">Ads <?php echo e($ads->title); ?></h4>
                        <form method="POST" action="<?php echo e(route('admin.ads.update', $ads->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <input type="Text" readonly class="form-control" value="<?php echo e($ads->title); ?>"
                                    name="page_title">
                                <input type="hidden" readonly class="form-control" value="<?php echo e($ads->page); ?>"
                                    name="page">
                            </div>

                            <?php if($ads->slot != ""): ?>
                            <div class="mb-3">
                                <label class="form-label">Slot</label>
                                <?php
                                    if($ads->slot == 1){
                                        $slot_name = "featured vehicles";
                                    } elseif($ads->slot == 2) {
                                        $slot_name = "news from blog";
                                    } else {
                                        $slot_name = "";
                                    }
                                ?>
                                <input type="Text" readonly class="form-control" value="<?php echo e($slot_name); ?>"
                                    name="slot_name">
                                <input type="hidden" readonly class="form-control" value="<?php echo e($ads->slot); ?>"
                                    name="slot">
                            </div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label class="form-label">Start Date</label>
                                <input type="text" required name="start_date" id="start_date" class="form-control" value="<?php echo date('d/m/Y', strtotime($ads->start_date)); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">End Date</label>
                                <input type="text" required id ="end_date" name="end_date" class="form-control" value="<?php echo date('d/m/Y', strtotime($ads->end_date)); ?>">
                            </div>
                            <div class="mb-3">
                                <select name="start_time" class="form-control">
                                    <option value="">Select Start Time</option>
                                    <?php for($i = 1; $i <= 24; $i++): ?>
                                        <option <?php echo e($ads->start_time == $i ? 'selected="selected"' : ''); ?> value="<?php echo e($i); ?>"><?php echo sprintf('%02d', $i) . ":00" ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="end_time" class="form-control">
                                    <option value="">Select End Time</option>
                                    <?php for($i = 1; $i <= 24; $i++): ?>
                                        <option <?php echo e($ads->end_time == $i ? 'selected="selected"' : ''); ?> value="<?php echo e($i); ?>"><?php echo sprintf('%02d', $i) . ":00" ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" accept="image/*" id="ads_img"/>
                                <br>
                                <img src="<?php echo e(url('storage/ads/'.$ads->image)); ?>" id="ads_show_img" height="200" width="200">
                            </div>
                            <select name="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="active" <?php echo e($ads->status == 'active' ? 'selected="selected"' : ''); ?>>Active</option>
                                <option value="inactive" <?php echo e($ads->status == 'inactive' ? 'selected="selected"' : ''); ?>>Inactive</option>
                            </select>
                    </div>
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/ads/edit.blade.php ENDPATH**/ ?>