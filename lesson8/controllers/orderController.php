<?php

include ROOT . "/models/cart.php";
include ROOT . "/models/product.php";
include ROOT . "/models/order.php";

function addOrderAction()
{
    $buyerId = $_SESSION['buyer_id'];

    if (isAuth()) {
        $userId = $_SESSION['user']['id'];
    } else {
        $userId = null;
    }

    $params['count'] = getProductsQuantity($buyerId); 
    $params['userMenu'] = MENU;
    $error = false; 

    if (isset($_POST['order'])) {
        if (empty($_POST['phone']) || empty($_POST['name'])) {
            showFormAction('Заполните все поля формы');
            exit();
        } else {
            $phone = clearString($_POST['phone']);
            $userName = clearString($_POST['name']);

            if ($userId !== null) {
                $error = createRecord($userName, $phone, $buyerId, $userId);
            } else {
                $error = createRecord($userName, $phone, $buyerId);
            }

            if ($error === false) {
                showFormAction('Что-то пошло не так!!');
                exit();
            }
        }

        $msg = 'Заказ создан.';
    }

    $oldBuyerId = $_SESSION['buyer_id'];
    $_SESSION['buyer_id'] = uniqid(rand(), true);

    showAllOrdersAction($oldBuyerId, $msg);
}

function showFormAction(string $msg = null)
{
    if (isset($msg)) {
        $params['orderErrorMsg'] = $msg;
    }

    $buyerId = $_SESSION['buyer_id'];
    $params['count'] = getProductsQuantity($buyerId); 
    $params['pageTitle'] = 'Оформление заказа';
    $params['userMenu'] = MENU;
    
    echo renderPage('orderForm', $params);
}

function showAllOrdersAction(string $oldBuyerId = null, string $message = null)
{
    if (!isset($oldBuyerId) && !isAuth()) {
        header('Location: /');
        exit();
    }

    $userId = $_SESSION['user']['id'] ?? null;
    $buyerId = $_SESSION['buyer_id'] ?? null;
    $params['orderMsg'] = isset($message) ? $message : null;
    $params['count'] = getProductsQuantity($buyerId); 
    $params['pageTitle'] = 'Мои заказы';
    $params['userMenu'] = MENU;

    if (isAuth()) {
        $params['orders'] = getAllOrders($buyerId, $userId);
    } else {
        $params['orders'] = getAllOrders($oldBuyerId);
    }

    echo renderPage('orders', $params);
}

function showCartOfOrderAction(array $params)
{
    $cart = getCartOfOrder($params['orderId']);

    if ($cart === null || empty($cart)) {
        $data['cartMsg'] = 'Корзина пуста.';
    } else {
        $data['cart'] = $cart;
    }

    $data['count'] = getProductsQuantity($_SESSION['buyer_id']); 
    $data['pageTitle'] = 'Корзина заказа';
    $data['userMenu'] = MENU;

    echo renderPage('cartOfOrder', $data);
}
