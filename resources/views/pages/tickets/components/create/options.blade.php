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

                        {{-- QUICK ORDER CLIENT (PHONE ONLY) --}}
                        @if(auth()->user()->is_team)
                        <div class="form-group row">
                            <label class="col-12 control-label col-form-label text-left required">
                                {{ cleanLang(__('lang.phone')) }}
                            </label>
                            <div class="col-12">
                                <input type="tel"
                                       name="quick_order_phone"
                                       id="quick_order_phone"
                                       class="form-control form-control-sm"
                                       placeholder="+380..."
                                       autocomplete="off">
                            </div>
                        </div>
                        @endif

                        {{-- PROJECT (kept, platform logic intact) --}}
                        @if(auth()->user()->is_team)
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

                        {{-- CATEGORY (HIDDEN, DEFAULT SENT) --}}
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
                                            {{ $category->is_default ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- CLIENT PROJECTS (CLIENT VIEW, UNCHANGED) --}}
                        @if(auth()->user()->is_client)
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

                        {{-- PRIORITY (HIDDEN, DEFAULT=normal) --}}
                        @if(auth()->user()->is_team)
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
                                            {{ $key === 'normal' ? 'selected' : '' }}>
                                            {{ runtimeLang($key) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="line m-t-40 m-b-0"></div>

                        {{-- CUSTOM FIELDS (PLATFORM) --}}
                        @include('pages.tickets.components.create.customfields')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
