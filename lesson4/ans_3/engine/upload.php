<?php

$messages = [
    'ok' => 'Файл загружен.',
    'error' => 'Ошибка загрузки.',
    'size' => 'Неправильный размер файла. Смотрите подсказку в форме.',
    'type' => 'Неправильный тип файла. Смотрите подсказку в форме.',
    'extention' => 'Неправильное расширение файла. Смотрите подсказку в форме.',
];

function getMessage(array $messages): ?string
{
    return isset($_GET['message']) ? $messages[$_GET['message']] : null;

}

function upload()
{
    // Обработать пришедший на сервер файл
    if (!empty($_FILES)) {
        /** @var string $fileName Пользовательское имя файла. */
        $fileName = $_FILES['picture']['name'];
        /** @var string $pathToTmpFile Путь к файлу во временной папке */
        $pathToTmpFile = $_FILES['picture']['tmp_name'];
        /** @var string $extension Расширение загружаемого файла */
        $extension = pathinfo($fileName)['extension'];
        /** @var string $pictureName Имя файла на сайте */
        $pictureName = date('Y-m-d H:i:s', time()) . "." . $extension;
        /** @var string $pathToFile Путь к папке, куда будет помещен загружаемый файл с новым именем */
        $pathToFile = $_SERVER['DOCUMENT_ROOT'] . "/images/gallery/big/" . $pictureName;

        // Проверить загружаемый файл на соответствие настройкам
        if (!checkFileSize($pathToTmpFile, MIN_FILE_SIZE, MAX_FILE_SIZE)) {
            header("Location: index.php?page=gallery&message=size");
            exit();
        } elseif (!checkFileExtention($fileName, WHITE_LIST)) {
            header("Location: index.php?page=gallery&message=extention");
            exit();
        } elseif (!checkMimeType($pathToTmpFile, WHITE_LIST)) {
            header("Location: index.php?page=gallery&message=type");
            exit();
        }

        // Загрузить файл в папку на сайте
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $pathToFile)) {
            // Создать миниатюру и сохранить ее в другую папку
            $image = new SimpleImage();
            $image->load($pathToFile);
            $image->resizeToWidth(150);
            $image->save($_SERVER['DOCUMENT_ROOT'] . "/images/gallery/small/" . $pictureName);
            // Удалить исходную картинку, если не удалось сохранить миниатюру
            if (empty(glob($_SERVER['DOCUMENT_ROOT'] . "/images/gallery/small/" . $pictureName))) {
                unlink($pathToFile);                                    
                header("Location: index.php?page=gallery&message=error");
                exit();
            }

            header("Location: index.php?page=gallery&message=ok");
            exit();
        } else {
            header("Location: index.php?page=gallery&message=error");
            exit();
        }
    }
}
