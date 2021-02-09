<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

// Папки шаблонов
define('TEMPLATES_DIR', '../templates/');
define('LAYOUTS_DIR', 'layouts/');

// Настройки для галереи
define('WHITE_LIST', ['jpeg', 'jpg', 'png']);
define('MIN_FILE_SIZE', 0);
define('MAX_FILE_SIZE', 1024 * 1024);
define('IMAGE_WIDTH', '150px');
define('GALLERY_MESSAGES',
    [
        'ok' => 'Файл загружен.',
        'error' => 'Ошибка загрузки.',
        'size' => 'Неправильный размер файла. Смотрите подсказку в форме.',
        'type' => 'Неправильный тип файла. Смотрите подсказку в форме.',
        'extention' => 'Неправильное расширение файла. Смотрите подсказку в форме.',
    ]
);

// Настройки для товара
define('BIG_PROD_IMAGE_WIDTH', '450px');
define('SMALL_PROD_IMAGE_WIDTH', '150px');
define('TERM_TO_CHANGE_COMMENT', 60000);

// Настройки соединения с базой данных
define('HOST', 'localhost:3306');
define('USER', 'site');
define('PASS', '12345');
define('DB', 'site');

include "../engine/db.php";
include "../engine/functions.php";
include "../engine/log.php";
include "../engine/gallery.php";
include "../engine/catalog.php";
include "../engine/upload.php";
include "../engine/lib/SimpleImage.php";
include "../engine/controller.php";
include "../engine/product_comments.php";
