<?php

/*
 * A la шаблонизатор
 */

$search = [
    '{{ title }}',
    '{{ heading }}',
    '{{ year }}'
];
$replace = [
    'Главная страница - страница обо мне',
    'Информация обо мне',
    date('Y')
];
$template = file_get_contents('index.tpl.php');

echo str_replace($search, $replace, $template);
