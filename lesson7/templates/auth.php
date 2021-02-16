<h2>Вход в учетную запись</h2>

<?php if (isset($authMessage)): ?>
<p><?= $authMessage; ?></p>
<?php endif; ?>

<form action="/auth" method="POST">
    <p>
        <span>Логин</span>
        <input type="text" name="login" value="<?= $login ?? ''; ?>">
    </p>
    <p>
        <span>Пароль</span>
        <input type="password" name="pass">
    </p>
    <p>
        <span>Запомнить</span>
        <input type="checkbox" name="remember" value="true">
    </p>
    <input type="submit" value="Войти">
</form>
