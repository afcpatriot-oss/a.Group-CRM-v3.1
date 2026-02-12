<div class="card">
    <div class="card-header">
        <h3 class="card-title">Группы статусов заказов</h3>
    </div>

    <div class="card-body">
        <?php if (empty($groups)) : ?>
            <div class="alert alert-info">
                Группы статусов не созданы
            </div>
        <?php else : ?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th>Название</th>
                        <th>Код</th>
                        <th width="100">Цвет</th>
                        <th width="80">Активна</th>
                        <th width="140"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($groups as $group) : ?>
                        <tr>
                            <td><?= $group->id ?></td>
                            <td><?= htmlspecialchars($group->name) ?></td>
                            <td><?= $group->code ?></td>
                            <td>
                                <span style="background:<?= $group->color ?>;padding:4px 10px;color:#fff">
                                    <?= $group->color ?>
                                </span>
                            </td>
                            <td><?= $group->is_active ? 'Да' : 'Нет' ?></td>
                            <td>
                                <a href="<?= site_url('settings/orderstatusgroups/delete/'.$group->id) ?>"
                                   class="btn btn-xs btn-danger"
                                   onclick="return confirm('Удалить группу?')">
                                    Удалить
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
</div>

<?php /**PATH /home/u944590956/domains/agroupcrm.online/public_html/application/resources/views/pages/settings/sections/orderstatusgroups/index.blade.php ENDPATH**/ ?>