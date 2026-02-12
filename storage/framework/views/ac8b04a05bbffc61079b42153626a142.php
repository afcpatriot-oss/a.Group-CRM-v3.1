<?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="file_<?php echo e($file->file_id); ?>">
    <?php if(config('visibility.files_col_checkboxes')): ?>
    <td class="files_col_checkbox checkitem" id="files_col_checkbox_<?php echo e($file->file_id); ?>">
        <!--list checkbox-->
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox" id="listcheckbox-files-<?php echo e($file->file_id); ?>" name="ids[<?php echo e($file->file_uniqueid); ?>]"
                class="listcheckbox listcheckbox-files filled-in chk-col-light-blue"
                data-actions-container-class="files-checkbox-actions-container">
            <label for="listcheckbox-files-<?php echo e($file->file_id); ?>"></label>
        </span>
    </td>
    <?php endif; ?>
    <td class="files_col_file" id="files_col_file_<?php echo e($file->file_id); ?>">
        <?php if($file->file_type == 'image'): ?>
        <!--dynamic inline style-->
        <div>
            <a class="fancybox preview-image-thumb"
                href="storage/files/<?php echo e($file->file_directory); ?>/<?php echo e($file->file_filename); ?>"
                title="<?php echo e(str_limit($file->file_filename, 60)); ?>" alt="<?php echo e(str_limit($file->file_filename, 60)); ?>">
                <img class="lists-table-thumb"
                    src="<?php echo e(url('storage/files/' . $file->file_directory .'/'. $file->file_thumbname)); ?>">
            </a>
        </div>
        <?php else: ?>
        <div class="lists-table-thumb">
            <a class="preview-image-thumb" href="files/download?file_id=<?php echo e($file->file_uniqueid); ?>" download>
                <?php echo e($file->file_extension); ?>

            </a>
        </div>
        <?php endif; ?>
    </td>
    <td class="files_col_file_name" id="files_col_file_name_<?php echo e($file->file_id); ?>">
        <a href="files/download?file_id=<?php echo e($file->file_uniqueid); ?>" title="<?php echo e($file->file_filename ?? '---'); ?>"
            download><?php echo e(str_limit($file->file_filename ?? '---', 25)); ?></a>
    </td>
    <td class="files_col_added_by" id="files_col_added_by_<?php echo e($file->file_id); ?>">
        <img src="<?php echo e(getUsersAvatar($file->avatar_directory, $file->avatar_filename)); ?>" alt="user"
            class="img-circle avatar-xsmall">
        <?php echo e($file->first_name ?? runtimeUnkownUser()); ?>

    </td>
    <td class="files_col_size" id="files_col_size_<?php echo e($file->file_id); ?>"><?php echo e($file->file_size); ?></td>
    <td class="files_col_date" id="files_col_date_<?php echo e($file->file_id); ?>">
        <?php echo e(runtimeDate($file->file_created)); ?>

    </td>

    <td class="files_col_tags <?php echo e(config('table.tableconfig_column_6')); ?> tableconfig_column_6">
        <!--tag-->
        <?php if(count($file->tags ?? []) > 0): ?>
        <?php $__currentLoopData = $file->tags->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <span class="label label-outline-default"><?php echo e(str_limit($tag->tag_title, 15)); ?></span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <span>---</span>
        <?php endif; ?>
        <!--/#tag-->

        <!--more tags (greater than tags->take(x) number above -->
        <?php if(count($file->tags ?? []) > 1): ?>
        <?php $tags = $file->tags; ?>
        <?php echo $__env->make('misc.more-tags', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <!--more tags-->
    </td>

    <td class="files_col_action actions_column" id="files_col_action_<?php echo e($file->file_id); ?>">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">

            <!--clent visibility-->
            <?php if(config('visibility.files_col_visibility')): ?>
            <span class="switch switch-small" id="file_edit_visibility_<?php echo e($file->file_id); ?>">
                <label>
                    <input <?php echo e(runtimePrechecked($file['file_visibility_client'] ?? '')); ?> type="checkbox"
                        class="js-ajax-ux-request-default" name="visible_to_client"
                        id="visible_to_client_<?php echo e($file->file_id); ?>" data-url="<?php echo e(url('/files')); ?>/<?php echo e($file->file_id); ?>"
                        data-ajax-type="PUT" data-type="form" data-form-id="file_edit_visibility_<?php echo e($file->file_id); ?>"
                        data-progress-bar='hidden'>
                    <span class="lever switch-col-light-blue"></span>
                </label>
            </span>
            <?php endif; ?>

            <!--set as cover-->
            <?php if(config('visibility.set_image_as_project_cover')): ?>
            <?php if($file->file_type == 'image'): ?>
            <button type="button" title="<?php echo app('translator')->get('lang.set_as_cover_image'); ?>"
                class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm confirm-action-info m-t-2"
                data-confirm-title="<?php echo app('translator')->get('lang.set_as_cover_image'); ?>" data-confirm-text="<?php echo app('translator')->get('lang.are_you_sure'); ?>"
                data-url="<?php echo e(url('projects/'.$file->fileresource_id.'/set-cover-image?file='.$file->file_id)); ?>">
                <i class="sl-icon-picture"></i>
            </button>
            <?php else: ?>
            <span class="btn btn-outline-default btn-circle btn-sm disabled <?php echo e(runtimePlaceholdeActionsButtons()); ?>"
                data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.actions_not_available'))); ?>"><i
                    class="sl-icon-picture"></i></span>
            <?php endif; ?>
            <?php endif; ?>


            <!--copy file-->
            <?php if(auth()->user()->is_team): ?>
            <button type="button"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                title="<?php echo app('translator')->get('lang.copy_file'); ?>" data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(urlResource('files/copy')); ?>" data-ajax-type="GET" data-loading-target="commonModalBody"
                data-modal-title="<?php echo app('translator')->get('lang.copy_files'); ?>" data-action-type="form" data-action-form-id="main-body"
                data-action-url="<?php echo e(urlResource('files/copy?id='.$file->file_uniqueid)); ?>" data-action-method="POST"
                data-modal-size="modal-sm" data-action-ajax-class="ajax-request" data-button-loading-annimation="yes"
                data-action-ajax-loading-target="commonModalBody">
                <i class="mdi mdi-content-copy"></i>
            </button>
            <?php endif; ?>

            <!--delete-->
            <?php if($file->permission_delete_file): ?>
            <button type="button" title="<?php echo app('translator')->get('lang.delete'); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo app('translator')->get('lang.delete_file'); ?>" data-confirm-text="<?php echo app('translator')->get('lang.are_you_sure'); ?>"
                data-ajax-type="DELETE" data-url="<?php echo e(url('/')); ?>/files/<?php echo e($file->file_id); ?>">
                <i class="sl-icon-trash"></i>
            </button>
            <?php else: ?>
            <!--optionally show disabled button?-->
            <span class="btn btn-outline-default btn-circle btn-sm disabled  <?php echo e(runtimePlaceholdeActionsButtons()); ?>"
                data-toggle="tooltip" title="<?php echo app('translator')->get('lang.actions_not_available'); ?>"><i class="sl-icon-trash"></i></span>
            <?php endif; ?>
            <a href="files/download?file_id=<?php echo e($file->file_uniqueid); ?>" title="<?php echo app('translator')->get('lang.download'); ?>"
                class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm" download>
                <i class="ti-download"></i>
            </a>

            <!--more button (team)-->
            <?php if($file->permission_edit_file): ?>
            <span class="list-table-action dropdown font-size-inherit">
                <button type="button" id="listTableAction" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" title="<?php echo e(cleanLang(__('lang.more'))); ?>"
                    class="data-toggle-action-tooltip btn btn-outline-default-light btn-circle btn-sm">
                    <i class="ti-more"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="listTableAction">
                    <!--actions button - change category-->
                    <a class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        href="javascript:void(0)" 
                        data-toggle="modal" 
                        data-target="#commonModal"
                        data-modal-title="<?php echo e(cleanLang(__('lang.edit_tags'))); ?>"
                        data-url="<?php echo e(urlResource('/files/'.$file->file_id.'/edit-tags')); ?>"
                        data-action-url="<?php echo e(urlResource('/files/'.$file->file_id.'/edit-tags')); ?>"
                        data-loading-target="commonModalBody" 
                        data-action-ajax-class="js-ajax-ux-request"
                        data-action-method="POST">
                        <?php echo e(cleanLang(__('lang.edit_tags'))); ?></a>
                    <!--actions button - attach project -->
                </div>
            </span>
            <?php endif; ?>
            <!--more button-->
        </span>
        <!--action button-->
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/files/components/table/ajax.blade.php ENDPATH**/ ?>