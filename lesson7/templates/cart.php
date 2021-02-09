<h2>Корзина</h2>
<?php if (empty($cart)): ?>
<p>Корзина пуста</p>
<?php else: ?>
<div>
    <table>
        <tr>
            <th>Список товаров</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Итого</th>
            <th>Действие</th>
        </tr>
        <?php foreach ($cart as $product): ?>
        <tr data-prod-id="<?= $product['goodsId']; ?>">
            <td>
                <img src="/images/products/small/<?= $product['img']; ?>" alt="<?= $product['name']; ?>">
                <a href="/product/<?= $product['id']; ?>">
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
            <td>
                <button data-prod-id="<?= $product['goodsId']; ?>" data-action-delete="true">Удалить</button>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3">
                Итого к оплате:  
            </td>
            <td data-total-for-cart="true">
            </td>
            <td>
                <button data-prod-id="all" data-action-delete="true">Очистить корзину</button>
            </td>
        </tr>
    </table>

    <a href="/order">Оформить заказ</a>
</div>
<?php endif; ?>

<script src="/js/price.js"></script>
<script src="/js/delete.js"></script>
