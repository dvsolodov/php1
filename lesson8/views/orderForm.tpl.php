<h2>Оформление заказа</h2>

<?php if (isset($orderErrorMsg)): ?>

<p><?= $orderErrorMsg; ?>

<?php endif; ?>

<form action="/order/add" method="POST">
    <p>
        <span>Ваш номер телефона</span>
        <input type="text" name="phone" value="<?= $phone ?? ''; ?>">
    </p>
    <p>
        <span>Ваше имя</span>
        <input type="text" name="name" value="<?= $name ?? ''; ?>">
    </p>
    <input type="submit" name="order" value="Оформить">
</form>
