<?php
    require '../database.php';
    require_once("../../top.html");
    $RoomID = null;
    if ( !empty($_GET['RoomID'])) {
        $RoomID = $_REQUEST['RoomID'];
    }
     
    if ( null==$RoomID ) {
        header("Location: RoomsList.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Rooms where RoomID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($RoomID));
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
                     
                    <form class="form" action="updaterooms.php?RoomID=<?php echo $RoomID?>" method="post">


                      <div class="control-group">
                        <label class="control-label">ID</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['RoomID'];?>
                            </label>
                        </div>
                      </div>

                       <div class="control-group">
                        <label class="control-label">Romnummer</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['RoomNumber'];?>
                            </label>
                        </div>
                      </div>
                      
                      
                        <div class="form-actions">
                          <a class="btn" href="RoomsList.php">Tilbake</a>
                       </div>
                     
                      
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
  <?php
    require_once("../../footer.html");
?> 
</html>
