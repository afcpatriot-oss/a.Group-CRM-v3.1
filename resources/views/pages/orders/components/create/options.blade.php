<!--options menu-->
<div class="col-sm-12 col-lg-3">
    <div class="card">
        <div class="row">
            <div class="col-lg-12">
                <div class="ticket-panel">

                    <div class="x-top-header">
                        {{ cleanLang(__('lang.order_options')) }}
                    </div>

                    <div class="x-body form-horizontal">

                        @if(auth()->user()->is_team)
                        <!--CLIENT-->
                        <div class="form-group row">
                            <label class="col-12 control-label col-form-label text-left required">
                                {{ cleanLang(__('lang.client')) }}
                            </label>
                            <div class="col-12">
                                <select name="client_id"
                                    id="client_id"
                                    class="form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                                    data-ajax--url="{{ url('/') }}/feed/company_names">
                                </select>
                            </div>
                        </div>
                        @endif

                        <!--STATUS-->
                        <div class="form-group row">
                            <label class="col-12 control-label col-form-label text-left required">
                                {{ cleanLang(__('lang.status')) }}
                            </label>
                            <div class="col-12">
                                <select class="select2-basic form-control form-control-sm"
                                        id="status_id"
                                        name="status_id">
                                    <option></option>
                                    @foreach($statuses ?? [] as $status)
                                    <option value="{{ $status->id }}">
                                        {{ $status->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!--SALES MODEL-->
                        <div class="form-group row">
                            <label class="col-12 control-label col-form-label text-left">
                                {{ cleanLang(__('lang.sales_model')) }}
                            </label>
                            <div class="col-12">
                                <select class="select2-basic form-control form-control-sm"
                                        id="sales_model_id"
                                        name="sales_model_id">
                                    <option value=""></option>
                                    @foreach($sales_models ?? [] as $model)
                                    <option value="{{ $model->id }}">
                                        {{ $model->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="line m-t-40 m-b-0"></div>

                        @include('pages.orders.components.create.customfields')

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
