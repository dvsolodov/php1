<?php

//Первым делом подключим файл с константами настроек
include "../config/config.php";

$url_array = explode('/', $_SERVER['REQUEST_URI']);
$params = prepareVariables($url_array);
$page = $params['page'];
unset($params['page']);

//_log($params, "render");
echo render($page, $params);
