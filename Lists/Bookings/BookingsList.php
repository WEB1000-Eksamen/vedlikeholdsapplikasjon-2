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
    
    <script src="../js/bootstrap.min.js"></script>
</head>
 
<body >
    <div class="background-image"></div>
    <div class="container">
            <div class="row">
                <h3>Land</h3>
            </div>
            
         <p>
                    <a href="createbookings.php" class="btn btn-success">Registrer</a>
                </p>
        <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Databasetabell
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                      <th>BookingID</th>
                      <th>Fra dato</th>
                      <th>Til dato</th>
                      <th>HotelromID</th>
                      <th>OrderID</th>
                      <th>Valg</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                   include '../database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM Bookings ORDER BY BookingID DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['BookingID'] . '</td>';
                            echo '<td>'. $row['FromDate'] . '</td>';
                            echo '<td>'. $row['ToDate'] . '</td>';
                            echo '<td>'. $row['HRID'] . '</td>';
                            echo '<td>'. $row['OrderID'] . '</td>';
                            echo '<td width=250>';
                               
                                echo '<a class="btn btn-success" href="updatebookings.php?BookingID='.$row['BookingID'].'">Oppdater</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deletebookings.php?BookingID='.$row['BookingID'].'">Slett</a>';
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
                    <!--End Advanced Tables -->
    </div> <!-- /container -->
      
 <?php
    require_once("../../footer.html");
?> 
  </body>
</html>