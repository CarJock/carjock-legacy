<?php $__env->startSection('content'); ?>
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Content Management</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">FAQs</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary"><a class="text-white"
                            href="<?php echo e(route('admin.faqs.create')); ?>">Create
                            New</a></button>
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

            <?php if(count($faqs) == 0): ?>
                <h4 class="text-center text-muted m-3">No data available</h4>
            <?php else: ?>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Sort Order</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->index + 1); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                <p class="mb-0"><?php echo e($faq->question); ?></p>
                                            </div>
                                            </div>
                                            </td>
                                            <td><?php echo e($faq->sort); ?></td>
                                            <td><?php echo e($faq->description); ?></td>
                                            <?php if($faq->updated_at == ""): ?>
                                                <td><?php echo date('d/m/Y', strtotime($faq->created_at)); ?></td>
                                            <?php else: ?>
                                                <td><?php echo date('d/m/Y', strtotime($faq->updated_at)); ?></td>
                                            <?php endif; ?>
                                            <td>
                                                <div class="d-flex align-items-center gap-3 fs-6">
                                                    <a href="<?php echo e(route('admin.faqs.edit', $faq->id)); ?>" class="text-warning" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Edit" data-bs-original-title="Edit info"
                                                        aria-label="Edit"><i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <form method="POST" action="<?php echo e(route('admin.faqs.destroy', [$faq->id])); ?>">
                                                        <button class="bi bi-trash-fill text-danger bg-transparent border-0" type="submit"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                                                        </button>
                                                        <?php echo method_field('delete'); ?>
                                                        <?php echo csrf_field(); ?>
                                                    </form>
                                                </div>
                </div>
                </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            </table>
        </div>
        <?php endif; ?>
        
        </div>
        </div>

    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/content-management/faqs/index.blade.php ENDPATH**/ ?>