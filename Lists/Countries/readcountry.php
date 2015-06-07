<?php
    require '../database.php';
    require_once("../../top.html");
    $OrderID = null;
    if ( !empty($_GET['OrderID'])) {
        $OrderID = $_REQUEST['OrderID'];
    }
     
    if ( null==$OrderID ) {
        header("Location: OrdersList.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM orders where OrderID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($OrderID));
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
                        <h3>Du ser på</h3>
                    </div>
                     
                    <form class="form" action="updateorder.php?OrderID=<?php echo $OrderID?>" method="post">


                      <div class="control-group">
                        <label class="control-label">Referanse</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Reference'];?>
                            </label>
                        </div>
                      </div>
                      
                      <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Email'];?>
                            </label>
                        </div>
                      </div>
                      
                        <div class="form-actions">
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
