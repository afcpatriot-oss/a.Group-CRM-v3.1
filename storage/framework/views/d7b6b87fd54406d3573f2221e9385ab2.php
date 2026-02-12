<?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="expense_<?php echo e($expense->expense_id); ?>" class="<?php echo e($expense->pinned_status ?? ''); ?>">
    <?php if(config('visibility.expenses_col_checkboxes')): ?>
    <td class="expenses_col_checkbox checkitem" id="expenses_col_checkbox_<?php echo e($expense->expense_id); ?>">
        <!--list checkbox-->
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox" id="listcheckbox-expenses-<?php echo e($expense->expense_id); ?>"
                name="ids[<?php echo e($expense->expense_id); ?>]"
                class="listcheckbox listcheckbox-expenses filled-in chk-col-light-blue expenses-checkbox"
                data-actions-container-class="expenses-checkbox-actions-container"
                data-expense-id="<?php echo e($expense->expense_id); ?>" data-unit="<?php echo e(cleanLang(__('lang.item'))); ?>"
                data-quantity="1" data-description="<?php echo e($expense->expense_description); ?>"
                data-rate="<?php echo e($expense->expense_amount); ?>">
            <label for="listcheckbox-expenses-<?php echo e($expense->expense_id); ?>"></label>
        </span>
    </td>
    <?php endif; ?>
    <td class="expenses_col_id">
        <span class="display-inline-block"><?php echo e($expense->expense_id); ?></span>
        <!--recurring-->
        <?php if($expense->expense_recurring == 'yes'): ?>
        <span class="sl-icon-refresh text-danger display-inline-block p-l-5 vertical-align-middle" data-toggle="tooltip"
            title="<?php echo app('translator')->get('lang.recurring_expense'); ?>"></span>
        <?php endif; ?>
        <!--child expense-->
        <?php if($expense->expense_recurring_child == 'yes'): ?>
        <span class="ti-back-right text-success display-inline-block p-l-5 vertical-align-middle" data-toggle="tooltip"
            title="<?php echo app('translator')->get('lang.expense_automatically_created_from_recurring'); ?> (#<?php echo e($expense->expense_recurring_parent_id); ?>)"></span>
        <?php endif; ?>
    </td>
    <?php if(config('visibility.expenses_col_date')): ?>
    <td class="expenses_col_date">
        <?php echo e(runtimeDate($expense->expense_date)); ?>

    </td>
    <?php endif; ?>
    <?php if(config('visibility.expenses_col_description')): ?>
    <td class="expenses_col_description">
        <?php if(config('settings.trimmed_title')): ?>
        <span
            title="<?php echo e($expense->expense_description); ?>"><?php echo e(str_limit($expense->expense_description ?? '---', 15)); ?></span>
        <?php else: ?>
        <span
            title="<?php echo e($expense->expense_description); ?>"><?php echo e(str_limit($expense->expense_description ?? '---', 35)); ?></span>
        <?php endif; ?>
    </td>
    <?php endif; ?>
    <!--column visibility-->
    <?php if(config('visibility.expenses_col_user')): ?>
    <td class="expenses_col_user">
        <span class="printing_hidden">
        <img src="<?php echo e(getUsersAvatar($expense->avatar_directory, $expense->avatar_filename)); ?>" alt="user"
            class="img-circle avatar-xsmall"> <?php echo e(str_limit($expense->first_name ?? runtimeUnkownUser(), 8)); ?>

        </span>

        <!--print view-->
        <span class="hidden printing_visible">
            <?php echo e($expense->first_name ?? runtimeUnkownUser()); ?> <?php echo e($expense->last_name ?? ''); ?>

        </span>
    </td>
    <?php endif; ?>
    <!--column visibility-->
    <?php if(config('visibility.expenses_col_client')): ?>
    <td class="expenses_col_client">
        <a
            href="/clients/<?php echo e($expense->expense_clientid); ?>"><?php echo e(str_limit($expense->client_company_name ?? '---', 12)); ?></a>
    </td>
    <?php endif; ?>
    <!--column visibility-->
    <?php if(config('visibility.expenses_col_project')): ?>
    <td class="expenses_col_project">
        <a href="/projects/<?php echo e($expense->expense_projectid); ?>"><?php echo e(str_limit($expense->project_title ?? '---', 12)); ?></a>
    </td>
    <?php endif; ?>
    <?php if(config('visibility.expenses_col_amount')): ?>
    <td class="expenses_col_amount">
        <?php echo e(runtimeMoneyFormat($expense->expense_amount)); ?>

    </td>
    <?php endif; ?>
    <?php if(config('visibility.expenses_col_status')): ?>
    <td class="expenses_col_status">

        <?php if($expense->expense_billable == 'billable'): ?>
        <?php if($expense->expense_billing_status == 'invoiced'): ?>
        <span class="table-icons printing_hidden">
            <a href="<?php echo e(url('/invoices/'.$expense->expense_billable_invoiceid)); ?>">
                <i class="mdi mdi-credit-card-plus text-danger" data-toggle="tooltip"
                    title="<?php echo e(cleanLang(__('lang.invoiced'))); ?> : <?php echo e(runtimeInvoiceIdFormat($expense->expense_billable_invoiceid)); ?>"></i>
            </a>
        </span>
        <!--printing-->
        <span class="hidden printing_visible"><?php echo app('translator')->get('lang.invoiced'); ?></span>
        <?php else: ?>
        <span class="table-icons printing_hidden">
            <i class="mdi mdi-credit-card-plus text-success" data-toggle="tooltip"
                title="<?php echo e(cleanLang(__('lang.billable'))); ?> - <?php echo e(cleanLang(__('lang.not_invoiced'))); ?>"></i>
        </span>
        <!--printing-->
        <span class="hidden printing_visible"><?php echo app('translator')->get('lang.billable'); ?> - <?php echo app('translator')->get('lang.not_invoiced'); ?></span>
        <?php endif; ?>
        <?php else: ?>
        <span class="table-icons printing_hidden">
            <i class="mdi mdi-credit-card-off text-disabled" data-toggle="tooltip"
                title="<?php echo e(cleanLang(__('lang.not_billable'))); ?>"></i>
        </span>
        <!--printing-->
        <span class="hidden printing_visible"><?php echo app('translator')->get('lang.not_billable'); ?></span>
        <?php endif; ?>
    </td>
    <?php endif; ?>
    <?php if(config('visibility.expenses_col_action')): ?>
    <td class="expenses_col_action actions_column" id="expenses_col_action_<?php echo e($expense->expense_id); ?>">
        <!--action button-->
        <span class="list-table-action font-size-inherit">
            <!--delete-->
            <?php if(config('visibility.action_buttons_delete')): ?>
            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                data-url="<?php echo e(url('/')); ?>/expenses/<?php echo e($expense->expense_id); ?>">
                <i class="sl-icon-trash"></i>
            </button>
            <?php endif; ?>
            <!--edit-->
            <?php if(config('visibility.action_buttons_edit')): ?>
            <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(urlResource('/expenses/'.$expense->expense_id.'/edit')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('lang.edit_expense'))); ?>"
                data-action-url="<?php echo e(urlResource('/expenses/'.$expense->expense_id.'?ref=list')); ?>"
                data-action-method="PUT" data-action-ajax-class=""
                data-action-ajax-loading-target="expenses-td-container">
                <i class="sl-icon-note"></i>
            </button>
            <?php endif; ?>
            <button type="button" title="<?php echo e(cleanLang(__('lang.view'))); ?>"
                class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                data-modal-title="<?php echo e(cleanLang(__('lang.expense_records'))); ?>"
                data-url="<?php echo e(url('/expenses/'.$expense->expense_id)); ?>">
                <i class="ti-new-window"></i>
            </button>

            <!--more button (team)-->
            <?php if(config('visibility.action_buttons_edit') == 'show'): ?>
            <span class="list-table-action dropdown font-size-inherit">
                <button type="button" id="listTableAction" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" title="<?php echo e(cleanLang(__('lang.more'))); ?>"
                    class="data-toggle-action-tooltip btn btn-outline-default-light btn-circle btn-sm">
                    <i class="ti-more"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="listTableAction">
                    <?php if($expense->expense_billing_status == 'not_invoiced'): ?>
                    <!--actions button - attach project -->
                    <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form"
                        href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                        data-modal-title=" <?php echo e(cleanLang(__('lang.attach_to_project'))); ?>"
                        data-url="<?php echo e(url('/expenses/' . $expense->expense_id .'/attach-dettach')); ?>"
                        data-action-url="<?php echo e(urlResource('/expenses/' . $expense->expense_id .'/attach-dettach')); ?>"
                        data-loading-target="actionsModalBody" data-action-method="POST">
                        <?php echo e(cleanLang(__('lang.attach_dettach'))); ?></a>
                    <?php endif; ?>
                    <!--actions button - change category-->
                    <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form"
                        href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                        data-modal-title="<?php echo e(cleanLang(__('lang.change_category'))); ?>"
                        data-url="<?php echo e(url('/expenses/change-category')); ?>"
                        data-action-url="<?php echo e(urlResource('/expenses/change-category?id='.$expense->expense_id)); ?>"
                        data-loading-target="actionsModalBody" data-action-method="POST">
                        <?php echo e(cleanLang(__('lang.change_category'))); ?></a>

                    <!--recurring settings-->
                    <a class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        href="javascript:void(0)" data-toggle="modal" data-target="#commonModal"
                        data-url="<?php echo e(urlResource('/expenses/'.$expense->expense_id.'/recurring-settings?source=list')); ?>"
                        data-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.recurring_settings'); ?>"
                        data-action-url="<?php echo e(url('/expenses/'.$expense->expense_id.'/recurring-settings?source=list')); ?>"
                        data-action-method="POST"
                        data-action-ajax-loading-target="invoices-td-container"><?php echo app('translator')->get('lang.recurring_settings'); ?></a>

                    <!--stop recurring -->
                    <?php if($expense->expense_recurring == 'yes'): ?>
                    <a class="dropdown-item confirm-action-info" href="javascript:void(0)"
                        data-confirm-title="<?php echo e(cleanLang(__('lang.stop_recurring'))); ?>"
                        data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                        data-url="<?php echo e(urlResource('/expenses/'.$expense->expense_id.'/stop-recurring')); ?>">
                        <?php echo e(cleanLang(__('lang.stop_recurring'))); ?></a>
                    <?php endif; ?>

                    <!--clone expense-->
                    <?php if(auth()->user()->role->role_expenses > 1): ?>
                    <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form edit-add-modal-button"
                        href="javascript:void(0)" data-toggle="modal" data-target="#commonModal"
                        data-modal-title="<?php echo e(cleanLang(__('lang.clone_expense'))); ?>"
                        data-url="<?php echo e(url('/expenses/'.$expense->expense_id.'/clone')); ?>"
                        data-action-ajax-class="ajax-request"
                        data-action-url="<?php echo e(url('/expenses/'.$expense->expense_id.'/clone?filter_category='.request('filter_category'))); ?>"
                        data-loading-target="actionsModalBody" data-action-method="POST">
                        <?php echo e(cleanLang(__('lang.clone_expense'))); ?></a>
                    <?php endif; ?>

                </div>
            </span>
            <?php endif; ?>

            <!--pin-->
            <span class="list-table-action">
                <a href="javascript:void(0);" title="<?php echo e(cleanLang(__('lang.pinning'))); ?>"
                    data-parent="expense_<?php echo e($expense->expense_id); ?>"
                    data-url="<?php echo e(url('/expenses/'.$expense->expense_id.'/pinning')); ?>"
                    class="data-toggle-action-tooltip btn btn-outline-default-light btn-circle btn-sm opacity-4 js-toggle-pinning">
                    <i class="ti-pin2"></i>
                </a>
            </span>
        </span>
        <!--action button-->

    </td>
    <?php endif; ?>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/expenses/components/table/ajax.blade.php ENDPATH**/ ?>