<?php
    require '../database.php';
    require_once("../../top.html");
     
    if ( !empty($_GET['ImageID'])) {
        $ImageID = $_REQUEST['ImageID'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $ImageID = $_POST['ImageID'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM images WHERE ImageID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ImageID));
        Database::disconnect();
        header("Location: ImagesList.php");
         
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
                        <h3>Slett bilde</h3>
                    </div>
                     
                    <form class="form" action="deleteImages.php" method="post">
                      <input type="hidden" name="ImageID" value="<?php echo $ImageID;?>"/>
                      <p class="alert alert-error"> Er du sikker?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Ja</button>
                          <a class="btn" href="ImagesList.php">Nei</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
  <?php
    require_once("../../footer.html");
?> 
</html>