<?php
    session_start();
    if (isset($_SESSION['user']) && $_SESSION['user'] != false) {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logg inn - Vedlikeholdsapplikasjon</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background: url(https://phgcdn.com/images/uploads/MLAEH/corporatemasthead/grand-hotel-excelsior_masthead.jpg) no-repeat; background-size: cover;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <?php
                // Error message handling
                if (isset($_SESSION['error_msg'])) {
                    echo "
                    <div>
                        <div class='panel panel-danger'>
                        {$_SESSION['error_msg']}
                        </div>
                    </div>
                    ";
                    unset($_SESSION['error_msg']);
                }

                if (isset($_SESSION['user'])) {
                    echo "
                    <div>
                        <div class='panel panel-success'>
                        {$_SESSION['success_msg']}
                        </div>
                    </div>
                    ";
                } else {
                ?>
                <form action="php/login/login.php" method="POST">
                    <h1 class="text-center">
                        Perfect Hotels Premium
                    </h1>
                    <div>
                        <input placeholder="Brukernavn" required type="text" id="username" name="username" class="form-control type">
                    </div>
                    <div>
                        <input placeholder="Passord" required type="password" id="password" name="password" class="form-control type">
                    </div>
                    <div>
                        <input type="hidden" name="req" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="submit" name="login" value="Logg inn" id="login" class="btn btn-lg btn-block btn-primary submit">
                    </div>
                </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>