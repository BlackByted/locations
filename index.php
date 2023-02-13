<?php
    $location=array(['20.6700645','-103.3583318'],['20.667243','-103.4181015'],['20.6747226','-103.355644'],['20.6744808','-103.3600858']);

    if (isset($_GET["lat"]) && isset($_GET["long"])){
        $lat = $_GET["lat"];
        $long = $_GET["long"];
        array_push($location,[$lat,$long]);
    }

    function cp($position,$location)
    {
        $data = shell_exec("py locations.py ".$location[$position][0]." ".$location[$position][1]);
        return $data;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Location</title>
    <script>
        function showLocation(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            window.location.href = window.location.href + "?lat=" + latitude + "&long=" + longitude;
        }
        function error(errorCode)
		{
			if(errorCode.code == 1)
				alert("No has permitido buscar tu localizacion")
			else if (errorCode.code==2)
				alert("Posicion no disponible")
			else
				alert("Ha ocurrido un error")
		}
        function getLocation() {
            if(navigator.geolocation) {
            // timeout at 60000 milliseconds (60 seconds)
            var options = {timeout:60000};
            navigator.geolocation.getCurrentPosition(showLocation, error, options);
            } else {
            alert("Sorry, browser does not support geolocation!");
            }
        }
    </script>
</head>

<body>
    <div class="center">
        <div>
            <button class="button-3" role="button" onclick = "getLocation();">LOCATION NOW</button>
        </div>
        <div class="objects">
            <label for="Location">Locations</label>
            <table align="center">
                <tr>
                    <th>Latitud</th>
                    <th>Longitud</th>
                    <th>CP</th>
                </tr>
                <?php
                for ($i=0; $i < sizeof($location); $i++) { 
                    echo '<tr><td>'. $location[$i][0] .'</td> <td>'. $location[$i][1] .'</td><td>'. cp($i,$location) .'</td></tr>';
                }
                ?>
            </table>
        </div>
    </div>
    
</body>
</html>
