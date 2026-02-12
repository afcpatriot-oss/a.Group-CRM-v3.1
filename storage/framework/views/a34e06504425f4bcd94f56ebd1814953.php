<?php if(isset($checklist->comments) && $checklist->comments->count() > 0): ?>
<?php $__currentLoopData = $checklist->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="display-flex flex-row comment-row" id="checklist_comment_<?php echo e($comment->comment_id); ?>">
    <div class="p-2 comment-avatar">
        <img src="<?php echo e(getUsersAvatar($comment->creator->avatar_directory ?? '', $comment->creator->avatar_filename ?? '')); ?>"
            class="img-circle" alt="<?php echo e($comment->creator->first_name ?? runtimeUnkownUser()); ?>" width="40">
    </div>
    <div class="comment-text w-100 js-hover-actions">
        <div class="row">
            <div class="col-sm-6 x-name"><?php echo e($comment->creator->first_name ?? runtimeUnkownUser()); ?>

                <?php echo e($comment->creator->last_name ?? ''); ?></div>
            <div class="col-sm-6 text-right">
                <small class="text-muted"><?php echo e(runtimeDate($comment->comment_created)); ?></small>
                <?php if(auth()->user()->is_admin || $comment->comment_creatorid == auth()->id()): ?>
                <span class="x-action-button p-l-10 display-inline-block">
                    <a href="javascript:void(0)" class="text-danger confirm-action-danger" title="<?php echo app('translator')->get('lang.edit'); ?>"
                        data-confirm-title="<?php echo app('translator')->get('lang.delete_item'); ?>" data-confirm-text="<?php echo app('translator')->get('lang.are_you_sure'); ?>"
                        data-ajax-type="DELETE"
                        data-url="<?php echo e(url('/checklists/delete-checklist-comment/'.$comment->comment_id)); ?>">
                        <small><?php echo app('translator')->get('lang.delete'); ?></small>
                    </a>
                </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="p-t-4" class="checklist_comment_body"><?php echo clean($comment->comment_text); ?></div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/checklists/checklist-comment.blade.php ENDPATH**/ ?>