<?php
    require '../database.php';
    require_once("../../AdminMenu/Blank.html");
    require_once '../../vendor/autoload.php';
    
    $client = new \Imgur\Client();
    $client->setOption('client_id', '99e41d31f15f2ea');
    $client->setOption('client_secret', 'fb1d34f57703390c133f72a81c9bf27f531d538e');
 
    $ImageID = null;
    if ( !empty($_GET['ImageID'])) {
        $ImageID = $_REQUEST['ImageID'];
    }
     
    if ( null==$ImageID ) {
        header("Location: ImagesList.php");
    }

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT URL FROM images where ImageID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($ImageID));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $oldimage = $data['URL'];
    Database::disconnect();
     
    // keep track validation errors
    $URL = null;

    if (!empty($_FILES['image']['name'])) {
         
        // keep track post values
        $URL = $_FILES['image'];

        // validate input
        $valid = true;
       
        if ($URL['error'] != 0) {
            $URLError = 'Vennligst velg et bilde';
            $valid = false;
        }
        $prod = true;
        // update data
        if ($valid && $prod) {
            $imgurImageOptions = array(
                'image' => base64_encode(file_get_contents($_FILES['image']['tmp_name'])),
                'type' => 'base64',
                'name' => $URL['tmp_name'],
                'title' => $URL['name'],
                'description' => md5($URL['tmp_name'])
            );
            $imgurURL = $client->api('image')->upload($imgurImageOptions);
            
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE images SET URL = ? WHERE ImageID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($imgurURL->getData()['link'], $ImageID));
            Database::disconnect();
            header('Location: ImagesList.php');
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfect Hotels Premium</title>
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
</head>
 
<body style="background: url(https://phgcdn.com/images/uploads/MLAEH/corporatemasthead/grand-hotel-excelsior_masthead.jpg) no-repeat; background-size: cover;">
    <div class="containers">
     
                <div class="container1">
                    <div class="row">
                        <h3>Oppdater bilde</h3>
                    </div>
             
                    <form class="form" enctype="multipart/form-data" action="updateImages.php?ImageID=<?php echo $ImageID?>" method="post">
                       <div class="control-group">
                        <label class="control-label">Gammelt bilde:</label>
                        <div class="controls">
                            <a width="250px" target="_blank" href="<?php echo $oldimage ?>"><img src="<?php echo $oldimage ?>"></a>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($URLError)?'error':'';?>">
                        <label class="control-label">Last opp nytt bilde:</label>
                        <div class="controls">
                            <div class="fargebildepad" id="fargebildepad">
                            <input name="image" type="file">
                            </div>
                            <?php if (!empty($URLError)): ?>
                                <span class="help-inline"><?php echo $URLError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="form-action">
                          <button type="submit" class="btn btn-success">Oppdater</button>
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