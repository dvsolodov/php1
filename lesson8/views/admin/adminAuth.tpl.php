<h2>Вход в панель администратора интернет-магазина</h2>

<?php if (isset($authMsg)): ?>
<p><?= $authMsg; ?></p>
<?php endif; ?>

<form action="/admin" method="POST">
    <p>
        <span>Логин</span>
        <input type="text" name="login" value="<?= $login ?? ''; ?>">
    </p>
    <p>
        <span>Пароль</span>
        <input type="password" name="password">
    </p>
    <input type="submit" name="auth" value="Войти">
</form>
