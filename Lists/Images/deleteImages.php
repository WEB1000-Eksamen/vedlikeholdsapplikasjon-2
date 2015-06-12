<?php
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
     
    if ( !empty($_GET['ImageID'])) {
        $ImageID = $_REQUEST['ImageID'];
    }

     
    if ( !empty($_POST)) {
        // keep track post values
        $ImageID = $_POST['ImageID'];
         
        // delete data
        try {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM images WHERE ImageID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ImageID));
        Database::disconnect();
        header("Location: ImagesList.php");
    } catch (Exception $e) {
 echo "<p align='center'><font color=red  size='6pt'>En annen tabell er avhengig av dette objektet.</font></p>";
}     
    }
?>
 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfect Hotels Premium</title>
  <!-- BOOTSTRAP STYLES-->
    <link href="../../AdminMenu/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../../AdminMenu/assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
   
        <!-- CUSTOM STYLES-->
    <link href="../../AdminMenu/assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="../../AdminMenu/assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
   <link   href="../css/bootstrap.min.css" rel="stylesheet">
    
    <script src="../js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="background-image"></div>
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
    <?php
    require_once("../../footer.html");
?> 
  </body>
</html>