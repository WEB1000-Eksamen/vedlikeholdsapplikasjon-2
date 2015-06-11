<?php
   require '../database.php';
   require_once("../../AdminMenu/Blank.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $HotelNameError = null;
        $CountryIDError = null;
        $ImageIDError = null;
        $DescriptionError = null;
        $AddressError = null;
        $Succsess = null;
   
        
         
        // keep track post values
        $HotelName = $_POST['HotelName'];
        $CountryID = $_POST['CountryID'];
        $ImageID = $_POST['ImageID'];
        $Description = $_POST['Description'];
        $Address = $_POST['Address'];
         
        // validate input
        $valid = true;
     
        if (empty($HotelName)) {
            $HotelNameError = 'Vennligts fyll inn hotelnavn';
            $valid = false;
        }else if (!ctype_alpha($HotelName)) {
            $HotelNameError = 'Ugyldig hotelnavn (Bruk bokstaver)';
            $valid = false;
        }
         
           if (empty($CountryID)) {
            $CountryIDError = 'Vennligst velg LandID';
            $valid = false;
        }

         if (empty($ImageID)) {
            $ImageIDError = 'Venligst velg ImageID';
            $valid = false;
        }

         if (empty($Description)) {
            $DescriptionError = 'Vennligst fyll inn beskrivelse';
            $valid = false;
        }

         if (empty($Address)) {
            $AddressError = 'Vennligst fyll inn adresse';
            $valid = false;
        }

        if (strlen ($HotelName) < 4 || strlen ($HotelName) > 20) {
           $HotelNameError = 'Minst 4 (fire) og maks 20 (tyve) bokstaver';
           $valid = false;
        } 

         if (strlen ($Description) < 10 || strlen ($Description) > 300) {
           $DescriptionError = 'Minst 10 (ti) og maks 300 (tre hundre) bokstaver';
           $valid = false;
        } 

        if (strlen ($Address) < 4 || strlen ($Address) > 20) {
           $AddressError = 'Minst 4 (fire) og maks 20 (tyve) bokstaver';
           $valid = false;
        } 


          
        // insert data
        if ($valid) {
           $Succsess = 'Hotellet ble registrert';
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO hotels (HotelName,CountryID,ImageID,Description,Address) values(?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($HotelName,$CountryID,$ImageID,$Description,$Address));
            Database::disconnect();
           //header("Location: HotelsList.php");
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
 
<body>
  <div class="background-image"></div>
    <div class="containers">
     
                <div class="container1">
                    <div class="row">
                        <h3>Registrer en bestilling</h3>
                    </div>
             
                    <form class="form" action="createhotels.php" method="post">
                      
                      <div class="control-group <?php echo !empty($HotelNameError)?'error':'';?>">
                        <label class="control-label">Navn</label>
                        <div class="controls">
                            <input name="HotelName" type="text"  placeholder="F.eks Lunde Hotell" value="<?php echo !empty($HotelName)?$HotelName:'';?>">
                            <?php if (!empty($HotelNameError)): ?>
                                <span class="show text-danger"><?php echo $HotelNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                       <div class="control-group <?php echo !empty($AddressError)?'error':'';?>">
                        <label class="control-label">Adresse</label>
                        <div class="controls">
                            <input name="Address" type="text"  placeholder="Slottsplassen 1,0010 Oslo" value="<?php echo !empty($Address)?$Address:'';?>">
                            <?php if (!empty($AddressError)): ?>
                                <span class="show text-danger"><?php echo $AddressError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                          <div class="control-group <?php echo !empty($CountryIDError)?'error':'';?>">
                        <label class="control-label">LandID</label>
                        <div class="controls">
                            <?php require_once("../Listebokser/listeboks-CountryID.php"); ?>
                            <?php if (!empty($CountryIDError)): ?>
                                <span class="show text-danger"><?php echo $CountryIDError;?></span>
                            <?php endif;?>
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

                      <div class="control-group <?php echo !empty($DescriptionError)?'error':'';?>">
                        <label class="control-label">Beskrivelse</label>
                        <div class="controls">
                            <textarea name="Description" id= "Beskrivelse" maxlength="300" type="text"  placeholder="Beskrivelse..." ><?php echo !empty($Description)?$Description:'';?></textarea>
                            <?php if (!empty($DescriptionError)): ?>
                                <span class="show text-danger"><?php echo $DescriptionError;?></span>
                            <?php endif; ?>
                            <?php if (!empty($Succsess)): ?>
                                <span class="show text"><?php echo $Succsess;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-action">
                          <button type="submit" class="btn btn-success">Registrer</button>
                          <a class="btn" href="HotelsList.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
   <?php
    require_once("../../footer.html");
?> 
  </body>

</html>
