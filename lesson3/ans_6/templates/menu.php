<?php if (isset($links)): ?>
<ul>
<?php foreach ($links as $key => $item): ?>
    <?php if ($item == 'cart'): ?>
        <?php if ($item == $active): ?>
            <li><a class="active" href="?page=<?= $item; ?>"><?= $key ?> (<?= $count; ?>)</a></li>
        <?php else: ?>
            <li><a href="?page=<?= $item; ?>"><?= $key ?> (<?= $count; ?>)</a></li>
        <?php endif; ?>
    <?php elseif ($item == $active): ?>
        <li><a class="active" href="?page=<?= $item; ?>"><?= $key ?></a></li>
    <?php else: ?>
        <li><a href="?page=<?= $item; ?>"><?= $key ?></a></li>
    <?php endif; ?>
<?php endforeach; ?>
</ul>
<?php endif; ?>
