
<?php $__env->startSection('settings-page'); ?>

<!--settings-->
<form class="form" id="settingsFormProductCustomFields">

    <!-- Custom CSS for this page -->
    <style>

    </style>

    <!-- Custom Fields Table -->
    <table class="custom-fields-table">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('lang.field_name'); ?></th>
                <th class="text-center"><?php echo app('translator')->get('lang.show_on_invoice'); ?> <span class="align-middle text-info font-16"
                        data-toggle="tooltip" title="<?php echo app('translator')->get('lang.products_custom_fields_info'); ?>" data-placement="top"><i
                            class="ti-info-alt"></i></span></th>
                <th class="text-center"><?php echo app('translator')->get('lang.status'); ?></th>
            </tr>
        </thead>

        <!-- First 5 rows (always visible) -->
        <tbody>
            <?php $__currentLoopData = $fields->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <!-- Field Name Input -->
                <td>
                    <input type="text" class="form-control form-control-sm field-name-input"
                        name="items_custom_field_name[<?php echo e($field->items_custom_id); ?>]"
                        value="<?php echo e($field->items_custom_field_name ?? ''); ?>">
                </td>

                <!-- Show On Invoice Toggle -->
                <td class="toggle-wrapper">
                    <div class="switch">
                        <label>
                            <input type="checkbox"
                                name="items_custom_field_show_on_invoice[<?php echo e($field->items_custom_id); ?>]"
                                <?php echo e(runtimePrechecked($field->items_custom_field_show_on_invoice ?? 'no')); ?>>
                            <span class="lever switch-col-light-blue"></span>
                        </label>
                    </div>
                </td>

                <!-- Status Toggle -->
                <td class="toggle-wrapper">
                    <div class="switch">
                        <label>
                            <input type="checkbox" name="items_custom_field_status[<?php echo e($field->items_custom_id); ?>]"
                                <?php echo e(runtimePrechecked($field->items_custom_field_status ?? 'disabled')); ?>>
                            <span class="lever switch-col-light-blue"></span>
                        </label>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>

        <!-- Rows 6-10 (initially hidden) -->
        <tbody id="custom-fields-hidden-rows" class="hidden">
            <?php $__currentLoopData = $fields->slice(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <!-- Field Name Input -->
                <td>
                    <input type="text" class="form-control form-control-sm field-name-input"
                        name="items_custom_field_name[<?php echo e($field->items_custom_id); ?>]"
                        value="<?php echo e($field->items_custom_field_name ?? ''); ?>">
                </td>

                <!-- Show On Invoice Toggle -->
                <td class="toggle-wrapper">
                    <div class="switch">
                        <label>
                            <input type="checkbox"
                                name="items_custom_field_show_on_invoice[<?php echo e($field->items_custom_id); ?>]"
                                <?php echo e(runtimePrechecked($field->items_custom_field_show_on_invoice ?? 'no')); ?>>
                            <span class="lever switch-col-light-blue"></span>
                        </label>
                    </div>
                </td>

                <!-- Status Toggle -->
                <td class="toggle-wrapper">
                    <div class="switch">
                        <label>
                            <input type="checkbox" name="items_custom_field_status[<?php echo e($field->items_custom_id); ?>]"
                                <?php echo e(runtimePrechecked($field->items_custom_field_status ?? 'disabled')); ?>>
                            <span class="lever switch-col-light-blue"></span>
                        </label>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <!-- Show More Button -->
    <div class="show-more-button">
        <button type="button" id="show-more-custom-fields" class="btn btn-sm btn-light">
            <?php echo app('translator')->get('lang.show_more'); ?>
        </button>
    </div>


    <!-- Option 1: Alert Box (Recommended) -->
    <div class="alert alert-danger m-b-40" role="alert">
        <i class="sl-icon-info"></i>
        <strong><?php echo app('translator')->get('lang.warning'); ?>:</strong> <?php echo app('translator')->get('lang.item_custom_fields_warning'); ?>
    </div>

    <!-- Action Buttons -->
    <div class="form-group row">
        <div class="col-6 text-left">
            <a href="<?php echo e(config('system.help_docs_url')); ?>" target="_blank" class="btn btn-info btn-sm">
                <i class="ti-help"></i> <?php echo app('translator')->get('lang.help_documentation'); ?>
            </a>
        </div>
        <div class="col-6 text-right">
            <button type="button" id="product-custom-fields-button"
                class="btn btn-rounded-x btn-danger waves-effect text-left ajax-request"
                data-url="/settings/products/custom-fields" data-ajax-type="PUT"
                data-form-id="settingsFormProductCustomFields" data-type="form" data-on-start-submit-button="disable">
                <?php echo app('translator')->get('lang.save_changes'); ?>
            </button>
        </div>
    </div>

</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/settings/sections/products/custom-fields.blade.php ENDPATH**/ ?>