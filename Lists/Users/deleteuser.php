<?php
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
    $UserID = 0;
     
    if ( !empty($_GET['UserID'])) {
        $UserID = $_REQUEST['UserID'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $UserID = $_POST['UserID'];
         
        // delete data
        try {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM users  WHERE UserID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($UserID));
        Database::disconnect();
        header("Location:/vedlikeholdsapplikasjon-2/app/config/login/hub/index.php");
        } catch (Exception $e) {
 echo "<p align='center'><font color=red  size='6pt'>En annen tabell er avhengig av dette objectet.</font></p>";
}   
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfect hotels premium</title>
  <!-- BOOTSTRAP STYLES-->
    <link href="../../AdminMenu/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../../AdminMenu/assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../../AdminMenu/assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link   href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>
 
<body >
  <div class="background-image"></div>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Slett rom</h3>
                    </div>
                     
                    <form class="form" action="deleteuser.php" method="post">
                      <input type="hidden" name="UserID" value="<?php echo $UserID;?>"/>
                      <p class="alert alert-error"> Er du sikker?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Ja</button>
                          <a class="btn" href="/vedlikeholdsapplikasjon-2/app/config/login/hub/index.php">Nei</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
    <script src="../../AdminMenu/assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../../AdminMenu/assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../../AdminMenu/assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="../../AdminMenu/assets/js/custom.js"></script>
  </body>
</html>