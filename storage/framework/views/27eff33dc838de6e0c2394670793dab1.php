<div class="row">

    <!--INCOME-->
    <?php echo $__env->make('pages.home.admin.widgets.second-row.income', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!--LEADS-->
    <?php echo $__env->make('pages.home.admin.widgets.second-row.leads', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!--TICKETS (optional)-->
    <?php echo $__env->make('pages.home.admin.widgets.second-row.tickets', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/home/admin/widgets/second-row/wrapper.blade.php ENDPATH**/ ?>