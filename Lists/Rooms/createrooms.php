<?php
     
    require '../database.php';
    require_once("../../top.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $NumberError = null;
       
        
         
        // keep track post values
        $RoomNumber = $_POST['RoomNumber'];
      
        // validate input
        $valid = true;
        if (empty($RoomNumber)) {
            $NumberError = 'Venligts fyll inn navn';
            $valid = false;
        }

      
              
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO rooms (RoomNumber) values(?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($RoomNumber));
            Database::disconnect();
            header("Location: RoomsList.php");
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
                        <h3>Registrer ett rom</h3>
                    </div>
             
                    <form class="form" action="createrooms.php" method="post">
                      
                      <div class="control-group <?php echo !empty($NumberError)?'error':'';?>">
                        <label class="control-label">Romnummer</label>
                        <div class="controls">
                            <input name="RoomNumber" type="text"  placeholder="F.eks 1" value="<?php echo !empty($RoomNumber)?$RoomNumber:'';?>">
                            <?php if (!empty($NumberError)): ?>
                                <span class="help-inline"><?php echo $NumberError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Registrer</button>
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
