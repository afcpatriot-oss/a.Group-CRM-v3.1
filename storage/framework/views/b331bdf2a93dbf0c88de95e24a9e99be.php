<!--totals-->
<tr class="report-results-table-totals">
    <td colspan="1"><?php echo app('translator')->get('lang.page_totals'); ?></td>


    <!--sum_not_invoiced-->
    <td>
        <?php echo e(runtimeSecondsWholeHours($totals['sum_not_invoiced'])); ?>:<?php echo e(runtimeSecondsWholeMinutesZero($totals['sum_not_invoiced'])); ?>

    </td>

    <!--sum_invoiced-->
    <td>
        <?php echo e(runtimeSecondsWholeHours($totals['sum_invoiced'])); ?>:<?php echo e(runtimeSecondsWholeMinutesZero($totals['sum_invoiced'])); ?>

    </td>

    <!--sum_hours-->
    <td>
        <?php echo e(runtimeSecondsWholeHours($totals['sum_hours'])); ?>:<?php echo e(runtimeSecondsWholeMinutesZero($totals['sum_hours'])); ?>

    </td>

</tr>

<!--pagination-->
<tr>
    <td class="pagination-container" data-tableexport-display="none" colspan="11">
        <div class="pagination">
            <?php echo e($timesheets->links('pages.reports.components.misc.pagination')); ?>

        </div>
    </td>
</tr><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/reports/timesheets/project/footer.blade.php ENDPATH**/ ?>