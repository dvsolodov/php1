<?php

include "functions.php";

echo renderTemplate(
    'layout', 
    [
        'menu' => renderTemplate('menu', ['active' => 'Главная']), 
        'title' => 'Главная', 
        'content' => renderTemplate('index'),
    ]
);
