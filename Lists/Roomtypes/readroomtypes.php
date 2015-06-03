<?php
    require '../database.php';
    require_once("../../top.html");
    $RoomtypeID = null;
    if ( !empty($_GET['RoomtypeID'])) {
        $RoomtypeID = $_REQUEST['RoomtypeID'];
    }
     
    if ( null==$RoomtypeID ) {
        header("Location: RoomtypesList.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM roomtypes where RoomtypeID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($RoomtypeID));
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
                        <h3>Valgt romtype</h3>
                    </div>
                     
                    <form class="form" action="updateorder.php?RoomtypeID=<?php echo $RoomtypeID?>" method="post">


                      <div class="control-group">
                        <label class="control-label">Navn</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['RoomtypeName'];?>
                            </label>
                        </div>
                      </div>

                       <div class="control-group">
                        <label class="control-label">Senger</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Beds'];?>
                            </label>
                        </div>
                      </div>
                      
                      <div class="control-group">
                        <label class="control-label">Pris</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Price'];?>
                            </label>
                        </div>
                      </div>
                      
                        <div class="form-actions">
                          <a class="btn" href="RoomtypesList.php">Tilbake</a>
                       </div>
                     
                      
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
  <?php
    require_once("../../footer.html");
?> 
</html>