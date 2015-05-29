<?php
    require_once '../Roomtype.php';
    session_start();
    if (!isset($_SESSION['roomtype']) || isset($_SESSION['roomtype']) && $_SESSION['roomtype'] == false) {
        header("Location: ../../../login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administrasjon</title>
    <link rel="stylesheet" type="text/css" href="../../../stylesheet.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <section id="administer_users">
        <header>
            <h1 class="">Database lister</h1>
        </header>
        <a href="../../../index.php" class="float-right back">Gå til forsiden</a>
        
		<h2>Romtyper</h2>
        <table>
            <thead>
                <tr>
                    <th>Romtype</th>
                    <th>Senger</th>
                    <th>Pris</th>
                    <th>Bilde</th>
                </tr>
            </thead>
			       
			<tbody>
                <?php
                    $roomtypes = new roomtype('', '');
                    $allroomtypes = $roomtypes->get();
                    foreach ($allRoomtypes as $key => $value) {
                      echo "<tr>";
					    echo "<td><input type='text' value='{$value['RoomtypeName']}' id='RoomtypeName' name='RoomtypeName' required onFocus='fokus(this)' onBlur='mistetFokus(this)' onMouseOver='musInn(this)' onMouseOut='musUt()'/></td>";
                        echo "<td><input type='text' value='{$value['Beds']}' id='Beds' name='Beds' required onFocus='fokus(this)' onBlur='mistetFokus(this)' onMouseOver='musInn(this)' onMouseOut='musUt()'/></td>";
					    echo "<td><input type='text' value='{$value['Price']}' id='Price' name='Price' required onFocus='fokus(this)' onBlur='mistetFokus(this)' onMouseOver='musInn(this)' onMouseOut='musUt()'/></td>";
                        echo "<td><input type='text' value='{$value['ImageID']}' id='ImageID' name='ImageID' required onFocus='fokus(this)' onBlur='mistetFokus(this)' onMouseOver='musInn(this)' onMouseOut='musUt()'/></td>";
					    echo "<td><input type='submit' value='Slett' id='SlettKnapp' name='SlettKnapp' /></td>";
					    echo "<td><input type='submit' value='Endre' id='Endreknapp' name='EndreKnapp' /></td>";
					  echo "</tr>";
                    }
                ?>
            </tbody>
	   </table>

    </section>
</body>
</html>