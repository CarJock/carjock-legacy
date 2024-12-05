<?php $__env->startSection('content'); ?>
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Subscriptions</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Subscriptions</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary"><a class="text-white"
                            href="<?php echo e(route('admin.subscription_exportcsv')); ?>">Export CSV</a></button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary"><a class="text-white" onclick="subsDestroy()">Delete All</a></button>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <?php if($message = Session::get('message')): ?>
                <div class="alert alert-success alert-block">
                    <?php echo e($message); ?>

                </div>
            <?php endif; ?>

            <?php if(count($subscriptions) == 0): ?>
                
            <?php else: ?>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->index + 1); ?></td>                    
                                        <td><?php echo e($subscription->email); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($subscription->created_at)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                <nav class="mt-4">
                    <?php if(count($subscriptions)): ?>
                        <ul class="pagination">
                            <?php echo e($subscriptions->withQueryString()->links()); ?>

                        </ul>
                    <?php else: ?>
                        <div class="col-sm-12 text-center">
                            <h4 class="text-muted inline m-t-sm m-b-sm">No Subscriptions available.</h4>
                        </div>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </main>
<script>
function subsDestroy(form) {
    let text = "Are you want to delete all subscribers emails.";
    if (confirm(text) == true) {
     $.ajax({
        url: "<?php echo e(route('admin.delete_all_subs')); ?>",
        method: 'GET',
        data: {},
        success: function(res) { window.location.reload(); },
        error: function(response) {}
     });
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/subscriptions/index.blade.php ENDPATH**/ ?>