<?php
     
    require '../database.php';
    require_once("../../top.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $HotelNameError = null;
        $RoomtypeNameError = null;
        $RoomNumberError = null;
    
        
         
        // keep track post values
        $HotelName = $_POST['HotelName'];
        $RoomtypeName = $_POST['RoomtypeName'];
        $RoomNumber = $_POST['RoomNumber'];
       
      
         
        // validate input
        $valid = true;
       
        if (empty($HotelName)) {
            $HotelNameError = 'Venligts fyll inn romtypenavn';
            $valid = false;
        }else if (!ctype_alpha($HotelName)) {
            $HotelNameError = 'Ugyldig romtypenavn';
            $valid = false;
        }


        if (empty($RoomtypeName)) {
            $RoomtypeNameError = 'Venligts fyll inn antall Senger';
            $valid = false;
        }else if (ctype_alpha($RoomtypeName)) {
            $RoomtypeNameError = 'Ugyldig antall senger ';
            $valid = false;
        }

        if (empty($RoomNumber)||!ctype_digit($RoomNumber)) {
            $RoomNumberError = 'Venligts fyll inn pris';
            $valid = false;
        } 

      

         $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT HRID, HotelName, RoomtypeName, RoomNumber FROM hotelroomtypes INNER JOIN hotels ON hotelroomtypes.HRID = hotels.HotelID INNER JOIN roomtypes ON hotelroomtypes.HRID = roomtypes.RoomtypeID INNER JOIN rooms ON hotelroomtypes.HRID = rooms.RoomID where HRID = ? AND HotelName = ? AND HotelName = ? AND RoomNumber = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($HotelName,$RoomtypeName,$RoomNumber));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if( $q->rowCount() > 0 ) { 
          $HotelNameError = 'Romtypen er allerede registrert';
          $RoomtypeNameError = 'Romtypen er allerede registrert';
          $RoomNumberError = 'Romtypen er allerede registrert';
          $valid = false;
               }
        Database::disconnect();
              
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO hotelroomtypes (HotelName,RoomtypeName,RoomNumber) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($HotelName,$RoomtypeName,$RoomNumber));
            Database::disconnect();
            header("Location: HRTList.php");
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
                        <h3>Registrer ett nytt Hotelrom</h3>
                    </div>
             
                    <form class="form" action="createHRT.php" method="post">
                    

                        <div class="control-group <?php echo !empty($ImageIDError)?'error':'';?>">
                        <label class="control-label">Romnummer</label>
                        <div class="controls">
                            <?php require_once("../Listebokser/listeboks-Rooms.php"); ?>
                            <?php if (!empty($ImageIDError)): ?>
                                <span class="show text-danger"><?php echo $ImageIDError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($ImageIDError)?'error':'';?>">
                        <label class="control-label">Romtype</label>
                        <div class="controls">
                            <?php require_once("../Listebokser/listeboks-RoomtypesName.php"); ?>
                            <?php if (!empty($ImageIDError)): ?>
                                <span class="show text-danger"><?php echo $ImageIDError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($ImageIDError)?'error':'';?>">
                        <label class="control-label">Hotel</label>
                        <div class="controls">
                            <?php require_once("../Listebokser/listeboks-HotelName.php"); ?>
                            <?php if (!empty($ImageIDError)): ?>
                                <span class="show text-danger"><?php echo $ImageIDError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Registrer</button>
                          <a class="btn" href="HRTList.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
  <?php
    require_once("../../footer.html");
?> 
</html>