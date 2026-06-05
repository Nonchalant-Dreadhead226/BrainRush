<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $has_register_flag = !empty($_SESSION['signup_error']) || !empty($_SESSION['signup_success']);
    $has_login_flag = !empty($_SESSION['login_failed']);

    if (!$has_register_flag) {
        $_SESSION['AddRegisterDisplay'] = 'style="display:none"';
    }
    if (!$has_login_flag) {
        $_SESSION['AddLoginDisplay'] = 'style="display:none"';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $_SESSION['AddRegisterDisplay'] = 'style="display:block"';
        $_SESSION['AddLoginDisplay'] = 'style="display:none"';
    }
    if (isset($_POST['login'])) {
        $_SESSION['AddLoginDisplay'] = 'style="display:block"';
        $_SESSION['AddRegisterDisplay'] = 'style="display:none"';
    }
    if (isset($_POST['atcelt'])) {
        $_SESSION['AddRegisterDisplay'] = 'style="display:none"';
        $_SESSION['AddLoginDisplay'] = 'style="display:none"';
    }
    if (isset($_POST['dashboard'])) {
        header('Location: index.php');
        die();
    }
}
