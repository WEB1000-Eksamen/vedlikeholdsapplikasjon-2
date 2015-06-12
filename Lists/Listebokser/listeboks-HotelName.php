<?php
    require_once("../../app/config/connect.php");
    $sqlSetning="SELECT * FROM hotels ORDER BY HotelName;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen"); 
    $antallRader=mysqli_num_rows($sqlResultat); 
    print("<select name='HotelName' id='HotelName'>"); 
    for ($r=1;$r<=$antallRader;$r++)
        {
            $rad=mysqli_fetch_array($sqlResultat);
            $HotelID=$rad["HotelID"];  
            $HotelName=$rad["HotelName"]; 
          
            print("<option value='$HotelID'>$HotelName </option>"); 
        }
    print("</select>"); 
?>