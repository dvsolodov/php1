<a href="/">Главная</a>
<a href="/catalog">Каталог</a>
<a href="/gallery">Галерея</a>
<a href="/cart">
    Корзина (<span id="count"><?= $count ?? 0; ?></span>)
</a>

<?php if (checkAuth()): ?>

<a href="/logout">Выход</a>

<?php else: ?>

<a href="/auth">Вход</a>
<a href="/reg">Регистрация</a>

<?php endif; ?>
<br>
