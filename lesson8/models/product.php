<?php

function getAllProducts()
{
    $sql = "SELECT * FROM `products`";

    if ($result = getAll($sql)) {
        return $result;
    }

    return null;
}

function getONeProduct(int $id)
{
    $sql = "SELECT * FROM `products` WHERE `id` = {$id}";

    return getOne($sql);
}
