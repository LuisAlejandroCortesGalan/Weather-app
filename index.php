<?php

$ciudad = "helsinki";

if ($_POST) {
    $ciudad = $_POST["ciudad"];
}

$ruta_icons = "https://www.imelcf.gob.pa/wp-content/plugins/location-weather/assets/images/icons/weather-icons/";

$URL = "https://api.openweathermap.org/data/2.5/weather?q=$ciudad&appid=13a90374849f8d04b244930a0d6c3885&units=metric&lang=es";

$stringMeteo = file_get_contents($URL); // devuelve un string
// echo $stringMeteo;



// CONVERTIR A JSON
$jsonMeteo = json_decode($stringMeteo, true);
// var_dump($jsonMeteo); 
// echo $jsonMeteo['name'];


// var_dump($jsonMeteo['weather']['0']['icon']);

// OBTENER EL ICONO
$nombre_icon = $jsonMeteo['weather']['0']['icon'];
// OBTENER LA CIUDAD
$ciudad = $jsonMeteo['name'];
// OBTENER EL PAIS
$country = $jsonMeteo['sys']['country'];
// OBTENER LA TEMPERATURA
$temperatura = $jsonMeteo['main']['temp'];
// OBTENER LA TEMPERATURA MAXIMA
$temp_max = $jsonMeteo['main']['temp_max'];
// OBTENER LA TEMPERATURA MINIMA
$temp_min = $jsonMeteo['main']['temp_min'];
// OBTENER LA SENSACION DE TEMPERATURA
$sensa_temp = $jsonMeteo['main']['feels_like'];
// OBTENER LA HUMEDAD
$humidity = $jsonMeteo['main']['humidity'];


?>

<!-- HTML  -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Meteo</title>

</head>

<body style="<?php if ($temperatura > 33) {
                    echo "background-color: #eb7915;";
                } else if ($temperatura > 28 && $temperatura < 33) {
                    echo "background-color: #7f8082;";
                } else if ($temperatura > 18 && $temperatura < 28) {
                    echo "background-color: #88eb10;";
                } else if ($temperatura > 12 && $temperatura < 18) {
                    echo "background-color: #02e096;";
                } else if ($temperatura > 0 && $temperatura < 12) {
                    echo "background-color: #06069e;";
                } else if ($temperatura < 0) {
                    echo "background-color: #7f8082;";
                }; ?>">
    <div class="container">
        <div class="input">
            <form method="post">
                <label for="ciudad">Introduce una ciudad</label><br>
                <input type="text" id="ciudad" name="ciudad" autofocus placeholder="Barcelona"><br>
                <button type="submit">Enviar</button>
            </form>
        </div>
        <?php if(isset($jsonMeteo["name"])) : ?>
        <div class="div_title">
            <div class="title_text">
                <p>Pais: <?= $country ?></p>
                <p>Ciudad: <?= $ciudad ?></p>
            </div>
            <div>
                <img src="<?= $ruta_icons . $nombre_icon ?>.svg" alt="Icono del tiempo">
            </div>
        </div>
        <div class="div_text">
            <p>Temperatura: <?= $temperatura ?> ºC</p>
            <p>Temperatura maxima: <?= $temp_max ?> ºC</p>
            <p>Temperatura minima: <?= $temp_min ?> ºC</p>
            <p>Sensacion de temperatura: <?= $sensa_temp ?> ªC</p>
            <p>Humedad: <?= $humidity ?></p>
        </div>
    </div>
<?php else : ?>
    <p>Introduce una ciudad correcta</p>
    
<?php endif; ?>    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #d2d6d2;
            position: relative;

        }

        .container {
            background-color: white;
            margin-top: 80px;
            width: 600px;
            height: 650px;
            border: 2px solid grey;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        button {
            width: 100px;
            height: 30px;
            background-color: #2d57cc;
            border-radius: 5px;
            color: white;
        }

        .div_title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 0 50px;
        }

        .title_text p {
            font-size: 30px;
        }

        .div_text {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 50px;
            gap: 20px;
        }

        img {
            width: 200px;
            height: 200px;
        }

        p {
            font-size: 20px;
            font-weight: bold;
        }

        label {
            font-size: 40px;
            font-weight: bold;
        }

        .input {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        #ciudad {
            height: 40px;
            width: 300px;
            text-align: center;
            font-size: 20px;
            border: none;
        }
    </style>


</body>

</html>