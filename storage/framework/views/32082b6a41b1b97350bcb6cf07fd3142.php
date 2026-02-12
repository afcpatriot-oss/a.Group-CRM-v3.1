<div class="card-top-nav-actions">
    <!--star button-->
    <span title="<?php echo e(cleanLang(__('lang.star_task'))); ?>"
        class="star-button data-toggle-action-tooltip opacity-4 ajax-request <?php echo e($task->is_starred ? 'hidden' : ''); ?> starred-star-button-<?php echo e($task->task_id); ?>"
        id="starred-star-button-<?php echo e($task->task_id); ?>"
        data-url="<?php echo e(url('/starred/togglestatus?action=star&resource_type=task&resource_id='.$task->task_id)); ?>"
        data-loading-target="starred-star-button-<?php echo e($task->task_id); ?>"
        data-ajax-type="POST"
        data-on-start-submit-button="disable">
        <i class="sl-icon-star"></i>
    </span>

    <!--unstar button-->
    <span title="<?php echo e(cleanLang(__('lang.unstar_task'))); ?>"
        class="star-button data-toggle-action-tooltip ajax-request text-warning <?php echo e(!$task->is_starred ? 'hidden' : ''); ?> starred-unstar-button-<?php echo e($task->task_id); ?>"
        id="starred-unstar-button-<?php echo e($task->task_id); ?>"
        data-url="<?php echo e(url('/starred/togglestatus?action=unstar&resource_type=task&resource_id='.$task->task_id)); ?>"
        data-loading-target="starred-unstar-button-<?php echo e($task->task_id); ?>"
        data-ajax-type="POST"
        data-on-start-submit-button="disable">
        <i class="sl-icon-star"></i>
    </span>
</div>

<div class="card-title m-b-0">
    <span id="<?php echo e(runtimePermissions('task-edit-title', $task->permission_edit_task)); ?>"> <?php echo e($task->task_title); ?>

    </span>
</div>
<!--buttons: edit-->
<?php if($task->permission_edit_task): ?>
<div id="card-title-edit" class="card-title-edit hidden">
    <input type="text" class="form-control form-control-sm card-title-input" id="task_title" name="task_title">
    <!--button: subit & cancel-->
    <div id="card-title-submit" class="p-t-10 text-right">
        <button type="button" class="btn waves-effect waves-light btn-xs btn-default"
            id="card-title-button-cancel"><?php echo e(cleanLang(__('lang.cancel'))); ?></button>
        <button type="button" class="btn waves-effect waves-light btn-xs btn-danger"
            data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/update-title')); ?>" data-progress-bar='hidden'
            data-type="form" data-form-id="card-title-edit" data-ajax-type="post"
            id="card-title-button-save"><?php echo e(cleanLang(__('lang.save'))); ?></button>
    </div>
</div>
<?php endif; ?>
<div class="m-b-5">
    <div><small><strong><?php echo app('translator')->get('lang.project'); ?>: </strong></small><small id="card-task-milestone-title"><a
                href="<?php echo e(url('projects/'.$task->project_id ?? '')); ?>"><?php echo e($task->project_title ?? '---'); ?></a></small>
    </div>
    <div><small><strong><?php echo app('translator')->get('lang.milestone'); ?>: </strong></small><small
            id="card-task-milestone-title"><?php echo e(runtimeLang($task->milestone_title, 'task_milestone')); ?></small></div>

    <!--module extension point - allows modules to inject content-->
    <?php echo $__env->yieldPushContent('section_task_left_panel_title'); ?>
</div>
<!--this item is archived notice-->
<?php if(runtimeArchivingOptions()): ?>
<div id="card_archived_notice_<?php echo e($task->task_id); ?>"
    class="alert alert-warning p-t-7 p-b-7 <?php echo e(runtimeActivateOrAchive('archived-notice', $task->task_active_state)); ?>">
    <i class="mdi mdi-archive"></i> <?php echo app('translator')->get('lang.this_task_is_archived'); ?>
</div>
<?php endif; ?><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/task/components/title.blade.php ENDPATH**/ ?>