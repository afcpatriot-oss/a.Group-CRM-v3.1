<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!-- each comment -->
<div class="display-flex flex-row comment-row" id="comment_<?php echo e($comment->comment_id); ?>">
    <div class="p-2">
        <img src="<?php echo e(getUsersAvatar($comment->avatar_directory, $comment->avatar_filename)); ?>" class="img-circle"
            alt="user" width="40">
    </div>
    <div class="comment-text w-100 js-hover-actions">
        <div class="row">
            <div class="col-sm-6 x-name">
                <a href="javascript:void(0);" class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" data-url="<?php echo e(url('contacts/'.$comment->id ?? 0)); ?>"
                data-loading-target="commonModalBody" data-modal-title="" data-modal-size="modal-md"
                data-header-close-icon="hidden" data-header-extra-close-icon="visible" data-footer-visibility="hidden"
                data-action-ajax-loading-target="commonModalBody">
                <?php echo e($comment->first_name ?? runtimeUnkownUser()); ?>

                </a>
            </div>
            <div class="col-sm-6 x-meta text-right">
                <!--actions-->
                <?php if($comment->permission_delete_comment): ?>
                <span class="comment-actions js-hover-actions-target hidden">
                    <a href="javascript:void(0)" class="btn-outline-danger confirm-action-danger"
                        data-confirm-title="<?php echo e(cleanLang(__('lang.delete_comment'))); ?>"
                        data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                        data-url="<?php echo e(url('/comments/'.$comment->comment_id)); ?>">
                        <i class="sl-icon-trash"></i>
                    </a>
                </span>
                <?php endif; ?>
                <!--actions-->
                <span class="text-muted x-date"><small><?php echo e(runtimeDateAgo($comment->comment_created)); ?></small></span>
            </div>
        </div>
        <div><?php echo _clean($comment->comment_text); ?></div>
        <!--read or unread-->
        <div class="text-right p-t-20">
            <!--team-->
            <?php if(auth()->user()->is_team && $comment->type == 'team'): ?>
            <?php if($comment->comment_client_status == 'read'): ?>
            <i class="mdi mdi-check-all text-info"></i>
            <?php else: ?>
            <i class="mdi mdi-check-all text-default opacity-7"></i>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!--each comment -->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/comments/components/ajax.blade.php ENDPATH**/ ?>