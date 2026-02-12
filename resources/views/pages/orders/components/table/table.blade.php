<!--filtered results warning-->
@if(config('filter.status') == 'active')
<div class="filtered-results-warning opacity-8 p-b-5">
    <small>
        @lang('lang.these_results_are')
        <a href="javascript:void(0);" class="js-toggle-side-panel"
            data-target="sidepanel-filter-orders">@lang('lang.filtered')</a>.
        @lang('lang.you_can')
        <a href="{{ url('/orders?clear-filter=yes') }}">@lang('lang.clear_the_filters')</a>.
    </small>
</div>
@endif

<div class="card count-{{ @count($orders ?? []) }}" id="orders-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">

            @if (@count($orders ?? []) > 0)
            <table id="orders-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list" data-page-size="10">
                <thead>
                    <tr>
                        @if(config('visibility.orders_col_checkboxes'))
                        <th class="list-checkbox-wrapper">
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-orders" name="listcheckbox-orders"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="orders-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-orders">
                                <label for="listcheckbox-orders"></label>
                            </span>
                        </th>
                        @endif

                        @if(config('visibility.orders_col_id'))
                        <th class="orders_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_order_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/orders?action=sort&orderby=id&sortorder=asc') }}">
                                {{ cleanLang(__('lang.id')) }}
                                <span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>
                        @endif

                        <th class="orders_col_number">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_order_number" href="javascript:void(0)"
                                data-url="{{ urlResource('/orders?action=sort&orderby=order_number&sortorder=asc') }}">
                                {{ cleanLang(__('lang.order')) }}
                                <span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>

                        <th class="orders_col_client">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_client" href="javascript:void(0)"
                                data-url="{{ urlResource('/orders?action=sort&orderby=client_name&sortorder=asc') }}">
                                {{ cleanLang(__('lang.client')) }}
                                <span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>

                        <th class="orders_col_date">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_order_created" href="javascript:void(0)"
                                data-url="{{ urlResource('/orders?action=sort&orderby=order_created&sortorder=asc') }}">
                                {{ cleanLang(__('lang.date')) }}
                                <span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>

                        <th class="orders_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_status" href="javascript:void(0)"
                                data-url="{{ urlResource('/orders?action=sort&orderby=status_id&sortorder=asc') }}">
                                {{ cleanLang(__('lang.status')) }}
                                <span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>

                        @if(config('visibility.orders_col_action'))
                        <th class="orders_col_action">
                            <a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a>
                        </th>
                        @endif
                    </tr>
                </thead>

                <tbody id="orders-td-container">
                    @include('pages.orders.components.table.ajax')
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="20">
                            @include('misc.load-more-button')
                        </td>
                    </tr>
                </tfoot>
            </table>
            @endif

            @if (@count($orders ?? []) == 0)
            @include('notifications.no-results-found')
            @endif

        </div>
    </div>
</div>
