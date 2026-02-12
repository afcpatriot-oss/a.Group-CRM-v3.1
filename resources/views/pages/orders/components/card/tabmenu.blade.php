<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active ajax-request"
           data-toggle="tab"
           href="javascript:void(0);"
           role="tab"
           data-url="{{ url('orders/'.$order->id) }}"
           data-loading-class="loading-before-centre"
           data-loading-target="card-orders-left-panel">
            <span class="hidden-sm-up"><i class="ti-layout"></i></span>
            <span class="hidden-xs-down">@lang('lang.overview')</span>
        </a>
    </li>
</ul>
