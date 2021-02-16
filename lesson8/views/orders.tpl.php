<h2>Мои заказы</h2>

<?php if (isset($orderMsg)): ?>
<p><?= $orderMsg; ?></p>
<?php endif; ?>

<?php if (!empty($orders)): ?>

<table>
    <tr>
        <th>Номер заказа</th>
        <th>Номер телефона</th>
        <th>Статус</th>
    </tr>

<?php foreach ($orders as $order): ?>

    <tr>
        <td><a href="/order/<?= $order['id']; ?>/show"><?= $order['id']; ?></a></td>
        <td><?= $order['phone']; ?></td>
        <td><?= $order['status']; ?></td>
    </tr>

<?php endforeach; ?>

</table>

<?php else: ?>

<p>У Вас нет заказов.</p>

<?php endif; ?>
