    <!--title-->
    <div class="form-group row">
        <label class="col-sm-12 col-lg-2 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.title'); ?></label>
        <div class="col-sm-12 col-lg-10">
            <input type="text" class="form-control form-control-sm" id="calendar_event_title"
                name="calendar_event_title" value="<?php echo e($event['title'] ?? ''); ?>">
        </div>
    </div>

    <div class="modal-selector m-t-15">
        <div class="form-group form-group-checkbox row m-b-10">
            <!--all day-->
            <div class="col-6 p-t-5">
                <input type="checkbox" id="calendar_event_all_day" name="calendar_event_all_day"
                    class="filled-in chk-col-light-blue"
                    <?php echo e(runtimePrechecked($event['extendedProps']['all_day'] ?? 'yes')); ?>

                    <?php echo e(runtimeDisabledCalenderAllDayCheckbox($event['extendedProps']['resource_type'] ?? '')); ?>>
                <label class="p-l-30" for="calendar_event_all_day"><?php echo app('translator')->get('lang.all_day_event'); ?> 
                    <span
                        class="align-middle text-info font-16 <?php echo e(runtimeDisabledCalenderAllDayTooltip($event['extendedProps']['resource_type'] ?? '')); ?>" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.event_can_only_be_all_day'); ?>"
                        data-placement="top"><i class="ti-info-alt"></i></span>
                    </label>
            </div>
            <!--reminder-->
            <div class="col-6 p-t-5">
                <input type="checkbox" id="calendar_event_reminder" name="calendar_event_reminder"
                    class="filled-in chk-col-light-blue"
                    <?php echo e(runtimePrechecked($event['extendedProps']['reminder'] ?? 'no')); ?>>
                <label class="p-l-30" for="calendar_event_reminder"><?php echo app('translator')->get('lang.reminder_email'); ?></label>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <!--start_date-->
        <label
            class="col-sm-12 col-lg-2 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.start_date'); ?></label>
        <div class="col-sm-12 col-lg-4">
            <input type="text" class="form-control form-control-sm pickadate" autocomplete="off"
                name="calendar_event_start_date"
                value="<?php echo e(runtimeDate($event['extendedProps']['start_date'] ?? '', '')); ?>">
            <input class="mysql-date" type="hidden" name="calendar_event_start_date" id="calendar_event_start_date"
                value="<?php echo e($event['extendedProps']['start_date'] ?? ''); ?>">
        </div>
        <!--start_time-->
        <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required calendar_event_start_time"><?php echo app('translator')->get('lang.start_time'); ?></label>
        <div class="col-sm-12 col-lg-3 calendar_event_start_time">
            <input type="text" class="form-control form-control-sm timepicker" id="calendar_event_start_time"
                name="calendar_event_start_time" value="<?php echo e($event['extendedProps']['start_time'] ?? '00:00'); ?>">
        </div>
    </div>

    <div class="form-group row">
        <!--end_date-->
        <label class="col-sm-12 col-lg-2 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.end_date'); ?></label>
        <div class="col-sm-12 col-lg-4">
            <input type="text" class="form-control form-control-sm pickadate" autocomplete="off"
                name="calendar_event_end_date" value="<?php echo e(runtimeDate($event['extendedProps']['end_date'] ?? '', '')); ?>">
            <input class="mysql-date" type="hidden" name="calendar_event_end_date" id="calendar_event_end_date"
                value="<?php echo e($event['extendedProps']['end_date'] ?? ''); ?>">
        </div>
        <!--end_time-->
        <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required calendar_event_end_time"><?php echo app('translator')->get('lang.end_time'); ?></label>
        <div class="col-sm-12 col-lg-3 calendar_event_end_time">
            <input type="text" class="form-control form-control-sm timepicker" id="calendar_event_end_time"
                name="calendar_event_end_time" value="<?php echo e($event['extendedProps']['end_time'] ?? '00:00'); ?>">
        </div>
    </div>



    <!--description-->
    <div class="form-group row">
        <label class="col-sm-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.details'); ?></label>
        <div class="col-sm-12">
            <textarea class="form-control form-control-sm tinymce-textarea" rows="5" name="calendar_event_description"
                id="calendar_event_description"><?php echo e($event['extendedProps']['details'] ?? ''); ?></textarea>
        </div>
    </div>

    <!--title-->
    <div class="form-group row">
        <label class="col-sm-12 col-lg-2 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.location'); ?></label>
        <div class="col-sm-12 col-lg-10">
            <input type="text" class="form-control form-control-sm" id="calendar_event_location"
                name="calendar_event_location" value="<?php echo e($event['extendedProps']['location'] ?? ''); ?>">
        </div>
    </div>

    <div class="line"></div>
    <!--sharing-->
    <div class="row">
        <div class="col-sm-12 col-lg-2">
            <div class="form-group row">
                <label
                    class="col-sm-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.share_with'); ?></label>
            </div>
        </div>
        <div class="col-sm-12 col-lg-10">
            <?php if((isset($event['extendedProps']['resource_type']) && $event['extendedProps']['resource_type'] ==
            'calendarevent') || config('response') == 'create'): ?>
            <!--myself-->
            <div class="form-group form-group-checkbox row">
                <div class="col-12 p-t-5">
                    <input type="checkbox" id="share_with_myself" name="share_with_myself"
                        class="filled-in chk-col-light-blue share-with"
                        <?php echo e(runtimePrechecked($event['extendedProps']['sharing'] ?? 'myself', 'myself')); ?>>
                    <label class="p-l-30" for="share_with_myself"><?php echo app('translator')->get('lang.myself'); ?></label>
                </div>
            </div>
            <!--whole team-->
            <div class="form-group form-group-checkbox row">
                <div class="col-12 p-t-5">
                    <input type="checkbox" id="share_with_whole_team" name="share_with_whole_team"
                        class="filled-in chk-col-light-blue share-with"
                        <?php echo e(runtimePrechecked($event['extendedProps']['sharing'] ?? 'myself', 'whole-team')); ?>>
                    <label class="p-l-30" for="share_with_whole_team"><?php echo app('translator')->get('lang.whole_team'); ?></label>
                </div>
            </div>
            <!--team members-->
            <div class="form-group form-group-checkbox row">
                <div class="col-12 p-t-5">
                    <input type="checkbox" id="share_with_team_members" name="share_with_team_members"
                        class="filled-in chk-col-light-blue share-with"
                        <?php echo e(runtimePrechecked($event['extendedProps']['sharing'] ?? 'myself', 'selected-users')); ?>>
                    <label class="p-l-30" for="share_with_team_members"><?php echo app('translator')->get('lang.selected_team_members'); ?></label>
                </div>
            </div>
            <?php else: ?>
            <!--team members-->
            <div class="form-group form-group-checkbox row">
                <div class="col-12 p-t-5">
                    <input type="checkbox" id="share_with_team_members" name="share_with_team_members"
                        class="filled-in chk-col-light-blue share-with" checked disabled>
                    <label class="p-l-30" for="share_with_team_members"><?php echo app('translator')->get('lang.selected_team_members'); ?>

                        <?php if(isset($event['extendedProps']['resource_type']) && $event['extendedProps']['resource_type']
                        =='project'): ?>
                        <span class="align-middle text-info font-16" data-toggle="tooltip"
                            title="<?php echo app('translator')->get('lang.calendar_assign_project_info'); ?>" data-placement="top"><i
                                class="ti-info-alt"></i></span>
                        <?php endif; ?>

                        <?php if(isset($event['extendedProps']['resource_type']) && $event['extendedProps']['resource_type']
                        =='task'): ?>
                        <span class="align-middle text-info font-16" data-toggle="tooltip"
                            title="<?php echo app('translator')->get('lang.calendar_assign_project_info'); ?>" data-placement="top"><i
                                class="ti-info-alt"></i></span>
                        <?php endif; ?>

                    </label>

                </div>
            </div>
            <?php endif; ?>

            <?php if((isset($event['extendedProps']['resource_type']) && $event['extendedProps']['resource_type'] ==
            'calendarevent') || config('response') == 'create'): ?>
            <div class="form-group row <?php echo e(calendarSharing($event['extendedProps']['sharing'] ?? '')); ?>"
                id="share-with-users-container">
                <label
                    class="col-12 p-t-5 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.team_members'); ?></label>
                <div class="col-12">
                    <select name="sharing_team_members" id="sharing_team_members"
                        class="form-control  form-control-sm select2-basic select2-multiple select2-hidden-accessible"
                        multiple="multiple" tabindex="-1" aria-hidden="true">
                        <!--array of assigned-->
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $assigned[] = $user['id']; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!--/#array of assigned-->
                        <!--users list (excluding current user-->
                        <?php $__currentLoopData = config('system.team_members'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($team->id == auth()->user()->id): ?>
                        <option value="<?php echo e($team->id); ?>" selected>
                            <?php echo e($team->full_name); ?></option>
                        <?php else: ?>
                        <option value="<?php echo e($team->id); ?>"
                            <?php echo e(runtimePreselectedInArray($team->id ?? '', $assigned ?? [])); ?>>
                            <?php echo e($team->full_name); ?></option>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!--/#users list-->
                    </select>
                </div>
            </div>
            <?php endif; ?>


        </div>
    </div>

    <div class="line"></div>

    <!--more information - toggle-->
    <div class="spacer row">
        <div class="col-sm-12 col-lg-8">
            <span class="title"><?php echo app('translator')->get('lang.attach_files'); ?></span>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="switch  text-right">
                <label>
                    <input type="checkbox" name="more_information" id="more_information"
                        class="js-switch-toggle-hidden-content" data-target="toogle_attach_files">
                    <span class="lever switch-col-light-blue"></span>
                </label>
            </div>
        </div>
    </div>
    <!--more information-->
    <div class="hidden p-t-10" id="toogle_attach_files">
        <!--attach files-->
        <div class="form-group row">
            <div class="col-12">
                <div class="dropzone dz-clickable" id="dropzone_upload_multiple_files">
                    <div class="dz-default dz-message">
                        <i class="icon-Upload-toCloud"></i>
                        <span><?php echo app('translator')->get('lang.drag_drop_file'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!--edit existing-->
        <?php if(config('response') == 'show' || config('response') == 'edit'): ?>
        <table class="table table-bordered">
            <tbody>
                <?php $__currentLoopData = $event['extendedProps']['files']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="event_file_<?php echo e($file['file_uniqueid']); ?>">
                    <td><?php echo e($file['file_name']); ?> </td>
                    <td class="w-px-40"> <button type="button"
                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                            data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
                            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                            data-url="<?php echo e(url('/calendar/files/'.$file['file_uniqueid'].'?type='.$file['file_type'])); ?>">
                            <i class="sl-icon-trash"></i>
                        </button></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>


    <!--resource type-->
    <input type="hidden" name="resource_type" value="<?php echo e($event['extendedProps']['resource_type'] ?? 'calendarevent'); ?>"><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/calendar/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>