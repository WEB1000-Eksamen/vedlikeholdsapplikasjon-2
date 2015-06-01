<?php
    require_once '../User.php';
    session_start();
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user'] == false) {
        header("Location: ../../../login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
     <title>Brukeradministrasjon - Obligatorisk Oppgave 4</title>
    <link rel="stylesheet" type="text/css" href="../../../../assets/css/stylesheet.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <section id="administer_users">
        <header>
            <h1 class="">Brukeradministrasjon</h1>
        </header>
        <a href="../../../../index.php" class="float-right back">Gå til forsiden</a>
        <h2>Brukerliste</h2>
        <table>
            <thead>
                <tr>
                    <th>BrukerID</th>
                    <th>Brukernavn</th>
                    <th>Passord</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $users = new User('', '');
                    $allUsers = $users->get();
                    foreach ($allUsers as $key => $value) {
                        echo "<tr>";
                        echo "<td>{$value['UserID']}</td>";
                        echo "<td>{$value['Username']}</td>";
                        echo "<td>Kryptert</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <h2>Registrer ny bruker</h2>
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
        <h2>Endre passord</h2>
        <?php
            // Error message handling
            if (isset($_SESSION['ch_error_msg'])) {
                echo "
                <div>
                    <div class='error_message'>
                    {$_SESSION['ch_error_msg']}
                    </div>
                </div>
                ";
                unset($_SESSION['ch_error_msg']);
            }
            // Success message handling
            if (isset($_SESSION['ch_success_msg'])) {
                echo "
                <div>
                    <div class='success_message'>
                    {$_SESSION['ch_success_msg']}
                    </div>
                </div>
                ";
                unset($_SESSION['ch_success_msg']);
            }
        ?>
        <form action="../change.php" method="POST">
            <div>
                <select class="change-password-select" name="username">
                    <?php
                    foreach ($allUsers as $key => $value) {
                        echo "<option value='{$value['Username']}'>{$value['Username']}</option>";
                    }
                ?>
                </select>
            </div>
            <div>
                <input required placeholder="Nytt passord" type="password" name="password" class="type">
            </div>
            <div>
                <input required placeholder="Bekreft nytt passord" type="password" name="password_confirm" class="type">
            </div>
            <div>
                <input type="hidden" name="req" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <input type="submit" name="change" value="Endre passord" id="change" class="submit">
            </div>
        </form>
    </section>
</body>
</html>