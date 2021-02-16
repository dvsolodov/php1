<?php

function autoload($pathToFolder)
{
    if (is_dir($pathToFolder)) {
        if ($files = scandir($pathToFolder)) {
            $files = array_slice($files, 2, count($files));

            foreach ($files as $file) {

                if ($file != 'autoloader.php' && substr($file, -3, 3) == 'php') {
                    require $pathToFolder . "/" . $file;
                }
            }
        } else {
            exit("Ошибка сканирования директории " . $pathToFolder);
        }
    } else {
        exit("Путь " . $pathToFolder . " не является директорией!!");
    }
}
