<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-tickets">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo e(cleanLang(__('lang.filter_tickets'))); ?>

                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-tickets"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body">

                <!--company name-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.client_name'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $client_data = config('filter.saved_data.filter_ticket_clientid');
                                $client_id = is_array($client_data) ? ($client_data['id'] ?? '') : ($client_data ?? '');
                                $client_text = is_array($client_data) ? ($client_data['text'] ?? '') : '';
                                ?>
                                <select name="filter_ticket_clientid" id="filter_ticket_clientid"
                                    class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                                    data-projects-dropdown="filter_ticket_projectid"
                                    data-feed-request-type="filter_tickets"
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
                                $project_data = config('filter.saved_data.filter_ticket_projectid');
                                $project_id = is_array($project_data) ? ($project_data['id'] ?? '') : ($project_data ?? '');
                                $project_text = is_array($project_data) ? ($project_data['text'] ?? '') : '';
                                ?>
                                <select
                                    class="select2-basic form-control form-control-sm dynamic_filter_ticket_projectid js-select2-dynamic-project"
                                    id="filter_ticket_projectid" name="filter_ticket_projectid" disabled
                                    <?php if($project_id): ?>
                                    data-filter-preselect-id="<?php echo e($project_id); ?>"
                                    data-filter-preselect-text="<?php echo e($project_text); ?>"
                                    <?php endif; ?>>
                                </select>
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
                                $saved_categories = config('filter.saved_data.filter_ticket_categoryid') ?? [];
                                if (!is_array($saved_categories)) {
                                    $saved_categories = [$saved_categories];
                                }
                                ?>
                                <select name="filter_ticket_categoryid" id="filter_ticket_categoryid"
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


                <!--date-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_ticket_created_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="Start"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_ticket_created_start') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" name="filter_ticket_created_start"
                                    id="filter_ticket_created_start"
                                    value="<?php echo e(config('filter.saved_data.filter_ticket_created_start') ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_ticket_created_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off" placeholder="End"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_ticket_created_end') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" name="filter_ticket_created_end"
                                    id="filter_ticket_created_end"
                                    value="<?php echo e(config('filter.saved_data.filter_ticket_created_end') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>


                <!--priority-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.priority'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $saved_priority = config('filter.saved_data.filter_ticket_priority') ?? [];
                                if (!is_array($saved_priority)) {
                                    $saved_priority = [$saved_priority];
                                }
                                ?>
                                <select class="select2-basic form-control form-control-sm" id="filter_ticket_priority"
                                    name="filter_ticket_priority" multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <?php $__currentLoopData = config('settings.ticket_priority'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e(in_array($key, $saved_priority) ? 'selected' : ''); ?>><?php echo e(runtimeLang($key)); ?></option>
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
                                $saved_statuses = config('filter.saved_data.filter_ticket_status') ?? [];
                                if (!is_array($saved_statuses)) {
                                    $saved_statuses = [$saved_statuses];
                                }
                                ?>
                                <select class="select2-basic form-control form-control-sm" id="filter_ticket_status"
                                    name="filter_ticket_status" multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($status->ticketstatus_id); ?>" <?php echo e(in_array($status->ticketstatus_id, $saved_statuses) ? 'selected' : ''); ?>><?php echo e(runtimeLang($status->ticketstatus_title)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <!--custom fields-->
                <?php echo $__env->make('misc.customfields-filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <!--show archived tickets-->
                <div class="filter-block">
                    <div class="fields">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-group-checkbox">
                                    <?php
                                    $saved_show_archive = config('filter.saved_data.show_archive_tickets') ?? '';
                                    ?>
                                    <input type="checkbox" id="show_archive_tickets" name="show_archive_tickets"
                                        class="filled-in chk-col-light-blue"
                                        <?php echo e($saved_show_archive == 'on' ? 'checked' : ''); ?>>
                                    <label class="p-l-30" for="show_archive_tickets"><?php echo app('translator')->get('lang.show_archive_tickets'); ?></label>
                                </div>
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
                    <a href="<?php echo e(url('/tickets?clear-filter=yes')); ?>"
                        class="btn btn-rounded-x btn-secondary"><?php echo app('translator')->get('lang.forget_filters'); ?></a>
                    <input type="hidden" name="query-type" value="filter">
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="<?php echo e($page['source_for_filter_panels'] ?? ''); ?>">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="<?php echo e(urlResource('/tickets/search?')); ?>" data-type="form"
                        data-ajax-type="GET"><?php echo e(cleanLang(__('lang.apply_filter'))); ?></button>
                </div>


            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/tickets/components/misc/filter-tickets.blade.php ENDPATH**/ ?>