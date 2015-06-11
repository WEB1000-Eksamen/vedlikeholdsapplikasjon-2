<?php
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
    $CountryID = 0;
     
    if ( !empty($_GET['CountryID'])) {
        $CountryID = $_REQUEST['CountryID'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $CountryID = $_POST['CountryID'];
         
        // delete data
        try {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM countries  WHERE CountryID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($CountryID));
        Database::disconnect();
        header("Location: countryList.php");
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
                     
                    <form class="form" action="deletecountry.php" method="post">
                      <input type="hidden" name="CountryID" value="<?php echo $CountryID;?>"/>
                      <p class="alert alert-error"> Er du sikker?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Ja</button>
                          <a class="btn" href="countryList.php">Nei</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
     <?php
    require_once("../../footer.html");
?> 
  </body>
</html>