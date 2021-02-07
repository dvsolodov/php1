<?php

/**
 * Функция отрисовки шаблона
 */
function renderTemplate($page, $data = []) {
    ob_start();
    extract($data);
    include "templates/{$page}.tpl.php";
    return ob_get_clean();
}
