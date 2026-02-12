<!--each file attachment-->
<div class="col-sm-12 col-md-6 col-lg-4">
    <div class="file-attachment">
        <?php if($attachment->attachment_type == 'image'): ?>
        <div class="">
            <a class="fancybox preview-image-thumb"
                href="storage/files/<?php echo e($attachment->attachment_directory); ?>/<?php echo e($attachment->attachment_filename); ?>"
                title="<?php echo e(str_limit($attachment->attachment_filename, 60)); ?>"
                alt="<?php echo e(str_limit($attachment->attachment_filename, 60)); ?>">
                <img class="x-image" src="<?php echo e(url('storage/files/' . $attachment->attachment_directory .'/'. $attachment->attachment_thumbname)); ?>">
            </a>
        </div>
        <?php else: ?>
        <div class="x-image"> <?php echo e($attachment->attachment_extension); ?></div>
        <?php endif; ?>
        <div class="x-details">
            <div class="x-name"><span
                    title="<?php echo e($attachment->attachment_filename); ?>"><?php echo e(str_limit($attachment->attachment_filename, 16)); ?></span>
            </div>
            <div class="x-date"><strong><?php echo e($attachment->creator->full_name ?? __('lang.unknown')); ?></strong></div>
            <div class="x-actions"><strong><a
                        href="tickets/attachments/download/<?php echo e($attachment->attachment_uniqiueid); ?>" download><?php echo e(cleanLang(__('lang.download'))); ?> <span
                            class="x-icons"><i class="ti-download"></i></span></strong></a></div>
        </div>
    </div>
</div>
<!--each file attachment--><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/ticket/components/attachments.blade.php ENDPATH**/ ?>