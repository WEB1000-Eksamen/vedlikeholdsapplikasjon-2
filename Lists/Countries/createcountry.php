<?php
     
    require '../database.php';
    require_once("../../top.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $CountryNameError = null;
      
        
         
        // keep track post values
        $CountryName = $_POST['CountryName'];
               
         
        // validate input
        $valid = true;
   

        if (empty($CountryName)) {
            $CountryNameError = 'Vennligts fyll inn landets navn.';
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
         
                      
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO countries (CountryName) values(?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($CountryName));
            Database::disconnect();
            header("Location: countrylist.php");
        }
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
    <div class="containers">
     
                <div class="container1">
                    <div class="row">
                        <h3>Registrer ett land</h3>
                    </div>
             
                    <form class="form" action="createcountry.php" method="post">
                      
                      <div class="control-group <?php echo !empty($CountryNameError)?'error':'';?>">
                        <label class="control-label">Land</label>
                        <div class="controls">
                            <input name="CountryName" type="text"  placeholder="F.eks Norge" value="<?php echo !empty($CountryName)?$CountryName:'';?>">
                            <?php if (!empty($CountryNameError)): ?>
                                <span class="show text-danger"><?php echo $CountryNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                     
                     <div class="form-actions">
                          <button type="submit" class="btn btn-success">Registrer</button>
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
