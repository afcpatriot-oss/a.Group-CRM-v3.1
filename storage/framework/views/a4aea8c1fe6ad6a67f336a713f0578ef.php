<!--filtered results warning-->
<?php if(config('filter.status') == 'active'): ?>
<div class="filtered-results-warning opacity-8 p-b-5">
    <small>
        <?php echo app('translator')->get('lang.these_results_are'); ?>
        <a href="javascript:void(0);" class="js-toggle-side-panel" data-target="sidepanel-filter-leads"><?php echo app('translator')->get('lang.filtered'); ?></a>.
        <?php echo app('translator')->get('lang.you_can'); ?>
        <a href="<?php echo e(url('/leads?clear-filter=yes')); ?>"><?php echo app('translator')->get('lang.clear_the_filters'); ?></a>.
    </small>
</div>
<?php endif; ?>

<div class="boards count-<?php echo e(@count($leads ?? [])); ?> js-trigger-leads-kanban-board" id="leads-view-wrapper" data-position="<?php echo e(url('leads/update-position')); ?>">
    <!--each board-->
    <?php $__currentLoopData = $boards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $board): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!--board-->
    <?php echo $__env->make('pages.leads.components.kanban.board', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/leads/components/kanban/kanban.blade.php ENDPATH**/ ?>