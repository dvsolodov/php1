<?php

//Первым делом подключим файл с константами настроек
include "../config/config.php";

$url_array = explode('/', $_SERVER['REQUEST_URI']);

if ($url_array[1] == '') {
    $page = 'index';
} else {
    $page = $url_array[1];
}

$messages = [
    'ok' => 'Файл загружен.',
    'error' => 'Ошибка загрузки.',
    'size' => 'Неправильный размер файла. Смотрите подсказку в форме.',
    'type' => 'Неправильный тип файла. Смотрите подсказку в форме.',
    'extention' => 'Неправильное расширение файла. Смотрите подсказку в форме.',
];


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

        if (!is_array(getGallery())) {
            $params['message'] = 'Что-то пошло не так!';
        }

        break;

    case 'picture':

        $id = (int) end($url_array) ?? null;
        $params['picture'] = getOnePicture($id);
        $params['message'] = getMessage($messages);

        break;

    case 'apicatalog':
        echo json_encode(getCatalog(), JSON_UNESCAPED_UNICODE);
        die();

    case '503':
        $params['message'] = 'Что-то пошло не так!';
        break;

    default:
        $page  = '404';
}

//_log($params, "render");
echo render($page, $params);
