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
                <h3>Romtyperegister</h3>
            </div>
            <div class="row">
                <p>
                    <a href="createHRT.php" class="btn btn-success">Registrer</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                     <th>ID</th>
                      <th>Hotell</th>
                      <th>Romtype</th>
                      <th>Romnummer</th>
                      <th>Valg</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include '../database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT HRID, HotelName, RoomtypeName, RoomNumber FROM hotelroomtypes INNER JOIN hotels ON hotelroomtypes.HRID = hotels.HotelID INNER JOIN roomtypes ON hotelroomtypes.HRID = roomtypes.RoomtypeID INNER JOIN rooms ON hotelroomtypes.HRID = rooms.RoomID ORDER BY HRID DESC';
   

                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['HRID'] . '</td>';
                            echo '<td>'. $row['HotelName'] . '</td>';    
                            echo '<td>'. $row['RoomtypeName'] . '</td>';
                            echo '<td>'. $row['RoomNumber'] . '</td>';   
    
                            echo '<td width=250>';
                               
                                echo '<a class="btn btn-success" href="updateHRT.php?HRID='.$row['HRID'].'">Oppdater</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deleteHRT.php?HRID='.$row['HRID'].'">Slett</a>';
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