<?php

function addGoodsToCart(int $prodId, $buyerId)
{
    $sql = "INSERT INTO `carts` (`product_id`, `buyer_id`, `quantity`) VALUES ({$prodId}, '{$buyerId}', 1)";

    if (executeQuery($sql)) {
        return true;
    }

    return false;
}

function getCart($buyerId)
{
    $sql = "SELECT products.id as `id`, products.name as `name`, products.img as `img`, products.price as `price`, carts.id as `goodsId`, carts.quantity as `quantity`
        FROM `carts`, `products`
        WHERE carts.buyer_id = '{$buyerId}' 
        AND products.id = carts.product_id";

    if ($result = getAll($sql)) {
        return $result;
    }

    return false;

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

function getGoodsQuantity($buyerId)
{
    $sql = "SELECT COUNT(*) as `count` FROM `carts` WHERE `buyer_id` = '{$buyerId}'";

    if ($result = getAll($sql)) {
        return $result;
    }

    return false;
}
