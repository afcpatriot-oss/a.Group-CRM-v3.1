<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-proposals">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo app('translator')->get('lang.filter_proposals'); ?>
                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-proposals"></i>
                </span>
            </div>

            <!--body-->
            <div class="r-panel-body">


                <!--client-->
                <?php if(config('visibility.filter_panel_client')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.client_name'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $client_data = config('filter.saved_data.filter_doc_client_id');
                                $client_id = is_array($client_data) ? ($client_data['id'] ?? '') : ($client_data ?? '');
                                $client_text = is_array($client_data) ? ($client_data['text'] ?? '') : '';
                                ?>
                                <select name="filter_doc_client_id" id="filter_doc_client_id"
                                    class="form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"
                                    data-ajax--url="<?php echo e(url('/')); ?>/feed/company_names"
                                    <?php if($client_id): ?>
                                    data-filter-preselect-id="<?php echo e($client_id); ?>"
                                    data-filter-preselect-text="<?php echo e($client_text); ?>"
                                    <?php endif; ?>>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>


                <!--lead-->
                <?php if(config('visibility.filter_panel_lead')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.lead'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $lead_data = config('filter.saved_data.filter_doc_lead_id');
                                $lead_id = is_array($lead_data) ? ($lead_data['id'] ?? '') : ($lead_data ?? '');
                                $lead_text = is_array($lead_data) ? ($lead_data['text'] ?? '') : '';
                                ?>
                                <select name="filter_doc_lead_id" id="filter_doc_lead_id"
                                    class="form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"
                                    data-ajax--url="<?php echo e(url('/')); ?>/feed/leadnames?ref=general"
                                    <?php if($lead_id): ?>
                                    data-filter-preselect-id="<?php echo e($lead_id); ?>"
                                    data-filter-preselect-text="<?php echo e($lead_text); ?>"
                                    <?php endif; ?>>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!--categorgies-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.category'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $saved_categories = config('filter.saved_data.filter_proposal_categoryid') ?? [];
                                if (!is_array($saved_categories)) {
                                    $saved_categories = [];
                                }
                                ?>
                                <select name="filter_proposal_categoryid" id="filter_proposal_categoryid"
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


                <!--proposal_date-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.proposal_date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_doc_date_start_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.start'))); ?>"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_doc_date_start_start') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" id="filter_doc_date_start_start"
                                    name="filter_doc_date_start_start"
                                    value="<?php echo e(config('filter.saved_data.filter_doc_date_start_start') ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_doc_date_start_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.end'))); ?>"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_doc_date_start_end') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" id="filter_doc_date_start_end"
                                    name="filter_doc_date_start_end"
                                    value="<?php echo e(config('filter.saved_data.filter_doc_date_start_end') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>


                <!--valid_until-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.valid_until'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_doc_date_end_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.start'))); ?>"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_doc_date_end_start') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" id="filter_doc_date_end_start"
                                    name="filter_doc_date_end_start"
                                    value="<?php echo e(config('filter.saved_data.filter_doc_date_end_start') ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_doc_date_end_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.end'))); ?>"
                                    value="<?php echo e(runtimeDatepickerDate(config('filter.saved_data.filter_doc_date_end_end') ?? '')); ?>">
                                <input class="mysql-date" type="hidden" id="filter_doc_date_end_end"
                                    name="filter_doc_date_end_end"
                                    value="<?php echo e(config('filter.saved_data.filter_doc_date_end_end') ?? ''); ?>">
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
                    <a href="<?php echo e(url('/proposals?clear-filter=yes')); ?>"
                        class="btn btn-rounded-x btn-secondary"><?php echo app('translator')->get('lang.forget_filters'); ?></a>
                    <input type="hidden" name="query-type" value="filter">
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="<?php echo e($page['source_for_filter_panels'] ?? ''); ?>">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="<?php echo e(urlResource('/proposals/search')); ?>" data-type="form"
                        data-ajax-type="GET"><?php echo e(cleanLang(__('lang.apply_filter'))); ?></button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/proposals/components/misc/filter-proposals.blade.php ENDPATH**/ ?>