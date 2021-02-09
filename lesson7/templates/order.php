<h2>Оформление заказа</h2>

<?php if (isset($orderMessage)): ?>

<p><?= $orderMessage; ?>

<?php else: ?>

<form action="/order/add" method="POST">
    <p>
        <span>Ваш номер телефона</span>
        <input type="text" name="phone" value="<?= $phone ?? ''; ?>">
    </p>
    <input type="submit" name="order" value="Оформить">
</form>

<?php endif; ?>
