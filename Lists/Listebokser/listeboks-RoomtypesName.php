<?php
    require_once("../../app/config/connect.php");
    $sqlSetning="SELECT * FROM roomtypes ORDER BY RoomtypeName;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen"); 
    $antallRader=mysqli_num_rows($sqlResultat); 
    print("<select name='RoomtypeName' id='RoomtypeName'>"); 
    for ($r=1;$r<=$antallRader;$r++)
        {
            $rad=mysqli_fetch_array($sqlResultat); 
            $RoomtypeName=$rad["RoomtypeName"]; 
          
            print("<option value='$RoomtypeName'>$RoomtypeName </option>"); 
        }
    print("</select>"); 
?>