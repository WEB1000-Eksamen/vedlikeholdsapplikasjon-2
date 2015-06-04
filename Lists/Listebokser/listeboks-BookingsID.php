<?php
    require_once("../../app/config/connect.php");
    $sqlSetning="SELECT * FROM hotelroomtypes ORDER BY HRID;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen"); 
    $antallRader=mysqli_num_rows($sqlResultat); 
    print("<select name='HRID' id='HRID'>"); 
    for ($r=1;$r<=$antallRader;$r++)
        {
            $rad=mysqli_fetch_array($sqlResultat); 
            $HRID=$rad["HRID"]; 
          
            print("<option value='$HRID'>$HRID </option>"); 
        }
    print("</select>"); 
?>