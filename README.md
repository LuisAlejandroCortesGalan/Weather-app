# Proyecto Meteorológico

Este proyecto utiliza la API de OpenWeather para mostrar el clima actual de una ciudad introducida por el usuario. La información presentada incluye la temperatura, la sensación térmica, la humedad, y un icono que representa el clima.

## Funcionalidades

- Permite al usuario ingresar el nombre de una ciudad para obtener información meteorológica.
- Muestra el clima actual de la ciudad, incluyendo:
  - Ciudad y país
  - Icono del clima
  - Temperatura actual, máxima y mínima
  - Sensación térmica
  - Humedad
- El color de fondo cambia dependiendo de la temperatura de la ciudad:
  - Rojo: temperatura > 33°C
  - Naranja: 28°C < temperatura <= 33°C
  - Verde: 18°C < temperatura <= 28°C
  - Verde claro: 12°C < temperatura <= 18°C
  - Azul oscuro: temperatura < 12°C
  - Gris: temperatura < 0°C

## Requisitos

- PHP 7 o superior.
- Conexión a Internet para obtener los datos de la API.

## Instrucciones de Uso

1. Clona o descarga el proyecto.
2. Abre el archivo `index.php` en tu servidor local o servidor web que soporte PHP.
3. Ingresa el nombre de una ciudad en el formulario y presiona "Enviar".
4. El clima de la ciudad se mostrará con la información relevante y un cambio en el color de fondo.

## Código de Ejemplo

```php
// URL de la API para obtener datos meteorológicos
$URL = "https://api.openweathermap.org/data/2.5/weather?q=$ciudad&appid=13a90374849f8d04b244930a0d6c3885&units=metric&lang=es";
$stringMeteo = file_get_contents($URL); // Obtener los datos como string
$jsonMeteo = json_decode($stringMeteo, true); // Convertir el string a JSON

// Obtener los datos
$nombre_icon = $jsonMeteo['weather']['0']['icon'];
$ciudad = $jsonMeteo['name'];
$country = $jsonMeteo['sys']['country'];
$temperatura = $jsonMeteo['main']['temp'];
