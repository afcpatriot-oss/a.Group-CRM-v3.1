<!-- action buttons -->
@include('pages.orders.components.misc.list-page-actions')
<!-- action buttons -->

<!--stats panel-->
@if(auth()->user()->is_team)
<div id="orders-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($orders ?? []) > 0)
    @include('misc.list-pages-stats')
@endif
</div>
@endif
<!--stats panel-->

<!--orders table-->
<div class="card-embed-fix">
@include('pages.orders.components.table.wrapper')
</div>
<!--orders table-->


@include('pages.orders.modal')
