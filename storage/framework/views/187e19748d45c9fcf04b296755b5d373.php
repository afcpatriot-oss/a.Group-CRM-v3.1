        <!--HEADER-->
        <div class="billing-mode-only-item">
            <span class="pull-left">
                <h3><b><?php echo e(cleanLang(__('lang.invoice'))); ?></b>
                    <!--recurring icon-->
                    <?php echo $__env->make('pages.bill.components.elements.invoice.icons-recuring', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </h3>
                <span>
                    <h5>#<?php echo e($bill->formatted_bill_invoiceid); ?></h5>
                </span>

                <!--module extension point-->
                <?php echo $__env->yieldPushContent('bill_position_1'); ?>
            </span>
            <span class="pull-right text-align-right">
                <!--status-->
                <span class="js-invoice-statuses" id="invoice-status-draft">
                    <h1 class="text-uppercase text-<?php echo e(runtimeInvoiceStatusColors($bill->bill_status, 'text')); ?>">
                        <?php echo e(runtimeInvoiceStatusTitle($bill->bill_status)); ?></h1>
                </span>

                <!--module extension point-->
                <?php echo $__env->yieldPushContent('bill_position_2'); ?>

                <?php if(config('system.settings_estimates_show_view_status') == 'yes' && (auth()->check() &&
                auth()->user()->is_team) &&
                $bill->bill_status != 1 && $bill->bill_status != 5): ?>
                <?php if($bill->bill_viewed_by_client == 'no'): ?>
                <span>
                    <span
                        class="label label-light-inverse text-lc font-normal"><?php echo app('translator')->get('lang.client_has_not_opened'); ?></span>
                </span>
                <?php endif; ?>
                <?php if($bill->bill_viewed_by_client == 'yes'): ?>
                <span>
                    <span
                        class="label label label-lighter-info text-lc font-normal"><?php echo app('translator')->get('lang.client_has_opened'); ?></span>
                </span>
                <?php endif; ?>
                <?php endif; ?>

                <!--reminder sent-->
                <?php if((auth()->check() && auth()->user()->is_team) && $bill->bill_status == 3): ?>
                <span>
                    <span
                        class="label label label-light-danger text-lc font-normal"><?php echo app('translator')->get('lang.overdue_reminders_sent'); ?>
                        -
                        <span
                            id="invoice_overdue_reminder_counter"><?php echo e($bill->bill_overdue_reminder_counter ?? 0); ?></span></span>
                </span>
                <?php endif; ?>
                                <!--module extension point-->
                <?php echo $__env->yieldPushContent('bill_position_3'); ?>
            </span>
        </div><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/bill/components/elements/invoice/header-web.blade.php ENDPATH**/ ?>