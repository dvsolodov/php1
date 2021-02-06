<?php
function getProducts() {
    $sql = 'SELECT * FROM `products`';
    $result = getAll($sql);
    
    if ($result === null) {
        header('Location: /503');
        exit();
    }

    return $result;
}

function getOneProduct($id)
{
    $sql = "SELECT * FROM `products` WHERE `id` = {$id}";
    $result = getOne($sql);

    if ($result === null) {
        header('Location: /404');
        exit();
    }

    return $result;
}
