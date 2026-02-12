<!--title-->
<?php echo $__env->make('pages.task.components.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<!--[dependency][lock-1] start-->
<?php if(config('visibility.task_is_locked')): ?>
<div class="alert alert-warning"><?php echo app('translator')->get('lang.task_dependency_info_cannot_be_started'); ?></div>
<?php else: ?>

<!--module extension point - allows modules to inject content-->
<?php echo $__env->yieldPushContent('section_task_left_panel_one'); ?>


<!--description-->
<?php echo $__env->make('pages.task.components.description', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--module extension point - allows modules to inject content-->
<?php echo $__env->yieldPushContent('section_task_left_panel_two'); ?>

<!--checklist-->
<div id="checklist-wrapper">
    <?php echo $__env->make('pages.task.components.checklists', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--module extension point - allows modules to inject content-->
    <?php echo $__env->yieldPushContent('section_task_left_panel_checklist'); ?>
</div>


<!--module extension point - allows modules to inject content-->
<?php echo $__env->yieldPushContent('section_task_left_panel_three'); ?>


<!--attachments-->
<?php echo $__env->make('pages.task.components.attachments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--module extension point - allows modules to inject content-->
<?php echo $__env->yieldPushContent('section_task_left_panel_four'); ?>


<!--comments-->
<?php if(config('visibility.tasks_standard_features')): ?>
<div class="card-comments" id="card-comments">
    <div class="x-heading"><i class="mdi mdi-message-text"></i>Comments</div>
    <div class="x-content">
        <?php echo $__env->make('pages.task.components.post-comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--comments-->
        <div id="card-comments-container">
            <!--dynamic content here-->
        </div>

        <!--module extension point - allows modules to inject content-->
        <?php echo $__env->yieldPushContent('section_task_left_panel_comments'); ?>

    </div>
</div>
<?php endif; ?>
<?php endif; ?>
<!--[dependency][lock-1] end-->

<!--module extension point - allows modules to inject content-->
<?php echo $__env->yieldPushContent('section_task_left_panel_five'); ?><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/task/leftpanel.blade.php ENDPATH**/ ?>