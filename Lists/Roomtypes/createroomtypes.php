<?php
     
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $RoomtypeNameError = null;
        $BedsError = null;
        $PriceError = null;
        $ImageIDError = null;
        $Succsess = null;
        
         
        // keep track post values
        $RoomtypeName = $_POST['RoomtypeName'];
        $Beds = $_POST['Beds'];
        $Price = $_POST['Price'];
        $ImageID = $_POST['ImageID'];
      
         
        // validate input
        $valid = true;
       
        if (empty($RoomtypeName)) {
            $RoomtypeNameError = 'Venligts fyll inn romtypenavn';
            $valid = false;
        }else if (!ctype_alpha($RoomtypeName)) {
            $RoomtypeNameError = 'Ugyldig romtypenavn';
            $valid = false;
        }


        if (empty($Beds)) {
            $BedsError = 'Venligts fyll inn antall Senger';
            $valid = false;
        }else if (ctype_alpha($Beds)) {
            $BedsError = 'Ugyldig antall senger ';
            $valid = false;
        }

        if (empty($Price)||!ctype_digit($Price)) {
            $PriceError = 'Vennligts fyll inn pris (bruk tall)';
            $valid = false;
        } 

        if (empty($ImageID)) {
            $ImageIDError = 'Venligst velg ImageID';
            $valid = false;
        }

        if (strlen($Beds)>1) {
           $BedsError = 'Bruk tall med maks 1 (ett) siffer';
           $valid = false;
        }

        if (strlen ($RoomtypeName) < 4 || strlen ($RoomtypeName) > 10) {
           $RoomtypeNameError = 'Minst 4 (fire) og maks 10 (ti) bokstaver';
           $valid = false;
        } 

          if (strlen ($Price) < 2 || strlen ($Price) > 4) {
           $PriceError = 'Bruk tall med minst 3 (tre) og maks 5 (fem) siffer';
           $valid = false;
        } 

         $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM roomtypes where RoomtypeName = ? AND Beds = ? AND Price = ? AND ImageID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($RoomtypeName,$Beds,$Price,$ImageID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if( $q->rowCount() > 0 ) { 
          $RoomtypeNameError = 'Romtypen er allerede registrert';
          $BedsError = 'Romtypen er allerede registrert';
          $PriceError = 'Romtypen er allerede registrert';
          $ImageIDError = 'Romtypen er allerede registrert';
          $valid = false;
               }
        Database::disconnect();
              
        // insert data
        if ($valid) {
            $Succsess = 'Romtypen ble registrert';
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO roomtypes (RoomtypeName,Beds, ImageID, Price) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($RoomtypeName,$Beds,$ImageID,$Price));
            Database::disconnect();
            //header("Location: RoomtypesList.php");
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
                        <h3>Registrer en ny romtype</h3>
                    </div>
             
                    <form class="form" action="createroomtypes.php" method="post">
                      
                      <div class="control-group <?php echo !empty($RoomtypeNameError)?'error':'';?>">
                        <label class="control-label">Romtypenavn</label>
                        <div class="controls">
                            <input name="RoomtypeName" type="text"  placeholder="F.eks Suite" value="<?php echo !empty($RoomtypeName)?$RoomtypeName:'';?>">
                            <?php if (!empty($RoomtypeNameError)): ?>
                                <span class="show text-danger"><?php echo $RoomtypeNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>


                       <div class="control-group <?php echo !empty($BedsError)?'error':'';?>">
                        <label class="control-label">Antall senger</label>
                        <div class="controls">
                            <input name="Beds" type="text"  placeholder="F.eks 4" value="<?php echo !empty($Beds)?$Beds:'';?>">
                            <?php if (!empty($BedsError)): ?>
                                <span class="show text-danger"><?php echo $BedsError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>


                        <div class="control-group <?php echo !empty($PriceError)?'error':'';?>">
                        <label class="control-label">Pris</label>
                        <div class="controls">
                            <input name="Price" type="text"  placeholder="F.eks 200" value="<?php echo !empty($Price)?$Price:'';?>">
                            <?php if (!empty($PriceError)): ?>
                                <span class="show text-danger"><?php echo $PriceError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($ImageIDError)?'error':'';?>">
                        <label class="control-label">Bilde</label>
                        <div class="controls">
                            <?php require_once("../Listebokser/listeboks-ImageID.php"); ?>
                            <?php if (!empty($ImageIDError)): ?>
                                <span class="show text-danger"><?php echo $ImageIDError;?></span>
                            <?php endif; ?>
                            <?php if (!empty($Succsess)): ?>
                                <span class="show text"><?php echo $Succsess;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="form-action">
                          <button type="submit" class="btn btn-success">Registrer</button>
                          <a class="btn" href="RoomtypesList.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
     <?php
    require_once("../../footer.html");
?> 
  </body>
 </html>
