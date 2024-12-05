<?php $__env->startSection('content'); ?>
<div class="mainBanner bannerheightadjust"
    style="background-image:url(<?php echo e(asset('frontend/assets/images/bg.png')); ?>); background-size: cover; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row">
            <div class="mainbanneroverlay">
                <h2>MY COMPARISIONS</h2>
                <div class="breadcrumb">
                    <ul>
                        <li>Home</li>
                        <li><?php echo e($user->name); ?></li>
                    </ul>
                </div>
            </div>
            <!-- <img src="<?php echo e(asset('frontend/assets/images/banner/redchevcaomparebanner.jpg')); ?>" alt=""> -->
        </div>
    </div>
</div>

<section class="profile">
    <div class="container">
        <div class="row">
            <?php echo $__env->make('frontend.auth.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="col-9 profile-details" id="SaveComparetions" data-card="SaveComparetions"
                style="display: block;">
                <div class="row">
                    <div class="relatedCar text-center new_sec_add">
                    <h3><?php echo e($page_content->heading); ?></h3>
                        <div class="inline-sec">
                            <p><?php echo e($page_content->content); ?></p>
                        </div>
                        <hr>

                        <div id="tab1" class="tab-content active">
                            <?php if($compares->isNotEmpty()): ?>
                            <?php $__currentLoopData = $compares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $compare): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row hello_check">
                                <h1 class="col-8">
                                    <?php ($vehicles = explode(',', $compare->vehicle_ids)); ?>
                                    <?php if(isset($vehicles[0])): ?>
                                    <?php echo e(App\Models\Vehicle::find($vehicles[0])->name); ?>

                                    <?php endif; ?>
                                    <?php if(isset($vehicles[1])): ?>
                                    <br />
                                    <?php echo e(App\Models\Vehicle::find($vehicles[1])->name); ?>

                                    <?php endif; ?>
                                    <?php if(isset($vehicles[2])): ?>
                                    <br />
                                    <?php echo e(App\Models\Vehicle::find($vehicles[2])->name); ?>

                                    <?php endif; ?>
                                    <?php if(isset($vehicles[3])): ?>
                                    <br />
                                    <?php echo e(App\Models\Vehicle::find($vehicles[3])->name); ?>

                                    <?php endif; ?>
                                    <?php if(isset($vehicles[4])): ?>
                                    <br />
                                    <?php echo e(App\Models\Vehicle::find($vehicles[4])->name); ?>

                                    <?php endif; ?>
                                    <?php if(isset($vehicles[5])): ?>
                                    <br />
                                    <?php echo e(App\Models\Vehicle::find($vehicles[5])->name); ?>

                                    <?php endif; ?>
                                </h1>

                                <div class="flex">
                                    <a href="<?php echo e(route('frontend.compare', ['comparisions' => $compare->vehicle_ids])); ?>">
                                        <button type="submit" class="btn btn-primary check_four mr-2">View</button>
                                    </a>
                                    <a onclick="deleteComparisions('<?php echo e($compare->id); ?>', '<?php echo e(route('frontend.account.compare.delete', $compare->id)); ?>')"
                                        data-link="<?php echo e(route('frontend.account.compare.delete', $compare->id)); ?>"
                                        href="javascript:;">
                                        <button type="submit" class="btn btn-primary check_two mr-2">Delete</button>
                                    </a>

                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <p class="text-center">
                                <a href="<?php echo e(route('frontend.compare')); ?>">
                                    <button type="submit" class="btn btn-primary check_three mr-2">Compare
                                        Vehciles</button>
                                </a>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" style="margin-top:15%" id="delete-comparision-confirmation" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remove Comparisions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure to delete comparisions?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a id="confirmationlink" href="" class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/profile.css')); ?>" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
//Save Comparision script start
function deleteComparisions(id, link) {
    $('#confirmationlink').attr('href', link);
    $('#delete-comparision-confirmation').modal('toggle');
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', ['class' => 'login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/frontend/auth/comparisions.blade.php ENDPATH**/ ?>