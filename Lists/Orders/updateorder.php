<?php
    require '../database.php';
    require_once("../../top.html");
 
    $OrderID = null;
    if ( !empty($_GET['OrderID'])) {
        $OrderID = $_REQUEST['OrderID'];
    }
     
    if ( null==$OrderID ) {
        header("Location: OrdersList.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $ReferenceError = null;
        $EmailError = null;
         
        // keep track post values
        $Reference = $_POST['Reference'];
        $Email = $_POST['Email'];
         
        // validate input
        $valid = true;
       
       if (empty($Reference)||!ctype_alnum($Reference)) {
            $ReferenceError = 'Venligst fyll inn Referanse';
            $valid = false;
        }
         
        if (empty($Email)) {
            $EmailError = 'Venligst fyll inn Email';
            $valid = false;
        } else if ( !filter_var($Email,FILTER_VALIDATE_EMAIL) ) {
            $EmailError = 'Ugyldig Email';
            $valid = false;
        }
         
      
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE orders set Reference = ?, Email = ? WHERE OrderID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($Reference,$Email,$OrderID));
            Database::disconnect();
            header("Location: OrdersList.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM orders where OrderID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($OrderID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $Reference = $data['Reference'];
        $Email = $data['Email'];
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
                        <h3>Oppdater Bestilling</h3>
                    </div>
             
                    <form class="form" action="updateorder.php?OrderID=<?php echo $OrderID?>" method="post">
                      

                      <div class="control-group <?php echo !empty($ReferenceError)?'error':'';?>">
                        <label class="control-label">Referanse</label>
                        <div class="controls">
                            <input name="Reference" type="text"  placeholder="Reference" value="<?php echo !empty($Reference)?$Reference:'';?>">
                            <?php if (!empty($ReferenceError)): ?>
                                <span class="help-inline"><?php echo $ReferenceError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                          <div class="control-group <?php echo !empty($EmailError)?'error':'';?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="Email" type="text" placeholder="Email Address" value="<?php echo !empty($Email)?$Email:'';?>">
                            <?php if (!empty($EmailError)): ?>
                                <span class="help-inline"><?php echo $EmailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Oppdater</button>
                          <a class="btn" href="OrdersList.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
<?php
    require_once("../../footer.html");
?> 

</html>