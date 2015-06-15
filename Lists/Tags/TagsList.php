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
    
    <?php
        require_once("../../AdminMenu/Blank.html");
    ?> 
     <div id="page-inn">
    <div class="background-image"></div>
    <div class="container">
            <div class="row">
                <h3>Tags</h3>
            </div>
            
        <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Databasetabell <a href="createtags.php" class="btn btn-success" id="RegistButton">Registrer</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>LandID</th>
                                            <th>Tekst</th>
                                            <th>Hotel</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                   include '../database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM countries ORDER BY TagID DESC';
                   $sql = 'SELECT hoteltags.TagID, TagText, hotels.HotelName FROM hoteltags INNER JOIN hotels ON (hotels.hotelID = hoteltags.hotelID) INNER JOIN images ON (images.ImageID = hotels.ImageID) ORDER BY hotels.HotelID';
                   
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['TagID'] . '</td>';
                            echo '<td>'. $row['TagText'] . '</td>';
                            echo '<td>'. $row['HotelName'] . '</td>';
                         
                             echo '<td style="vertical-align: middle; text-align: center;" width=300>';
                                echo '<a class="btn btn-success" href="updatetags.php?TagID='.$row['TagID'].'">Oppdater</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deletetags.php?TagID='.$row['TagID'].'">Slett</a>';
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