<div class="row">
    <div class="col-lg-12">

        <!--ORDER NUMBER-->
        <div class="form-group row">
            <label class="col-sm-12 text-left control-label col-form-label required">
                {{ cleanLang(__('lang.order')) }}*
            </label>
            <div class="col-sm-12">
                <input type="text"
                    class="form-control form-control-sm"
                    id="order_number"
                    name="order_number"
                    value="{{ $order->order_number ?? '' }}">
            </div>
        </div>

        <!--CLIENT NAME-->
        <div class="form-group row">
            <label class="col-sm-12 text-left control-label col-form-label required">
                {{ cleanLang(__('lang.client')) }}*
            </label>
            <div class="col-sm-12">
                <input type="text"
                    class="form-control form-control-sm"
                    id="client_name"
                    name="client_name"
                    value="{{ $order->client_name ?? '' }}">
            </div>
        </div>

        <!--FIRST NAME-->
        <div class="form-group row">
            <label class="col-sm-12 text-left control-label col-form-label">
                {{ cleanLang(__('lang.first_name')) }}
            </label>
            <div class="col-sm-12">
                <input type="text"
                    class="form-control form-control-sm"
                    id="first_name"
                    name="first_name"
                    value="{{ $order->first_name ?? '' }}">
            </div>
        </div>

        <!--LAST NAME-->
        <div class="form-group row">
            <label class="col-sm-12 text-left control-label col-form-label">
                {{ cleanLang(__('lang.last_name')) }}
            </label>
            <div class="col-sm-12">
                <input type="text"
                    class="form-control form-control-sm"
                    id="last_name"
                    name="last_name"
                    value="{{ $order->last_name ?? '' }}">
            </div>
        </div>

        <!--PHONE-->
        <div class="form-group row">
            <label class="col-sm-12 text-left control-label col-form-label">
                {{ cleanLang(__('lang.phone')) }}
            </label>
            <div class="col-sm-12">
                <input type="text"
                    class="form-control form-control-sm"
                    id="phone"
                    name="phone"
                    value="{{ $order->phone ?? '' }}">
            </div>
        </div>

        <!--AMOUNT-->
        <div class="form-group row">
            <label class="col-sm-12 text-left control-label col-form-label">
                {{ cleanLang(__('lang.amount')) }}
            </label>
            <div class="col-sm-12">
                <input type="number"
                    step="0.01"
                    class="form-control form-control-sm"
                    id="total_amount"
                    name="total_amount"
                    value="{{ $order->total_amount ?? '' }}">
            </div>
        </div>

        <!--STATUS-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 col-form-label text-left required">
                {{ cleanLang(__('lang.status')) }}*
            </label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm"
                        id="status_id"
                        name="status_id">
                    @foreach($statuses ?? [] as $status)
                    <option value="{{ $status->id }}"
                        {{ runtimePreselected($order->status_id ?? '', $status->id) }}>
                        {{ runtimeLang($status->name) }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!--CUSTOM FIELDS-->
        @if(config('system.settings_customfields_display_orders') == 'toggled')
        <div class="spacer row">
            <div class="col-sm-12 col-lg-8">
                <span class="title">{{ cleanLang(__('lang.more_information')) }}</span>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch text-right">
                    <label>
                        <input type="checkbox"
                            class="js-switch-toggle-hidden-content"
                            data-target="orders_custom_fields_collaped">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <div id="orders_custom_fields_collaped" class="hidden">
            <div id="order-custom-fields-container">
                @include('misc.customfields')
            </div>
        </div>
        @else
            @include('misc.customfields')
        @endif

        <!--TYPE-->
        <input type="hidden" name="edit_type" value="{{ request('edit_type') }}">
        <input type="hidden" name="edit_source" value="{{ request('edit_source') }}">

        <!--required note-->
        <div class="row">
            <div class="col-12">
                <div><small><strong>* {{ cleanLang(__('lang.required')) }}</strong></small></div>
            </div>
        </div>

    </div>
</div>
