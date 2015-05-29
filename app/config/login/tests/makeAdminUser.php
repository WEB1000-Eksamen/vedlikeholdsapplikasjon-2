<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrer første gang - Vedlikeholdsapplikasjon</title>
    <link rel="stylesheet" type="text/css" href="../../../stylesheet.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <section id="user_box">
        <header>
            <h1>Registrer bruker</h1>
        </header>
        <?php
            // Error message handling
            if (isset($_SESSION['error_msg'])) {
                echo "
                <div>
                    <div class='error_message'>
                    {$_SESSION['error_msg']}
                    </div>
                </div>
                ";
                unset($_SESSION['error_msg']);
            }
            // Success message handling
            if (isset($_SESSION['success_msg'])) {
                echo "
                <div>
                    <div class='success_message'>
                    {$_SESSION['success_msg']}
                    </div>
                </div>
                ";
                unset($_SESSION['success_msg']);
            }
        ?>
        <form action="../register.php" method="POST">
            <div>
                <input placeholder="Brukernavn" required type="text" id="username" name="username" class="type">
            </div>
            <div>
                <input placeholder="Passord" required type="password" id="password" name="password" class="type">
            </div>
            <div>
                <input placeholder="Bekreft passord" required type="password" id="password_confirm" name="password_confirm" class="type">
            </div>
            <div>
                <input type="hidden" name="req" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <input type="submit" name="register" value="Registrer" id="register" class="submit">
            </div>
        </form>
    </section>
</body>
</html>