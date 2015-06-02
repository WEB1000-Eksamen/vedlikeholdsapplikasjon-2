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
                    <a href="createorder.php" class="btn btn-success">Registrer</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
					  <th>ID</th>
                      <th>Referanse</th>
                      <th>E-post</th>
                      <th>Valg</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include '../database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM orders ORDER BY OrderID DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
							
							echo '<td>'. $row['OrderID'] . '</td>';
                            echo '<td>'. $row['Reference'] . '</td>';
                            echo '<td>'. $row['Email'] . '</td>';
                            echo '<td width=250>';
                                echo '<a class="btn" href="readorder.php?OrderID='.$row['OrderID'].'">Se</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="updateorder.php?OrderID='.$row['OrderID'].'">Oppdater</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deleteorder.php?OrderID='.$row['OrderID'].'">Slett</a>';
                                echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
<?php
	@$endreStudentKnapp=$_POST ["endreStudentKnapp"];
    if ($endreStudentKnapp)
        {
            $brukernavn=$_POST ["brukernavn"];
            $fornavn=$_POST ["fornavn"];
            $etternavn=$_POST ["etternavn"];
            $klassekode=$_POST ["klassekode"];
            $bildenr=$_POST ["bildenr"];
            if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode)
                {
                    print ("Alle felt må fylles ut"); 
                }
            else
                {
                    $sqlSetning="UPDATE student SET fornavn='$fornavn', etternavn='$etternavn', klassekode='$klassekode', bildenr='$bildenr' WHERE brukernavn='$brukernavn';";
                    mysqli_query($db,$sqlSetning) or die ("ikke mulig å endre data i databasen");
                    print ("Studenten med brukernavn $brukernavn er nå endret<br />");
                }
        }
?>
  </body>
  <?php
    require_once("../../footer.html");
?> 
</html>
