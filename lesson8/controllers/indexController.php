<?php

include ROOT . "/models/cart.php";

function indexAction()
{
    $params['pageTitle'] = 'Главная';
    $params['userMenu'] = MENU; 
    $params['count'] = getProductsQuantity(clearString($_SESSION['buyer_id'])); 

    if (isset($_SESSION['user']['login'])) {
        $params['login'] = $_SESSION['user']['login'];
    }
    echo renderPage('index', $params);
}
