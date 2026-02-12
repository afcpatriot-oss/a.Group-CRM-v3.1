<!--CRUMBS CONTAINER (RIGHT)-->
<div class="col-md-12 col-lg-7 p-b-9 align-self-center text-right"
     id="list-page-actions-container">

    <div id="list-page-actions">

        <!-- SEARCH -->
        <div class="header-search" id="header-search">
            <i class="sl-icon-magnifier"></i>
            <input type="text"
                   class="form-control search-records list-actions-search"
                   data-url="<?php echo e($page['dynamic_search_url'] ?? ''); ?>"
                   data-type="form"
                   data-ajax-type="post"
                   data-form-id="header-search"
                   id="search_query"
                   name="search_query"
                   placeholder="<?php echo e(cleanLang(__('lang.search'))); ?>">
        </div>

        <!-- FILTER -->
        <?php if(config('visibility.list_page_actions_filter_button')): ?>
        <button type="button"
                data-toggle="tooltip"
                title="<?php echo e(cleanLang(__('lang.filter'))); ?>"
                class="list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-side-panel <?php echo e(config('filter.status')); ?>"
                data-target="<?php echo e($page['sidepanel_id'] ?? ''); ?>">
            <i class="mdi mdi-filter-outline"></i>
        </button>
        <?php endif; ?>

        <!-- ADD ORDER -->
        <?php if(config('visibility.list_page_actions_add_button')): ?>
        <button type="button"
                class="btn btn-danger btn-add-circle edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal"
                data-target="#commonModal"
                data-url="<?php echo e($page['add_modal_create_url'] ?? ''); ?>"
                data-loading-target="commonModalBody"
                data-modal-title="<?php echo e($page['add_modal_title'] ?? cleanLang(__('lang.add_order'))); ?>"
                data-action-url="<?php echo e($page['add_modal_action_url'] ?? ''); ?>"
                data-action-method="<?php echo e($page['add_modal_action_method'] ?? 'POST'); ?>">
            <i class="ti-plus"></i>
        </button>
        <?php endif; ?>

    </div>
</div>
<?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/orders/components/misc/list-page-actions.blade.php ENDPATH**/ ?>