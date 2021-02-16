<?php

include ROOT . "/models/adminPanel.php";

function showAllOrdersAction()
{
    if (!isAdmin()) {
        header('Location: /');
        exit();
    }

    $params['pageTitle'] = 'Панель администратора';
    $params['orders'] = getAllOrders();
    $params['statuses'] = getAllStatusesOfOrder();

    echo renderPage('admin/adminPanel', $params); 
}

function updateOrderStatusAction()
{
    if (!isAdmin()) {
        header('Location: /');
        exit();
    }
    
    if ($jsonReq= file_get_contents('php://input')) {
        $data = json_decode($jsonReq, true);
        $jsonResp = ''; 
        $arrForJson = [];

        if (updateStatus($data['statusId'], $data['orderId'])) {
            $arrForJson['status'] = 'ok';
        } else {
            $arrForJson['status'] = 'bed';
        }

        $jsonResp = json_encode($arrForJson);

        echo $jsonResp;
    }
}

function showCartOfOrderAction(array $params)
{
    if (!isAdmin()) {
        header('Location: /');
        exit();
    }

    $data['cart'] = getCartOfOrder($params['orderId']);
    $data['orderId'] = $params['orderId'];
    $data['pageTitle'] = 'Корзина ордера';

    echo renderPage('admin/adminCartOfOrder', $data);
}
