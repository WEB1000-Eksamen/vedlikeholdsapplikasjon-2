<?php
    require_once 'User.php';
    session_start();
    if (isset($_POST['login'], $_POST['username'], $_POST['password'], $_POST['req'])) {
        $username = strtolower($_POST['username']);
        $password = $_POST['password'];
        $request_uri = $_POST['req'];
        $user = new User($username, $password);

        // Do switch on check return value
        switch ($user->check()) {
            // User is not found
            case 0:
                $_SESSION['error_msg'] = Config::$USER_LOGIN_ERROR;
                header("Location:".$request_uri);
                exit;
                break;
            // User has wrong password
            case 1:
                $_SESSION['error_msg'] = Config::$USER_LOGIN_ERROR;
                header("Location:".$request_uri);
                exit;
                break;
            // User is authenticated
            case 2:
                $_SESSION['user'] = Config::$USER_COOKIE_VALUE;
                $_SESSION['username'] = $username;
                header("Location: ../../index.php");
                exit;
                break;
            // Unexpected error happened
            default:
                $_SESSION['error_msg'] = Config::$UNKNOWN_ERROR;
                header("Location:".$request_uri);
                exit;
                break;
        }
    } else {
        header("Location: ../../login.php");
    }