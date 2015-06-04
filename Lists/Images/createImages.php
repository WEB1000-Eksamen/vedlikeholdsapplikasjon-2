<?php
     
    require '../database.php';
    require_once("../../top.html");
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
            $sql = "INSERT INTO images (URL) values (?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($imgurURL->getData()['link']));
            Database::disconnect();
           header("Location: ImagesList.php");
        }
    } else {
        $ImageError = 'Vennligst velg et bilde';
        $valid = false;
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
                        <h3>Registrer et bilde</h3>
                    </div>
             
                    <form class="form" enctype="multipart/form-data" action="createImages.php" method="post">
                      
                      <div class="control-group <?php echo !empty($ImageError)?'error':'';?>">
                        <label class="control-label">Navn</label>
                        <div class="controls">
                            <input name="image" type="file">
                            <?php if (!empty($ImageError)): ?>
                                <span class="help-inline"><?php echo $ImageError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-actions">
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
