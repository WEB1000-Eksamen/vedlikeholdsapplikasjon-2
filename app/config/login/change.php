<?php
    require_once 'User.php';
    session_start();
    if (isset($_POST['change'], $_POST['username'], $_POST['password'], $_POST['password_confirm'], $_POST['req'])) {
        $username = strtolower($_POST['username']);
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $request_uri = $_POST['req'];
        $user = new User($username, $password);

        if ($password == $password_confirm && $password != '') {
            // Do switch on check return value
            switch ($user->changePassword()) {
                // User is not found
                case 0:
                    $_SESSION['ch_error_msg'] = Config::$USER_NOT_EXIST;
                    header("Location:".$request_uri);
                    exit;
                    break;
                // Unkown error
                case 1:
                    $_SESSION['ch_error_msg'] = Config::$UNKNOWN_ERROR;
                    header("Location:".$request_uri);
                    exit;
                    break;
                // User is authenticated
                case 2:
                    $_SESSION['ch_success_msg'] = Config::CHANGE_PASSWORD_SUCCESS($username);
                    header("Location: ".$request_uri);
                    exit;
                    break;
                // Unexpected error happened
                default:
                    $_SESSION['ch_error_msg'] = Config::$UNKNOWN_ERROR;
                    header("Location:".$request_uri);
                    exit;
                    break;
            }
        } else {
            $_SESSION['ch_error_msg'] = Config::$PASSWORD_NOT_MATCHING;
            header("Location:".$request_uri);
        }
    } else {
        header("Location: ../../login.php");
    }