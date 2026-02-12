<!--each row-->
<tr id="order_{{ $order->id }}" class="{{ $order->pinned_status ?? '' }}">

    @if(config('visibility.orders_col_checkboxes'))
    <td class="orders_col_checkbox checkitem" id="orders_col_checkbox_{{ $order->id }}">
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox"
                id="listcheckbox-orders-{{ $order->id }}"
                name="ids[{{ $order->id }}]"
                class="listcheckbox listcheckbox-orders filled-in chk-col-light-blue"
                data-actions-container-class="orders-checkbox-actions-container">
            <label for="listcheckbox-orders-{{ $order->id }}"></label>
        </span>
    </td>
    @endif

    @if(config('visibility.orders_col_id'))
    <td class="orders_col_id">
        <a href="/orders/{{ $order->id }}">
            {{ $order->order_number }}
        </a>
    </td>
    @endif

    <td class="orders_col_subject">
        <a href="/orders/{{ $order->id }}">
            {{ str_limit($order->order_number ?? '---', 35) }}
        </a>
    </td>

    <td class="orders_col_user">
        @if(config('visibility.show_contact_profile'))
        <a href="javascript:void(0);"
            class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form user_profile_name_{{ $order->id }}"
            data-toggle="modal"
            data-target="#commonModal"
            data-url="{{ url('contacts/'.$order->id) }}"
            data-loading-target="commonModalBody"
            data-modal-title=""
            data-modal-size="modal-md"
            data-header-close-icon="hidden"
            data-header-extra-close-icon="visible"
            data-footer-visibility="hidden"
            data-action-ajax-loading-target="commonModalBody">
            {{ $order->first_name ?? '---' }} {{ $order->last_name ?? ''}}
        </a>
        @else
        <span>{{ $order->first_name ?? '---' }} {{ $order->last_name ?? ''}}</span>
        @endif
    </td>

    @if(config('visibility.orders_col_client'))
    <td class="orders_col_client">
        {{ str_limit($order->client_name ?? '---', 15) }}
    </td>
    @endif

    <td class="orders_col_date">
        {{ runtimeDate($order->order_created ?? $order->created_at) }}
    </td>

    <td class="orders_col_status">
        <span class="label label-outline-default">
            {{ runtimeLang('order_status') }}
        </span>
    </td>

    @if(config('visibility.orders_col_action'))
    <td class="orders_col_action actions_column">

        <span class="list-table-action font-size-inherit">

            <!--delete-->
            @if(config('visibility.action_buttons_delete'))
            <button type="button"
                title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE"
                data-url="{{ url('/orders/'.$order->id) }}">
                <i class="sl-icon-trash"></i>
            </button>
            @endif

            <!--edit-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button"
                title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal"
                data-target="#commonModal"
                data-url="{{ urlResource('/orders/'.$order->id.'/edit?edit_type=all&edit_source=list') }}"
                data-loading-target="commonModalBody"
                data-modal-title="{{ cleanLang(__('lang.edit_order')) }}"
                data-action-url="{{ urlResource('/orders/'.$order->id) }}"
                data-action-method="PUT"
                data-action-ajax-class="js-ajax-ux-request"
                data-action-ajax-loading-target="orders-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif

            <a href="/orders/{{ $order->id }}"
                title="{{ cleanLang(__('lang.view')) }}"
                class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm">
                <i class="ti-new-window"></i>
            </a>

        </span>

    </td>
    @endif

</tr>
