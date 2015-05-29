<?php
    session_start();
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user'], $_SESSION['username']);
        header("Location: ../../login.php");
        exit;
    }
    header("Location: ../../index.php");
    exit;