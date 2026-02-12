<!--modal for adding tasks to invoice-->
<div class="modal" role="dialog" aria-labelledby="tasksModal" id="tasksModal">
    <div class="modal-dialog modal-xl" id="tasksModalContainer">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="ti-close"></i>
                </button>
                <h4 class="modal-title" id="tasksModalTitle"><?php echo app('translator')->get('lang.project_tasks'); ?></h4>
            </div>
            <div class="modal-body min-h-300" id="tasksModalBody">
                <!--dynamic ajax content-->
            </div>
        </div>
    </div>
</div><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/bill/components/modals/bill-tasks.blade.php ENDPATH**/ ?>