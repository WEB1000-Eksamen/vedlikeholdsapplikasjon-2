<?php
    require '../database.php';
    require_once("../../top.html");
    $RoomtypeID = 0;
     
    if ( !empty($_GET['RoomtypeID'])) {
        $RoomtypeID = $_REQUEST['RoomtypeID'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $RoomtypeID = $_POST['RoomtypeID'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM Roomtypes  WHERE RoomtypeID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($RoomtypeID));
        Database::disconnect();
        header("Location: RoomtypesList.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>
 
<body style="background: url(https://phgcdn.com/images/uploads/MLAEH/corporatemasthead/grand-hotel-excelsior_masthead.jpg) no-repeat; background-size: cover;">
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Slett romtype</h3>
                    </div>
                     
                    <form class="form" action="deleteroomtypes.php" method="post">
                      <input type="hidden" name="RoomtypeID" value="<?php echo $RoomtypeID;?>"/>
                      <p class="alert alert-error"> Er du sikker?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Ja</button>
                          <a class="btn" href="RoomtypesList.php">Nei</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
  <?php
    require_once("../../footer.html");
?> 
</html>