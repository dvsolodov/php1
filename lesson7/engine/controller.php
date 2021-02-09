<?php

function prepareVariables($page, $url_array, $userId, $buyerId)
{
    
    $params = [
        'count' => getGoodsQuantity($buyerId)[0]['count'] ?? 0,
        'userName' => $_SESSION['auth']['login'] ?? 'гость',
    ];

    switch ($page) {
        case 'index':
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

        case 'cart':

            if ($jsonReq= file_get_contents('php://input')) {
                $data = json_decode($jsonReq, true);
                $jsonResp = ''; 
                $arrForJson = [];

                if ($data['action'] == 'add') {

                    if (addGoodsToCart(clearString($data['productId']), $buyerId)) {
                        $arrForJson['buyMessage'] = 'Товар добавлен в корзину';
                    } else {
                        $arrForJson['buyMessage'] = 'Что-то пошло не так!';
                    }
                }

                if ($data['action'] == 'delete') {

                    if ($data['productId'] == 'all') {

                        if (deleteAllGoods($buyerId)) {
                            $arrForJson['status'] = 'all';
                        }

                    } elseif (deleteGoods(clearString($data['productId']), $buyerId)) {
                        $arrForJson['status'] = 'ok';
                    }
                }

                $arrForJson['count'] = getGoodsQuantity($buyerId)[0]['count'];
                $jsonResp = json_encode($arrForJson);

                echo $jsonResp;
                exit();
            }

            $params['cart'] = getCart($buyerId);
            
            break;

        case 'reg':
            if (checkAuth()) {
                header('Location: /');
                exit();
            }

            if (isset($_POST['reg'])) {
                $login = clearString($_POST['login']);
                $password = clearString($_POST['pass']);

                if (!checkLogin($login) || !checkPassword($password)) {
                    $params['regMessage'] = 'Логин или пароль не соответствуют формату. Смотрите подсказки к полям формы.';
                    $params['login'] = $login;
                } elseif (searchForLoginInDb($login)) {
                    $params['regMessage'] = 'Учетная запись с таким логином уже существует.';
                    $params['login'] = $login;
                } elseif (addUser($login, $password)) {

                    if (isset($_POST['remember'])) {
                        rememberUser($login);
                    }

                    $_SESSION['auth']['user_id'] = mysqli_insert_id(getDb());
                    $_SESSION['auth']['login'] = $login;
                    header('Location: /');
                    exit();
                } else {
                    header('Location: /503');
                    exit();
                }     
            }

            break;

        case 'auth':
            if (checkAuth()) {
                header('Location: /');
                exit();
            }

            if ($_POST) {
                $login = clearString($_POST['login']);
                $password = clearString($_POST['pass']);

                if (isset($_POST['remember'])) {
                    $hash = true;
                }

                if ($userId = searchForLoginAndPassInDb($login, $password)) {
                    if ($hash) {
                        rememberUser($login);
                    }

                    $_SESSION['auth']['login'] = $login;
                    $_SESSION['auth']['user_id'] = $userId;
                    header('Location: /');
                    exit();
                } else {
                    $params['authMessage'] = 'Неправильный логин или пароль.';
                }
            }

            break;

        case 'logout':
            logout();
            header('Location: /');
            exit();
            break;

        case 'order':
            if (isset($_POST['order'])) {
                $phone = clearString($_POST['phone']);

                if (addOrder($buyerId, $phone)) {
                    $params['count'] = 0;
                    $params['orderMessage'] = "Заказ №" . mysqli_insert_id(getDb()) . " оформляется."; 
                    setcookie('buyer', '', time()-3000, "/");
                } else {
                    $params['orderMessage'] = "Что-то пошло не так. Попробуйте еще раз."; 
                }
            } 

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
