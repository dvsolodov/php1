<nav>
<?php foreach (['index.php' => 'Главная' , 'about.php' => 'О нас'] as $url => $linkName): ?>
    <?php if ($active == $linkName): ?>
    <span class="active"><?= $linkName ?></span>
    <?php else: ?>
    <a href="<?= $url ?>"><?= $linkName ?></a>
    <?php endif; ?>
<?php endforeach; ?>
</nav>
