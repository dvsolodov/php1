<?php

include ROOT . "/models/product.php";
include ROOT . "/models/cart.php";

function showCatalogAction()
{
    $result = getAllProducts();

    if ($result === null) {
        $params['catalogMsg'] = 'Корзина пуста.';
    } else {
        $params['catalog'] = $result;
    }

    $params['count'] = getProductsQuantity(clearString($_SESSION['buyer_id'])); 
    $params['pageTitle'] = 'Каталог';
    $params['userMenu'] = MENU;

    echo renderPage('catalog', $params);
}

