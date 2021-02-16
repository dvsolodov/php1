<h2>Корзина заказа №<?= $orderId; ?></h2>

<a href="/admin/panel">Назад</a>

<?php if (!empty($cart)): ?>

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

<?php endif; ?>

<script src="/assets/js/price.js"></script>
