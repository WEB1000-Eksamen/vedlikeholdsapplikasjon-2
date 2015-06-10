<?php
     
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $RoomNumberError = null;
        $RoomNumberSuccsess = null;
       
        
         
        // keep track post values
        $RoomNumber = $_POST['RoomNumber'];
      
        // validate input
        $valid = true;
    

         if (empty($RoomNumber)||!ctype_digit($RoomNumber)) {
            $RoomNumberError = 'Vennligts fyll inn romnummer (Bruk tall)';
            $valid = false;
        }

        if (strlen($RoomNumber)>3) {
           $RoomNumberError = 'Bruk tall med maks 3 (tre) siffer';
           $valid = false;
               } 

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM rooms where RoomNumber = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($RoomNumber));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if( $q->rowCount() > 0 ) { 
          $RoomNumberError = 'Nummeret er allerede registrert';
          $valid = false;
               }
        Database::disconnect();

        // insert data
        if ($valid) {
            $RoomNumberSuccsess = 'Rommet ble registrert';
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO rooms (RoomNumber) values(?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($RoomNumber));
            Database::disconnect();
          
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
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
                        <h3>Registrer ett rom</h3>
                    </div>
             
                    <form class="form" action="createrooms.php" method="post">
                      
                      <div class="control-group <?php echo !empty($RoomNumberError)?'error':'';?>">
                        <label class="control-label">Romnummer</label>
                        <div class="controls">
                            <input name="RoomNumber" type="text"  placeholder="F.eks 1" value="<?php echo !empty($RoomNumber)?$RoomNumber:'';?>">
                            <?php if (!empty($RoomNumberError)): ?>
                                <span class="show text-danger"><?php echo $RoomNumberError;?></span>
                            <?php endif; ?>
                            <?php if (!empty($RoomNumberSuccsess)): ?>
                                <span class="show text"><?php echo $RoomNumberSuccsess;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="form-action">
                      
                          <button type="submit" class="btn btn-success">Registrer</button>
                          <a class="btn" href="RoomsList.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
       <script src="../../AdminMenu/assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../../AdminMenu/assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../../AdminMenu/assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="../../AdminMenu/assets/js/custom.js"></script>
  </body>

</html>
