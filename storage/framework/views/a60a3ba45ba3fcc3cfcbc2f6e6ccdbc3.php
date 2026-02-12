
<!--totals-->
<tr class="report-results-table-totals">
    <td colspan="3"><?php echo app('translator')->get('lang.page_totals'); ?></td>

    <!--count_tasks_due-->
    <td>
        <?php echo e($totals['count_tasks_due']); ?></td>

    <!--count_tasks_completed-->
    <td><?php echo e($totals['count_tasks_completed']); ?></td>

    <!--sum_hours-->
    <td>
        <?php if($totals['sum_hours'] == 0): ?>
        0
        <?php else: ?>
        <?php echo e(runtimeSecondsWholeHours($totals['sum_hours'])); ?>:<?php echo e(runtimeSecondsWholeMinutesZero($totals['sum_hours'])); ?>

        <?php endif; ?>
    </td>

    <!--sum_expenses-->
    <td class="data-type-money" data-tableexport-xlsxformatid="4">
        <?php echo e(runtimeMoneyFormat($totals['sum_expenses'] ?? 0)); ?></td>

    <!--sum_invoices-->
    <td class="data-type-money" data-tableexport-xlsxformatid="4">
        <?php echo e(runtimeMoneyFormat($totals['sum_invoices'] ?? 0)); ?>

    </td>

    <!--sum_payments-->
    <td class="data-type-money" data-tableexport-xlsxformatid="4">
        <?php echo e(runtimeMoneyFormat($totals['sum_payments'] ?? 0)); ?>

    </td>
    <td>---</td>
</tr>

<!--pagination-->
<tr>
    <td class="pagination-container" data-tableexport-display="none" colspan="11">
        <div class="pagination">
            <?php echo e($projects->links('pages.reports.components.misc.pagination')); ?>

        </div>
    </td>
</tr><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/reports/projects/overview/footer.blade.php ENDPATH**/ ?>