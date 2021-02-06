<h2>Каталог</h2>
<div>

<?php if (empty($products)): ?>

    <p>Каталог пуст.</p>

<?php else: ?>

    <?php foreach ($products as $product): ?>

    <section>
    <h3><?= $product['name']; ?></h3>
        <a href="/product/<?= $product['id']; ?>">
            <img src="/images/products/small/<?= $product['img']; ?>" alt="<?= $product['name']; ?>">
        </a>
        <p>
            <span><?= $product['price']; ?></span>
            <button>Купить</button>
        </p>
    </section>

    <?php endforeach; ?>

<?php endif; ?>

</div>
