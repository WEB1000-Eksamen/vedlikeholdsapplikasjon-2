<?php
    require_once 'User.php';
    session_start();
    if (isset($_POST['username'], $_POST['password'], $_POST['password_confirm'], $_POST['register'], $_POST['req'])) {
        $username = strtolower($_POST['username']);
        $password = $_POST['password'];
        $request_uri = $_POST['req'];
        $password_confirm = $_POST['password_confirm'];

        if ($password == $password_confirm) {
            $user = new User($username, $password);

            // Do switch on create return value
            switch ($user->create()) {
                // User with the same username found
                case 0:
                    $_SESSION['error_msg'] = Config::$REGISTER_USER_DUPLICATE;
                    header("Location: $request_uri");
                    break;
                // Unknown error happened when registering user
                case 1:
                    $_SESSION['error_msg'] = Config::$UNKNOWN_ERROR;
                    header("Location: $request_uri");
                    break;
                // User was created successfully
                case 2:
                    $_SESSION['success_msg'] = Config::REGISTER_SUCCESS($username);
                    header("Location: $request_uri");
                    break;
                // Unkown error happened when registering user
                default:
                    $_SESSION['error_msg'] = Config::$UNKNOWN_ERROR;
                    header("Location: $request_uri");
                    break;
            }

        } else {
            $_SESSION['error_msg'] = Config::$PASSWORD_NOT_MATCHING;
            header("Location: $request_uri");
        }
    } else {
        header("Location: ../../login.php");
    }