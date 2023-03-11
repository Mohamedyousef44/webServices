<?php

require_once('./functions.php');

$city_details = getWeatherDataCurl($_GET['cities']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Weather App</title>
</head>
<body>

    <div class= "container">

        <div class="weatherData">

            <p> <?php echo date("l j F  h:i A") ?> </p>
            <h2><?php echo ($city_details['name'].",".$city_details['sys']['country']) ?></h2>
            <h2> <?php echo "Temp : ".$city_details['main']['temp']." C" ?></h2>
            <h2> <?php echo "Humidity : ".$city_details['main']['humidity']."%" ?></h2>
            <h2> <?php echo "Wind : ".$city_details['wind']['speed']."km/h" ?></h2>

        </div>

        <form action="./index.php">

            <div class="formContainer">

                <label for="cities">Choose a City:</label>
                <select name="cities">

                    <?php
                    $cities = filterCities('EG'); 
                    foreach($cities as $city){?>
                    <option value="<?php echo($city['name'])?>"><?php echo($city['name']) ?></option>
                    <?php } ?>
                </select>

            </div>

            <button type="submit">Get Weather</button>

        </form>
    
    </div>
    
</body>
</html>