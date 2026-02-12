@php
    $statuses = $statuses ?? [];
@endphp

<div class="row m-t-10 m-b-10">

    <div class="col-md-4">
        <input type="text"
            class="form-control form-control-sm"
            placeholder="{{ cleanLang(__('lang.search')) }}"
            name="q"
            value="{{ request('q') }}">
    </div>

    <div class="col-md-3">
        <select class="form-control form-control-sm" name="status_id">
            <option value="">{{ cleanLang(__('lang.status')) }}</option>

            @foreach($statuses as $status)
                <option value="{{ $status->id ?? '' }}" @if(request('status_id') == ($status->id ?? '')) selected @endif>
                    {{ $status->name ?? '-' }}
                </option>
            @endforeach

        </select>
    </div>

    <div class="col-md-5 text-right">
        <button type="button"
            class="btn btn-sm btn-default js-ajax-ux-request"
            data-url="{{ url('orders') }}">
            {{ cleanLang(__('lang.reset')) }}
        </button>
    </div>

</div>
