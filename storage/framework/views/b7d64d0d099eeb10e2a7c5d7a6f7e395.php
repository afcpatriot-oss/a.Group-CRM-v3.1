<!--categories menu-->
<?php echo $__env->make('pages.search.modal.categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!--search results-->
<div class="search-results-container" id="search-results-container">

    <!--no resulsts-->
    <?php if($count == 0): ?>
    <?php echo $__env->make('pages.search.modal.404', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>

    <!--clients-->
    <?php if($clients['state'] && $clients['count'] > 0): ?>
    <?php echo $__env->make('pages.search.results.clients', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!--projects-->
    <?php if($projects['state'] && $projects['count'] > 0): ?>
    <?php echo $__env->make('pages.search.results.projects', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!--contacts-->
    <?php if($contacts['state'] && $contacts['count'] > 0): ?>
    <?php echo $__env->make('pages.search.results.contacts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!--contracts-->
    <?php if($contracts['state'] && $contracts['count'] > 0): ?>
    <?php echo $__env->make('pages.search.results.contracts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!--tasks-->
    <?php if($tasks['state'] && $tasks['count'] > 0): ?>
    <?php echo $__env->make('pages.search.results.tasks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!--leads-->
    <?php if($leads['state'] && $leads['count'] > 0): ?>
    <?php echo $__env->make('pages.search.results.leads', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!--files-->
    <?php if($files['state'] && $files['count'] > 0): ?>
    <?php echo $__env->make('pages.search.results.files', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!--attachments-->
    <?php if($attachments['state'] && $attachments['count'] > 0): ?>
    <?php echo $__env->make('pages.search.results.attachments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!--tickets-->
    <?php if($tickets['state'] && $tickets['count'] > 0): ?>
    <?php echo $__env->make('pages.search.results.tickets', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!--proposals-->
    <?php if($proposals['state'] && $proposals['count'] > 0): ?>
    <?php echo $__env->make('pages.search.results.proposals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!--knowledgebase-->
    <?php if($knowledgebase['state'] && $knowledgebase['count'] > 0): ?>
    <?php echo $__env->make('pages.search.results.knowledgebase', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!--end-->
    <?php endif; ?>

</div>

<!--load more-->
<?php if(isset($search_type) && $search_type != 'all' && $count > 0): ?>
<?php echo $__env->make('pages.search.modal.load-more', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="p-b-50"></div>
<?php endif; ?><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/search/results/results.blade.php ENDPATH**/ ?>