<!--CRUMBS CONTAINER (RIGHT)-->
<div class="col-md-12  col-lg-7 p-b-9 align-self-center text-right <?php echo e($page['list_page_actions_size'] ?? ''); ?> <?php echo e($page['list_page_container_class'] ?? ''); ?>"
    id="list-page-actions-container">
    <div id="list-page-actions">
        <!--ADD NEW ITEM-->
        <button type="button"
            class="btn btn-danger btn-add-circle edit-add-modal-button js-ajax-ux-request reset-target-modal-form "
            data-toggle="modal" data-target="#commonModal"
            data-url="<?php echo e(url('settings/units/create')); ?>"
            data-loading-target="commonModalBody"
            data-modal-title="<?php echo app('translator')->get('lang.add_product_unit'); ?>"
            data-action-url="<?php echo e(url('settings/units/create')); ?>"
            data-action-method="POST"
            data-action-ajax-class="ajax-request" 
            data-modal-size="" 
            data-action-ajax-loading-target="commonModalBody"
            data-save-button-class="ajax-request" 
            data-project-progress="0">
            <i class="ti-plus"></i>
        </button>
    </div>
</div><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/settings/sections/units/misc/list-page-actions.blade.php ENDPATH**/ ?>