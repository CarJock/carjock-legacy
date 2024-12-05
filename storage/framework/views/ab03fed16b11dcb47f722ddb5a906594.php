<?php $__env->startSection('content'); ?>
    <main class="page-content">
        <form method="post" action="<?php echo e(route('admin.setting.store')); ?>">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Home</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
        </form>

        <div class="container">
            <div class="row">
                <div class="col-6 m-auto mt-2 pt-5">

                    <?php if($message = Session::get('message')): ?>
                        <div class="alert alert-<?php echo e(Session::get('alert-type', 'info')); ?> alert-block">
                            <?php echo e($message); ?>

                        </div>
                    <?php endif; ?>

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="vehicle_detail_icons"
                                                        <?php echo e($setting->where('meta_key', 'vehicle_detail_icons')->where('meta_value', 'on')->first() ? 'checked' : ''); ?>>
                                                    <label class="form-check-label"
                                                        for="vehicle_detail_icons">Enable/Disable
                                                        Vehicle Detail Icons</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Save Setting</button>
                        </div>

                    </div>

                    <div class="card mt-5">
                        <div class="card-body">
                            <h4 class="pb-2">Chrome Data Jobs</h4>

                            <form method="POST" action="<?php echo e(route('admin.chromedata.job')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                <!-- Year Field with Value Retention and Validation Error Display -->
                                <div class="mb-3">
                                    <label class="form-label">Year</label>
                                    <select name="year" id="year"
                                        class="form-control <?php $__errorArgs = ['year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option value="">Select Year</option>
                                        <option value="2020" <?php echo e(old('year') == '2020' ? 'selected' : ''); ?>>2020</option>
                                        <option value="2021" <?php echo e(old('year') == '2021' ? 'selected' : ''); ?>>2021</option>
                                        <option value="2022" <?php echo e(old('year') == '2022' ? 'selected' : ''); ?>>2022</option>
                                        <option value="2023" <?php echo e(old('year') == '2023' ? 'selected' : ''); ?>>2023</option>
                                        <option value="2024" <?php echo e(old('year') == '2024' ? 'selected' : ''); ?>>2024</option>
                                        <option value="2025" <?php echo e(old('year') == '2025' ? 'selected' : ''); ?>>2025</option>
                                        <option value="2026" <?php echo e(old('year') == '2026' ? 'selected' : ''); ?>>2026</option>
                                    </select>
                                    <?php $__errorArgs = ['year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <!-- Division Selection -->
                                <div class="mb-3">
                                    <label class="form-label">Divisions / Make</label>
                                    <select id="division" name="division"
                                        class="form-control <?php $__errorArgs = ['division'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option value="">No Divisions availble</option>
                                    </select>
                                    <button id="update-divisions" class="btn btn-sm btn-primary mt-1 float-end"
                                        type="button">
                                        Fetch Divisions
                                    </button>
                                    <small id="division-count" class="text-muted"></small>
                                    <!-- Placeholder for division count -->
                                    <?php $__errorArgs = ['division'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <!-- Model Selection -->
                                <div class="mb-3">
                                    <label class="form-label">Models</label>

                                    <select size="10" id="model" name="model[]" multiple
                                        class="form-control <?php $__errorArgs = ['model'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option value="">No models available</option>
                                    </select>
                                    <button id="update-models" class="btn btn-sm btn-primary mt-1 float-end" type="button">
                                        Fetch Models
                                    </button>

                                    <small id="model-count" class="text-muted"></small>
                                    <?php $__errorArgs = ['model'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>


                                <!-- Style Selection -->
                                <div class="mt-5">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="form-label">Styles / Variants</label>
                                        <label class="form-check-label">
                                            <input type="checkbox" id="only-undumped" class="form-check-input" />
                                            Show only undumped styles
                                        </label>
                                    </div>
                                    <select size="10" id="style" name="style[]" multiple
                                        class="form-control <?php $__errorArgs = ['style'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option value="">No Styles available</option>
                                    </select>
                                    <button id="update-styles" class="btn btn-sm btn-primary mt-1 float-end" type="button">
                                        Fetch Styles
                                    </button>
                                    <small id="style-count" class="text-muted"></small> <!-- Placeholder for style count -->
                                    <?php $__errorArgs = ['style'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Vehicles</label>
                                    <select id="vehicle" name="vehicle[]" multiple
                                        class="form-control <?php $__errorArgs = ['vehicle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    </select>
                                    <small id="vehicle-count" class="text-muted"></small>
                                    <!-- Placeholder for style count -->
                                    <?php $__errorArgs = ['style'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div id="update-vehicle" style="display: none">

                                    <!-- Vehicles Limit Input -->
                                    <div class="col-md-12">
                                        <input type="number" name="limit" id="limit" class="form-control"
                                            min="1" placeholder="Enter vehicles limit">
                                    </div>

                                    <!-- Free Pull Checkbox with Value Retention -->
                                    <div class="col-md-12">
                                        <div class="form-check mt-3">
                                            <input type="checkbox" checked class="form-check-input" id="withImages"
                                                name="withImages">
                                            <label class="form-check-label" for="withImages">With Images</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check mt-3">
                                            <input type="checkbox" class="form-check-input" id="override"
                                                name="override">
                                            <label class="form-check-label" for="override">Override?</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check mt-3">
                                            <input type="checkbox" class="form-check-input" id="onlyImages"
                                                name="onlyImages">
                                            <label class="form-check-label" for="onlyImages">Only Images</label>
                                        </div>
                                    </div>
                                    <!-- Fetch Vehicles Button -->
                                    <div class="col-md-12">
                                        <button class="btn btn-sm btn-primary mt-2" id="vehicle-update" type="button"
                                            style="width: auto; width:100%">
                                            Fetch Vehicles
                                        </button>
                                    </div>

                                </div>

                                <!-- Car Pull Limit Input -->
                            </form>
                        </div>
                    </div>





                </div>
            </div>
        </div>


        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/admin/setting/index.blade.php ENDPATH**/ ?>