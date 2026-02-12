<div class="card-top-nav-actions">
    <!--star button-->
    <span title="<?php echo e(cleanLang(__('lang.star_lead'))); ?>"
        class="star-button data-toggle-action-tooltip opacity-4 ajax-request <?php echo e($lead->is_starred ? 'hidden' : ''); ?> starred-star-button-<?php echo e($lead->lead_id); ?>"
        id="starred-star-button-<?php echo e($lead->lead_id); ?>"
        data-url="<?php echo e(url('/starred/togglestatus?action=star&resource_type=lead&resource_id='.$lead->lead_id)); ?>"
        data-loading-target="starred-star-button-<?php echo e($lead->lead_id); ?>"
        data-ajax-type="POST"
        data-on-start-submit-button="disable">
        <i class="sl-icon-star"></i>
    </span>

    <!--unstar button-->
    <span title="<?php echo e(cleanLang(__('lang.unstar_lead'))); ?>"
        class="star-button data-toggle-action-tooltip ajax-request text-warning <?php echo e(!$lead->is_starred ? 'hidden' : ''); ?> starred-unstar-button-<?php echo e($lead->lead_id); ?>"
        id="starred-unstar-button-<?php echo e($lead->lead_id); ?>"
        data-url="<?php echo e(url('/starred/togglestatus?action=unstar&resource_type=lead&resource_id='.$lead->lead_id)); ?>"
        data-loading-target="starred-unstar-button-<?php echo e($lead->lead_id); ?>"
        data-ajax-type="POST"
        data-on-start-submit-button="disable">
        <i class="sl-icon-star"></i>
    </span>
</div>

<div class="card-title" id="<?php echo e(runtimePermissions('lead-edit-title', $lead->permission_edit_lead)); ?>">
    <?php echo e($lead->lead_title); ?>

</div>


<!--buttons: edit-->
<?php if($lead->permission_edit_lead): ?>
<div id="card-title-edit" class="card-title-edit hidden">
    <input type="text" class="form-control form-control-sm card-title-input" id="lead_title" name="lead_title">
    <!--button: subit & cancel-->
    <div id="card-title-submit" class="p-t-10 text-right">
        <button type="button" class="btn waves-effect waves-light btn-xs btn-default"
            id="card-title-button-cancel"><?php echo e(cleanLang(__('lang.cancel'))); ?></button>
        <button type="button" class="btn waves-effect waves-light btn-xs btn-danger"
            data-url="<?php echo e(url('/leads/'.$lead->lead_id.'/update-title')); ?>" data-progress-bar='hidden' data-type="form"
            data-form-id="card-title-edit" data-ajax-type="post" id="card-title-button-save"><?php echo e(cleanLang(__('lang.save'))); ?></button>
    </div>
</div>
<?php endif; ?>

<!--this item is archived notice-->
<?php if(runtimeArchivingOptions()): ?>
<div id="card_archived_notice_<?php echo e($lead->lead_id); ?>" class="alert alert-warning p-t-7 p-b-7 <?php echo e(runtimeActivateOrAchive('archived-notice', $lead->lead_active_state)); ?>"> <i class="mdi mdi-archive"></i> <?php echo app('translator')->get('lang.this_lead_is_archived'); ?>
</div>
<?php endif; ?><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/lead/components/title.blade.php ENDPATH**/ ?>