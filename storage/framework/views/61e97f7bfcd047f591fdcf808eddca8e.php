<div class="row">
    <div class="col-lg-12">
        <!--unit name-->
        <div class="form-group row">
            <label class="col-12 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.unit_name'))); ?>*</label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="unit_name" name="unit_name"
                    placeholder="<?php echo e(cleanLang(__('lang.units_examples'))); ?>"
                    value="<?php echo e($unit->unit_name ?? ''); ?>">
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/settings/sections/units/modals/add-edit.blade.php ENDPATH**/ ?>