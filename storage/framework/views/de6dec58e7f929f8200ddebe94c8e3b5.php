<?php $__env->startSection('content'); ?>
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Cars</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Featured</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <?php if($message = Session::get('message')): ?>
                <div class="alert alert-success alert-block">
                    <?php echo e($message); ?>

                </div>
            <?php endif; ?>
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0">Vehicles</h5>
                    <form method="GET" class="ms-auto position-relative d-flex mb-3">
                        <div>
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                            <input class="form-control ps-5" type="text" placeholder="Search" name="keywords" value="<?php echo e(request()->has('keywords') ? request()->keywords : ''); ?>">
                        </div>
                        <div>
                            <select name="featured" class="form-control mx-3">
                                <option value="">Select Featured Vehciles</option>
                                <option value="yes" <?php echo e(request()->featured == 'yes' ? 'selected="selected"' : ''); ?>>Yes</option>
                                <option value="no" <?php echo e(request()->featured == 'no' ? 'selected="selected"' : ''); ?>>No</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mx-4">Filter</button>
                        </div>
                    </form>
                </div>
                <?php if(count($vehicles) == 0): ?>
                    
                <?php else: ?>
                
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Body Type</th>
                                    <th>Featured</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->index + 1); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                <?php if($vehicle->image && (file_exists($vehicle->image) || file_exists('/'.$vehicle->image))): ?>
                                                    <img src="/<?php echo e($vehicle->image); ?>" class="rounded-circle" width="44"
                                                        height="44" alt="">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('frontend/assets/images/comparision-placeholder.jpeg')); ?>"
                                                        width="44" height="44" />
                                                <?php endif; ?>
                                                <div class="">
                                                    <p class="mb-0"><?php echo e($vehicle->name); ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo e($vehicle->body_type); ?></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" data-id="<?php echo e($vehicle->id); ?>"
                                                    type="checkbox" id="featured-<?php echo e($vehicle->id); ?>"
                                                    <?php echo e($vehicle->feature == 'yes' ? 'checked' : ''); ?>>
                                                <label class="form-check-label" for="featured"></label>
                                            </div>
                                        </td>
                                        <td><?php echo date('d/m/Y', strtotime($vehicle->created_at)); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 fs-6">
                                                
                                                <a href="<?php echo e(route('admin.vehicles.show', $vehicle->id)); ?>"
                                                    class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="View" data-bs-original-title="Show info" aria-label="Show"><i
                                                        class="bi bi-eye-fill"></i>
                                                </a>

                                                
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

            <nav class="mt-4">
                <?php if(count($vehicles)): ?>
                    <ul class="pagination">
                        <?php echo e($vehicles->withQueryString()->links()); ?>

                    </ul>
                <?php else: ?>
                    <div class="col-sm-12 text-center">
                        <h4 class="text-muted inline m-t-sm m-b-sm">No records found.</h4>
                    </div>
                <?php endif; ?>
            </nav>
        </div>
    </div>

</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        select{
            -moz-appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: transparent;
            background-image: url('<?php echo e(asset('frontend/assets/images/arrowdn.png')); ?>');
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: 14px;
            background-size: 5%;
            cursor:pointer;
            width: 100%;
            border: 1px solid gray;
            border-radius: 5px;
            padding: 0 15px;
            font-size: 16px;
            color: #979797;
        } 
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(".form-check-input").change(function() {
            var id = $(this).attr("data-id");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('<?php echo e(url('admin/vehicles')); ?>/' + id, {
                _method: "PUT",
            }, function() {
                console.log('done');
            })
            //$.post('<?php echo e(url('admin/vehicle/update')); ?>/' + id)
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/featured-cars/index.blade.php ENDPATH**/ ?>