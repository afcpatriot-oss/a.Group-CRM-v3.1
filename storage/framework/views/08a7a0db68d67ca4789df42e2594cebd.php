<div class="boards count-<?php echo e(@count($tasks ?? [])); ?>" id="tasks-view-wrapper">
    <!--filtered results warning-->
    <?php if(config('filter.status') == 'active'): ?>
    <div class="filtered-results-warning opacity-8 p-b-5">
        <small>
            <?php echo app('translator')->get('lang.these_results_are'); ?>
            <a href="javascript:void(0);" class="js-toggle-side-panel" data-target="sidepanel-filter-tasks"><?php echo app('translator')->get('lang.filtered'); ?></a>.
            <?php echo app('translator')->get('lang.you_can'); ?>
            <a href="<?php echo e(url('/tasks?clear-filter=yes')); ?>"><?php echo app('translator')->get('lang.clear_the_filters'); ?></a>.
        </small>
    </div>
    <?php endif; ?>
    <!--each board-->
    <?php $__currentLoopData = $boards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $board): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!--board-->
    <?php echo $__env->make('pages.tasks.components.kanban.board', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<!--ajax element-->
<span class="hidden" data-url=""></span>

<!--filter-->
<?php if(auth()->user()->is_team): ?>
<?php echo $__env->make('pages.tasks.components.misc.filter-tasks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!--filter-->

<!--export-->
<?php if(config('visibility.list_page_actions_exporting')): ?>
<?php echo $__env->make('pages.export.tasks.export', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/tasks/components/kanban/kanban.blade.php ENDPATH**/ ?>