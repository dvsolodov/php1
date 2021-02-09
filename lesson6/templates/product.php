<section>
    <h2><?= $product['name']; ?></h2>
    <img src="/images/products/big/<?= $product['img']; ?>" alt="<?= $product['name']; ?>" width="<?= BIG_PROD_IMAGE_WIDTH; ?>">
    <p><?= $product['descr']; ?></p>
    <p>
        <span><?= $product['price']; ?></span>
        <button>Купить</button>
    </p>
</section>

<section>
    <h3>Оставить отзыв о товаре</h3>
    <form action="<?= $pathToAction; ?>" method="POST">
        <p>
            <span>Ваше имя</span>
            <input type="text" name="user" value="<?= $comment['user'] ?? ''; ?>" <?= $readOnly ?? ''; ?>>
        </p>
        <p>
            <span>Ваш отзыв</span>
            <textarea name="text" cols="30" rows="10"><?= $comment['text'] ?? ''; ?></textarea>
        </p>
        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
        <input type="submit" name="sub" value="<?= $submitBtnName; ?>">
        <input type="reset">
    </form>
</section> 

<section>
    <h3>Отзывы</h3>

<?php if (empty($comments)): ?>

    <p>На данный товар нет отзывов.</p>

<?php else: ?>
    
    <?php foreach ($comments as $comment): ?>
    <p>
        <span><?= date('Y-m-d H:i:s', $comment['comment_date']); ?> |</span>
        <span><?= $comment['user']; ?>:</span>
        <span><?= $comment['text']; ?></span>

        <?php if ((time() - $comment['comment_date']) <= TERM_TO_CHANGE_COMMENT): ?>

        <a href="/product/<?= $product['id']; ?>/comment/<?= $comment['id']; ?>/edit">Редактировать</a>
        <a href="/product/<?= $product['id']; ?>/comment/<?= $comment['id']; ?>/delete">Удалить</a>
        
        <?php endif; ?>
    </p>
    <?php endforeach; ?>

<?php endif; ?>
</section>
