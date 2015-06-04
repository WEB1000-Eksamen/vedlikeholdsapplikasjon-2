<?php
    require_once("../../top.html");
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
    <div class="container">
            <div class="row">
                <h3>Bilderegister</h3>
            </div>
            <div class="row">
                <p>
                    <a href="createimages.php" class="btn btn-success">Registrer</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                     <th>ID</th>
                      <th>URL</th>
                      <th>Valg</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include '../database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM images ORDER BY ImageID DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td style="vertical-align: middle; text-align: center;">'. $row['ImageID'] . '</td>';
                            echo '<td><a target="_blank" href="' . $row['URL'] . '"><img width="250px" src="' . $row['URL'] . '"></a></td>';
                            echo '<td style="vertical-align: middle; text-align: center;" width=300>';
                                echo '<a class="btn btn-success" href="updateImages.php?ImageID='.$row['ImageID'].'">Oppdater</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deleteImages.php?ImageID='.$row['ImageID'].'">Slett</a>';
                                echo '</td>';
                            echo '</tr>';

                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
  <?php
    require_once("../../footer.html");
?> 
</html>