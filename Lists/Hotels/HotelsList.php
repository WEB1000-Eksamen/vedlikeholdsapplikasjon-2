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
                <h3>Hotell register</h3>
            </div>
            <div class="row">
                <p>
                    <a href="createhotels.php" class="btn btn-success">Registrer</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                     <th>ID</th>
                      <th>Hotellnavn</th>
                      <th>LandID</th>
                      <th>BildeID</th>
                      <th>Beskrivelse</th>
                      <th>Adresse</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include '../database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM Hotels ORDER BY HotelID DESC';
                   foreach ($pdo->query($sql) as $row) {
                     $ellipsis = (strlen($row['Description']) >= 30) ? '...' : '';
                            echo '<tr>';
                            echo '<td>'. $row['HotelID'] . '</td>';
                            echo '<td>'. $row['HotelName'] . '</td>';
                            echo '<td>'. $row['CountryID'] . '</td>';
                           echo '<td>'. $row['ImageID'] . '</td>';
                         
                            echo '<td>'. substr($row['Description'], 0, 30) . $ellipsis . '</td>';
                            echo '<td>'. $row['Address'] . '</td>';
                            echo '<td width=300>';
                                echo '<a class="btn" href="readhotels.php?HotelID='.$row['HotelID'].'">Se</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="updatehotels.php?HotelID='.$row['HotelID'].'">Oppdater</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deletehotels.php?HotelID='.$row['HotelID'].'">Slett</a>';
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