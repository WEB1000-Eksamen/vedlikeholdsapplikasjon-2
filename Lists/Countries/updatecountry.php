<?php
    require '../database.php';
    require_once("../../top.html");
 
    $CountryID = null;
    if ( !empty($_GET['CountryID'])) {
        $CountryID = $_REQUEST['CountryID'];
    }
     
    if ( null==$CountryID ) {
        header("Location: countrylist.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $CountryNameError = null;
      
         
        // keep track post values
        $CountryName = $_POST['CountryName'];
      


        // validate input
        $valid = true;
       
          if (empty($CountryName)) {
            $CountryNameError = 'Vennligts fyll inn land';
            $valid = false;
        }else if (!ctype_alpha($CountryName)) {
            $CountryNameError = 'Ugyldig land. (Bruk bokstaver)';
            $valid = false;
        }



         $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM countries where CountryName = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($CountryName));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if( $q->rowCount() > 0 ) { 
          $CountryNameError = 'Landet er allerede registrert';
         
          $valid = false;
               }
        Database::disconnect();
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE countries set CountryName = ? WHERE CountryID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($CountryName,$CountryID));
            Database::disconnect();
            header("Location: countrylist.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM countries where CountryID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($CountryID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $CountryName = $data['CountryName'];
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../assets/css/stylesheet.css">
    <script src="../js/bootstrap.min.js"></script>
</head>
 
<body style="background: url(https://phgcdn.com/images/uploads/MLAEH/corporatemasthead/grand-hotel-excelsior_masthead.jpg) no-repeat; background-size: cover;">
    <div class="containers">
     
                <div class="container1">
                    <div class="row">
                        <h3>Oppdater Land</h3>
                    </div>
             
                    <form class="form" action="updatecountry.php?CountryID=<?php echo $CountryID?>" method="post">
                      

                      <div class="control-group <?php echo !empty($CountryNameError)?'error':'';?>">
                        <label class="control-label">Antall Senger</label>
                        <div class="controls">
                            <input name="CountryName" type="text" placeholder="CountryName Address" value="<?php echo !empty($CountryName)?$CountryName:'';?>">
                            <?php if (!empty($CountryNameError)): ?>
                                <span class="show text-danger"><?php echo $CountryNameError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                          
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Oppdater</button>
                          <a class="btn" href="countrylist.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
<?php
    require_once("../../footer.html");
?> 

</html>