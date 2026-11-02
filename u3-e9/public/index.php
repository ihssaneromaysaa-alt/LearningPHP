<?php

require_once __DIR__ . "/src/EnvioExpress.php";
require_once __DIR__ . "/src/EnvioEstandar.php";
require_once __DIR__ . "/src/EnvioInternacional.php";


$peso = 1.5; // Peso en kg
$distancia = 250; // Distancia en km
$tipo_envio = 'Internacional';
$cadena = "Envio".$tipo_envio;
$envio= new $cadena($peso, $distancia);
echo "El costo final para el envío '{$tipo_envio}' ({$peso}kg, {$distancia}km) es: \${$envio->calcular_tarifa()}";
