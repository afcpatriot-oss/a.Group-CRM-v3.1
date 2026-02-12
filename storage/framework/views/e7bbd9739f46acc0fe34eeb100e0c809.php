<?php $__env->startSection('content'); ?>

<!-- main content -->
<div class="container-fluid">

    <!-- page heading -->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        <?php echo $__env->make('misc.heading-crumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Page Title & Bread Crumbs -->

    </div>
    <!-- page heading -->

    <!-- orders page content -->
    <div class="row">
        <div class="col-12" id="orders-layout-wrapper">

            
            <?php echo $__env->make('pages.orders.components.table.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Заменили на orders -->

        </div>
    </div>
    <!-- orders page content -->

</div>
<!-- main content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/orders/wrapper.blade.php ENDPATH**/ ?>