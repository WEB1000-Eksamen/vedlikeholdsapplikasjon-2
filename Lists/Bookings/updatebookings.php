<?php
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
 
    $BookingID = null;
    if ( !empty($_GET['BookingID'])) {
        $BookingID = $_REQUEST['BookingID'];
    }
     
    if ( null==$BookingID ) {
        header("Location: RoomsList.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
         $datepickerError = null;
         $datepickertoError = null;
        $HRIDError = null;
        $OrderIDError = null;
   
       
         
        // keep track post values
         $datepicker = $_POST['From'];
         $datepickerto = $_POST['To'];
        $HRID = $_POST['HRID'];
        $OrderID = $_POST['OrderID'];
      
        // validate input
        $valid = true;
       
       if (empty( $datepicker)) {
             $datepickerError = 'Venligst fyll inn Hotellnavn';
            $valid = false;
        }
         
           if (empty( $datepickerto)) {
             $datepickerError = 'Venligst velg LandID';
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
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE bookings set bookings.From = ?, bookings.To = ?, HRID = ?, OrderID = ? WHERE BookingID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($datepicker,$datepickerto,$HRID,$OrderID,$BookingID));
            Database::disconnect();
            header("Location: BookingsList.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM bookings where BookingID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($BookingID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $datepicker = $data['From'];
        $datepickerto = $data['To'];
        $HRID = $data['HRID'];
        $OrderID = $data['OrderID'];
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
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
    
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <script>
  $(document).ready(function(){
    $("#txtFromDate").datepicker({
        minDate: 0,
        maxDate: "+60D",
        dateFormat: 'yy-mm-dd',
        numberOfMonths: 1,
        onSelect: function(selected) {
          $("#txtToDate").datepicker("option","minDate", selected)
        }
    });
    $("#txtToDate").datepicker({ 
        minDate: 0,
        maxDate:"+60D",
        dateFormat: 'yy-mm-dd',
        numberOfMonths: 1,
        onSelect: function(selected) {
           $("#txtFromDate").datepicker("option","maxDate", selected)
        }
    });  
});
  </script>
  
</head>
 
<body>
  <div class="background-image"></div>
    <div class="containers">
     
                <div class="container1">
                    <div class="row">
                        <h3>Oppdater romtype</h3>
                    </div>
             
                    <form class="form" action="updatebookings.php?BookingID=<?php echo $BookingID?>" method="post">
                      
                    <div class="control-group <?php echo !empty( $datepickerError)?'error':'';?>">
                        <label class="control-label">Fra dato</label>
                        <div class="controls">
                            <input name="From" id="txtFromDate" type="text" readonly  placeholder="fra dato..." value="<?php echo !empty( $datepicker)? $datepicker:'';?>"><?php if (!empty( $datepickerError)): ?>
                                <span class="help-inline"><?php echo  $datepickerError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                          <div class="control-group <?php echo !empty( $datepickertoError)?'error':'';?>">
                        <label class="control-label">Til dato</label>
                        <div class="controls">
                            <input name="To" id="txtToDate" type="text" readonly placeholder="Til dato..." value="<?php echo !empty( $datepicker)? $datepicker:'';?>">
                            <?php if (!empty( $datepickertoError)): ?>
                                <span class="help-inline"><?php echo  $datepickertoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($HRIDError)?'error':'';?>">
                        <label class="control-label">Hotelrom ID</label>
                        <div class="controls">
                             <?php require_once("../Listebokser/listeboks-BookingsID.php"); ?>
                            <?php if (!empty($HRIDError)): ?>
                                <span class="help-inline"><?php echo $HRIDError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($OrderIDError)?'error':'';?>">
                        <label class="control-label">Referanse</label>
                        <div class="controls">
                            <?php require_once("../Listebokser/listeboks-OrderID.php"); ?>
                            <?php if (!empty($OrderIDError)): ?>
                                <span class="help-inline"><?php echo $OrderIDError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                         



                      <div class="form-action">
                          <button type="submit" class="btn btn-success">Oppdater</button>
                          <a class="btn" href="BookingsList.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
    <?php
    require_once("../../footer.html");
?> 
  </body> 

</html>