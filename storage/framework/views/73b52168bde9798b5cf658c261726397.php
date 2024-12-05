<?php $__env->startSection('content'); ?>
<div class="mainBanner bannerheightadjust"
    style="background-image:url(<?php echo e(url('storage/banners/'.$banner->image)); ?>); background-size: cover; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row">
            <div class="mainbanneroverlay">
                <h2>DISCLAIMER</h2>
                <div class="breadcrumb">
                    <ul>
                        <li>Home</li>
                        <li>Disclaimer</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="dis_claim">
    <div class="container py-5">
        <div class="col-md-12">
            <h2><?php echo e($terms->heading); ?></h2>
            <p><?php echo $terms->content; ?></p> 
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/frontend/pages/term-and-conditions.blade.php ENDPATH**/ ?>