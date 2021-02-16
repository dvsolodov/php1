<?php

function addOrder($buyerId, $phone)
{
    $sql = "INSERT INTO `orders` (`phone`, `buyer_id`) VALUES ('{$phone}', '{$buyerId}')";
    
    if (executeQuery($sql)) {
        return true;
    }

    return false;
}
