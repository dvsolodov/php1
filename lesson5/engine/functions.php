<?php

//Функция, возвращает текст шаблона $page с подстановкой переменных
//из массива $params, содержимое шабона $page подставляется в
//переменную $content главного шаблона layout для всех страниц
function render($page, $params = []) {
    return renderTemplate(LAYOUTS_DIR . 'main', [
        'menu' => renderTemplate('menu', $params),
        'content' => renderTemplate($page, $params)
    ]);
}

//$params = [
//    'menu' => renderTemplate('menu'),
//    'content' => renderTemplate('catalog')
//];
//Функция возвращает текст шаблона $page с подставленными переменными из
//массива $params, просто текст
function renderTemplate($page, $params = []) {

    extract($params);
//    foreach ($params as $key => $value) {
//        $$key = $value;
//    }
    ob_start();
    $fileName = TEMPLATES_DIR . $page . ".php";
    if (file_exists($fileName)) {
        include $fileName;
    }
    return ob_get_clean();
}

/**
 * Функция определяет, находится ли размер файла
 * в указанных границах
 *
 * @param string $pathToFile путь к файлу
 * @param int $minSize начальное значение границы размера
 * @param int $maxSize конечное значение границы размера
 *
 * @return bool true - соответствует; false - не соответствует
 */
function checkFileSize($pathToFile, $minSize, $maxSize): bool
{
    $fileSize = filesize($pathToFile);

    if ($fileSize >= $minSize && $fileSize <= $maxSize) {
        return true; 
    }

    return false;
}

/**
 * Функция определяет MIME-тип изображения
 *
 * @param string $pathToImage путь к файлу изображения
 * @param array $whiteList белый список типов
 *
 * @return string|bool вернет MIME-тип или false
 */
function checkMimeType(string $pathToImage, array $whiteList)
{
    $mimeType = image_type_to_mime_type(exif_imagetype($pathToImage));

    foreach ($whiteList as $item) {
        if(preg_match("#\/$item#i", $mimeType)) {
           return true;
        }
    }
    return false;
}

/**
 * Функция проверяет расширение файла изображения
 * на наличие его в белом списке
 *
 * @param string $fileName имя файла ($_FILE['file']['name'])
 * @param array $whiteList индексный массив с разрешенными расширениями файлов
 *
 * @return bool true- проверка пройдена; false - проверка не пройдена
 *
 */
function checkFileExtention(string $fileName, array $whiteList): bool
{
    foreach ($whiteList as $item) {
        if(preg_match("/$item\$/i", $fileName)) {
           return true;
        }
    }

    return false;
}
