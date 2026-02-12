<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-tasks">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo e(cleanLang(__('lang.filter_tasks'))); ?>

                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-tasks"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body">

                <!--module extension point - allows modules to inject content-->
                <?php echo $__env->yieldPushContent('filter_panel_1'); ?>

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
                                $client_data = config('filter.saved_data.filter_task_clientid');
                                $client_id = is_array($client_data) ? ($client_data['id'] ?? '') : ($client_data ?? '');
                                $client_text = is_array($client_data) ? ($client_data['text'] ?? '') : '';
                                ?>
                                <select name="filter_task_clientid" id="filter_task_clientid"
                                    class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                                    data-projects-dropdown="filter_task_projectid"
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
                                $project_data = config('filter.saved_data.filter_task_projectid');
                                $project_id = is_array($project_data) ? ($project_data['id'] ?? '') : ($project_data ?? '');
                                $project_text = is_array($project_data) ? ($project_data['text'] ?? '') : '';
                                ?>
                                <select class="select2-basic form-control form-control-sm dynamic_filter_task_projectid js-select2-dynamic-project" data-allow-clear="true"
                                    id="filter_task_projectid" name="filter_task_projectid" disabled
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

                <!--task type (when viewing a project)-->
                <?php if(config('visibility.tasks_filter_milestone')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.milestone'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $saved_milestones = config('filter.saved_data.filter_task_milestoneid') ?? [];
                                if (!is_array($saved_milestones)) {
                                    $saved_milestones = [];
                                }
                                ?>
                                <select name="filter_task_milestoneid" id="filter_task_milestoneid"
                                    class="form-control  form-control-sm select2-basic select2-multiple select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <?php if(isset($milestones)): ?>
                                    <?php $__currentLoopData = $milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($milestone->milestone_id); ?>" <?php echo e(in_array($milestone->milestone_id, $saved_milestones) ? 'selected' : ''); ?>>
                                        <?php echo e(runtimeLang($milestone->milestone_title, 'task_milestone')); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>


                <!--assigned-->
                <?php if(config('visibility.filter_panel_assigned')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.assigned_to'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $saved_assigned = config('filter.saved_data.filter_assigned') ?? [];
                                if (!is_array($saved_assigned)) {
                                    $saved_assigned = [];
                                }
                                ?>
                                <select name="filter_assigned" id="filter_assigned"
                                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <!--users list-->
                                    <?php $__currentLoopData = config('system.team_members'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>" <?php echo e(in_array($user->id, $saved_assigned) ? 'selected' : ''); ?>><?php echo e($user->full_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <!--/#users list-->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!--date added-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.date_added'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_task_date_start_start" autocomplete="off"
                                    class="form-control form-control-sm pickadate" placeholder="Start"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_task_date_start_start') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" name="filter_task_date_start_start"
                                    id="filter_task_date_start_start" value="<?php echo e(config('filter.saved_data.filter_task_date_start_start') ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_task_date_start_end" autocomplete="off"
                                    class="form-control form-control-sm pickadate" placeholder="End"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_task_date_start_end') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" name="filter_task_date_start_end"
                                    id="filter_task_date_start_end" value="<?php echo e(config('filter.saved_data.filter_task_date_start_end') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!--date due-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.due_date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_task_date_due_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="Start"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_task_date_due_start') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" name="filter_task_date_due_start"
                                    id="filter_task_date_due_start" value="<?php echo e(config('filter.saved_data.filter_task_date_due_start') ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_task_date_due_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off" placeholder="End"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_task_date_due_end') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" name="filter_task_date_due_end"
                                    id="filter_task_date_due_end" value="<?php echo e(config('filter.saved_data.filter_task_date_due_end') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <!--filter item-->
                <!--tags-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.tags'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $saved_tags = config('filter.saved_data.filter_tags') ?? [];
                                if (!is_array($saved_tags)) {
                                    $saved_tags = [];
                                }
                                ?>
                                <select name="filter_tags" id="filter_tags"
                                    class="form-control form-control-sm select2-multiple <?php echo e(runtimeAllowUserTags()); ?> select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tag->tag_title); ?>" <?php echo e(in_array($tag->tag_title, $saved_tags) ? 'selected' : ''); ?>>
                                        <?php echo e($tag->tag_title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--tags-->


                <!--priority-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.priority'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $saved_priority = config('filter.saved_data.filter_task_priority') ?? [];
                                if (!is_array($saved_priority)) {
                                    $saved_priority = [];
                                }
                                ?>
                                <select name="filter_task_priority" id="filter_task_priority"
                                    class="form-control  form-control-sm select2-basic select2-multiple select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $priorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($priority->taskpriority_id); ?>" <?php echo e(in_array($priority->taskpriority_id, $saved_priority) ? 'selected' : ''); ?>><?php echo e($priority->taskpriority_title); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
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
                                $saved_status = config('filter.saved_data.filter_tasks_status') ?? [];
                                if (!is_array($saved_status)) {
                                    $saved_status = [];
                                }
                                ?>
                                <select name="filter_tasks_status" id="filter_tasks_status"
                                    class="form-control  form-control-sm select2-basic select2-multiple select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <?php $__currentLoopData = config('task_statuses'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($task_status->taskstatus_id); ?>" <?php echo e(in_array($task_status->taskstatus_id, $saved_status) ? 'selected' : ''); ?>>
                                        <?php echo e(runtimeLang($task_status->taskstatus_title)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--has pending checklists-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.has_pending_checklists'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm select2-preselected" id="filter_task_pending_checklists"
                                    name="filter_task_pending_checklists"
                                    data-preselected="<?php echo e(config('filter.saved_data.filter_task_pending_checklists') ?? ''); ?>">
                                    <option value=""></option>
                                    <option value="yes"><?php echo app('translator')->get('lang.yes'); ?></option>
                                    <option value="no"><?php echo app('translator')->get('lang.no'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--state-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.show'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm select2-preselected" id="filter_task_state"
                                    name="filter_task_state"
                                    data-preselected="<?php echo e(config('filter.saved_data.filter_task_state') ?? ''); ?>">
                                    <option value=""></option>
                                    <option value="active"><?php echo app('translator')->get('lang.active_tasks'); ?></option>
                                    <option value="archived"><?php echo app('translator')->get('lang.archives_tasks'); ?></option>
                                    <option value="all"><?php echo app('translator')->get('lang.everything'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--status -->

                <!--module extension point - allows modules to inject content-->
                <?php echo $__env->yieldPushContent('filter_panel_2'); ?>

                <!--custom fields-->
                <?php echo $__env->make('misc.customfields-filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                    <a href="<?php echo e(url('/tasks?clear-filter=yes')); ?>"
                        class="btn btn-rounded-x btn-secondary"><?php echo app('translator')->get('lang.forget_filters'); ?></a>
                    <input type="hidden" name="query-type" value="filter">
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="<?php echo e($page['source_for_filter_panels'] ?? ''); ?>">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="<?php echo e(urlResource('/tasks/search?')); ?>" data-type="form"
                        data-ajax-type="GET"><?php echo e(cleanLang(__('lang.apply_filter'))); ?></button>
                </div>

            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/tasks/components/misc/filter-tasks.blade.php ENDPATH**/ ?>