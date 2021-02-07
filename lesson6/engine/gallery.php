<?php
function getGallery()
{
    $sql = "SELECT * FROM `gallery` ORDER BY `views` DESC";
    $result = getAll($sql);

    if (isset($result)) {
        return $result;
    }

    header("Location: /503");
    exit();
}

function getOnePicture(int $id): array
{
    $sql = "SELECT `name`, `views` FROM `gallery` WHERE `id` = {$id}";
    $result = getOne($sql);
    
    if (isset($result)) {
        return $result;
    }

    header("Location: /404");
    exit();
}

function increaseFieldByOne(int $id)
{
    $sql = "UPDATE `gallery` SET `views` = `views` + 1 WHERE `id` = {$id}";

    executeQuery($sql);
}
