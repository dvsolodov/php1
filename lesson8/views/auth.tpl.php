<h2>Вход в учетную запись</h2>

<?php if (isset($authMsg)): ?>
<p><?= $authMsg; ?></p>
<?php endif; ?>

<form action="/login" method="POST">
    <p>
        <span>Логин</span>
        <input type="text" name="login" value="<?= $login ?? ''; ?>">
    </p>
    <p>
        <span>Пароль</span>
        <input type="password" name="password">
    </p>
    <p>
        <span>Запомнить</span>
        <input type="checkbox" name="remember" value="true">
    </p>
    <input type="submit" name="auth" value="Войти">
</form>
