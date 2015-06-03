<?php
     
    require '../database.php';
    require_once("../../top.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $HotelNameError = null;
        $CountryIDError = null;
        $ImageIDError = null;
        $DescriptionError = null;
        $AddressError = null;
   
        
         
        // keep track post values
        $HotelName = $_POST['HotelName'];
        $CountryID = $_POST['CountryID'];
        $ImageID = $_POST['ImageID'];
        $Description = $_POST['Description'];
        $Address = $_POST['Address'];
         
        // validate input
        $valid = true;
        if (empty($HotelName)) {
            $HotelNameError = 'Venligst fyll inn Hotellnavn';
            $valid = false;
        }
         
           if (empty($CountryID)) {
            $CountryIDError = 'Venligst velg LandID';
            $valid = false;
        }

         if (empty($ImageID)) {
            $ImageIDError = 'Venligst velg ImageID';
            $valid = false;
        }

         if (empty($Description)) {
            $DescriptionError = 'Venligst fyll inn beskrivelse';
            $valid = false;
        }

         if (empty($Address)) {
            $AddressError = 'Venligst fyll inn adresse';
            $valid = false;
        }
          
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO hotels (HotelName,CountryID,ImageID,Description,Address) values(?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($HotelName,$CountryID,$ImageID,$Description,$Address,$HotelID));
            Database::disconnect();
           header("Location: HotelsList.php");
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
             
                    <form class="form" action="createhotels.php" method="post">
                      
                      <div class="control-group <?php echo !empty($HotelNameError)?'error':'';?>">
                        <label class="control-label">Navn</label>
                        <div class="controls">
                            <input name="HotelName" type="text"  placeholder="F.eks Lunde Hotell" value="<?php echo !empty($HotelName)?$HotelName:'';?>">
                            <?php if (!empty($HotelNameError)): ?>
                                <span class="help-inline"><?php echo $HotelNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                          <div class="control-group <?php echo !empty($CountryIDError)?'error':'';?>">
                        <label class="control-label">LandID</label>
                        <div class="controls">
                            <input name="CountryID" type="text" placeholder="F.eks 1" value="<?php echo !empty($CountryID)?$CountryID:'';?>">
                            <?php if (!empty($CountryIDError)): ?>
                                <span class="help-inline"><?php echo $CountryIDError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($ImageIDError)?'error':'';?>">
                        <label class="control-label">ImageID</label>
                        <div class="controls">
                            <input name="ImageID" type="text"  placeholder="F.eks 1" value="<?php echo !empty($ImageID)?$ImageID:'';?>">
                            <?php if (!empty($ImageIDError)): ?>
                                <span class="help-inline"><?php echo $ImageIDError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($DescriptionError)?'error':'';?>">
                        <label class="control-label">Beskrivelse</label>
                        <div class="controls">
                            <input name="Description" type="text"  placeholder="Fyll inn beskrivelse her..." value="<?php echo !empty($Description)?$Description:'';?>">
                            <?php if (!empty($DescriptionError)): ?>
                                <span class="help-inline"><?php echo $DescriptionError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($AddressError)?'error':'';?>">
                        <label class="control-label">Adresse</label>
                        <div class="controls">
                            <input name="Address" type="text"  placeholder="Slottsplassen 1,0010 Oslo" value="<?php echo !empty($Address)?$Address:'';?>">
                            <?php if (!empty($AddressError)): ?>
                                <span class="help-inline"><?php echo $AddressError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Registrer</button>
                          <a class="btn" href="HotelsList.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
  <?php
    require_once("../../footer.html");
?> 
</html>
