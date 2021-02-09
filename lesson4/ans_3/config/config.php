<?php
define('TEMPLATES_DIR', '../templates/');
define('LAYOUTS_DIR', 'layouts/');
define('WHITE_LIST', ['jpeg', 'jpg', 'png']);
define('MIN_FILE_SIZE', 0);
define('MAX_FILE_SIZE', 1024 * 1024);
define('IMAGE_WIDTH', '150px');

include "../engine/functions.php";
include "../engine/log.php";
include "../engine/gallery.php";
include "../engine/catalog.php";
include "../engine/upload.php";
include "../engine/lib/SimpleImage.php";
