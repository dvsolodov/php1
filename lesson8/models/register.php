<?php

function searchForLoginInDb(string $login): bool
{
    $sql = "SELECT `id` FROM `users` WHERE `login` = '{$login}'";

    if (getOne($sql) === null) {
        return false;
    }

    return true;
}

