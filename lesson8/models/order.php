<?php

function createRecord(string $userName, string $phone, string $buyerId, int $userId = null)
{
    if (isset($userId)) {
        $sql = "INSERT INTO `orders` (`user_name`, `phone`, `user_id`, `buyer_id`) 
            VALUES ('{$userName}', '{$phone}', {$userId}, '{$buyerId}')";
    } else {
        $sql = "INSERT INTO `orders` (`user_name`, `phone`, `buyer_id`) 
            VALUES ('{$userName}', '{$phone}', '{$buyerId}')";
    }

    return executeQuery($sql);    
}

function getAllOrders(string $buyerId, int $userId = null)
{
    if (isset($userId)) {
        $sql = "SELECT orders.id as id, orders.phone, order_statuses.name as status  FROM `orders`, `order_statuses` 
            WHERE order_statuses.id = orders.status 
            AND `user_id` = {$userId}";
    } else {
        $sql = "SELECT orders.id as id, orders.phone, order_statuses.name as status  FROM `orders`, `order_statuses` 
            WHERE order_statuses.id = orders.status 
            AND `buyer_id` = '{$buyerId}'";
    }

    return getAll($sql);
}

function getCartOfOrder(int $orderId)
{
    $sql = "SELECT carts.id as goodsId, carts.product_id as prodId, products.img as img, products.name as name, carts.price as price, carts.quantity as quantity, (carts.quantity * carts.price) as totalPrice  
        FROM `carts`, `products`, `orders` 
        WHERE carts.product_id = products.id AND orders.id = {$orderId} AND orders.buyer_id = carts.buyer_id";

    $result = getAll($sql);

    if ($result === null) {
        return null;
    }

   return $result; 
}
