<div class="card p-20 m-b-0 border-0" id="order-card-sidepanel">
    <div class="x-meta-line m-b-10">
        <strong>{{ cleanLang(__('lang.status')) }}:</strong>
        <span>{{ $order->status_name ?? '---' }}</span>
    </div>
</div>
