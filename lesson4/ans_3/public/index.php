<?php

//Первым делом подключим файл с константами настроек
include "../config/config.php";

//Читаем параметр page из url, чтобы определить, какую страницу-шаблон
//хочет увидеть пользователь, по умолчанию это будет index
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'index';
}


//Для каждой страницы готовим массив со своим набором переменных
//для подстановки их в соотвествующий шаблон
$params = [
    'count' => 2
];

switch ($page) {
    case 'index':
        $params['name'] = 'Alex';
        break;

    case 'catalog':
        $params['catalog'] = getCatalog();
        break;

    case 'gallery':

        if (!empty($_FILES)) {
            upload();
        }
        $params['photos'] = getGallery();
        $params['message'] = getMessage($messages);
        break;

    case 'apicatalog':
        echo json_encode(getCatalog(), JSON_UNESCAPED_UNICODE);
        die();
}

//_log($params, "render");
echo render($page, $params);
