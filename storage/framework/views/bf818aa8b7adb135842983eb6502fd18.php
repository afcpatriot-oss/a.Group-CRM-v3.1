<div class="card count-<?php echo e(@count($items ?? [])); ?>" id="items-table-wrapper">
    <div class="card-body">
        <!--filtered results warning-->
        <?php if(config('filter.status') == 'active'): ?>
        <div class="filtered-results-warning opacity-8 p-b-5">
            <small>
                <?php echo app('translator')->get('lang.these_results_are'); ?>
                <a href="javascript:void(0);" class="js-toggle-side-panel" data-target="sidepanel-filter-items"><?php echo app('translator')->get('lang.filtered'); ?></a>.
                <?php echo app('translator')->get('lang.you_can'); ?>
                <a href="<?php echo e(url('/items?clear-filter=yes')); ?>"><?php echo app('translator')->get('lang.clear_the_filters'); ?></a>.
            </small>
        </div>
        <?php endif; ?>

        <div class="table-responsive list-table-wrapper">
            <?php if(@count($items ?? []) > 0): ?>
            <table id="items-list-table" class="table m-t-0 m-b-0 table-hover no-wrap item-list" data-page-size="10">
                <thead>
                    <tr>
                        <?php if(config('visibility.items_col_checkboxes')): ?>
                        <th class="list-checkbox-wrapper">
                            <!--list checkbox-->
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-items" name="listcheckbox-items"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="items-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-items">
                                <label for="listcheckbox-items"></label>
                            </span>
                        </th>
                        <?php endif; ?>
                        <!--tableconfig_column_1 [title]-->
                        <th class="items_col_tableconfig_column_1 <?php echo e(config('table.tableconfig_column_1')); ?> tableconfig_column_1">
                            <a class="js-ajax-ux-request js-list-sorting"
                                id="sort_item_description" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/items?action=sort&orderby=item_description&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.title'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_2 [rate]-->
                        <th class="items_col_tableconfig_column_2 <?php echo e(config('table.tableconfig_column_2')); ?> tableconfig_column_2">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_item_rate"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/items?action=sort&orderby=item_rate&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.rate'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_3 [unit]-->
                        <th class="items_col_tableconfig_column_3 <?php echo e(config('table.tableconfig_column_3')); ?> tableconfig_column_3">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_item_unit"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/items?action=sort&orderby=item_unit&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.unit'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_4 [category]-->
                        <th class="items_col_tableconfig_column_4 <?php echo e(config('table.tableconfig_column_4')); ?> tableconfig_column_4">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_category"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/items?action=sort&orderby=category&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.category'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_5 [number sold]-->
                        <th class="items_col_tableconfig_column_5 <?php echo e(config('table.tableconfig_column_5')); ?> tableconfig_column_5">
                            <a class="js-ajax-ux-request js-list-sorting"
                                id="sort_count_sold" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/items?action=sort&orderby=count_sold&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.number_sold'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_6 [amount sold]-->
                        <th class="items_col_tableconfig_column_6 <?php echo e(config('table.tableconfig_column_6')); ?> tableconfig_column_6">
                            <a class="js-ajax-ux-request js-list-sorting"
                                id="sort_amount_sold" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/items?action=sort&orderby=amount_sold&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.amount_sold'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_7 [description]-->
                        <th class="items_col_tableconfig_column_7 <?php echo e(config('table.tableconfig_column_7')); ?> tableconfig_column_7">
                            <a class="js-ajax-ux-request js-list-sorting"
                                id="sort_item_notes" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/items?action=sort&orderby=item_notes&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.description'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_8 [tax status]-->
                        <th class="items_col_tableconfig_column_8 <?php echo e(config('table.tableconfig_column_8')); ?> tableconfig_column_8">
                            <a class="js-ajax-ux-request js-list-sorting"
                                id="sort_item_tax_status" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/items?action=sort&orderby=item_tax_status&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.tax_status'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_9 [default tax]-->
                        <th class="items_col_tableconfig_column_9 <?php echo e(config('table.tableconfig_column_9')); ?> tableconfig_column_9">
                            <a href="javascript:void(0)"><?php echo app('translator')->get('lang.default_tax'); ?></a>
                        </th>

                        <!--tableconfig_column_10 [custom field 1]-->
                        <?php if(\App\Models\ProductCustomField::where('items_custom_id', 1)->where('items_custom_field_status', 'enabled')->exists()): ?>
                        <th class="items_col_tableconfig_column_10 <?php echo e(config('table.tableconfig_column_10')); ?> tableconfig_column_10">
                            <a href="javascript:void(0)"><?php echo e(\App\Models\ProductCustomField::where('items_custom_id', 1)->first()->items_custom_field_name); ?></a>
                        </th>
                        <?php endif; ?>

                        <!--tableconfig_column_11 [custom field 2]-->
                        <?php if(\App\Models\ProductCustomField::where('items_custom_id', 2)->where('items_custom_field_status', 'enabled')->exists()): ?>
                        <th class="items_col_tableconfig_column_11 <?php echo e(config('table.tableconfig_column_11')); ?> tableconfig_column_11">
                            <a href="javascript:void(0)"><?php echo e(\App\Models\ProductCustomField::where('items_custom_id', 2)->first()->items_custom_field_name); ?></a>
                        </th>
                        <?php endif; ?>

                        <!--tableconfig_column_12 [custom field 3]-->
                        <?php if(\App\Models\ProductCustomField::where('items_custom_id', 3)->where('items_custom_field_status', 'enabled')->exists()): ?>
                        <th class="items_col_tableconfig_column_12 <?php echo e(config('table.tableconfig_column_12')); ?> tableconfig_column_12">
                            <a href="javascript:void(0)"><?php echo e(\App\Models\ProductCustomField::where('items_custom_id', 3)->first()->items_custom_field_name); ?></a>
                        </th>
                        <?php endif; ?>

                        <!--tableconfig_column_13 [custom field 4]-->
                        <?php if(\App\Models\ProductCustomField::where('items_custom_id', 4)->where('items_custom_field_status', 'enabled')->exists()): ?>
                        <th class="items_col_tableconfig_column_13 <?php echo e(config('table.tableconfig_column_13')); ?> tableconfig_column_13">
                            <a href="javascript:void(0)"><?php echo e(\App\Models\ProductCustomField::where('items_custom_id', 4)->first()->items_custom_field_name); ?></a>
                        </th>
                        <?php endif; ?>

                        <!--tableconfig_column_14 [custom field 5]-->
                        <?php if(\App\Models\ProductCustomField::where('items_custom_id', 5)->where('items_custom_field_status', 'enabled')->exists()): ?>
                        <th class="items_col_tableconfig_column_14 <?php echo e(config('table.tableconfig_column_14')); ?> tableconfig_column_14">
                            <a href="javascript:void(0)"><?php echo e(\App\Models\ProductCustomField::where('items_custom_id', 5)->first()->items_custom_field_name); ?></a>
                        </th>
                        <?php endif; ?>

                        <!--tableconfig_column_15 [custom field 6]-->
                        <?php if(\App\Models\ProductCustomField::where('items_custom_id', 6)->where('items_custom_field_status', 'enabled')->exists()): ?>
                        <th class="items_col_tableconfig_column_15 <?php echo e(config('table.tableconfig_column_15')); ?> tableconfig_column_15">
                            <a href="javascript:void(0)"><?php echo e(\App\Models\ProductCustomField::where('items_custom_id', 6)->first()->items_custom_field_name); ?></a>
                        </th>
                        <?php endif; ?>

                        <!--tableconfig_column_16 [custom field 7]-->
                        <?php if(\App\Models\ProductCustomField::where('items_custom_id', 7)->where('items_custom_field_status', 'enabled')->exists()): ?>
                        <th class="items_col_tableconfig_column_16 <?php echo e(config('table.tableconfig_column_16')); ?> tableconfig_column_16">
                            <a href="javascript:void(0)"><?php echo e(\App\Models\ProductCustomField::where('items_custom_id', 7)->first()->items_custom_field_name); ?></a>
                        </th>
                        <?php endif; ?>

                        <!--tableconfig_column_17 [custom field 8]-->
                        <?php if(\App\Models\ProductCustomField::where('items_custom_id', 8)->where('items_custom_field_status', 'enabled')->exists()): ?>
                        <th class="items_col_tableconfig_column_17 <?php echo e(config('table.tableconfig_column_17')); ?> tableconfig_column_17">
                            <a href="javascript:void(0)"><?php echo e(\App\Models\ProductCustomField::where('items_custom_id', 8)->first()->items_custom_field_name); ?></a>
                        </th>
                        <?php endif; ?>

                        <!--tableconfig_column_18 [custom field 9]-->
                        <?php if(\App\Models\ProductCustomField::where('items_custom_id', 9)->where('items_custom_field_status', 'enabled')->exists()): ?>
                        <th class="items_col_tableconfig_column_18 <?php echo e(config('table.tableconfig_column_18')); ?> tableconfig_column_18">
                            <a href="javascript:void(0)"><?php echo e(\App\Models\ProductCustomField::where('items_custom_id', 9)->first()->items_custom_field_name); ?></a>
                        </th>
                        <?php endif; ?>

                        <!--tableconfig_column_19 [custom field 10]-->
                        <?php if(\App\Models\ProductCustomField::where('items_custom_id', 10)->where('items_custom_field_status', 'enabled')->exists()): ?>
                        <th class="items_col_tableconfig_column_19 <?php echo e(config('table.tableconfig_column_19')); ?> tableconfig_column_19">
                            <a href="javascript:void(0)"><?php echo e(\App\Models\ProductCustomField::where('items_custom_id', 10)->first()->items_custom_field_name); ?></a>
                        </th>
                        <?php endif; ?>

                        <?php if(config('visibility.items_col_action')): ?>
                        <th class="items_col_action with-table-config-icon actions_column"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a>

                            <!--[tableconfig]-->
                            <div class="table-config-icon">
                                <span class="text-default js-toggle-table-config-panel"
                                    data-target="table-config-items">
                                    <i class="sl-icon-settings">
                                    </i>
                                </span>
                            </div>
                            <!--[/tableconfig]-->

                        </th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody id="items-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.items.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!--ajax content here-->

                    <!--bulk actions - change category-->
                    <input type="hidden" name="checkbox_actions_items_category" id="checkbox_actions_items_category">
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            <?php echo $__env->make('misc.load-more-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <!--load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            <?php endif; ?> <?php if(@count($items ?? []) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/items/components/table/table.blade.php ENDPATH**/ ?>