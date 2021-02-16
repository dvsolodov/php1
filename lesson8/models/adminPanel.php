<?php

function getAdminByLogin(string $login)
{
    $sql = "SELECT * FROM `users` WHERE `login` = '{$login}' AND `role_id` = 2";

    return getOne($sql);
}

function getAllOrders()
{
    $sql = "SELECT `orders`.id as id, `orders`.user_name as user_name, `orders`.phone as phone, `orders`.status as status_id, `order_statuses`.name as status
        FROM `orders`, `order_statuses`
        WHERE `orders`.status = `order_statuses`.id";

    return getAll($sql);
    
}

function getOrderById(int $id)
{
    $sql = "SELECT * FROM `orders` WHERE `id` = {$id}";

    return getOne($sql);
}

function getCartOfOrder(int $orderId)
{
    $sql = "SELECT `products`.id as prodId, `products`.name as name, `products`.img as img, `carts`.price as price, `carts`.quantity as quantity, `carts`.id as goodsId 
        FROM `carts`, `orders`, `products` 
        WHERE `orders`.id = {$orderId} 
        AND `orders`.buyer_id = `carts`.buyer_id AND `products`.id = `carts`.product_id";

    return getAll($sql);
}

function getStatusById(int $id)
{
    $sql = "SELECT * FROM `order_statuses` WHERE `id` = {$id}";

    return getOne($sql);
}

function getAllStatusesOfOrder()
{
    $sql = "SELECT * FROM `order_statuses`";

    return getAll($sql);
}

function isAdmin()
{
    if (isset($_SESSION['admin'])) {
        $login = $_SESSION['admin']['login'];
        $id = $_SESSION['admin']['id'];
        $sql = "SELECT * FROM `users` WHERE `login` = '{$login}' AND `id` = {$id} AND `role_id` = 2";

        if (getOne($sql)) {
            return true;
        }

    }
        return false;
}

function updateStatus(int $statusId, int $orderId)
{
    $sql = "UPDATE `orders` SET `status` = {$statusId} WHERE `orders`.id = {$orderId}";

    return executeQuery($sql);
}
