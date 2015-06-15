<?php
    require_once("../../app/config/connect.php");
    $sqlSetning="SELECT * FROM countries ORDER BY CountryID;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen"); 
    $antallRader=mysqli_num_rows($sqlResultat); 
    print("<select name='CountryID' id='CountryID'>"); 
    for ($r=1;$r<=$antallRader;$r++)
        {
            $rad=mysqli_fetch_array($sqlResultat); 
            $CountryID=$rad["CountryID"];
            $CountryName=$rad["CountryName"];  
          
            print("<option value='$CountryID'>$CountryName </option>"); 
        }
    print("</select>"); 
?>