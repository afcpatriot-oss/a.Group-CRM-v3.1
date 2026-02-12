@if(config('visibility.list_page_actions_exporting'))
<div class="m-t-10 text-right">
    <button class="btn btn-sm btn-default">
        {{ cleanLang(__('lang.export')) }}
    </button>
</div>
@endif
