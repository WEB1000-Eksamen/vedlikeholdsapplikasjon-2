<?php
    require_once '../User.php';
    require_once("../../../../AdminMenu/Blank.html");
    
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfect Hotels Premium</title>
  <!-- BOOTSTRAP STYLES-->
    <link href="/vedlikeholdsapplikasjon-2/AdminMenu/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="/vedlikeholdsapplikasjon-2/AdminMenu/assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="/vedlikeholdsapplikasjon-2/AdminMenu/assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link href="/vedlikeholdsapplikasjon-2/Lists/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="../../../../assets/css/stylesheet.css">
  
    <script src="/vedlikeholdsapplikasjon-2/Lists/js/bootstrap.min.js"></script>
</head>
<body>
     <div id="page-inn">
    <section id="administer_users">
        <header>
            <h2 class="">Brukeradministrasjon</h2>
        </header>
       
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
                <input placeholder="Brukernavn" required type="text" id="username" name="username" class="form-control">
            </div>
            <div>
                <input placeholder="Passord" required type="password" id="password" name="password" class="form-control">
            </div>
            <div>
                <input placeholder="Bekreft passord" required type="password" id="password_confirm" name="password_confirm" class="form-control">
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
                <select class="form-control" name="username">
                    <?php
                    foreach ($allUsers as $key => $value) {
                        echo "<option value='{$value['Username']}'>{$value['Username']}</option>";
                    }
                ?>
                </select>
            </div>
            <div>
                <input required placeholder="Nytt passord" type="password" name="password" class="form-control">
            </div>
            <div>
                <input required placeholder="Bekreft nytt passord" type="password" name="password_confirm" class="form-control">
            </div>
            <div>
                <input type="hidden" name="req" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <input type="submit" name="change" value="Endre passord" id="change" class="submit">
            </div>
        </form>
    </section>
    </div>
</body>
<?php
    require_once("../../../../footer.html");
?> 
</html>