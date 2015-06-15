<?php
    require_once("../../app/config/connect.php");
    $sqlSetning="SELECT * FROM orders ORDER BY OrderID;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen"); 
    $antallRader=mysqli_num_rows($sqlResultat); 
    print("<select name='OrderID' id='OrderID'>"); 
    for ($r=1;$r<=$antallRader;$r++)
        {
            $rad=mysqli_fetch_array($sqlResultat); 
            $OrderID=$rad["OrderID"];
            $Reference=$rad["Reference"]; 
          
            print("<option value='$OrderID'>$Reference </option>"); 
        }
    print("</select>"); 
?>