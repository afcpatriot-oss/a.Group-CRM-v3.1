<!-- right-sidebar -->
<div class="right-sidebar" id="table-config-items">
    <form id="table-config-form">
        <div class="slimscrollright">
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo e(cleanLang(__('lang.table_settings'))); ?>

                <span>
                    <i class="ti-close js-close-side-panels" data-target="table-config-items"></i>
                </span>
            </div>

            <!--set ajax url on parent container-->
            <div class="r-panel-body table-config-ajax" data-url="<?php echo e(url('preferences/tables')); ?>" data-type="form"
                data-form-id="table-config-form" data-ajax-type="post" data-progress-bar="hidden">

                <!--tableconfig_column_1 [title]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_1" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_1'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.title'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_2 [rate]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_2" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_2'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.rate'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_3 [unit]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_3" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_3'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.unit'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_4 [category]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_4" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_4'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.category'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_5 [number sold]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_5" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_5'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.number_sold'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_6 [amount sold]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_6" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_6'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.amount_sold'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_7 [description]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_7" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_7'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.description'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_8 [tax status]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_8" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_8'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.tax_status'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_9 [default tax]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_9" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_9'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.default_tax'); ?></span>
                    </label>
                </div>

                <!--custom fields section-->
                <?php if(\App\Models\ProductCustomField::where('items_custom_field_status', 'enabled')->exists()): ?>
                <div class="p-t-20">
                    <h6 class="p-b-10"><?php echo app('translator')->get('lang.custom_fields'); ?></h6>

                    <?php $__currentLoopData = \App\Models\ProductCustomField::where('items_custom_field_status', 'enabled')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-b-5">
                        <label class="custom-control custom-checkbox table-config-checkbox-container">
                            <input name="tableconfig_column_<?php echo e(9 + $customField->items_custom_id); ?>"
                                   type="checkbox"
                                   class="custom-control-input table-config-checkbox cursor-pointer"
                                   <?php echo e(runtimePrechecked(config('table.tableconfig_column_' . (9 + $customField->items_custom_id)))); ?>>
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description"><?php echo e($customField->items_custom_field_name); ?></span>
                        </label>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>

            </div>

            <!--table name-->
            <input type="hidden" name="tableconfig_table_name" value="items">

            <!--buttons-->
            <div class="buttons-block">
                <button type="button" name="foo1" class="btn btn-rounded-x btn-secondary js-close-side-panels"
                    data-target="table-config-items"><?php echo e(cleanLang(__('lang.close'))); ?></button>
                <input type="hidden" name="action" value="search">
            </div>
        </div>
        <!--body-->
</div>
</form>
</div>
<!--sidebar-->
<?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/items/components/misc/table-config.blade.php ENDPATH**/ ?>