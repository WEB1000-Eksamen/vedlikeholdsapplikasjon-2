<?php
    require '../database.php';
     require_once("../../AdminMenu/Blank.html");
 
    $TagID = null;
    if ( !empty($_GET['TagID'])) {
        $TagID = $_REQUEST['TagID'];
    }
     
    if ( null==$TagID ) {
        header("Location: countrylist.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $TextError = null;
        $Succsess = null;

      
         
        // keep track post values
        $TagText = $_POST['TagText'];
        $HotelName = $_POST['HotelName'];
      


        // validate input
        $valid = true;
       
          if (empty($TagText)) {
            $TextError = 'Vennligts fyll inn land';
            $valid = false;
        }else if (!ctype_alpha($TagText)) {
            $TextError = 'Ugyldig land. (Bruk bokstaver)';
            $valid = false;
        }

         if (strlen ($TagText) < 3 || strlen ($TagText) > 20) {
           $TextError = 'Minst 3 (tre) og maks 20 (tyve) bokstaver';
           $valid = false;
        }



         $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM hoteltags where TagText = ? AND HotelName = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($TagText));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if( $q->rowCount() > 0 ) { 
          $TextError = 'Taggen er allerede registrert';
         
          $valid = false;
               }
        Database::disconnect();
         
        // update data
        if ($valid) {
            $Succsess = 'Taggen ble oppdatert';
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE hoteltags set TagText = ?, HotelName =?, WHERE TagID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($TagText,$HotelName,$TagID));
            Database::disconnect();
            //header("Location: countrylist.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM hoteltags where TagID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($TagID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $TagText = $data['TagText'];
        $HotelName = $data['HotelName'];
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
                        <h3>Oppdater tag</h3>
                    </div>
             
                    <form class="form" action="updatecountry.php?TagID=<?php echo $TagID?>" method="post">
                      

                      <div class="control-group <?php echo !empty($TextError)?'error':'';?>">
                        <label class="control-label">Text</label>
                        <div class="controls">
                            <input name="TagText" type="text" placeholder="TagText Address" value="<?php echo !empty($TagText)?$TagText:'';?>">
                            <?php if (!empty($TextError)): ?>
                                <span class="show text-danger"><?php echo $TextError;?></span>
                            <?php endif;?>
                            <?php if (!empty($Succsess)): ?>
                                <span class="show text"><?php echo $Succsess;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($HotelNameError)?'error':'';?>">
                        <label class="control-label">Hotel</label>
                        <div class="controls">
                            <?php require_once("../Listebokser/listeboks-HotelName.php"); ?>
                            <?php if (!empty($HotelNameError)): ?>
                                <span class="show text-danger"><?php echo $HotelNameError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                          
                      <div class="form-action">
                          <button type="submit" class="btn btn-success">Oppdater</button>
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