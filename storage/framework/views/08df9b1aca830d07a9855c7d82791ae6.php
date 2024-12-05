<?php $__env->startSection('content'); ?>
    
<script src="<?php echo e(asset('admin/assets/js/ckeditor.js')); ?>"></script>
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
                        <h4 class="pb-2"><?php echo e($contents->pages->title); ?></h4>
                        <form method="POST" action="<?php echo e(route('admin.contents.update', $contents->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                             <?php if($contents->short_heading != ""): ?>
                            <div class="mb-3">
                                <label class="form-label">Short Heading</label>
                                <input type="Text" required class="form-control" value="<?php echo e($contents->short_heading); ?>"
                                    name="short_heading">
                            </div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label class="form-label">Heading</label>
                                <input type="Text" required class="form-control" value="<?php echo e($contents->heading); ?>"
                                    name="heading">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <textarea  required class="form-control"
                                    name="content" id="editor"><?php echo e($contents->content); ?></textarea>
                            </div>
                            <?php if($contents->slot != ""): ?>
                            <div class="mb-3">
                                <label class="form-label">Slot</label>
                                <input type="Text" readonly class="form-control" value="<?php echo e($contents->slot); ?>"
                                    name="slot">
                            </div>
                            <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    </div>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
    } );
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/content-management/page-contents/edit_ckeditor.blade.php ENDPATH**/ ?>