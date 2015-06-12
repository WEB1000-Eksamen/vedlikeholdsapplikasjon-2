<?php
    session_start();
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user'], $_SESSION['username']);
        header("Location: /vedlikeholdsapplikasjon-2/login.php");
        exit;
    }
    header("Location: /vedlikeholdsapplikasjon-2/index.php");
    exit;
