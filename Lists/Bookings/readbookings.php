<?php
    require '../database.php';
    require_once("../../top.html");
    $BookingID = null;
    if ( !empty($_GET['BookingID'])) {
        $BookingID = $_REQUEST['BookingID'];
    }
     
    if ( null==$BookingID ) {
        header("Location: BookingsList.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM bookings where BookingID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($BookingID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../assets/css/stylesheet.css">
    <script src="../js/bootstrap.min.js"></script>
</head>
 
<body style="background: url(https://phgcdn.com/images/uploads/MLAEH/corporatemasthead/grand-hotel-excelsior_masthead.jpg) no-repeat; background-size: cover;">
    <div class="containers">
     
                <div class="container1">
                    <div class="row">
                        <h3>Valgt hotell</h3>
                    </div>
                     
                    <form class="form" action="updatebookings.php?BookingID=<?php echo $BookingID?>" method="post">


                      <div class="control-group">
                        <label class="control-label">HotellID</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['BookingID'];?>
                            </label>
                        </div>
                      </div>

                       <div class="control-group">
                        <label class="control-label">Hotellnavn</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['FromDate'];?>
                            </label>
                        </div>
                      </div>
                      
                      <div class="control-group">
                        <label class="control-label">Land ID</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['ToDate'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">ImageID</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['HRID'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Beskrivelse</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['OrderID'];?>
                            </label>
                        </div>
                      </div>
                           <div class="form-actions">
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
