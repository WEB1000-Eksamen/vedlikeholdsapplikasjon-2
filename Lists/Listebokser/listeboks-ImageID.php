<?php
    require_once("../../app/config/connect.php");
    $sqlSetning="SELECT * FROM images ORDER BY ImageID;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen"); 
    $antallRader=mysqli_num_rows($sqlResultat); 
    print("<select name='ImageID' id='ImageID'>"); 
    for ($r=1;$r<=$antallRader;$r++)
        {
            $rad=mysqli_fetch_array($sqlResultat); 
            $ImageID=$rad["ImageID"];
            $ImageName=$rad["ImageName"];  
          
            print("<option value='$ImageID'>$ImageName </option>"); 
        }
    print("</select>"); 
?>