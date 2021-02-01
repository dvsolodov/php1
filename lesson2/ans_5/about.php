<?php

include "functions.php";

echo renderTemplate(
    'layout', 
    [
        'menu' => renderTemplate('menu', ['active' => 'О нас']), 
        'title' => 'О нас', 
        'content' => renderTemplate('about'),
    ]
);
