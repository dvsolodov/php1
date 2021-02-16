<?php

include ROOT . "/models/user.php";
include ROOT . "/models/cart.php";

function loginAction()
{
    $params['pageTitle'] = 'Авторизация';
    $params['userMenu'] = MENU;
    $params['count'] = getProductsQuantity(clearString($_SESSION['buyer_id'])); 

    if (isset($_POST['auth'])) {
        $login = isset($_POST['login']) ? clearString($_POST['login']) : null;
        $password = isset($_POST['password']) ? clearString($_POST['password']) : null;
        $params['authMsg'] = 'Неправильный логин или пароль';
        $params['login'] = $login;
        $auth = false;

        if (empty($login) || empty($password)) {
            $params['authMsg'] = 'Заполните все поля формы';
        } elseif (isset($_COOKIE['auth']) && ($user = getUserByCookie($_COOKIE['auth']))) {
            $auth = true; 
        } elseif ($user = getUserByLogin($login)) {
            $auth = password_verify($password, $user['password']); 
        }
            
        if ($auth) {
            if (!empty($_POST['remember'])) {
                rememberUser($login);
            }

            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['login'] = $user['login'];
            $_SESSION['buyer_id'] = $user['buyer_id'];

            header('Location: /');
            exit();
        }
    }

    echo renderPage('auth', $params);
}

function logoutAction()
{
    if (isset($_SESSION['user'])) {
        forgetUser($_SESSION['user']['id']);
        unset($_SESSION['user']);
    }

    if (isset($_SESSION['buyer_id'])) {
        $_SESSION['buyer_id'] = uniqid(rand(), true);
    }


    header('Location: /');
    exit();
}
