<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-projects">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo e(cleanLang(__('lang.filter_projects'))); ?>

                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-projects"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body">

                <!--client-->
                <?php if(config('visibility.filter_panel_client_project')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.client_name'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <!--select2 basic search-->
                                <?php
                                $client_data = config('filter.saved_data.filter_project_clientid');
                                $client_id = is_array($client_data) ? ($client_data['id'] ?? '') : ($client_data ?? '');
                                $client_text = is_array($client_data) ? ($client_data['text'] ?? '') : '';
                                ?>
                                <select name="filter_project_clientid" id="filter_project_clientid"
                                    class="form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                                    data-ajax--url="<?php echo e(url('/')); ?>/feed/company_names"
                                    <?php if($client_id): ?>
                                    data-filter-preselect-id="<?php echo e($client_id); ?>"
                                    data-filter-preselect-text="<?php echo e($client_text); ?>"
                                    <?php endif; ?>>
                                </select>
                                <!--select2 basic search-->
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <!--client-->

                <!--assigned-->
                <?php if(config('visibility.filter_panel_assigned')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.assigned'))); ?>

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

                <!--start date-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.start_date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_start_date_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.start'))); ?>"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_start_date_start') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" id="filter_start_date_start"
                                    name="filter_start_date_start" value="<?php echo e(config('filter.saved_data.filter_start_date_start') ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_start_date_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.end'))); ?>"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_start_date_end') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" id="filter_start_date_end"
                                    name="filter_start_date_end" value="<?php echo e(config('filter.saved_data.filter_start_date_end') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <!--start date-->


                <!--due date-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.due_date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_due_date_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.start'))); ?>"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_due_date_start') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" id="filter_due_date_start"
                                    name="filter_due_date_start" value="<?php echo e(config('filter.saved_data.filter_due_date_start') ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_due_date_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.end'))); ?>"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_due_date_end') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" id="filter_due_date_end"
                                    name="filter_due_date_end" value="<?php echo e(config('filter.saved_data.filter_due_date_end') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <!--due date-->

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

                <!--categorgies-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.category'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $saved_categories = config('filter.saved_data.filter_project_categoryid') ?? [];
                                if (!is_array($saved_categories)) {
                                    $saved_categories = [];
                                }
                                ?>
                                <select name="filter_project_categoryid" id="filter_project_categoryid"
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

                <!--status-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.status'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $saved_statuses = config('filter.saved_data.filter_project_status') ?? [];
                                if (!is_array($saved_statuses)) {
                                    $saved_statuses = [];
                                }
                                ?>
                                <select name="filter_project_status" id="filter_project_status"
                                    class="form-control form-control-sm select2-basic select2-multiple <?php echo e(runtimeAllowUserTags()); ?> select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <?php $__currentLoopData = config('settings.project_statuses'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e(in_array($key, $saved_statuses) ? 'selected' : ''); ?>><?php echo e(runtimeLang($key)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--status-->


                <!--state-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.show'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm select2-preselected"
                                    id="filter_project_state" name="filter_project_state"
                                    data-preselected="<?php echo e(config('filter.saved_data.filter_project_state') ?? ''); ?>">
                                    <option value=""></option>
                                    <option value="active"><?php echo app('translator')->get('lang.active_projects'); ?></option>
                                    <option value="archived"><?php echo app('translator')->get('lang.archives_projects'); ?></option>
                                    <option value="all"><?php echo app('translator')->get('lang.everything'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--status -->
                    
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
                    <a href="<?php echo e(url('/projects?clear-filter=yes')); ?>"
                        class="btn btn-rounded-x btn-secondary"><?php echo app('translator')->get('lang.forget_filters'); ?></a>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="query-type" value="filter">
                    <input type="hidden" name="source" value="<?php echo e($page['source_for_filter_panels'] ?? ''); ?>">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="<?php echo e(urlResource('/projects/search')); ?>" data-type="form"
                        data-ajax-type="GET"><?php echo e(cleanLang(__('lang.apply_filter'))); ?></button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/projects/components/misc/filter-projects.blade.php ENDPATH**/ ?>