<?php

function getProductComments(int $id): ?array
{
    $id = clearString($id);
    $sql = "SELECT * FROM `product_comments` WHERE `product_id` = {$id} ORDER BY `id` DESC";
    $result = getAll($sql);

    if ($result) {
        return $result;
    }

    return null;
}

function doCommentAction(string $action, array $data = [])
{
    extract($data);

    if (!empty($_POST)) {
        $user = clearString($_POST['user']) ?? null;
        $text = clearString($_POST['text']) ?? null;
        $product_id = clearString($_POST['product_id']) ?? null;
        $comment_date = time();
    }

    switch ($action) {
        case 'add':
            addComment($user, $text, $product_id, $comment_date);
            break;

        case 'edit':
            $comment_id = clearString($comment_id);

            return editComment($comment_id);

        case 'delete':
            $comment_id = clearString($comment_id);
            deleteComment($prod_id, $comment_id);
            break;

        case 'save':
            $comment_id = clearString($comment_id);
            saveComment($text, $product_id, $comment_id);
            break;
    }
}

function addComment(string $user, string $text, int $product_id, int $comment_date)
{

    $sql = "INSERT INTO `product_comments` (`user`, `text`, `product_id`, `comment_date`) VALUES ('{$user}', '{$text}', {$product_id}, {$comment_date})";

    executeQuery($sql);

    header("Location: /product/{$product_id}");
    exit();
}

function editComment(int $comment_id)
{
    $sql = "SELECT * FROM `product_comments` WHERE `id` = {$comment_id}";

    return getOne($sql);
}

function saveComment(string $text, int $product_id, int $comment_id)
{
    $sql = "UPDATE `product_comments` SET `text` = '{$text}' WHERE `id` = {$comment_id}";

    executeQuery($sql);

    header("Location: /product/{$product_id}");
    exit();
}

function deleteComment(int $product_id, int $comment_id)
{
    $sql = "DELETE FROM `product_comments` WHERE `id` = {$comment_id}";

    executeQuery($sql);

    header("Location: /product/{$product_id}");
    exit();
}
