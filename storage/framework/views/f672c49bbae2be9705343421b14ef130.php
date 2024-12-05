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
                        <h4 class="pb-2"><?php echo e($faqs->question); ?></h4>
                        <form method="POST" action="<?php echo e(route('admin.faqs.update', $faqs->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label class="form-label">Question</label>
                                <input type="Text" required class="form-control" value="<?php echo e($faqs->question); ?>"
                                    name="question">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea required rows="6" class="form-control"
                                    name="description"><?php echo e($faqs->description); ?></textarea>
                            </div>
                            <div class="mb-3">
                            <label class="form-label">Sort Order</label>
                                <select name="sort" class="form-control">
                                    <option value="">Select Sort</option>
                                    <?php for($i = 1; $i <= $count; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php echo e($faqs->sort == $i ? 'selected="selected"' : ''); ?>><?php echo e($i); ?></option>
                                    <?php endfor; ?>
                                </select>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/content-management/faqs/edit.blade.php ENDPATH**/ ?>