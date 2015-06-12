<?php
    require_once("../../app/config/connect.php");
    $sqlSetning="SELECT * FROM rooms ORDER BY RoomNumber;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen"); 
    $antallRader=mysqli_num_rows($sqlResultat); 
    print("<select name='RoomNumber' id='RoomNumber'>"); 
    for ($r=1;$r<=$antallRader;$r++)
        {
            $rad=mysqli_fetch_array($sqlResultat); 
            $RoomID=$rad["RoomID"]; 
            $RoomNumber=$rad["RoomNumber"]; 
          
            print("<option value='$RoomID'>$RoomNumber </option>"); 
        }
    print("</select>"); 
?>