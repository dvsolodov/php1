<?php

function addUser(string $login, string $password, string $regDate, string $buyerId): bool
{
    $sql = "INSERT INTO `users` (`login`, `password`, `reg_date`, `buyer_id`) VALUES ('{$login}', '{$password}', '{$regDate}', '{$buyerId}')";

    if (executeQuery($sql)) {
        return true;
    }

    return false;
}

function rememberUser(string $login)
{
    $hash = uniqid(rand(), true);
    $sql = "UPDATE `users` SET `remember_hash` = '{$hash}' WHERE `login` = '{$login}'";

    executeQuery($sql);
}

function forgetUser(int $id)
{
    $sql = "UPDATE `users` SET `remember_hash` = NULL WHERE `id` = {$id}";

    executeQuery($sql);
}

function getUserByLogin(string $login)
{
    $sql = "SELECT * FROM `users` WHERE `login` = '{$login}'";

    return getOne($sql);
}

function getUserByCookie(string $cookie)
{
    $sql = "SELECT * FROM `users` WHERE `remember_hash` = '{$cookie}'";

    return getOne($sql);
}
