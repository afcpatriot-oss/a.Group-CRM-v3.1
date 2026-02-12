<!--rows-->
<?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>

    <!--project_id-->
    <td><a href="<?php echo e(url('projects/'.$project->project_id)); ?>"><?php echo e($project->project_id); ?></a>
    </td>

    <!--project_title-->
    <td><a href="<?php echo e(url('projects/'.$project->project_id)); ?>"><?php echo e(str_limit_reports($project->project_title ?? '---', 40)); ?></a>
    </td>

    <!--project_date_due-->
    <td><span class="hidden used-for-sorting"><?php echo e($project->timestamp_project_date_due); ?></span><?php echo e(runtimeDate($project->project_date_due)); ?></td>

    <!--count_tasks_due-->
    <td>
        <?php echo e($project->count_tasks_due); ?></td>

    <!--count_tasks_completed-->
    <td>
        <?php echo e($project->count_tasks_completed); ?></td>


    <!--sum_hours-->
    <td>
        <?php echo e(runtimeSecondsWholeHours($project->sum_hours)); ?>:<?php echo e(runtimeSecondsWholeMinutesZero($project->sum_hours)); ?></td>

    <!--sum_expenses-->
    <td class="data-type-money" data-tableexport-xlsxformatid="4">
        <?php echo e(runtimeMoneyFormat($project->sum_expenses)); ?></td>

    <!--sum_invoices-->
    <td class="data-type-money" data-tableexport-xlsxformatid="4">
        <?php echo e(runtimeMoneyFormat($project->sum_invoices)); ?></td>

    <!--sum_payments-->
    <td class="data-type-money" data-tableexport-xlsxformatid="4">
        <?php echo e(runtimeMoneyFormat($project->sum_payments)); ?></td>

    <!--project_status-->
    <td> <span class="label <?php echo e(runtimeProjectStatusColors($project->project_status, 'label')); ?>"><?php echo e(runtimeLang($project->project_status)); ?></span></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/reports/projects/overview/ajax.blade.php ENDPATH**/ ?>