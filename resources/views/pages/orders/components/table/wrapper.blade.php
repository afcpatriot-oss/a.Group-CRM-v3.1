<!--bulk actions-->
@include('pages.orders.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.orders.components.table.table')

<!--filter-->
@if(auth()->user()->is_team)
@include('pages.orders.components.misc.filter-orders')
@endif
<!--filter-->

<!--export-->
@if(config('visibility.list_page_actions_exporting'))
@include('pages.export.orders.export')
@endif
<!--export-->
