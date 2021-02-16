<?php

function getRouteWithParams($uri)
{
    $uri = substr($uri, 1);
    $data = [];

    foreach (ROUTES as $pattern => $route) {
        if (preg_match("#^" . $pattern . "$#", $uri, $matches) === 1) {
            $data += $route;
            unset($matches[0]);
            
            if (!empty($matches)) {
                $data['params'] = $matches;
            }

            return $data;
        }
    }

    return null;
}

function router($routeWithParams)
{
    $pathToController = ROOT . "/controllers/" . $routeWithParams['controller'] . "Controller.php";

    if (file_exists($pathToController)) {
        $actionName = $routeWithParams['action'] . "Action";
    } else {
        exit("Такого контроллера " . $pathToController . " не существует!!");
    }
    
    include $pathToController;

    if (!function_exists($actionName)) {
        exit("Функция " . $actionName . " в контроллере " . $pathToController . " не существует!!");
    }

    if (!empty($routeWithParams['params'])) {
        $actionName($routeWithParams['params']); 
    } else {
        $actionName();
    }
}
