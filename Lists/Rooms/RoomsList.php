<?php
    require_once("../../AdminMenu/Blank.html");
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
  <div id="page-inn">
    <div class="content">
    <div class="container">
             <h3>Rom</h3>
             
        <!-- Advanced Tables -->
                    <div class="panel panel-default">

                         <div class="row">
               
            </div>
                        <div class="panel-heading">
                             Databasetabell  <a href="createrooms.php" class="btn btn-success" id="RegistButton">Registrer</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>RomID</th>
                                            <th>Romnummer</th>
                                            <th>Valg</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                   include '../database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM rooms ORDER BY RoomID DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['RoomID'] . '</td>';
                            echo '<td>'. $row['RoomNumber'] . '</td>';
                            echo '<td style="vertical-align: middle; text-align: center;" width=300>';
                              
                                echo '<a class="btn btn-success" href="updaterooms.php?RoomID='.$row['RoomID'].'">Oppdater</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deleterooms.php?RoomID='.$row['RoomID'].'">Slett</a>';
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
     </div>
     <?php
    require_once("../../footer.html");
?> 
  </body>
</html>