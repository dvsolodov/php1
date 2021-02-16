<h2>Корзина</h2>

<?php if (isset($cartMsg)): ?>

<p><?= $cartMsg; ?></p>

<?php elseif (!empty($cart)): ?>

<div>
    <table>
        <tr>
            <th>Список товаров</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Итого</th>
        </tr>
        <?php foreach ($cart as $product): ?>
        <tr data-prod-id="<?= $product['goodsId']; ?>">
            <td>
                <img src="/assets/images/products/small/<?= $product['img']; ?>" alt="<?= $product['name']; ?>" width="100">
                <a href="/products/<?= $product['prodId']; ?>/show">
                    <?= $product['name']; ?>
                </a>
            </td>
            <td data-price="<?= $product['goodsId']; ?>">
                <?= $product['price']; ?>
            </td>
            <td data-quantity="<?= $product['goodsId']; ?>">
                <?= $product['quantity']; ?> 
            </td>
            <td data-total-for-prod="<?= $product['goodsId']; ?>">
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3">
                Итого к оплате:  
            </td>
            <td data-total-for-cart="true">
            </td>
        </tr>
    </table>
</div>
<?php endif; ?>

<script src="/assets/js/price.js"></script>
