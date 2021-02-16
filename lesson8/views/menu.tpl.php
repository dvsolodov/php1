<?php if (isset($userMenu)): ?>

<nav>
    <ul>

<?php foreach ($userMenu as $link => $name): ?>
 
        <?php if (($link == 'register' || $link == 'login') && isAuth()): ?>
            <?php continue; ?>
        <?php elseif (($link == 'logout' || $link == 'my-orders') && !isAuth()): ?>
            <?php continue; ?>
        <?php else: ?>

        <li>
            <a href="/<?= $link; ?>">

            <?php if ($link == 'cart'): ?>
                Корзина (<span id="count"><?= $count ?? 0; ?></span>)
            <?php else: ?>
                <?= $name; ?>
            <?php endif; ?>

            </a>
        </li>

        <?php endif; ?>

<?php endforeach; ?>

    </ul>
</nav>

<?php endif; ?>
