<?php
     
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $ReferenceError = null;
        $emailError = null;
        $Succsess = null;
        $Succsess = null;
        
         
        // keep track post values
        $Reference = $_POST['Reference'];
        $Email = $_POST['Email'];
        
         
        // validate input
        $valid = true;
         
        if (empty($Email)) {
            $emailError = 'Vennligst fyll inn Email';
            $valid = false;
        } else if ( !filter_var($Email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Ugyldig Email';
            $valid = false;
        }

        if (empty($Reference)) {
            $ReferenceError = 'Vennligst fyll inn Referanse';
            $valid = false;
        }  else if (!ctype_alnum($Reference)) {
            $ReferenceError = 'Ugyldig referanse';
            $valid = false;
        }

        if (strlen ($Reference) < 6 || strlen ($Reference) > 6) {
           $ReferenceError = 'Refferansen skal inneholde 6 tall/bokstaver';
           $valid = false;
        }

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM orders where Reference = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($Reference));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if( $q->rowCount() > 0 ) { 
          $ReferenceError = 'Refferansen er allerede registrert';
          $valid = false;
               }
        Database::disconnect();
         
              
        // insert data
        if ($valid) {
            $Succsess = 'Bestillingen ble registrert';
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO orders (Reference,Email) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($Reference,$Email));
            function make ($email) {
        return substr(md5($email), 0, 6);
    }
            Database::disconnect();
            //header("Location: OrdersList.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
  <!-- BOOTSTRAP STYLES-->
    <link href="../../AdminMenu/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../../AdminMenu/assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../../AdminMenu/assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link   href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


 <script>
  $(document).ready(function(){
    $("#txtFromDate").datepicker({
        minDate: 0,
        maxDate: "+60D",
        dateFormat: 'yy-mm-dd',
        numberOfMonths: 1,
        onSelect: function(selected) {
          $("#txtToDate").datepicker("option","minDate", selected)
        }
    });
    $("#txtToDate").datepicker({ 
        minDate: 0,
        maxDate:"+60D",
        dateFormat: 'yy-mm-dd',
        numberOfMonths: 1,
        onSelect: function(selected) {
           $("#txtFromDate").datepicker("option","maxDate", selected)
        }
    });  
});
  </script>
</head>
 
<body >
    <div class="background-image"></div>
    <div class="containers">
     
                <div class="container1">
                    <div class="row">
                        <h3>Registrer en bestilling</h3>
                    </div>
         
                    
                    <form class="form" action="createorder.php" method="post">
                      
                      <div class="control-group <?php echo !empty($ReferenceError)?'error':'';?>">
                        <label class="control-label">Referanse</label>
                        <div class="controls">
                            <input name="Reference" oninvalid="setCustomValidity('Vennligst fyll inn feltet riktig')" onkeyup="try{setCustomValidity('')}catch(e){}" pattern="[a-zA-Z0-9]{6}" required title="Skal inneholde 6 tegn" type="text"  placeholder="Reference" value="<?php echo !empty($Reference)?$Reference:'';?>">
                            <?php if (!empty($ReferenceError)): ?>
                                <span class="show text-danger"><?php echo $ReferenceError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email Addresse</label>
                        <div class="controls">
                            <input name="Email" oninvalid="setCustomValidity('Vennligst fyll inn feltet riktig')" onkeyup="try{setCustomValidity('')}catch(e){}"   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"   required title="Eks. ola@nordman.no"  type="text" placeholder="Email Address" value="<?php echo !empty($Email)?$Email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="show text-danger"><?php echo $emailError;?></span>
                            <?php endif;?>
                            <?php if (!empty($Succsess)): ?>
                                <span class="show text"><?php echo $Succsess;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      
                      

                      <div class="form-action">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="OrdersList.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
    <?php
    require_once("../../footer.html");
?> 
  </body>

</html>
