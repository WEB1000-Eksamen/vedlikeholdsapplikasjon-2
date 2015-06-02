<?php
     
    require '../database.php';
    require_once("../../top.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        
         
        // keep track post values
        $CountryName = $_POST['CountryName'];
               
         
        // validate input
        $valid = true;
        if (empty($CountryName)) {
            $nameError = 'Please enter CountryName';
            $valid = false;
        }
         
                      
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO orders (CountryName) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($CountryName));
            Database::disconnect();
            header("Location: OrdersList.php");
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
                        <h3>Registrer en bestilling</h3>
                    </div>
             
                    <form class="form" action="createorder.php" method="post">
                      
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">CountryName</label>
                        <div class="controls">
                            <input name="CountryName" type="text"  placeholder="CountryName" value="<?php echo !empty($CountryName)?$CountryName:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                     
                     <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="OrdersList.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
  <?php
    require_once("../../footer.html");
?> 
</html>
