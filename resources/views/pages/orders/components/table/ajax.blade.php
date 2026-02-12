@if (@count($orders ?? []) > 0)
    @foreach($orders as $order)
        @include('pages.orders.components.table.ajax-inc')
    @endforeach
@endif
