<?php $__env->startSection('content'); ?>
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Manufacturers</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bxs-car"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vehicle Manufacturers</li>
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

        <?php if(count($models) == 0): ?>
        <h4 class="text-center text-muted m-3">No manufacturers available</h4>
        <?php else: ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Link</th>
                            <!-- <th>Number</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->index + 1); ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <p class="mb-0"><?php echo e($model->name); ?></p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <?php if($model->link_url): ?>
                                    <p class="mb-0"><?php echo e($model->link_url); ?></p>
                                    <?php else: ?>
                                    <p class="mb-0">N/A</p>
                                    <?php endif; ?>
                                </div>
                            </td>
                            
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    
                                    <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Link URL" onclick="openEditLinkModal(<?php echo e($model->id); ?>, '<?php echo e($model->link_url); ?>', '<?php echo e($model->name); ?>')">
                                        <i class="bi bi-link"></i> Add Website Link
                                    </a>

                                    
                                    <input type="hidden" name="model_id" value="<?php echo e($model->id); ?>">
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <?php echo e($models->links('pagination::bootstrap-4')); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>

</main>
<!-- Modal for editing link_url -->
<div class="modal fade" id="editLinkModal" tabindex="-1" aria-labelledby="editLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLinkModalLabel">Edit Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('admin.vehicle-model.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <div class="modal-body">
                    <input type="hidden" name="model_id" id="model_id">
                    <input type="hidden" name="model_name" id="model_name">
                    <label for="link_url" class="form-label">Add/Update Url</label>
                        <input type="text" class="form-control" id="link_url" name="link_url">
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function openEditLinkModal(modelId, linkUrl, name) {
        console.log(name);
        document.getElementById('model_id').value = modelId;
        document.getElementById('link_url').value = linkUrl;
        document.getElementById('model_name').value = name;
        $('#editLinkModal').modal('show');
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/vehicle-model/index.blade.php ENDPATH**/ ?>