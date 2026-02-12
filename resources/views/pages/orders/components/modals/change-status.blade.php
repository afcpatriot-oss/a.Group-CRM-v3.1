<!--item-->
<div class="form-group row">
    <div class="col-sm-12">
        <select class="select2-basic form-control form-control-sm select2-preselected"
            id="status_id"
            name="status_id"
            data-preselected="1">

            @foreach($statuses as $status)
            <option value="{{ $status->id }}">
                {{ $status->name }}
            </option>
            @endforeach

        </select>
    </div>
</div>

<!--form buttons-->
<div class="text-right p-t-30">
    <button type="submit"
        id="submitButton"
        class="btn btn-danger waves-effect text-left ajax-request"
        data-url="{{ url('orders/change-status') }}"
        data-form-id="main-body"
        data-ajax-type="POST"
        data-on-start-submit-button="disable">
        @lang('lang.submit')
    </button>
</div>
