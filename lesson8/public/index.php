<?php

session_start();

require_once "../library/autoloader.php";

define("ROOT", dirname($_SERVER['DOCUMENT_ROOT']));

autoload(ROOT . "/config");
autoload(ROOT . "/library");
autoload(ROOT . "/routing");

if (!isAuth() && !isset($_SESSION['buyer_id'])) {
    $_SESSION['buyer_id'] = uniqid(rand(), true);
}

$uri = $_SERVER['REQUEST_URI'];
$routeWithParams = getRouteWithParams($uri);

if ($routeWithParams) {
    router($routeWithParams);
} else {
    router(['controller' => 'index', 'action' => 'index']);
}
