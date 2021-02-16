<?php

include ROOT . "/models/product.php";
include ROOT . "/models/cart.php";

function showProductAction(array $params)
{
    $params['count'] = getProductsQuantity(clearString($_SESSION['buyer_id'])); 
    $params['product'] = getOneProduct($params['id']);
    $params['pageTitle'] = $params['product']['name'];
    $params['userMenu'] = MENU;

    echo renderPage('product', $params);
}
