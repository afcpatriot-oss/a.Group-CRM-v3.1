<!--bulk actions-->
<?php echo $__env->make('pages.proposals.components.actions.checkbox-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--main table view-->
<?php echo $__env->make('pages.proposals.components.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--filter-->
<?php if(auth()->user()->is_team): ?>
<?php echo $__env->make('pages.proposals.components.misc.filter-proposals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!--filter--><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/proposals/components/table/wrapper.blade.php ENDPATH**/ ?>