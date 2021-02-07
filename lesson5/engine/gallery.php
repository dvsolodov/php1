<?php
function getGallery()
{
    $sql = "SELECT * FROM `gallery` ORDER BY `views` DESC";

    if ($result = mysqli_query(getDb(), $sql)) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    header("Location: /503");
}

function getOnePicture($id)
{
    $sql = "SELECT `name`, `views` FROM `gallery` WHERE `id` = {$id}";

    increaseFieldByOne($id);
    
    if ($result = mysqli_query(getdb(), $sql)) {
       return mysqli_fetch_array($result, MYSQLI_ASSOC) ?? header("Location: /404");
    }
}

function increaseFieldByOne($id)
{
    $sql = "UPDATE `gallery` SET `views` = `views` + 1 WHERE `id` = {$id}";

    mysqli_query(getdb(), $sql);
}
