<?php
     
    require '../database.php';
    require_once("../../top.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $RoomtypeNameError = null;
        $BedsError = null;
        $PriceError = null;
        $ImageIDError = null;
        
         
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
            $PriceError = 'Venligts fyll inn pris';
            $valid = false;
        } 

        if (empty($ImageID)) {
            $ImageIDError = 'Venligst velg ImageID';
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
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO roomtypes (RoomtypeName,Beds, ImageID, Price) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($RoomtypeName,$Beds,$ImageID,$Price));
            Database::disconnect();
            header("Location: RoomtypesList.php");
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
                        <label class="control-label">ImageID</label>
                        <div class="controls">
                            <?php require_once("../Listebokser/listeboks-ImageID.php"); ?>
                            <?php if (!empty($ImageIDError)): ?>
                                <span class="show text-danger"><?php echo $ImageIDError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Registrer</button>
                          <a class="btn" href="RoomtypesList.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
  <?php
    require_once("../../footer.html");
?> 
</html>
