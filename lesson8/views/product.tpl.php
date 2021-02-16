<h2><?= $product['name']; ?></h2>
<img src="/assets/images/products/big/<?= $product['img']; ?>" width="400">
<p><?= $product['descr']; ?></p>
<p><?= $product['price']; ?></p>
<button id="buy" data-prod-id="<?= $product['id']; ?>">В корзину</button>

<script src="/assets/js/addProductToCart.js"></script>
