<div class="card p-20 m-b-0 border-0" id="order-card-overview">
    <h5 class="m-b-15">{{ cleanLang(__('lang.order')) }} #{{ $order->id }}</h5>

    <div class="x-meta-line m-b-10">
        <strong>{{ cleanLang(__('lang.id')) }}:</strong>
        <span>{{ $order->id }}</span>
    </div>

    <div class="x-meta-line m-b-10">
        <strong>{{ cleanLang(__('lang.order')) }}:</strong>
        <span>{{ $order->order_number ?? '---' }}</span>
    </div>
</div>
