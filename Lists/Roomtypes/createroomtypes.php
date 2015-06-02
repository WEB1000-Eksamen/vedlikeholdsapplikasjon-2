<?php
     
    require '../database.php';
    require_once("../../top.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $RoomtypenNameError = null;
        $BedsError = null;
        $PriceError = null;
        
         
        // keep track post values
        $RoomtypeName = $_POST['RoomtypeName'];
        $Beds = $_POST['Beds'];

        $Price = $_POST['Price'];
        
         
        // validate input
        $valid = true;
        if (empty($RoomtypeName)) {
            $nameError = 'Please enter RoomtypeName';
            $valid = false;
        }

        if (empty($Beds)) {
            $BedsError = 'Please enter Beds';
            $valid = false;
        }


        if (empty($Price)) {
            $PriceError = 'Please enter Price';
            $valid = false;
        }
              
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO roomtypes (RoomtypeName,Beds,Price) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($RoomtypeName,$Beds,$Price));
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
                        <h3>Registrer en bestilling</h3>
                    </div>
             
                    <form class="form" action="createroomtypes.php" method="post">
                      
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">RoomtypeName</label>
                        <div class="controls">
                            <input name="RoomtypeName" type="text"  placeholder="RoomtypeName" value="<?php echo !empty($RoomtypeName)?$RoomtypeName:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>


                       <div class="control-group <?php echo !empty($BedsError)?'error':'';?>">
                        <label class="control-label">Beds</label>
                        <div class="controls">
                            <input name="Beds" type="text"  placeholder="Beds" value="<?php echo !empty($Beds)?$Beds:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $BedsError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>


                        <div class="control-group <?php echo !empty($PriceError)?'error':'';?>">
                        <label class="control-label">Price</label>
                        <div class="controls">
                            <input name="Price" type="text"  placeholder="Price" value="<?php echo !empty($Price)?$Price:'';?>">
                            <?php if (!empty($PriceError)): ?>
                                <span class="help-inline"><?php echo $PriceError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Registrer</button>
                          <a class="btn" href="OrdersList.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
  <?php
    require_once("../../footer.html");
?> 
</html>
