<?php
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
    $TagID = 0;
     
    if ( !empty($_GET['TagID'])) {
        $TagID = $_REQUEST['TagID'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $TagID = $_POST['TagID'];
         
        // delete data
        try {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM hoteltags  WHERE TagID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($TagID));
        Database::disconnect();
        header("Location: TagsList.php");
        } catch (Exception $e) {
 echo "<p align='center'><font color=red  size='6pt'>En annen tabell er avhengig av dette objektet.</font></p>";
}     
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfect Hotels Premium</title>
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
                        <h3>Slett land</h3>
                    </div>
                     
                    <form class="form" action="deletetags.php" method="post">
                      <input type="hidden" name="TagID" value="<?php echo $TagID;?>"/>
                      <p class="alert alert-error"> Er du sikker?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Ja</button>
                          <a class="btn" href="TagsList.php">Nei</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
     <?php
    require_once("../../footer.html");
?> 
  </body>
</html>