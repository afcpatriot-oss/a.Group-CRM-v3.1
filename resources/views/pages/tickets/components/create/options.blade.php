<!--options menu-->
<div class="col-sm-12 col-lg-3">
    <div class="card">
        <div class="row">
            <div class="col-lg-12">
                <div class="ticket-panel">
                    <div class="x-top-header">
                        {{ cleanLang(__('lang.order_parameters')) }}
                    </div>
                    <div class="x-body form-horizontal">

                        @if(auth()->user()->is_team)
                        <!--client-->
                        <div class="form-group row">
                            <label class="col-12 control-label col-form-label text-left required">
                                {{ cleanLang(__('lang.order_customer')) }}
                            </label>
                            <div class="col-12">
                                <select name="ticket_clientid"
                                        id="ticket_clientid"
                                        class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search"
                                        data-projects-dropdown="ticket_projectid"
                                        data-feed-request-type="clients_projects"
                                        data-ajax--url="{{ url('/') }}/feed/company_names">
                                </select>
                            </div>
                        </div>

                        <!--project-->
                        <div class="form-group row">
                            <label class="col-12 col-form-label text-left">
                                {{ cleanLang(__('lang.order_related_project')) }}
                            </label>
                            <div class="col-12">
                                <select class="select2-basic form-control form-control-sm dynamic_ticket_projectid"
                                        id="ticket_projectid"
                                        name="ticket_projectid"
                                        disabled>
                                </select>
                            </div>
                        </div>
                        @endif

                        <!--department (hidden, value selected & sent)-->
                        <div class="form-group row" hidden aria-hidden="true">
                            <label class="col-12 control-label col-form-label text-left required">
                                {{ cleanLang(__('lang.order_category')) }}
                            </label>
                            <div class="col-12">
                                <select class="select2-basic form-control form-control-sm"
                                        id="ticket_categoryid"
                                        name="ticket_categoryid">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}"
                                            {{ !old('ticket_categoryid') && $category->is_default ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @if(auth()->user()->is_client)
                        <!--clients projects-->
                        <div class="form-group row">
                            <label class="col-12 col-form-label text-left">
                                {{ cleanLang(__('lang.order_related_project')) }}
                            </label>
                            <div class="col-12">
                                <select class="select2-basic form-control form-control-sm"
                                        id="ticket_projectid"
                                        name="ticket_projectid"
                                        data-allow-clear="true">
                                    <option value=""></option>
                                    @foreach($clients_projects as $project)
                                        <option value="{{ $project->project_id }}">
                                            {{ $project->project_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <!--priority (hidden, default=normal)-->
                        <div class="form-group row" hidden aria-hidden="true">
                            <label class="col-12 col-form-label text-left">
                                {{ cleanLang(__('lang.order_priority')) }}
                            </label>
                            <div class="col-12">
                                <select class="select2-basic form-control form-control-sm"
                                        id="ticket_priority"
                                        name="ticket_priority">
                                    @foreach(config('settings.ticket_priority') as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ $key == 'normal' ? 'selected' : '' }}>
                                            {{ runtimeLang($key) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="line m-t-40 m-b-0"></div>

                        @include('pages.tickets.components.create.customfields')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
