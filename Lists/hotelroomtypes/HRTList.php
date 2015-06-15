<?php
    require_once("../../AdminMenu/Blank.html");
?> 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pefect Hotels Premium</title>
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
    
</head>
 
<body >
   <div id="page-inn">
    <div class="container">
            <div class="row">
                <h3>Hotelrom</h3>
            </div>
        <!-- Advanced Tables -->
                    <div class="panel panel-default" id="ListWindow">
                        <div class="panel-heading">
                             Databasetabell <a href="createHRT.php" class="btn btn-success" id="RegistButton">Registrer</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                   $sql = 'SELECT hotelroomtypes.HRID, hotels.HotelName, roomtypes.RoomtypeName, rooms.RoomNumber FROM hotelroomtypes INNER JOIN hotels ON (hotels.HotelID = hotelroomtypes.HotelID) INNER JOIN roomtypes ON (roomtypes.RoomtypeID = hotelroomtypes.RoomtypeID) INNER JOIN rooms ON (rooms.RoomID = hotelroomtypes.RoomID) ORDER BY hotelroomtypes.HRID';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                           echo '<td>'. $row['HRID'] . '</td>';
                            echo '<td>'. $row['HotelName'] . '</td>';    
                            echo '<td>'. $row['RoomtypeName'] . '</td>';
                            echo '<td>'. $row['RoomNumber'] . '</td>';   
                             echo '<td style="vertical-align: middle; text-align: center;" width=300>';
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
                             </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
    </div> <!-- /container -->
      
 <?php
    require_once("../../footer.html");
?> 
  </body>
</html>