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
                <h3>Bestillings register</h3>
            </div>
            <div class="row">
                <p>
                    <a href="createroomtypes.php" class="btn btn-success">Registrer</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                     <th>ID</th>
                      <th>Navn</th>
                      <th>Senger</th>
                      <th>BildeID</th>
                      <th>Pris</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include '../database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM roomtypes ORDER BY RoomtypeID DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['RoomtypeID'] . '</td>';
                            echo '<td>'. $row['RoomtypeName'] . '</td>';
                            echo '<td>'. $row['Beds'] . '</td>';
                             echo '<td>'. $row['Price'] . '</td>';
                            echo '<td>'. $row['ImageID'] . '</td>';
                            echo '<td width=250>';
                                echo '<a class="btn" href="readroomtype.php?RoomtypeID='.$row['RoomtypeID'].'">Se</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="updateroomtype.php?RoomtypeID='.$row['RoomtypeID'].'">Oppdater</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deleteroomtype.php?RoomtypeID='.$row['RoomtypeID'].'">Slett</a>';
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