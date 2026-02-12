<div class="col-12 align-self-center hidden checkbox-actions box-shadow-minimum"
    id="orders-checkbox-actions-container">

    @if(config('visibility.action_buttons_edit'))

    <div class="x-buttons">

        <!--delete-->
        @if(config('visibility.action_buttons_delete'))
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark confirm-action-danger"
            data-type="form"
            data-ajax-type="POST"
            data-form-id="orders-list-table"
            data-url="{{ url('/orders/delete?type=bulk') }}"
            data-confirm-title="{{ cleanLang(__('lang.delete_selected_items')) }}"
            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
            id="checkbox-actions-delete-orders">
            <i class="sl-icon-trash"></i>
            {{ cleanLang(__('lang.delete')) }}
        </button>
        @endif

        <!--archive-->
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark confirm-action-info"
            data-type="form"
            data-ajax-type="POST"
            data-form-id="orders-list-table"
            data-url="{{ url('/orders/archive?ref=list') }}"
            data-confirm-title="@lang('lang.archive_orders')"
            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
            id="checkbox-actions-archive-orders">
            <i class="ti-archive"></i>
            @lang('lang.archive')
        </button>

        <!--restore-->
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark confirm-action-info"
            data-type="form"
            data-ajax-type="POST"
            data-form-id="orders-list-table"
            data-url="{{ url('/orders/restore?ref=list') }}"
            data-confirm-title="{{ cleanLang(__('lang.restore_orders')) }}"
            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
            id="checkbox-actions-restore-orders">
            <i class="ti-folder"></i>
            @lang('lang.restore')
        </button>

        <!--change status-->
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark actions-modal-button js-ajax-ux-request"
            data-toggle="modal"
            data-target="#actionsModal"
            data-modal-title="{{ cleanLang(__('lang.change_status')) }}"
            data-url="{{ urlResource('/orders/change-status') }}"
            data-action-url="{{ urlResource('/orders/change-status?type=bulk') }}"
            data-action-method="POST"
            data-action-type="form"
            data-action-form-id="main-body"
            data-loading-target="actionsModalBody"
            data-skip-checkboxes-reset="TRUE"
            id="checkbox-actions-change-status-orders">
            <i class="ti-bookmark"></i>
            {{ cleanLang(__('lang.change_status')) }}
        </button>

    </div>

    @else

    <div class="x-notice">
        {{ cleanLang(__('lang.no_actions_available')) }}
    </div>

    @endif

</div>

