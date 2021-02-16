<?php

function getCart(string $buyerId)
{
    $sql = "SELECT carts.id as goodsId, carts.product_id as prodId, products.img as img, products.name as name, carts.price as price, carts.quantity as quantity, (carts.quantity * carts.price) as totalPrice  
        FROM `carts`, `products` 
        WHERE carts.product_id = products.id AND carts.buyer_id = '{$buyerId}'";

    $result = getAll($sql);

    if ($result === null) {
        return null;
    }

   return $result; 
}

function addToCart(int $id, float $price, int $quantity, string $buyerId, int $userId = null)
{
    if ($userId !== null) {
        $sql = "INSERT INTO `carts` (`product_id`, `price`, `quantity`, `buyer_id`, `user_id`) 
            VALUES ({$id}, {$price}, {$quantity}, '{$buyerId}', {$userId})";
    } else {
        $sql = "INSERT INTO `carts` (`product_id`, `price`, `quantity`, `buyer_id`) 
            VALUES ({$id}, {$price}, {$quantity}, '{$buyerId}')";
    }

    return executeQuery($sql);
}

function getProductsQuantity(string $buyerId)
{
    $sql = "SELECT COUNT(*) as count FROM `carts` WHERE `buyer_id` = '{$buyerId}'";
    
    return getOne($sql)['count'];
}

function deleteGoods($goodsId, $buyerId)
{
    $sql = "DELETE FROM `carts` WHERE `id` = {$goodsId} AND `buyer_id` = '{$buyerId}'";

    if (executeQuery($sql)) {
        return true;
    }

    return false;
}

function deleteAllGoods($buyerId)
{
    $sql = "DELETE FROM `carts` WHERE `buyer_id` = '{$buyerId}'";

    if (executeQuery($sql)) {
        return true;
    }

    return false;
}
