<?php
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $CountryNameError = null;
        $Succsess = null;
      
        
         
        // keep track post values
        $CountryName = $_POST['CountryName'];
               
         
        // validate input
        $valid = true;
   

        if (empty($CountryName)) {
            $CountryNameError = 'Vennligts fyll inn landets navn.';
            $valid = false;
        }else if (!ctype_alpha(str_replace(' ', '', $CountryName))) {
            $CountryNameError = 'Ugyldig land. (Bruk bokstaver)';
            $valid = false;
        }

        if (strlen ($CountryName) < 3 || strlen ($CountryName) > 20) {
           $CountryNameError = 'Minst 3 (tre) og maks 20 (tyve) bokstaver';
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
            $Succsess = 'Landet ble registrert';
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO countries (CountryName) values(?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($CountryName));
            Database::disconnect();
            //header("Location: countrylist.php");
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
    <div class="containers">
     
                <div class="container1">
                    <div class="row">
                        <h3>Registrer ett land</h3>
                    </div>
             
                    <form class="form" action="createcountry.php" method="post">
                      
                      <div class="control-group <?php echo !empty($CountryNameError)?'error':'';?>">
                        <label class="control-label">Land</label>
                        <div class="controls">
                            <input name="CountryName" oninvalid="setCustomValidity('Vennligst fyll inn feltet riktig')" onkeyup="try{setCustomValidity('')}catch(e){}"  pattern="[A-Za-z ]{3,20}"   required title="Mellom 3-20 tegn" type="text"  placeholder="F.eks Norge" value="<?php echo !empty($CountryName)?$CountryName:'';?>">
                            <?php if (!empty($CountryNameError)): ?>
                                <span class="show text-danger"><?php echo $CountryNameError;?></span>
                            <?php endif; ?>
                            <?php if (!empty($Succsess)): ?>
                                <span class="show text"><?php echo $Succsess;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                     
                     <div class="form-action">
                          <button type="submit" class="btn btn-success">Registrer</button>
                          <a class="btn" href="countrylist.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
    <?php
    require_once("../../footer.html");
?> 
  </body>

</html>
