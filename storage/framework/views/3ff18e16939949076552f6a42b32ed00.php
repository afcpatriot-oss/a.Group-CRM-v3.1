<div class="table-responsive p-b-30" id="units-table-wrapper">
    <?php if(@count($units ?? []) > 0): ?>
    <table id="units-list" class="table m-t-0 m-b-0 table-hover no-wrap units-list">
        <thead>
            <tr>
                <th class="units_col_name"><?php echo e(cleanLang(__('lang.unit_name'))); ?></th>
                <th class="units_col_created_by"><?php echo e(cleanLang(__('lang.created_by'))); ?></th>
                <th class="units_col_products"><?php echo e(cleanLang(__('lang.products'))); ?></th>
                <th class="units_col_action w-px-110"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
            </tr>
        </thead>
        <tbody id="units-td-container">
            <!--ajax content here-->
            <?php echo $__env->make('pages.settings.sections.units.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--ajax content here-->
        </tbody>
    </table>
    <?php endif; ?>
    <?php if(@count($units ?? []) == 0): ?>
    <!--nothing found-->
    <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--nothing found-->
    <?php endif; ?>
</div>
<?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/settings/sections/units/table.blade.php ENDPATH**/ ?>