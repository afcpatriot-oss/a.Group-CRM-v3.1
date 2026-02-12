<!--checklist container-->
<div class="global-checklist checklist-comments-visible max-width-800 m-l-auto m-r-auto p-t-20" id="global-checklist-container">
    <div class="x-heading clearfix">
        <span class="pull-left"><i class="mdi mdi-checkbox-marked"></i><?php echo e(cleanLang(__('lang.checklist'))); ?></span>
        <span class="pull-right p-t-5" id="card-checklist-progress"><?php echo e($progress['completed'] ?? '---'); ?></span>
    </div>
    <div class="progress" id="card-checklist-progress-container">
        <?php echo $__env->make('pages.checklists.progressbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="x-content p-t-30" id="card-checklists-container" data-progress-bar="hidden" data-type="form"
        data-ajax-type="post" data-form-id="card-checklists-container"
        data-url="<?php echo e(url('/checklists/update-checklist-positions')); ?>">
        <!--dynamic content here-->
        <?php if(isset($checklists) && $checklists->count() > 0): ?>
        <?php echo $__env->make('pages.checklists.checklist', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>

    <?php if(isset($can_manage_checklists) && $can_manage_checklists): ?>
    <div class="x-action p-b-20 p-t-30" id="checklists-actions-panel">

        <!--add new checklist button-->
        <a href="javascript:void(0)" id="checklist-add-new-button" class="btn btn-info btn-rounded btn-sm btn-rounded-icon"
            data-action-url="<?php echo e(url('/checklists/add-checklist')); ?>" data-toggle="new">
            <i class="mdi mdi-plus-circle-outline"></i>
                <span><?php echo app('translator')->get('lang.add_new_item'); ?></span></a>


        <!-- Import Checklist Items Link -->
        <a href="javascript:void(0);"  class="btn btn-success btn-rounded btn-sm btn-rounded-icon" id="import-checklist-link"><i class="mdi mdi-arrow-up-bold-circle-outline"></i>
            <span><?php echo app('translator')->get('lang.import_checklist_items'); ?></span></a>

        <!--Hide or Show checklist comments-->
        <a href="javascript:void(0);" class="checklist-comments-hide-button btn btn-default btn-rounded btn-sm btn-rounded-icon"><i class="mdi mdi-comment-outline"></i>
            <span><?php echo app('translator')->get('lang.hide_checklist_comments'); ?></span></a>
        <a href="javascript:void(0);" class="p-l-10 checklist-comments-show-button btn btn-default btn-rounded btn-sm btn-rounded-icon"><i class="mdi mdi-comment-plus-outline"></i>
            <span><?php echo app('translator')->get('lang.show_comments'); ?></span></a>

    </div>


    <!--add checklist form-->
    <div id="new-checklist-text-container" class="hidden p-l-25">
        <textarea class="form-control form-control-sm checklist_text" rows="3" name="checklist_text"
            id="checklist_text"></textarea>
        <div class="text-right">


            <!--checklistresource_type-->
            <input type="hidden" name="checklistresource_type" value="<?php echo e(request('checklistresource_type')); ?>">

            <!--checklistresource_id-->
            <input type="hidden" name="checklistresource_id" value="<?php echo e(request('checklistresource_id')); ?>">

            <!--close button-->
            <button type="button" class="btn btn-default  btn-xs" data-toggle="close"
                id="new-checklist-text-form-close-button" href="JavaScript:void(0);">
                <?php echo app('translator')->get('lang.close'); ?>
            </button>

            <!--submit new checklist button-->
            <button type="button" class="btn btn-danger  btn-xs js-ajax-ux-request x-submit-button disable-on-click"
                id="new-checklist-text-form-submit-button" data-url="<?php echo e(url('/checklists')); ?>" data-type="form"
                data-ajax-type="post" data-form-id="new-checklist-text-container"
                data-loading-target="new-checklist-text-container">
                <?php echo app('translator')->get('lang.add'); ?>
            </button>
        </div>
    </div>

    <!-- Import Checklist Container -->
    <div class="hidden" id="import-checklist-container" data-initial-url="<?php echo e(url('/fileupload')); ?>"
        data-url="<?php echo e(url('/checklists/import-checklists')); ?>" data-type="form" data-form-id="import-checklist-container"
        data-ajax-type="post" data-loading-target="import-checklist-file">

        <!-- Resource type and ID hidden fields -->
        <input type="hidden" name="checklistresource_type" value="<?php echo e(request('checklistresource_type', 'project')); ?>">
        <input type="hidden" name="checklistresource_id" value="<?php echo e(request('checklistresource_id')); ?>">

        <div class="x-content">
            <div class="dropzone dz-clickable" id="import-checklist-file">
                <div class="dz-default dz-message">
                    <i class="icon-Upload-toCloud"></i>
                    <span><?php echo app('translator')->get('lang.drag_drop_checklist_file'); ?></span>
                    <small>Excel - CSV - TXT</small>
                </div>
            </div>
        </div>
        <!--dynamic file details-->
        <div id="import-checklist-file-payload"></div>
    </div>
    <?php endif; ?>
</div><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/checklists/checklists.blade.php ENDPATH**/ ?>