<?php

include ROOT . "/models/register.php";
include ROOT . "/models/cart.php";
include ROOT . "/models/user.php";

function registerAction()
{
    $params['count'] = getProductsQuantity(clearString($_SESSION['buyer_id'])); 
    $params['userMenu'] = MENU;

    if (isset($_POST['reg'])) {
        $login = isset($_POST['login']) ? clearString($_POST['login']) : '';
        $password = isset($_POST['password']) ? clearString($_POST['password']) : '';
        $regDate = time();
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $buyerId = uniqId(rand(), true);

        $checkLogin = preg_match('#[A-Za-z0-9]{3,10}#', $login) === 1;
        $checkPassword = preg_match('#[A-Za-z0-9]{3,20}#', $password) === 1;

        $params['login'] = $login;

        if (!$checkLogin || !$checkPassword) {
            $params['regMsg'] = 'Неправильный формат логина или пароля. Смотрите подсказки в форме.';

        } elseif (searchForLoginInDb($login)) {
            $params['regMsg'] = 'Пользователь с таким логином уже зарегистрирован.';
        } elseif (!addUser($login, $passwordHash, $regDate, $buyerId)) {
                $params['regMsg'] = 'Что-то пошло не так.';
        } else {
            $_SESSION['user']['login'] = $login;
            $_SESSION['user']['id'] = mysqli_insert_id(getDb());
            $_SESSION['buyer_id'] = $buyerId;

            if (!empty($_POST['remember'])) {
                rememberUser($login);
            }

            header('Location: /');
            exit();
        }
    }

    $params['pageTitle'] = 'Регистрация';

    echo renderPage('register', $params);
}
