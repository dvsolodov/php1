<h2>Каталог</h2>

<?php if (isset($catalogMsg)): ?>

<p><?= $catalogMsg; ?></p>

<?php else: ?>

<?php foreach ($catalog as $product): ?>

<section>
    <h3><?= $product['name']; ?></h3>
    <a href="/products/<?= $product['id']; ?>/show">
        <img src="/assets/images/products/small/<?= $product['img']; ?>">
    </a>
    <p><?= $product['price']; ?></p>
    <button id="buy" data-prod-id="<?= $product['id']; ?>">В корзину</button>
</section>

<?php endforeach; ?>

<?php endif; ?>

<script src="/assets/js/addProductToCart.js"></script>
