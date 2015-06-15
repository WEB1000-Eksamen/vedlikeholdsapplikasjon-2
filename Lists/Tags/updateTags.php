<?php
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
 
    $TagID = null;
    if ( !empty($_GET['TagID'])) {
        $TagID = $_REQUEST['TagID'];
    }
     
    if ( null==$TagID ) {
        header("Location: HRTList.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $TextError = null;
        $HotelNameError = null;
        
        $Succsess = null;
    
         
        // keep track post values
        $HotelName = $_POST['HotelName'];
        $TagText = $_POST['TagText'];
    

        // validate input
        $valid = true;
       
          if (empty($TagText)) {
            $TextError = 'Venligts fyll inn romtypenavn';
            $valid = false;
        }


        if (empty($HotelName)) {
            $HotelNameError = 'Venligts fyll inn antall Senger';
            $valid = false;
        }



         $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM hoteltags where TagText = ? AND HotelID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($TagText,$HotelName));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if( $q->rowCount() > 0 ) { 
          $TextError = 'Taggen er allerede registrert';
          $HotelNameError = 'Taggen er allerede registrert';
          $valid = false;
               }
        Database::disconnect();
         
        // update data
        if ($valid) {
            $Succsess = 'Taggen ble oppdatert';
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE hoteltags set TagText = ?, HotelID = ? WHERE TagID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($TagText,$HotelName,$TagID));
            Database::disconnect();
            //header("Location: TagsList.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM hoteltags where TagID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($TagID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $TagText = $data['TagText'];
        $HotelName = $data['HotelID'];
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
             
                    <form class="form" action="updatetags.php?TagID=<?php echo $TagID?>" method="post">

                        <div class="control-group <?php echo !empty($TextError)?'error':'';?>">
                        <label class="control-label">Tagtekst</label>
                        <div class="controls">
                            <input name="TagText" oninvalid="setCustomValidity('Vennligst fyll inn feltet riktig')" onkeyup="try{setCustomValidity('')}catch(e){}"  pattern=".{4,40}"   required title="Mellom 4-40 tegn" type="text"  placeholder="Feks. Holtandalen" value="<?php echo !empty($TagText)?$TagText:'';?>">
                           <?php if (!empty($TextError)): ?>
                                <span class="show text-danger"><?php echo $TextError;?></span>
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
                             <?php if (!empty($Succsess)): ?>
                                <span class="show text"><?php echo $Succsess;?></span>
                            <?php endif; ?>
                        </div>
                      </div>


                      <div class="form-action">
                          <button type="submit" class="btn btn-success">Oppdater</button>
                          <a class="btn" href="TagsList.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->

<?php
    require_once("../../footer.html");
?> 

