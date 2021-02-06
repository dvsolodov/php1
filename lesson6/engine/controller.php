<?php

function prepareVariables($url_array)
{
    $params = [
        'count' => 2,
    ];

    if ($url_array[1] == '') {
        $params['page'] = 'index';
    } else {
        $params['page'] = $url_array[1];
    }

    switch ($params['page']) {
        case 'index':
            $params['name'] = 'Alex';
            break;

        case 'catalog':
            $params['products'] = getProducts();
            break;

        case 'product':
            $id = (int) $url_array[2] ?? null;
            $params['submitBtnName'] = 'Отправить';
            $params['pathToAction'] = "/product/{$id}/comment/add";
            
            if (isset($url_array[3]) && $url_array[3] == 'comment') {
                if ($url_array[4] == 'add') {
                    doCommentAction('add');
                } elseif ($url_array[5] == 'edit' && isset($url_array[4])) {
                    $params['comment'] = doCommentAction('edit', ['comment_id' => $url_array[4]]);
                    $params['pathToAction'] = "/product/{$id}/comment/{$url_array[4]}/save";
                    $params['submitBtnName'] = 'Сохранить';
                    $params['readOnly'] = 'readonly';
                } elseif ($url_array[5] == 'save' && isset($url_array[4])) {
                    doCommentAction('save', ['comment_id' => $url_array[4]]);
                } elseif ($url_array[5] == 'delete' && isset($url_array[4])) {
                    doCommentAction('delete', ['comment_id' => $url_array[4], 'prod_id' => $url_array[2]]);
                }
            }

            $params['product'] = getOneProduct($id);
            $params['comments'] = getProductComments($id);
            break;

        case 'gallery':

            if (!empty($_FILES)) {
                upload();
            }

            $params['photos'] = getGallery();
            $params['message'] = getMessage(GALLERY_MESSAGES);

            if (!is_array(getGallery())) {
                $params['message'] = 'Что-то пошло не так!';
            }

            break;

        case 'picture':

            $id = (int) $url_array[2] ?? null;
            
            if ($params['picture'] = getOnePicture($id)) {
                increaseFieldByOne($id);
            }

            $params['message'] = getMessage(GALLERY_MESSAGES);
            break;

        case 'apicatalog':
            echo json_encode(getCatalog(), JSON_UNESCAPED_UNICODE);
            die();

        case '503':
            $params['message'] = 'Что-то пошло не так!';
            break;
    }

    return $params;
}
