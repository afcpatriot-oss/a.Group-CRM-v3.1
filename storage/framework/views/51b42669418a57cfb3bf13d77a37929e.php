<!-- Nav tabs -->
<ul class="nav nav-tabs profile-tab" role="tablist">

    <!--module extension point - allows modules to inject content-->
    <?php echo $__env->yieldPushContent('top_nav_1'); ?>

    <!--timeline-->
    <li class="nav-item">
        <a class="nav-link  tabs-menu-item <?php echo e($page['tabmenu_timeline'] ?? ''); ?>"
            href="<?php echo e(url('clients')); ?>/<?php echo e($client->client_id); ?>" role="tab"><?php echo e(cleanLang(__('lang.timeline'))); ?></a>
    </li>

    <!--module extension point - allows modules to inject content-->
    <?php echo $__env->yieldPushContent('top_nav_2'); ?>

    <!--details-->
    <li class="nav-item">
        <a class="nav-link tabs-menu-item   js-dynamic-url js-ajax-ux-request" data-toggle="tab" id="tabs-menu-details"
            data-loading-class="loading-tabs" data-loading-target="embed-content-container"
            data-dynamic-url="<?php echo e(_url('/clients')); ?>/<?php echo e($client->client_id); ?>/details"
            data-url="<?php echo e(_url('/clients')); ?>/<?php echo e($client->client_id); ?>/client-details" href="#clients_ajaxtab"
            role="tab"><?php echo e(cleanLang(__('lang.details'))); ?></a>
    </li>

    <!--module extension point - allows modules to inject content-->
    <?php echo $__env->yieldPushContent('top_nav_3'); ?>

    <!--contacts-->
    <li class="nav-item">
        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request <?php echo e($page['tabmenu_contacts'] ?? ''); ?>"
            data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"
            id="tabs-menu-contacts" data-dynamic-url="<?php echo e(url('clients')); ?>/<?php echo e($client->client_id); ?>/contacts"
            data-url="<?php echo e(url('/contacts')); ?>?contactresource_type=client&contactresource_id=<?php echo e($client->client_id); ?>&source=ext&page=1"
            href="#clients_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.users'))); ?></a>
    </li>

    <!--module extension point - allows modules to inject content-->
    <?php echo $__env->yieldPushContent('top_nav_4'); ?>

    <!--projects-->
    <li class="nav-item">
        <a class="nav-link tabs-menu-item js-dynamic-url js-ajax-ux-request <?php echo e($page['tabmenu_projects'] ?? ''); ?>"
            data-toggle="tab" data-loading-class="loading-tabs" id="tabs-menu-projects"
            data-loading-target="embed-content-container"
            data-dynamic-url="<?php echo e(_url('clients/'.$client->client_id.'/projects')); ?>"
            data-url="<?php echo e(url('/projects')); ?>?projectresource_type=client&projectresource_id=<?php echo e($client->client_id); ?>&source=ext&page=1"
            href="#clients_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.projects'))); ?></a>
    </li>

    <!--module extension point - allows modules to inject content-->
    <?php echo $__env->yieldPushContent('top_nav_5'); ?>

    <!--files-->
    <li class="nav-item dropdown <?php echo e($page['tabmenu_files'] ?? ''); ?>">
        <a class="nav-link dropdown-toggle tabs-menu-item tabs-menu-item" data-toggle="dropdown" id="tabs-menu-files"
            href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="hidden-xs-down"><?php echo e(cleanLang(__('lang.files'))); ?></span>
        </a>
        <div class="dropdown-menu" x-placement="bottom-start" id="fx-client-misc-topnave-files">
            <!--[project file]-->
            <a class="dropdown-item js-dynamic-url  js-ajax-ux-request <?php echo e($page['tabmenu_invoices'] ?? ''); ?>"
                data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                data-dynamic-url="<?php echo e(url('/clients')); ?>/<?php echo e($client->client_id); ?>/project-files"
                data-url="<?php echo e(url('/files')); ?>?fileresource_type=project&filter_file_clientid=<?php echo e($client->client_id); ?>&source=ext&page=1"
                href="#projects_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.project_files'))); ?></a>
            <!--[client files]-->
            <a class="dropdown-item js-dynamic-url  js-ajax-ux-request <?php echo e($page['tabmenu_invoices'] ?? ''); ?>"
                data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                data-dynamic-url="<?php echo e(url('/clients')); ?>/<?php echo e($client->client_id); ?>/client-files"
                data-url="<?php echo e(url('/files')); ?>?fileresource_id=<?php echo e($client->client_id); ?>&fileresource_type=client&source=ext&page=1"
                href="#projects_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.client_files'))); ?></a>

            <!--module extension point - allows modules to inject content-->
            <?php echo $__env->yieldPushContent('top_nav_menu_files'); ?>
        </div>
    </li>

    <!--module extension point - allows modules to inject content-->
    <?php echo $__env->yieldPushContent('top_nav_6'); ?>

    <!--tickets-->
    <li class="nav-item">
        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request <?php echo e($page['tabmenu_tickets'] ?? ''); ?>"
            id="tabs-menu-tickets" data-toggle="tab" data-loading-class="loading-tabs"
            data-loading-target="embed-content-container"
            data-dynamic-url="<?php echo e(url('clients')); ?>/<?php echo e($client->client_id); ?>/tickets"
            data-url="<?php echo e(url('/tickets')); ?>?ticketresource_type=client&ticketresource_id=<?php echo e($client->client_id); ?>&source=ext&page=1"
            href="#clients_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.tickets'))); ?></a></li>

    <!--module extension point - allows modules to inject content-->
    <?php echo $__env->yieldPushContent('top_nav_7'); ?>

    <!--module extension point - allows modules to inject content-->
    <?php echo $__env->yieldPushContent('top_nav_8'); ?>

    <!--billing-->
    <li class="nav-item dropdown <?php echo e($page['tabmenu_financial'] ?? ''); ?>">
        <a class="nav-link dropdown-toggle tabs-menu-item tabs-menu-item" data-toggle="dropdown" id="tabs-menu-billing"
            href="javascript:void(0)" role="button" aria-haspopup="true" id="tabs-menu-billing" aria-expanded="false">
            <span class="hidden-xs-down"><?php echo e(cleanLang(__('lang.financial'))); ?></span>
        </a>
        <div class="dropdown-menu" x-placement="bottom-start" id="fx-client-misc-topnave-billing">
            <!--[invoices]-->
            <a class="dropdown-item js-dynamic-url  js-ajax-ux-request <?php echo e($page['tabmenu_invoices'] ?? ''); ?>"
                data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                data-dynamic-url="<?php echo e(url('/clients')); ?>/<?php echo e($client->client_id); ?>/invoices"
                data-url="<?php echo e(url('/invoices')); ?>?source=ext&page=1&invoiceresource_id=<?php echo e($client->client_id); ?>&invoiceresource_type=client"
                href="#projects_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.invoices'))); ?></a>
            <!--[payments]-->
            <a class="dropdown-item js-dynamic-url  js-ajax-ux-request <?php echo e($page['tabmenu_invoices'] ?? ''); ?>"
                data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                data-dynamic-url="<?php echo e(url('/clients')); ?>/<?php echo e($client->client_id); ?>/payments"
                data-url="<?php echo e(url('/payments')); ?>?source=ext&page=1&paymentresource_id=<?php echo e($client->client_id); ?>&paymentresource_type=client"
                href="#projects_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.payments'))); ?></a>
            <!--[expenses]-->
            <a class="dropdown-item js-dynamic-url  js-ajax-ux-request <?php echo e($page['tabmenu_invoices'] ?? ''); ?>"
                data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                data-dynamic-url="<?php echo e(url('/clients')); ?>/<?php echo e($client->client_id); ?>/expenses"
                data-url="<?php echo e(url('/expenses')); ?>?source=ext&page=1&expenseresource_id=<?php echo e($client->client_id); ?>&expenseresource_type=client"
                href="#projects_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.expenses'))); ?></a>
            <!--[estimates]-->
            <a class="dropdown-item js-dynamic-url  js-ajax-ux-request <?php echo e($page['tabmenu_invoices'] ?? ''); ?>"
                data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                data-dynamic-url="<?php echo e(url('/clients')); ?>/<?php echo e($client->client_id); ?>/estimates"
                data-url="<?php echo e(url('/estimates')); ?>?source=ext&page=1&estimateresource_id=<?php echo e($client->client_id); ?>&estimateresource_type=client"
                href="#projects_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.estimates'))); ?></a>
            <!--[timesheets]-->
            <a class="dropdown-item js-dynamic-url  js-ajax-ux-request <?php echo e($page['tabmenu_timesheets'] ?? ''); ?>"
                data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                data-dynamic-url="<?php echo e(url('/clients')); ?>/<?php echo e($client->client_id); ?>/timesheets"
                data-url="<?php echo e(url('/timesheets')); ?>?source=ext&page=1&timesheetresource_id=<?php echo e($client->client_id); ?>&timesheetresource_type=client"
                href="#projects_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.timesheets'))); ?></a>
            <!--[contracts]-->
            <a class="dropdown-item js-dynamic-url  js-ajax-ux-request <?php echo e($page['tabmenu_contracts'] ?? ''); ?>"
                data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                data-dynamic-url="<?php echo e(url('/clients')); ?>/<?php echo e($client->client_id); ?>/contracts"
                data-url="<?php echo e(url('/contracts')); ?>?source=ext&page=1&filter_doc_client_id=<?php echo e($client->client_id); ?>"
                href="#projects_ajaxtab" role="tab"><?php echo app('translator')->get('lang.contracts'); ?></a>
            <!--[proposals]-->
            <a class="dropdown-item js-dynamic-url  js-ajax-ux-request <?php echo e($page['tabmenu_proposals'] ?? ''); ?>"
                data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                data-dynamic-url="<?php echo e(url('/clients')); ?>/<?php echo e($client->client_id); ?>/proposals"
                data-url="<?php echo e(url('/proposals')); ?>?source=ext&page=1&filter_doc_client_id=<?php echo e($client->client_id); ?>"
                href="#projects_ajaxtab" role="tab"><?php echo app('translator')->get('lang.proposals'); ?></a>

            <!--module extension point - allows modules to inject content-->
            <?php echo $__env->yieldPushContent('top_nav_menu_financial'); ?>
        </div>
    </li>

    <!--module extension point - allows modules to inject content-->
    <?php echo $__env->yieldPushContent('top_nav_9'); ?>

    <!--notes-->
    <li class="nav-item">
        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request <?php echo e($page['tabmenu_notes'] ?? ''); ?>"
            id="tabs-menu-notes" data-toggle="tab" data-loading-class="loading-tabs"
            data-loading-target="embed-content-container"
            data-dynamic-url="<?php echo e(url('clients')); ?>/<?php echo e($client->client_id); ?>/notes"
            data-url="<?php echo e(url('/notes')); ?>?source=ext&page=1&noteresource_type=client&noteresource_id=<?php echo e($client->client_id); ?>"
            href="#clients_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.notes'))); ?></a>

        <!--module extension point - allows modules to inject content-->
        <?php echo $__env->yieldPushContent('top_nav_menu_notes'); ?>
    </li>

    <!--module extension point - allows modules to inject content-->
    <?php echo $__env->yieldPushContent('top_nav_10'); ?>
</ul><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/client/components/misc/topnav.blade.php ENDPATH**/ ?>