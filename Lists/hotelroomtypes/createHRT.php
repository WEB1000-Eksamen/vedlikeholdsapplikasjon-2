<?php
     
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $HotelNameError = null;
        $RoomtypeNameError = null;
        $RoomNumberError = null;
        $Succsess = null;
    
        
         
        // keep track post values
        $HotelName = $_POST['HotelName'];
        $RoomtypeName = $_POST['RoomtypeName'];
        $RoomNumber = $_POST['RoomNumber'];
       
      
         
        // validate input
        $valid = true;
       
        if (empty($HotelName)) {
            $HotelNameError = 'Venligts fyll inn romtypenavn';
            $valid = false;
        }


        if (empty($RoomtypeName)) {
            $RoomtypeNameError = 'Venligts fyll inn antall Senger';
            $valid = false;
        }

        if (empty($RoomNumber)||!ctype_digit($RoomNumber)) {
            $RoomNumberError = 'Venligts fyll inn pris';
            $valid = false;
        } 

      

         $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM hotelroomtypes where HotelID = ? AND RoomtypeID = ? AND RoomID = ?";
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
            $Succsess = 'Hotelromet ble registrert';
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO hotelroomtypes (HotelID,RoomtypeID,RoomID) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($HotelName,$RoomtypeName,$RoomNumber));
            Database::disconnect();
            //header("Location: HRTList.php");
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
    <link   href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>
 
<body >
    <div class="background-image"></div>
    <div class="containers">
     
                <div class="container1">
                    <div class="ro">
                        <h3>Registrer ett nytt hotelrom</h3>
                    </div>
             
                    <form class="form" action="createHRT.php" method="post">
                    

                        <div class="control-group <?php echo !empty($RoomNumberError)?'error':'';?>">
                        <label class="control-label">Romnummer</label>
                        <div class="controls">
                            <?php require_once("../Listebokser/listeboks-Rooms.php"); ?>
                            <?php if (!empty($RoomNumberError)): ?>
                                <span class="show text-danger"><?php echo $RoomNumberError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($RoomtypeNameError)?'error':'';?>">
                        <label class="control-label">Romtype</label>
                        <div class="controls">
                            <?php require_once("../Listebokser/listeboks-RoomtypesName.php"); ?>
                            <?php if (!empty($RoomtypeNameError)): ?>
                                <span class="show text-danger"><?php echo $RoomtypeNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($HotelNameError)?'error':'';?>">
                        <label class="control-label">Hotel</label>
                        <div class="controls">
                            <?php require_once("../Listebokser/listeboks-HotelName.php"); ?>
                            <?php if (!empty($HotelNameError)): ?>
                                <span class="show text-danger"><?php echo $HotelNameError;?></span>
                            <?php endif; ?>
                            <?php if (!empty($Succsess)): ?>
                                <span class="show text"><?php echo $Succsess;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="form-action">
                          <button type="submit" class="btn btn-success">Registrer</button>
                          <a class="btn" href="HRTList.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
     <?php
    require_once("../../footer.html");
?>
