<?php
     
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
    require_once '../../vendor/autoload.php';
    
    $client = new \Imgur\Client();
    $client->setOption('client_id', '99e41d31f15f2ea');
    $client->setOption('client_secret', 'fb1d34f57703390c133f72a81c9bf27f531d538e');
 
    

    // keep track validation errors
    $ImageError = null;
   

    // validate input
    $valid = true;

    if ( !empty($_FILES['image']['name'])) {  
        // insert data
        if ($valid) {
            $imgurImageOptions = array(
                'image' => base64_encode(file_get_contents($_FILES['image']['tmp_name'])),
                'type' => 'base64',
                'name' => $_FILES['image']['tmp_name'],
                'title' => $_FILES['image']['name'],
                'description' => md5($_FILES['image']['tmp_name'])
            );
            $imgurURL = $client->api('image')->upload($imgurImageOptions);
            
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO images (URL,ImageName) values (?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($imgurURL->getData()['link'],$_FILES['image']['name']));
            Database::disconnect();
           header("Location: ImagesList.php");
        }
    } else {
        $ImageError = 'Vennligst velg et bilde';
        $valid = false;
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfect Hotels Premium</title>
  <!-- BOOTSTRAP STYLES-->
    <link href="../../AdminMenu/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../../AdminMenu/assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
   
        <!-- CUSTOM STYLES-->
    <link href="../../AdminMenu/assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="../../AdminMenu/assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
   <link   href="../css/bootstrap.min.css" rel="stylesheet">
    
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>
    <div class="background-image"></div>
    <div class="containers">
     
                <div class="container1">
                    <div class="row">
                        <h3>Registrer et bilde</h3>
                    </div>
             
                    <form class="form" enctype="multipart/form-data" action="createImages.php" method="post">
                      
                      <div class="control-group <?php echo !empty($ImageError)?'error':'';?>">
                        <label class="control-label">Navn</label>
                        <div class="controls">
                            <div class="fargebildepad" id="fargebildepad">
                            <input name="image" type="file" id="file">
                        </div>
                            <?php if (!empty($ImageError)): ?>
                                <span class="help-inline"><?php echo $ImageError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="form-action">
                          <button type="submit" class="btn btn-success">Registrer</button>
                          <a class="btn" href="ImagesList.php">Tilbake</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
  <?php
    require_once("../../footer.html");
?> 
</html>
