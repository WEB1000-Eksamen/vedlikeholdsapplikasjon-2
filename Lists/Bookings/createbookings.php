<?php
     
    require '../database.php';
    require_once("../../top.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $FromDateError = null;
        $ToDateError = null;
        $HRIDError = null;
        $OrderIDError = null;
   
        
         
        // keep track post values
        $FromDate = $_POST['FromDate'];
        $ToDate = $_POST['ToDate'];
        $HRID = $_POST['HRID'];
        $OrderID = $_POST['OrderID'];
         
        // validate input
        $valid = true;
        if (empty($FromDate)) {
            $FromDateError = 'Venligst fyll inn Hotellnavn';
            $valid = false;
        }
         
           if (empty($ToDate)) {
            $ToDateError = 'Venligst velg LandID';
            $valid = false;
        }

         if (empty($HRID)) {
            $HRIDError = 'Venligst velg HRID';
            $valid = false;
        }

         if (empty($OrderID)) {
            $OrderIDError = 'Venligst fyll inn beskrivelse';
            $valid = false;
        }

          
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO hotels (FromDate,ToDate,HRID,OrderID) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($FromDate,$ToDate,$HRID,$OrderID,$HotelID));
            Database::disconnect();
           header("Location: BookingsList.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>

    <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepickerTo" ).datepicker();
     $( "#datepickerFrom" ).datepicker();
  });
  </script>
</head>
 
<body style="background: url(https://phgcdn.com/images/uploads/MLAEH/corporatemasthead/grand-hotel-excelsior_masthead.jpg) no-repeat; background-size: cover;">
    <div class="containers">
     
                <div class="container1">
                    <div class="row">
                        <h3>Registrer en bestilling</h3>
                    </div>
             
                    <form class="form" action="createbookings.php" method="post">
                      
                      <div class="control-group <?php echo !empty($FromDateError)?'error':'';?>">
                        <label class="control-label">Fra dato</label>
                        <div class="controls">
                            <input name="FromDate" id="datepickerFrom" type="text"  placeholder="fra dato..." value="<?php echo !empty($FromDate)?$FromDate:'';?>">
                            <?php if (!empty($FromDateError)): ?>
                                <span class="help-inline"><?php echo $FromDateError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                          <div class="control-group <?php echo !empty($ToDateError)?'error':'';?>">
                        <label class="control-label">Til dato</label>
                        <div class="controls">
                            <input name="ToDate" id="datepickerTo" type="text" placeholder="Til dato..." value="<?php echo !empty($ToDate)?$ToDate:'';?>">
                            <?php if (!empty($ToDateError)): ?>
                                <span class="help-inline"><?php echo $ToDateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($HRIDError)?'error':'';?>">
                        <label class="control-label">HRID</label>
                        <div class="controls">
                            <input name="HRID" type="text"  placeholder="Velg hotellromID" value="<?php echo !empty($HRID)?$HRID:'';?>">
                            <?php if (!empty($HRIDError)): ?>
                                <span class="help-inline"><?php echo $HRIDError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($OrderIDError)?'error':'';?>">
                        <label class="control-label">Ordre ID</label>
                        <div class="controls">
                            <input name="OrderID" type="text"  placeholder="Velg ordre ID" value="<?php echo !empty($OrderID)?$OrderID:'';?>">
                            <?php if (!empty($OrderIDError)): ?>
                                <span class="help-inline"><?php echo $OrderIDError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Registrer</button>
                          <a class="btn" href="BookingsList.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
  <?php
    require_once("../../footer.html");
?> 
</html>
