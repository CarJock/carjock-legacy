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
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary"><a class="text-white"
                            href="<?php echo e(route('admin.contact_exportcsv')); ?>">Export CSV</a></button>
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

            <?php if(count($contacts) == 0): ?>
                
            <?php else: ?>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>

                                        <td><?php echo e($contact->first_name); ?></td>
                                        <td><?php echo e($contact->last_name); ?></td>
                                        <td><?php echo e($contact->email); ?></td>
                                        
                                        
                                        <td>
                                            <div class="d-flex align-items-center gap-3 fs-6">
                                                <a href="<?php echo e(route('admin.contact.show', $contact->id)); ?>"
                                                    class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="View" data-bs-original-title="View detail"
                                                    aria-label="Views"><i class="bi bi-eye-fill"></i></a>

                                                


                                                
                                            </div>
                    </div>
                    </td>
                    </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            </table>
        </div>
        <?php endif; ?>
        <nav class="mt-4">
            <?php if(count($contacts)): ?>
                <ul class="pagination">
                    <?php echo e($contacts->withQueryString()->links()); ?>

                </ul>
            <?php else: ?>
                <div class="col-sm-12 text-center">
                    <h4 class="text-muted inline m-t-sm m-b-sm">No Contacts available.</h4>
                </div>
            <?php endif; ?>
        </nav>
        </div>
        </div>

    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/content-management/contact-us/index.blade.php ENDPATH**/ ?>