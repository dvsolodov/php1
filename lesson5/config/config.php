<?php
// Папки шаблонов
define('TEMPLATES_DIR', '../templates/');
define('LAYOUTS_DIR', 'layouts/');
// Настройки для галереи
define('WHITE_LIST', ['jpeg', 'jpg', 'png']);
define('MIN_FILE_SIZE', 0);
define('MAX_FILE_SIZE', 1024 * 1024);
define('IMAGE_WIDTH', '150px');
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
