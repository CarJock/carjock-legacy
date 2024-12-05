<?php $__env->startSection('content'); ?>
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vehicles</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">View</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-header py-3">
            <div class="row g-3 align-items-center">
                <div class="col-12 col-lg-4 col-md-6 me-auto">
                    <h5 class="mb-1"><?php echo date('d/m/Y', strtotime($vehicle->created_at)); ?></h5>
                    <p class="mb-0">Vehicle ID : <?php echo e($vehicle->id); ?></p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col">
                    <div class="card border-0 shadow-none radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <div class=" border-0">
                                    <?php if($vehicle->image): ?>
                                    <img src="<?php echo e($vehicle->image); ?>" class="img-fluid" width="400">
                                    <?php else: ?>
                                    <img src="<?php echo e(asset('frontend/assets/images/comparision-placeholder.jpeg')); ?>" class="img-fluid" width="400" />
                                    <?php endif; ?>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2"><b>Modal: </b><?php echo e($vehicle->name); ?></h6>
                                    
                                    <p class="mb-1"><b>Body: </b><?php echo e($vehicle->body_type); ?></p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

</main>
<!--end page main-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/featured-cars/show.blade.php ENDPATH**/ ?>