<?php

session_start();

//Первым делом подключим файл с константами настроек
include "../config/config.php";

$url_array = explode('/', $_SERVER['REQUEST_URI']);

if ($url_array[1] == '') {
    $page = 'index';
} else {
    $page = $url_array[1];
}

$userId = $buyerId = null;

if (checkAuth()) {
    $userId = clearString($_SESSION['auth']['user_id']);
} 

if (isset($_COOKIE['buyer'])) {
    $buyerId = clearString($_COOKIE['buyer']);
} else {
    setcookie('buyer', uniqId(rand(), true), time()+60*60*24*365*10, "/");
}

$params = prepareVariables($page, $url_array, $userId, $buyerId);

//_log($params, "render");
echo render($page, $params);
