
<?php $__env->startSection('settings-page'); ?>
<!--settings-->
<form class="form" id="settingsFormTimesheets">

    <!--item-->
    <div class="form-group row">
        <label class="col-sm-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.show_trimesheet_recorded_by'); ?></label>
        <div class="col-sm-12">
            <select class="select2-basic form-control form-control-sm select2-preselected" id="settings2_timesheets_show_recorded_by"
                name="settings2_timesheets_show_recorded_by" data-preselected="<?php echo e($settings->settings2_timesheets_show_recorded_by ?? ''); ?>">
                <option></option>
                <option value="yes"><?php echo app('translator')->get('lang.yes'); ?></option>
                <option value="no"><?php echo app('translator')->get('lang.no'); ?></option>
            </select>
        </div>
    </div>

    <!--buttons-->
    <div class="text-right">
        <button type="submit" id="settingsFormTimesheetsButton" class="btn btn-rounded-x btn-danger waves-effect text-left ajax-request"
            data-url="/settings/timesheets" data-loading-target="" data-ajax-type="PUT" data-type="form"
            data-on-start-submit-button="disable"><?php echo e(cleanLang(__('lang.save_changes'))); ?></button>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/settings/sections/timesheets/page.blade.php ENDPATH**/ ?>