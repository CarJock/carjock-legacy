<?php $__env->startSection('content'); ?>
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Ads</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Logs</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <?php if($message = Session::get('message')): ?>
                <div class="alert alert-success alert-block">
                    <?php echo e($message); ?>

                </div>
            <?php endif; ?>

            <?php if(count($ads_logs) == 0): ?>
                
            <?php else: ?>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">Vehicles</h5>
                        <form method="GET" class="ms-auto position-relative d-flex mb-3">
                            <div>
                                <select name="type" class="form-control mx-3">
                                    <option value="">Select Type</option>
                                    <option value="click" <?php echo e(request()->type == 'click' ? 'selected="selected"' : ''); ?>>Click</option>
                                    <option value="view" <?php echo e(request()->type == 'view' ? 'selected="selected"' : ''); ?>>View</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mx-4">Filter</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Page</th>
                                    <th>Type</th>
                                    <th>Slot</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $ads_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->index + 1); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                <p class="mb-0"><?php echo e($logs->title); ?></p>
                                            </div>
                    
                                        </td>
                                        <td><?php echo e($logs->type); ?></td>
                                        <td>
                                            <?php
                                            $slot_name = "";
                                            if ($logs->slot == 0 || $logs->slot == "") {
                                                $slot_name = "-";
                                            } else {
                                                if ($logs->slot == 1) {
                                                    $slot_name = "featured vehicles";
                                                } else {
                                                    $slot_name = "news from blog";
                                                }
                                            }
                                            echo $slot_name;
                                            ?>
                                        </td>
                                        <td><?php echo date('d/m/Y', strtotime($logs->created_at)); ?></td>                    
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            </table>
        </div>
        <?php endif; ?>
        <nav class="mt-4">
            <?php if(count($ads_logs)): ?>
                <ul class="pagination">
                    <?php echo e($ads_logs->withQueryString()->links()); ?>

                </ul>
            <?php else: ?>
                <div class="col-sm-12 text-center">
                    <h4 class="text-muted inline m-t-sm m-b-sm">No ads logs available.</h4>
                </div>
            <?php endif; ?>
        </nav>
        </div>
        </div>

    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/ads_logs/index.blade.php ENDPATH**/ ?>