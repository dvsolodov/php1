<?php

function renderPage($page, $params = []) 
{
    return renderTemplate(LAYOUTS_DIR . 'main', [
        'pageTitle' => $params['pageTitle'],
        'menu' => renderTemplate('menu', $params),
        'content' => renderTemplate($page, $params),
        'footer' => renderTemplate('footer', $params),
    ]);
}

function renderTemplate($page, $params = []) 
{
    $fileName = VIEWS_DIR . $page . ".tpl.php";

    if (!file_exists($fileName)) {
        exit("Шаблон {$fileName} не найден!!");
    } else {
        ob_start();
        extract($params);
        include $fileName;

        return ob_get_clean();
    }
}

function isAuth()
{
    if (isset($_SESSION['user'])) {
        return true;
    }

    return false;
}
