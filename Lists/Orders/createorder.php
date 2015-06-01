<?php
     
    require '../database.php';
    require_once("../../top.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        
         
        // keep track post values
        $Reference = $_POST['Reference'];
        $Email = $_POST['Email'];
        
         
        // validate input
        $valid = true;
        if (empty($Reference)) {
            $nameError = 'Please enter Reference';
            $valid = false;
        }
         
        if (empty($Email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($Email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
              
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO orders (Reference,Email) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($Reference,$Email));
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
                        <label class="control-label">Reference</label>
                        <div class="controls">
                            <input name="Reference" type="text"  placeholder="Reference" value="<?php echo !empty($Reference)?$Reference:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="Email" type="text" placeholder="Email Address" value="<?php echo !empty($Email)?$Email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
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
