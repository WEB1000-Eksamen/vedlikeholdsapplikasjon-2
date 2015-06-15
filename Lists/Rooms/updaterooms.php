<?php
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
 
    $RoomID = null;
    if ( !empty($_GET['RoomID'])) {
        $RoomID = $_REQUEST['RoomID'];
    }
     
    if ( null==$RoomID ) {
        header("Location: RoomsList.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $RoomNumberError = null;
        $Succsess = null;
       
         
        // keep track post values
        $RoomNumber = $_POST['RoomNumber'];
      
        // validate input
        $valid = true;
       
       if (empty($RoomNumber)||!ctype_digit($RoomNumber)) {
            $RoomNumberError = 'Vennligts fyll inn romnummer (Bruk tall)';
            $valid = false;
        } 

        if (strlen($RoomNumber)>4) {
           $RoomNumberError = 'Bruk tall med maks 4 (fire) siffer';
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
         
        // update data
        if ($valid) {
            $Succsess = 'Rommet ble oppdatert';
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE rooms set RoomNumber = ? WHERE RoomID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($RoomNumber,$RoomID));
            Database::disconnect();
            //header("Location: RoomsList.php"); Kommentert ut
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM rooms where RoomID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($RoomID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $RoomNumber = $data['RoomNumber'];
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
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
                        <h3>Oppdater rom</h3>
                    </div>
             
                    <form class="form" action="updaterooms.php?RoomID=<?php echo $RoomID?>" method="post">
                      

                      <div class="control-group <?php echo !empty($RoomNumberError)?'error':'';?>">
                        <label class="control-label">Romnummer</label>
                        <div class="controls">
                            <input name="RoomNumber" oninvalid="setCustomValidity('Vennligst fyll inn feltet riktig')" onkeyup="try{setCustomValidity('')}catch(e){}"  pattern="[0-9]{1,4}"   required title="Mellom 1-4 tall" type="text"  placeholder="F.eks 1" value="<?php echo !empty($RoomNumber)?$RoomNumber:'';?>">
                            <?php if (!empty($RoomNumberError)): ?>
                                <span class="show text-danger"><?php echo $RoomNumberError;?></span>
                            <?php endif; ?>
                            <?php if (!empty($Succsess)): ?>
                                <span class="show text"><?php echo $Succsess;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                         



                      <div class="form-action">
                          <button type="submit" class="btn btn-success">Oppdater</button>
                          <a class="btn" href="RoomsList.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
    <?php
    require_once("../../footer.html");
?> 
  </body>


</html>