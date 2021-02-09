<?php

function checkAuth(): bool
{
    if (isset($_SESSION['auth'])) {
        return true;
    }

    if (isset($_COOKIE['auth'])) {

        if ($user = searchForUserHashInDb($_COOKIE['auth'])) {

            if (!isset($_SESSION['auth'])) {
                $_SESSION['auth']['login'] = $user['login'];
                $_SESSION['auth']['user_id'] = $user['id'];
            }

            return true;
        }
    }

    return false;
}

function logout(): bool
{
    if (checkAuth) {
        unset($_SESSION['auth']);
        setcookie('auth', '', time() - 2);
        return true;
    }

    return false;
}

function searchForLoginAndPassInDb(string $login, string $password)
{
    $sql = "SELECT `id`, `password` FROM `users` WHERE `login` = '{$login}'";
    $user = getOne($sql);

    if ($user === null) {
        return false;
    }

    if (password_verify($password, $user['password'])) {
        return $user['id'];
    }

    return false;
}

function searchForUserHashInDb(string $hash)
{
    $sql = "SELECT * FROM `users` WHERE `hash` = '{$hash}'";

    if (getOne($sql) === null) {
        return false;
    }

    return getOne($sql);
}
