<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Заказы</h3>

        <a href="<?php echo e(route('orders.create')); ?>" class="btn btn-primary">
            + Создать заказ
        </a>
    </div>

    
    <div class="mb-3">
        <div class="btn-group">
            <button class="btn btn-outline-secondary active">
                Список
            </button>
            <button class="btn btn-outline-secondary" disabled>
                Канбан
            </button>
        </div>
    </div>

    
    <div class="card">
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Номер </th>
                        <th>Контактный телефон</th>
                        <th>Дата и время</th>
                        <th>Покупатель</th>
                        <th>Магазинс</th>
                        <th>Статус заказа</th>
                        <th>Оплата</th>
                        <th>Состав</th>
                        <th>Сумма</th>
                        <th>ТТН</th>

                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Заказы пока отсутствуют
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/orders/index.blade.php ENDPATH**/ ?>