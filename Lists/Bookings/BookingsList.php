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
                <h3>Rom-register</h3>
            </div>
            <div class="row">
                <p>
                    <a href="createbookings.php" class="btn btn-success">Registrer</a>
                </p>
                <table class="table table-striped table-bordered">
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
                                echo '<a class="btn" href="readbookings.php?BookingID='.$row['BookingID'].'">Se</a>';
                                echo ' ';
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
    </div> <!-- /container -->
  </body>
  <?php
    require_once("../../footer.html");
?> 
</html>