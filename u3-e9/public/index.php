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




/**
 * HACER EJERCICIOS
 * NO SE QUÉ CON ENUM
 * 9,10,EL DEL EXAMEN ENUM
 * class perro{
 * private $name;
 * public function ladra(){
 *  echo "guau!";
 * }
 * public function __call($methodName,$args){
 *  echo "el metodo $methodName no existe";
 *  echo "<br> Pero puedo ladrar";
 *  return $this->ladra();
 *  }
 * }
 */
/*
SE PIDE:
1. Crear una interfaz CalculadorEnvio con el método calcularCosto().
2. Crear una clase abstracta EnvioBase con las propiedades comunes ($peso, $distancia).
3. Definir clases hijas (EnvioEstandar, EnvioExpress, EnvioInternacional) con su propia lógica.
4. Usar características de PHP 8 (constructor property promotion, match).
*/

// Datos de entrada
// $peso = 1.5; // Peso en kg
// $distancia = 250; // Distancia en km
// $tipo_envio = 'express';

// // FUNCIONES
// function calcular_tarifa_estandar($peso, $distancia) {
//     $costo_base = 5.0;
//     $costo_por_peso = $peso * 1.5;
//     $costo_por_distancia = $distancia * 0.05;
//     return $costo_base + $costo_por_peso + $costo_por_distancia;
// }

// function calcular_tarifa_express($peso, $distancia) {
//     $tarifa_estandar = calcular_tarifa_estandar($peso, $distancia);
//     $cargo_urgencia = 10.0;
//     return $tarifa_estandar + $cargo_urgencia;
// }

// function calcular_tarifa_internacional($peso, $distancia) {
//     $costo_base = 20.0;
//     $costo_por_peso = $peso * 5.0;
//     $costo_por_distancia = ($distancia > 500) ? $distancia * 0.1 : 0.0;
//     return $costo_base + $costo_por_peso + $costo_por_distancia;
// }

// function obtener_costo_total($peso, $distancia, $tipo_envio) {
//     switch ($tipo_envio) {
//         case 'estandar': return calcular_tarifa_estandar($peso, $distancia);
//         case 'express': return calcular_tarifa_express($peso, $distancia);
//         case 'internacional': return calcular_tarifa_internacional($peso, $distancia);
//         default:
//         echo 'Error: tipo de envío desconocido.';
//         return 0.0;
//     }
// }
