<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-expenses">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo e(cleanLang(__('lang.filter_expenses'))); ?>

                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-expenses"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body">


                <!--filter by team members-->
                <?php if(config('visibility.filter_by_user')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo app('translator')->get('lang.team_member'); ?>
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $saved_creators = config('filter.saved_data.filter_expense_creatorid_list') ?? [];
                                if (!is_array($saved_creators)) {
                                    $saved_creators = [];
                                }
                                ?>
                                <select name="filter_expense_creatorid_list" id="filter_expense_creatorid_list"
                                    data-allow-clear="true"
                                    class="form-control  form-control-sm select2-basic select2-multiple select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <option></option>
                                    <?php $__currentLoopData = config('system.team_members'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>" <?php echo e(in_array($user->id, $saved_creators) ? 'selected' : ''); ?>><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>



                <!--company name-->
                <?php if(config('visibility.filter_panel_client')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.client_name'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $client_data = config('filter.saved_data.filter_expense_clientid');
                                $client_id = is_array($client_data) ? ($client_data['id'] ?? '') : ($client_data ?? '');
                                $client_text = is_array($client_data) ? ($client_data['text'] ?? '') : '';
                                ?>
                                <select name="filter_expense_clientid" id="filter_expense_clientid"
                                    class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                                    data-projects-dropdown="filter_expense_projectid"
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
                <?php endif; ?>

                <!--project-->
                <?php if(config('visibility.filter_panel_project')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.project'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $project_data = config('filter.saved_data.filter_expense_projectid');
                                $project_id = is_array($project_data) ? ($project_data['id'] ?? '') : ($project_data ?? '');
                                $project_text = is_array($project_data) ? ($project_data['text'] ?? '') : '';
                                ?>
                                <select class="select2-basic form-control form-control-sm dynamic_expense_projectid js-select2-dynamic-project"
                                    id="filter_expense_projectid" name="filter_expense_projectid" disabled
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
                                <select class="select2-basic form-control form-control-sm" id="filter_expense_projectid"
                                    name="filter_expense_projectid">
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

                <!--amount-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.amount'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6 input-group input-group-sm">
                                <span
                                    class="input-group-addon"><?php echo e(config('system.settings_system_currency_symbol')); ?></span>
                                <input type="number" name="filter_expense_amount_min" id="filter_expense_amount_min"
                                    class="form-control form-control-sm"
                                    placeholder="<?php echo e(cleanLang(__('lang.minimum'))); ?>"
                                    value="<?php echo e(config('filter.saved_data.filter_expense_amount_min') ?? ''); ?>">
                            </div>
                            <div class="col-md-6 input-group input-group-sm">
                                <span
                                    class="input-group-addon"><?php echo e(config('system.settings_system_currency_symbol')); ?></span>
                                <input type="number" name="filter_expense_amount_max" id="filter_expense_amount_max"
                                    class="form-control form-control-sm"
                                    placeholder="<?php echo e(cleanLang(__('lang.maximum'))); ?>"
                                    value="<?php echo e(config('filter.saved_data.filter_expense_amount_max') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!--date-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_expense_date_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.start'))); ?>"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_expense_date_start') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" id="filter_expense_date_start"
                                    name="filter_expense_date_start"
                                    value="<?php echo e(config('filter.saved_data.filter_expense_date_start') ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_expense_date_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.end'))); ?>"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_expense_date_end') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" id="filter_expense_date_end"
                                    name="filter_expense_date_end"
                                    value="<?php echo e(config('filter.saved_data.filter_expense_date_end') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!--category-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.category'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $saved_categories = config('filter.saved_data.filter_expense_categoryid') ?? [];
                                if (!is_array($saved_categories)) {
                                    $saved_categories = [];
                                }
                                ?>
                                <select name="filter_expense_categoryid" id="filter_expense_categoryid"
                                    class="form-control form-control-sm select2-basic select2-multiple select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->category_id); ?>" <?php echo e(in_array($category->category_id, $saved_categories) ? 'selected' : ''); ?>>
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
                    <a href="<?php echo e(url('/expenses?clear-filter=yes')); ?>"
                        class="btn btn-rounded-x btn-secondary"><?php echo app('translator')->get('lang.forget_filters'); ?></a>
                    <input type="hidden" name="query-type" value="filter">
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="<?php echo e($page['source_for_filter_panels'] ?? ''); ?>">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="<?php echo e(urlResource('/expenses/search')); ?>" data-type="form"
                        data-ajax-type="GET"><?php echo e(cleanLang(__('lang.apply_filter'))); ?></button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/expenses/components/misc/filter-expenses.blade.php ENDPATH**/ ?>