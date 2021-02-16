<h2>Регистрация учетной записи</h2>

<?php if (isset($regMessage)): ?>
<p><?= $regMessage; ?></p>
<?php endif; ?>

<form action="/reg" method="POST">
    <p>
        <span>Логин</span>
        <input type="text" name="login" value="<?= $login ?? ''; ?>">
        <span>Буквы латинского алфавита и цифры &ndash; 3-10 символов.</span>
    </p>
    <p>
        <span>Пароль</span>
        <input type="password" name="pass">
        <span>Буквы латинского алфавита и цифры &ndash; 6-20 символов.</span>
    </p>
    <p>
        <span>Запомнить</span>
        <input type="checkbox" name="remember" value="true">
    </p>
    <input type="submit" name="reg" value="Зарегистрироваться">
</form>
