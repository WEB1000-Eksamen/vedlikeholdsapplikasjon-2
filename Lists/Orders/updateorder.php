<?php
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
 
    $OrderID = null;
    if ( !empty($_GET['OrderID'])) {
        $OrderID = $_REQUEST['OrderID'];
    }
     
    if ( null==$OrderID ) {
        header("Location: OrdersList.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $ReferenceError = null;
        $EmailError = null;
        $Succsess = null;
         
        // keep track post values
        $Reference = $_POST['Reference'];
        $Email = $_POST['Email'];
         
        // validate input
        $valid = true;
       
       if (empty($Email)) {
            $EmailError = 'Vennligst fyll inn Email';
            $valid = false;
        } else if ( !filter_var($Email,FILTER_VALIDATE_EMAIL) ) {
            $EmailError = 'Ugyldig Email';
            $valid = false;
        }

        if (empty($Reference)) {
            $ReferenceError = 'Vennligst fyll inn Referanse';
            $valid = false;
        }  else if (!ctype_alnum($Reference)) {
            $ReferenceError = 'Ugyldig referanse (Ikke bruk ! # ¤ eller lignende)';
            $valid = false;
        }

        if (strlen ($Reference) < 4 || strlen ($Reference) > 15) {
           $ReferenceError = 'Minst 4 (fire) og maks 15 (femten) bokstaver/tall';
           $valid = false;
        } 

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM orders where Reference = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($Reference));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if( $q->rowCount() > 0 ) { 
          $ReferenceError = 'Refferansen er allerede registrert';
          $valid = false;
               }
        Database::disconnect();
         
      
         
        // update data
        if ($valid) {
            $Succsess = 'Bestillingen ble oppdatert';
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE orders set Reference = ?, Email = ? WHERE OrderID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($Reference,$Email,$OrderID));
            Database::disconnect();
            //header("Location: OrdersList.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM orders where OrderID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($OrderID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $Reference = $data['Reference'];
        $Email = $data['Email'];
        Database::disconnect();
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
                        <h3>Oppdater Bestilling</h3>
                    </div>
             
                    <form class="form" action="updateorder.php?OrderID=<?php echo $OrderID?>" method="post">
                      

                      <div class="control-group <?php echo !empty($ReferenceError)?'error':'';?>">
                        <label class="control-label">Referanse</label>
                        <div class="controls">
                            <input name="Reference" type="text"  placeholder="Reference" value="<?php echo !empty($Reference)?$Reference:'';?>">
                            <?php if (!empty($ReferenceError)): ?>
                                <span class="show text-danger"><?php echo $ReferenceError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                          <div class="control-group <?php echo !empty($EmailError)?'error':'';?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="Email" type="text" placeholder="Email Address" value="<?php echo !empty($Email)?$Email:'';?>">
                            <?php if (!empty($EmailError)): ?>
                                <span class="show text-danger"><?php echo $EmailError;?></span>
                            <?php endif;?>
                            <?php if (!empty($Succsess)): ?>
                                <span class="show text"><?php echo $Succsess;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-action">
                          <button type="submit" class="btn btn-success">Oppdater</button>
                          <a class="btn" href="OrdersList.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
      <?php
    require_once("../../footer.html");
?> 
  </body>

</html>