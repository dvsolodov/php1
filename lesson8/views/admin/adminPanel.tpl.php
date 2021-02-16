<h2>Панель администратора</h2>
<a href="/admin/logout">Выйти</a>

<?php if (isset($orderMsg)): ?>
<p><?= $orderMsg; ?></p>
<?php endif; ?>

<?php if (!empty($orders)): ?>

<table>
    <tr>
        <th>Номер заказа</th>
        <th>Номер телефона</th>
        <th>Имя покупателя</th>
        <th>Статус</th>
    </tr>

<?php foreach ($orders as $order): ?>

    <tr>
        <td><a href="/admin/order/<?= $order['id']; ?>/show"><?= $order['id']; ?></a></td>
        <td><?= $order['phone']; ?></td>
        <td><?= $order['user_name']; ?></td>
        <td>
            <select>

                <?php foreach ($statuses as $status): ?>

                <option data-status-id="<?= $status['id']; ?>" 
                        data-order-id="<?= $order['id']; ?>" 
                        <?php if ($status['id'] === $order['status_id']) echo 'selected'; ?>>

                    <?= $status['name']; ?>

                </option>

                <?php endforeach; ?>

            </select> 
        </td>
    </tr>

<?php endforeach; ?>

</table>

<?php else: ?>

<p>Заказов нет.</p>

<?php endif; ?>

<script src="/assets/js/changeStatus.js"></script>
