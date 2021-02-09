<?php

function checkLogin(string $login): bool
{
    return preg_match('#[A-Za-z0-9]{3,10}#', $login) === 1; 
}

function checkPassword(string $password): bool
{
    return preg_match('#[A-Za-z0-9]{6,20}#', $password) === 1;
}

function searchForLoginInDb(string $login): bool
{
    $sql = "SELECT `id` FROM `users` WHERE `login` = '{$login}'";

    if (getOne($sql) === null) {
        return false;
    }

    return true;
}

function addUser(string $login, string $password): bool
{
    $regDate = time();
    $password = password_hash($password, PASSWORD_DEFAULT);
    $buyerId = uniqid(rand(), true);
    $sql = "INSERT INTO `users` (`login`, `password`, `buyer_id`, `reg_date`) VALUES ('{$login}', '{$password}', '{$buyerId}', {$regDate})";

    if (executeQuery($sql)) {
        return true;
    }

    return false;
}

function rememberUser(string $login)
{
    $hash = uniqid(rand(), true);
    $sql = "UPDATE `users` SET `hash` = '{$hash}' WHERE `login` = '{$login}'";

    executeQuery($sql);

    setcookie('auth', $hash, time() + 60 * 60 * 24 * 30);    
}
