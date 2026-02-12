<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-items">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo e(cleanLang(__('lang.filter_products'))); ?>

                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-items"></i>
                </span>
            </div>

            <!--body-->
            <div class="r-panel-body">

                <!--rate-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.rate'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6 input-group input-group-sm">
                                <span class="input-group-addon"><?php echo e(config('system.settings_system_currency_symbol')); ?></span>
                                <input type="number" name="filter_item_rate_min" id="filter_item_rate_min"
                                    class="form-control form-control-sm" placeholder="<?php echo e(cleanLang(__('lang.minimum'))); ?>"
                                    value="<?php echo e(config('filter.saved_data.filter_item_rate_min') ?? ''); ?>">
                            </div>
                            <div class="col-md-6 input-group input-group-sm">
                                <span class="input-group-addon"><?php echo e(config('system.settings_system_currency_symbol')); ?></span>
                                <input type="number" name="filter_item_rate_max" id="filter_item_rate_max"
                                    class="form-control form-control-sm" placeholder="<?php echo e(cleanLang(__('lang.maximum'))); ?>"
                                    value="<?php echo e(config('filter.saved_data.filter_item_rate_max') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!--categorgies-->
                <?php
                $saved_categories = config('filter.saved_data.filter_item_categoryid') ?? [];
                if (!is_array($saved_categories)) {
                    $saved_categories = [];
                }
                ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.category'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_item_categoryid" id="filter_item_categoryid"
                                    class="form-control form-control-sm select2-basic select2-multiple select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->category_id); ?>" <?php echo e(in_array($category->category_id, $saved_categories) ? 'selected' : ''); ?>>
                                        <?php echo e($category->category_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--description-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.description'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="filter_item_notes" id="filter_item_notes"
                                    class="form-control form-control-sm"
                                    value="<?php echo e(config('filter.saved_data.filter_item_notes') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!--tax status-->
                <?php
                $saved_tax_status = config('filter.saved_data.filter_item_tax_status') ?? [];
                if (!is_array($saved_tax_status)) {
                    $saved_tax_status = [];
                }
                ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.tax_status'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_item_tax_status" id="filter_item_tax_status"
                                    class="form-control form-control-sm select2-basic select2-multiple select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <option value="taxable" <?php echo e(in_array('taxable', $saved_tax_status) ? 'selected' : ''); ?>><?php echo e(cleanLang(__('lang.taxable'))); ?></option>
                                    <option value="exempt" <?php echo e(in_array('exempt', $saved_tax_status) ? 'selected' : ''); ?>><?php echo e(cleanLang(__('lang.exempt'))); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--default tax-->
                <?php
                $saved_default_tax = config('filter.saved_data.filter_item_default_tax') ?? [];
                if (!is_array($saved_default_tax)) {
                    $saved_default_tax = [];
                }
                ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.default_tax'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_item_default_tax" id="filter_item_default_tax"
                                    class="form-control form-control-sm select2-basic select2-multiple select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <?php $__currentLoopData = \App\Models\TaxRate::orderBy('taxrate_name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxRate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($taxRate->taxrate_id); ?>" <?php echo e(in_array($taxRate->taxrate_id, $saved_default_tax) ? 'selected' : ''); ?>>
                                        <?php echo e($taxRate->taxrate_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--custom fields-->
                <?php if(\App\Models\ProductCustomField::where('items_custom_field_status', 'enabled')->exists()): ?>
                <?php $__currentLoopData = \App\Models\ProductCustomField::where('items_custom_field_status', 'enabled')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e($customField->items_custom_field_name); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="filter_item_custom_field_<?php echo e($customField->items_custom_id); ?>"
                                    id="filter_item_custom_field_<?php echo e($customField->items_custom_id); ?>"
                                    class="form-control form-control-sm"
                                    value="<?php echo e(config('filter.saved_data.filter_item_custom_field_' . $customField->items_custom_id) ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <!--remember filters-->
                <div class="modal-selector m-t-20 p-b-0 p-l-35 p-t-20">
                    <div class="filter-block">
                        <div class="fields">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group form-group-checkbox m-b-0">
                                        <input type="checkbox" id="filter_remember" name="filter_remember"
                                            class="filled-in chk-col-light-blue"
                                            <?php echo e(config('filter.status') == 'active' ? 'checked' : ''); ?>>
                                        <label class="p-l-30"
                                            for="filter_remember"><?php echo app('translator')->get('lang.remember_filters'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--buttons-->
                <div class="buttons-block">
                    <a href="<?php echo e(url('/items?clear-filter=yes')); ?>"
                        class="btn btn-rounded-x btn-secondary"><?php echo app('translator')->get('lang.forget_filters'); ?></a>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="<?php echo e($page['source_for_filter_panels'] ?? ''); ?>">
                    <input type="hidden" name="query-type" value="filter">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="<?php echo e(urlResource('/items/search')); ?>"
                        data-type="form" data-ajax-type="GET"><?php echo e(cleanLang(__('lang.apply_filter'))); ?></button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/items/components/misc/filter-items.blade.php ENDPATH**/ ?>