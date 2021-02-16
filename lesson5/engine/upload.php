<?php

function getMessage(array $messages): ?string
{
    return isset($_GET['message']) ? $messages[$_GET['message']] : null;

}

function upload()
{
    // Обработать пришедший на сервер файл
    if (!empty($_FILES)) {
        $fileName = $_FILES['picture']['name'];
        $pathToTmpFile = $_FILES['picture']['tmp_name'];
        $extension = pathinfo($fileName)['extension'];
        $pictureName = date('Y-m-d H:i:s', time()) . "." . $extension;
        $pathToFile = $_SERVER['DOCUMENT_ROOT'] . "/images/gallery/big/" . $pictureName;

        // Проверить загружаемый файл на соответствие настройкам
        if (!checkFileSize($pathToTmpFile, MIN_FILE_SIZE, MAX_FILE_SIZE)) {
            header("Location: /gallery/?message=size");
            exit();
        } elseif (!checkFileExtention($fileName, WHITE_LIST)) {
            header("Location: /gallery/?message=extention");
            exit();
        } elseif (!checkMimeType($pathToTmpFile, WHITE_LIST)) {
            header("Location: /gallery/?message=type");
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
                header("Location: /gallery/?message=error");
                exit();
            }

            // Сделать запись в базу данных
            $sql = "INSERT INTO `gallery` (name) VALUES ('{$pictureName}')";

            if (!mysqli_query(getDb(), $sql)) {
                unlink($pathToFile);                                    
                unlink($_SERVER['DOCUMENT_ROOT'] . "/images/gallery/small/" . $pictureName);

                header("Location: /gallery/?message=error");
            }

            header("Location: /gallery/?message=ok");
            exit();
        } else {
            header("Location: /gallery/?message=error");
            exit();
        }
    }
}
