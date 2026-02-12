<div class="search-categories" id="search-categories">

    <!--all-->
    <span
        class="x-each-category <?php echo e(runtimeSearchCurrentMenu('all', $current_category)); ?> ajax-request search-category-button"
        data-url="<?php echo e(url('search?search_type=all')); ?>" data-type="form" data-form-id="global-search-form"
        data-ajax-type="post" data-loading-target="global-search-form">
        <?php echo app('translator')->get('lang.all'); ?> (<?php echo e($total_count ?? 0); ?>)
    </span>

    <!--clients-->
    <?php if(config('search.clients')): ?>
    <span
        class="x-each-category  <?php echo e(runtimeSearchCurrentMenu('clients', $current_category)); ?>  search-category-button ajax-request"
        data-url="<?php echo e(url('search?search_type=clients')); ?>" data-type="form" data-form-id="global-search-form"
        data-ajax-type="post" data-loading-target="global-search-form">
        <?php echo app('translator')->get('lang.clients'); ?> (<?php echo e($clients['count'] ?? 0); ?>)
    </span>
    <?php endif; ?>

    </span>

    <!--contacts-->
    <?php if(config('search.contacts')): ?>
    <span
        class="x-each-category  <?php echo e(runtimeSearchCurrentMenu('contacts', $current_category)); ?>  search-category-button ajax-request"
        data-url="<?php echo e(url('search?search_type=contacts')); ?>" data-type="form" data-form-id="global-search-form"
        data-ajax-type="post" data-loading-target="global-search-form">
        <?php echo app('translator')->get('lang.contacts'); ?> (<?php echo e($contacts['count'] ?? 0); ?>)
    </span>
    <?php endif; ?>

    <!--projects-->
    <?php if(config('search.projects')): ?>
    <span
        class="x-each-category  <?php echo e(runtimeSearchCurrentMenu('projects', $current_category)); ?>  search-category-button ajax-request"
        data-url="<?php echo e(url('search?search_type=projects')); ?>" data-type="form" data-form-id="global-search-form"
        data-ajax-type="post" data-loading-target="global-search-form">
        <?php echo app('translator')->get('lang.projects'); ?> (<?php echo e($projects['count'] ?? 0); ?>)
    </span>
    <?php endif; ?>

    <!--tasks-->
    <?php if(config('search.tasks')): ?>
    <span
        class="x-each-category  <?php echo e(runtimeSearchCurrentMenu('tasks', $current_category)); ?>  search-category-button ajax-request"
        data-url="<?php echo e(url('search?search_type=tasks')); ?>" data-type="form" data-form-id="global-search-form"
        data-ajax-type="post" data-loading-target="global-search-form">
        <?php echo app('translator')->get('lang.tasks'); ?> (<?php echo e($tasks['count'] ?? 0); ?>)
    </span>
    <?php endif; ?>

    <!--leads-->
    <?php if(config('search.leads')): ?>
    <span
        class="x-each-category  <?php echo e(runtimeSearchCurrentMenu('leads', $current_category)); ?>  search-category-button ajax-request"
        data-url="<?php echo e(url('search?search_type=leads')); ?>" data-type="form" data-form-id="global-search-form"
        data-ajax-type="post" data-loading-target="global-search-form">
        <?php echo app('translator')->get('lang.leads'); ?> (<?php echo e($leads['count'] ?? 0); ?>)
    </span>
    <?php endif; ?>

    <!--files-->
    <?php if(config('search.files')): ?>
    <span
        class="x-each-category  <?php echo e(runtimeSearchCurrentMenu('files', $current_category)); ?>  search-category-button ajax-request"
        data-url="<?php echo e(url('search?search_type=files')); ?>" data-type="form" data-form-id="global-search-form"
        data-ajax-type="post" data-loading-target="global-search-form">
        <?php echo app('translator')->get('lang.files'); ?> (<?php echo e($files['count'] ?? 0); ?>)
    </span>
    <?php endif; ?>

    <!--attachments-->
    <?php if(config('search.attachments')): ?>
    <span
        class="x-each-category  <?php echo e(runtimeSearchCurrentMenu('attachments', $current_category)); ?>  search-category-button ajax-request"
        data-url="<?php echo e(url('search?search_type=attachments')); ?>" data-type="form" data-form-id="global-search-form"
        data-ajax-type="post" data-loading-target="global-search-form">
        <?php echo app('translator')->get('lang.attachments'); ?> (<?php echo e($attachments['count'] ?? 0); ?>)
    </span>
    <?php endif; ?>

    <!--tickets-->
    <?php if(config('search.tickets')): ?>
    <span
        class="x-each-category  <?php echo e(runtimeSearchCurrentMenu('tickets', $current_category)); ?>  search-category-button ajax-request"
        data-url="<?php echo e(url('search?search_type=tickets')); ?>" data-type="form" data-form-id="global-search-form"
        data-ajax-type="post" data-loading-target="global-search-form">
        <?php echo app('translator')->get('lang.tickets'); ?> (<?php echo e($tickets['count'] ?? 0); ?>)
    </span>
    <?php endif; ?>

    <!--contracts-->
    <?php if(config('search.contracts')): ?>
    <span
        class="x-each-category  <?php echo e(runtimeSearchCurrentMenu('contracts', $current_category)); ?>  search-category-button ajax-request"
        data-url="<?php echo e(url('search?search_type=contracts')); ?>" data-type="form" data-form-id="global-search-form"
        data-ajax-type="post" data-loading-target="global-search-form">
        <?php echo app('translator')->get('lang.contracts'); ?> (<?php echo e($contracts['count'] ?? 0); ?>)
    </span>
    <?php endif; ?>

    <!--proposals-->
    <?php if(config('search.proposals')): ?>
    <span
        class="x-each-category  <?php echo e(runtimeSearchCurrentMenu('proposals', $current_category)); ?>  search-category-button ajax-request"
        data-url="<?php echo e(url('search?search_type=proposals')); ?>" data-type="form" data-form-id="global-search-form"
        data-ajax-type="post" data-loading-target="global-search-form">
        <?php echo app('translator')->get('lang.proposals'); ?> (<?php echo e($proposals['count'] ?? 0); ?>)
    </span>
    <?php endif; ?>

    <!--knowledgebase-->
    <?php if(config('search.knowledgebase')): ?>
    <span
        class="x-each-category  <?php echo e(runtimeSearchCurrentMenu('knowledgebase', $current_category)); ?>  search-category-button ajax-request"
        data-url="<?php echo e(url('search?search_type=knowledgebase')); ?>" data-type="form" data-form-id="global-search-form"
        data-ajax-type="post" data-loading-target="global-search-form">
        <?php echo app('translator')->get('lang.knowledgebase'); ?> (<?php echo e($knowledgebase['count'] ?? 0); ?>)
    </span>
    <?php endif; ?>

</div><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/search/modal/categories.blade.php ENDPATH**/ ?>