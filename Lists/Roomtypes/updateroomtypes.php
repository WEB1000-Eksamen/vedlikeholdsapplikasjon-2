<?php
    require '../database.php';
    require_once("../../top.html");
 
    $RoomtypeID = null;
    if ( !empty($_GET['RoomtypeID'])) {
        $RoomtypeID = $_REQUEST['RoomtypeID'];
    }
     
    if ( null==$RoomtypeID ) {
        header("Location: RoomtypesList.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $RoomtypeNameError = null;
        $BedsError = null;
         
        // keep track post values
        $RoomtypeName = $_POST['RoomtypeName'];
        $Beds = $_POST['Beds'];
         
        $RoomtypeName = $_POST['RoomtypeName'];
        $Beds = $_POST['Beds'];
        $Price = $_POST['Price'];


        // validate input
        $valid = true;
       
        if (empty($RoomtypeName)) {
            $RoomtypeNameError = 'Please enter RoomtypeName';
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
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE roomtypes set RoomtypeName = ?, Beds = ?, Price = ? WHERE RoomtypeID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($RoomtypeName,$Beds,$Price,$RoomtypeID));
            Database::disconnect();
            header("Location: RoomtypesList.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM roomtypes where RoomtypeID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($RoomtypeID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $RoomtypeName = $data['RoomtypeName'];
        $Beds = $data['Beds'];
        $Price = $data['Price'];
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
                        <h3>Oppdater romtype</h3>
                    </div>
             
                    <form class="form" action="updateroomtypes.php?RoomtypeID=<?php echo $RoomtypeID?>" method="post">
                      

                      <div class="control-group <?php echo !empty($RoomtypeNameError)?'error':'';?>">
                        <label class="control-label">Navn</label>
                        <div class="controls">
                            <input name="RoomtypeName" type="text"  placeholder="RoomtypeName" value="<?php echo !empty($RoomtypeName)?$RoomtypeName:'';?>">
                            <?php if (!empty($RoomtypeNameError)): ?>
                                <span class="help-inline"><?php echo $RoomtypeNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                          <div class="control-group <?php echo !empty($BedsError)?'error':'';?>">
                        <label class="control-label">Antall Senger</label>
                        <div class="controls">
                            <input name="Beds" type="text" placeholder="Beds Address" value="<?php echo !empty($Beds)?$Beds:'';?>">
                            <?php if (!empty($BedsError)): ?>
                                <span class="help-inline"><?php echo $BedsError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($PriceError)?'error':'';?>">
                        <label class="control-label">Pris</label>
                        <div class="controls">
                            <input name="Price" type="text"  placeholder="Price" value="<?php echo !empty($Price)?$Price:'';?>">
                            <?php if (!empty($PriceError)): ?>
                                <span class="help-inline"><?php echo $PriceError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>



                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Oppdater</button>
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