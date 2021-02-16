<?php

include ROOT . "/models/adminPanel.php";

function loginAction()
{
    $params['pageTitle'] = 'Авторизация';

    if (isset($_POST['auth'])) {
        $login = isset($_POST['login']) ? clearString($_POST['login']) : null;
        $password = isset($_POST['password']) ? clearString($_POST['password']) : null;
        $params['authMsg'] = 'Неправильный логин или пароль';
        $params['login'] = $login;
        $auth = false;

        if (empty($login) || empty($password)) {
            $params['authMsg'] = 'Заполните все поля формы';
        } elseif ($admin = getAdminByLogin($login)) {
            $auth = password_verify($password, $admin['password']); 
        }
            
        if ($auth) {
            $_SESSION['admin']['id'] = $admin['id'];
            $_SESSION['admin']['login'] = $admin['login'];

            header('Location: /admin/panel');
            exit();
        }
    }

    echo renderPage('admin/adminAuth', $params);
}

function logoutAction()
{
    if (isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
    }

    header('Location: /admin');
    exit();
}
