<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-invoices">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo e(cleanLang(__('lang.filter_invoices'))); ?>

                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-invoices"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body">

                <?php if(config('visibility.filter_panel_client_project')): ?>
                <!--company name-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.client_name'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $client_data = config('filter.saved_data.filter_bill_clientid');
                                $client_id = is_array($client_data) ? ($client_data['id'] ?? '') : ($client_data ?? '');
                                $client_text = is_array($client_data) ? ($client_data['text'] ?? '') : '';
                                ?>
                                <select name="filter_bill_clientid" id="filter_bill_clientid"
                                    class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                                    data-projects-dropdown="filter_bill_projectid"
                                    data-feed-request-type="clients_projects"
                                    data-ajax--url="<?php echo e(url('/')); ?>/feed/company_names"
                                    <?php if($client_id): ?>
                                    data-filter-preselect-id="<?php echo e($client_id); ?>"
                                    data-filter-preselect-text="<?php echo e($client_text); ?>"
                                    <?php endif; ?>></select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--project-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.project'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $project_data = config('filter.saved_data.filter_bill_projectid');
                                $project_id = is_array($project_data) ? ($project_data['id'] ?? '') : ($project_data ?? '');
                                $project_text = is_array($project_data) ? ($project_data['text'] ?? '') : '';
                                ?>
                                <select class="select2-basic form-control form-control-sm dynamic_filter_bill_projectid js-select2-dynamic-project" id="filter_bill_projectid"
                                    name="filter_bill_projectid" disabled
                                    <?php if($project_id): ?>
                                    data-filter-preselect-id="<?php echo e($project_id); ?>"
                                    data-filter-preselect-text="<?php echo e($project_text); ?>"
                                    <?php endif; ?>>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                
                <!--clients project list-->
                <?php if(config('visibility.filter_panel_clients_projects')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.project'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm" id="filter_bill_projectid"
                                    name="filter_bill_projectid">
                                    <option></option>
                                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($project->project_id); ?>"><?php echo e($project->project_title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!--invoice amount-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.invoice_amount'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6 input-group input-group-sm">
                                <span class="input-group-addon"><?php echo e(config('system.settings_system_currency_symbol')); ?></span>
                                <input type="number" name="filter_bill_final_amount_min"
                                    id="filter_bill_final_amount_min" class="form-control form-control-sm"
                                    placeholder="min" value="<?php echo e(config('filter.saved_data.filter_bill_final_amount_min') ?? ''); ?>">
                            </div>
                            <div class="col-md-6 input-group input-group-sm">
                                <span class="input-group-addon"><?php echo e(config('system.settings_system_currency_symbol')); ?></span>
                                <input type="number" name="filter_bill_final_amount_max"
                                    id="filter_bill_final_amount_max" class="form-control form-control-sm"
                                    placeholder="max" value="<?php echo e(config('filter.saved_data.filter_bill_final_amount_max') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!--payments-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.payments_amount'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6 input-group input-group-sm">
                                <span class="input-group-addon"><?php echo e(config('system.settings_system_currency_symbol')); ?></span>
                                <input type="number" name="filter_invoice_payments_min" id="filter_invoice_payments_min"
                                    class="form-control form-control-sm" placeholder="min" value="<?php echo e(config('filter.saved_data.filter_invoice_payments_min') ?? ''); ?>">
                            </div>
                            <div class="col-md-6 input-group input-group-sm">
                                <span class="input-group-addon"><?php echo e(config('system.settings_system_currency_symbol')); ?></span>
                                <input type="number" name="filter_invoice_payments_max" id="filter_invoice_payments_max"
                                    class="form-control form-control-sm" placeholder="max" value="<?php echo e(config('filter.saved_data.filter_invoice_payments_max') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!--invoice date-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.date_created'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_bill_date_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="Start"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_bill_date_start') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" name="filter_bill_date_start"
                                    id="filter_bill_date_start" value="<?php echo e(config('filter.saved_data.filter_bill_date_start') ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_bill_date_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off" placeholder="End"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_bill_date_end') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" name="filter_bill_date_end"
                                    id="filter_bill_date_end" value="<?php echo e(config('filter.saved_data.filter_bill_date_end') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!--due date-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.due_date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_bill_due_date_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="Start"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_bill_due_date_start') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" id="filter_bill_due_date_start"
                                    name="filter_bill_due_date_start" value="<?php echo e(config('filter.saved_data.filter_bill_due_date_start') ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_bill_due_date_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off" placeholder="End"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_bill_due_date_end') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" id="filter_bill_due_date_end"
                                    name="filter_bill_due_date_end" value="<?php echo e(config('filter.saved_data.filter_bill_due_date_end') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>


                <!--status-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.status'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $saved_status = config('filter.saved_data.filter_bill_status') ?? [];
                                if (!is_array($saved_status)) {
                                    $saved_status = [];
                                }
                                ?>
                                <select name="filter_bill_status" id="filter_bill_status"
                                    class="form-control form-control-sm select2-multiple <?php echo e(runtimeAllowUserTags()); ?> select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <?php $__currentLoopData = config('settings.invoice_statuses'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e(in_array($key, $saved_status) ? 'selected' : ''); ?>><?php echo e(runtimeLang($key)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--created by -->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.added_by'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $saved_creator = config('filter.saved_data.filter_bill_creatorid') ?? [];
                                if (!is_array($saved_creator)) {
                                    $saved_creator = [];
                                }
                                ?>
                                <select name="filter_bill_creatorid" id="filter_bill_creatorid"
                                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <?php $__currentLoopData = config('system.team_members'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>" <?php echo e(in_array($user->id, $saved_creator) ? 'selected' : ''); ?>><?php echo e($user->full_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--categorgies-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.recurring'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $saved_recurring = config('filter.saved_data.filter_recurring_option') ?? [];
                                if (!is_array($saved_recurring)) {
                                    $saved_recurring = [];
                                }
                                ?>
                                <select name="filter_recurring_option" id="filter_recurring_option"
                                    class="form-control form-control-sm select2-basic select2-multiple select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <option value="recurring_invoices" <?php echo e(in_array('recurring_invoices', $saved_recurring) ? 'selected' : ''); ?>><?php echo e(cleanLang(__('lang.recurring_invoices'))); ?></option>
                                    <option value="child_invoices" <?php echo e(in_array('child_invoices', $saved_recurring) ? 'selected' : ''); ?>><?php echo e(cleanLang(__('lang.recurring_child_invoices'))); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <!--categorgies-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.category'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $saved_category = config('filter.saved_data.filter_bill_categoryid') ?? [];
                                if (!is_array($saved_category)) {
                                    $saved_category = [];
                                }
                                ?>
                                <select name="filter_bill_categoryid" id="filter_bill_categoryid"
                                    class="form-control form-control-sm select2-basic select2-multiple select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->category_id); ?>" <?php echo e(in_array($category->category_id, $saved_category) ? 'selected' : ''); ?>>
                                        <?php echo e($category->category_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--remember filters-->
                <div class="modal-selector m-t-20 p-b-0 p-l-35 p-t-20">
                    <div class="filter-block">
                        <div class="fields">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group form-group-checkbox m-b-0">
                                        <input type="checkbox" id="filter_remember" name="filter_remember"
                                            class="filled-in chk-col-light-blue"
                                            <?php echo e(config('filter.status') == 'active' ? 'checked' : ''); ?>>
                                        <label class="p-l-30"
                                            for="filter_remember"><?php echo app('translator')->get('lang.remember_filters'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--buttons-->
                <div class="buttons-block">
                    <a href="<?php echo e(url('/invoices?clear-filter=yes')); ?>"
                        class="btn btn-rounded-x btn-secondary"><?php echo app('translator')->get('lang.forget_filters'); ?></a>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="<?php echo e($page['source_for_filter_panels'] ?? ''); ?>">
                    <input type="hidden" name="query-type" value="filter">
                    <button type="button"
                        class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="<?php echo e(urlResource('/invoices/search')); ?>" data-type="form" data-ajax-type="GET"><?php echo e(cleanLang(__('lang.apply_filter'))); ?></button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/invoices/components/misc/filter-invoices.blade.php ENDPATH**/ ?>