<!--fileupload-->
<div class="form-group row">
    <div class="col-12">
        <div class="dropzone dz-clickable" id="fileupload_files">
            <div class="dz-default dz-message">
                <i class="icon-Upload-toCloud"></i>
                <span><?php echo e(cleanLang(__('lang.drag_drop_file'))); ?></span>
            </div>
        </div>
    </div>

    <input type="hidden" name="fileresource_id" value="<?php echo e(request('fileresource_id')); ?>">
    <input type="hidden" name="fileresource_type" value="<?php echo e(request('fileresource_type')); ?>">
</div>

<!--tags-->
<div class="form-group row">
    <label class="col-12 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.tags'))); ?></label>
    <div class="col-12">
        <select name="tags" id="tags"
            class="form-control form-control-sm select2-multiple <?php echo e(runtimeAllowUserTags()); ?> select2-hidden-accessible"
            multiple="multiple" tabindex="-1" aria-hidden="true">
            <!--array of selected tags-->
            <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
            <?php $__currentLoopData = $invoice->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $selected_tags[] = $tag->tag_title ; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <!--/#array of selected tags-->
            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($tag->tag_title); ?>"
                <?php echo e(runtimePreselectedInArray($tag->tag_title ?? '', $selected_tags ?? [])); ?>>
                <?php echo e($tag->tag_title); ?>

            </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<?php if(config('visibility.file_modal_visible_to_client_option') && auth()->user()->role->role_id == 1): ?>
<div class="form-group form-group-checkbox row p-l-15">
    <label class="float-left"><?php echo e(cleanLang(__('lang.visible_to_client'))); ?>?</label>
    <div class="float-left clearfix p-t-0 p-l-10">
        <input type="checkbox" id="file_visibility_client" name="file_visibility_client"
            class="filled-in chk-col-light-blue" checked="checked">
        <label for="file_visibility_client"></label>
    </div>
</div>
<?php endif; ?>

<!--fileupload-->
<!--pass source-->
<input type="hidden" name="source" value="<?php echo e(request('source')); ?>"><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/files/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>