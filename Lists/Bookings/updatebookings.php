<?php
    require '../database.php';
    require_once("../../top.html");
 
    $RoomID = null;
    if ( !empty($_GET['RoomID'])) {
        $RoomID = $_REQUEST['RoomID'];
    }
     
    if ( null==$RoomID ) {
        header("Location: RoomsList.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $RoomNumberError = null;
       
         
        // keep track post values
        $RoomNumber = $_POST['RoomNumber'];
      
        // validate input
        $valid = true;
       
        if (empty($RoomNumber)) {
            $RoomNumberError = 'Venligst fyll inn rumnummer';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE rooms set RoomNumber = ? WHERE RoomID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($RoomNumber,$RoomID));
            Database::disconnect();
            header("Location: RoomsList.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM rooms where RoomID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($RoomID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $RoomNumber = $data['RoomNumber'];
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
                        <h3>Oppdater romtype</h3>
                    </div>
             
                    <form class="form" action="updaterooms.php?RoomID=<?php echo $RoomID?>" method="post">
                      

                      <div class="control-group <?php echo !empty($RoomNumberError)?'error':'';?>">
                        <label class="control-label">Romnummer</label>
                        <div class="controls">
                            <input name="RoomNumber" type="text"  placeholder="RoomNumber" value="<?php echo !empty($RoomNumber)?$RoomNumber:'';?>">
                            <?php if (!empty($RoomNumberError)): ?>
                                <span class="help-inline"><?php echo $RoomNumberError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                         



                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Oppdater</button>
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