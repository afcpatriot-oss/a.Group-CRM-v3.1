<!-- action buttons -->
<?php echo $__env->make('pages.orders.components.misc.list-page-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Заменили на orders -->
<!-- action buttons -->

<!--stats panel-->
<?php if(auth()->user()->is_team): ?>
<div id="orders-stats-wrapper" class="stats-wrapper card-embed-fix"> <!-- Заменили на orders -->
    <?php if(@count($orders ?? []) > 0): ?> <?php echo $__env->make('misc.list-pages-stats', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endif; ?> <!-- Заменили на orders -->
</div>
<?php endif; ?>
<!--stats panel-->

<?php if(auth()->user()->pref_view_orders_layout =='list'): ?> <!-- Заменили на orders -->
<div class="card-embed-fix kanban-wrapper">
    <?php echo $__env->make('pages.orders.components.table.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Заменили на orders -->
</div>
<?php else: ?>
<div class="card-embed-fix kanban-wrapper">
    <?php echo $__env->make('pages.orders.components.kanban.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Заменили на orders -->
</div>
<?php endif; ?>

<!--filter-->
<?php if(auth()->user()->is_team): ?>
<?php echo $__env->make('pages.orders.components.misc.filter-orders', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Заменили на orders -->
<?php endif; ?>
<!--filter-->
<?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/orders/tabswrapper.blade.php ENDPATH**/ ?>