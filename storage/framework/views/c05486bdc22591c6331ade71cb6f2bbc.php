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
                        <h4 class="pb-2"><?php echo e($banners->pages->title); ?></h4>
                        <form method="POST" action="<?php echo e(route('admin.banners.update', $banners->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label class="form-label">Heading</label>
                                <input type="Text" class="form-control" value="<?php echo e($banners->heading); ?>"
                                    name="heading">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <textarea class="form-control"
                                    name="content" rows="6"><?php echo e($banners->content); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <?php
                                    if ($banners->id == 1) 
                                        $image_size = "1590 * 540";
                                    else if ($banners->id == 4)
                                        $image_size = "1590 * 395";
                                    else
                                        $image_size = "1590 * 415";
                                ?>    
                                <label class="form-label">Image  <b>(<?php echo $image_size; ?>)</b></label>
                                <input type="file" class="form-control" name="image" accept="image/*" id="banner_img"/>
                                <br>
                                <div class="banner-scrollable-container">
                                    <div class="banner-image-container">
                                        <img src="<?php echo e(url('storage/banners/'.$banners->image)); ?>" id="ads_banner_img">
                                    </div>
                                </div>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/content-management/banners/edit.blade.php ENDPATH**/ ?>