<?php

include ROOT . "/models/cart.php";
include ROOT . "/models/product.php";

function showCartAction()
{
    $buyerId = clearString($_SESSION['buyer_id']);
    $cart = getCart($buyerId);

    if ($cart === null || empty($cart)) {
        $params['cartMsg'] = 'Корзина пуста.';
    } else {
        $params['cart'] = $cart;
    }

    $params['count'] = getProductsQuantity($buyerId); 
    $params['pageTitle'] = 'Корзина';
    $params['userMenu'] = MENU;

    echo renderPage('cart', $params);
}


function addProductToCartAction()
{
    if ($jsonReq = file_get_contents('php://input')) {
        $data = json_decode($jsonReq, true);
        $jsonResp = ''; 
        $arrForJson = [];
        
        $product = getOneProduct(clearString($data['productId'])); 
        $id = $product['id'];
        $price = $product['price'];
        $quantity = 1;
        $buyerId = $_SESSION['buyer_id'];
        $userId = !empty($_SESSION['user']) ? $_SESSION['user']['id'] : null;

        if (addToCart($id, $price, $quantity, $buyerId, $userId)) {
            $arrForJson['status'] = 'ok';
            $arrForJson['buyMsg'] = 'Товар добавлен в корзину';
        } else {
            $arrForJson['status'] = 'false';
        }
        
        $arrForJson['count'] = getProductsQuantity($buyerId) ?? 0;
        $jsonResp = json_encode($arrForJson);

        echo $jsonResp;
        exit();
    }
}

function deleteProductFromCartAction()
{
    if ($jsonReq= file_get_contents('php://input')) {
        $data = json_decode($jsonReq, true);
        $jsonResp = ''; 
        $arrForJson = [];
        $buyerId = $_SESSION['buyer_id'];

        if ($data['productId'] == 'all') {

            if (deleteAllGoods($buyerId)) {
                $arrForJson['status'] = 'all';
            }

        } elseif (deleteGoods(clearString($data['productId']), $buyerId)) {
            $arrForJson['status'] = 'ok';
        }

        $arrForJson['count'] = getProductsQuantity($buyerId);
        $jsonResp = json_encode($arrForJson);

        echo $jsonResp;
        exit();
    }

}
