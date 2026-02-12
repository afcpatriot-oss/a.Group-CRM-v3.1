<!-- action buttons -->
<?php echo $__env->make('pages.leads.components.misc.list-page-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- action buttons -->

<!--stats panel-->
<?php if(auth()->user()->is_team): ?>
<div id="leads-stats-wrapper" class="stats-wrapper card-embed-fix">
    <?php if(@count($leads ?? []) > 0): ?> <?php echo $__env->make('misc.list-pages-stats', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endif; ?>
</div>
<?php endif; ?>
<!--stats panel-->

<?php if(auth()->user()->pref_view_leads_layout =='list'): ?>
<div class="card-embed-fix  kanban-wrapper">
    <?php echo $__env->make('pages.leads.components.table.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php else: ?>
<div class="card-embed-fix  kanban-wrapper">
    <?php echo $__env->make('pages.leads.components.kanban.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php endif; ?>


<!--filter-->
<?php if(auth()->user()->is_team): ?>
<?php echo $__env->make('pages.leads.components.misc.filter-leads', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!--filter--><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/leads/tabswrapper.blade.php ENDPATH**/ ?>