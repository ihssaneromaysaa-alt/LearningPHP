<?php
include_once __DIR__."/src/Coche.php";
echo "<h1>Ejercicios 1: Coche</h1>";

echo "<h3>Primer Coche</h3>";
$coche = new Coche();
echo $coche->toString();

echo "<h4>Le cambiamos de color</h4>";
$coche->setColor("Amarillo");
echo "El nuevo color de mi coche es: ".$coche->getColor();

echo "<h4>Mi coche va a acelerar 4 veces y a frenar una vez</h4>";
$coche->acelerar();
$coche->acelerar();
$coche->acelerar();
$coche->acelerar();

$coche->frenar();


echo "La velocidad de mi coche es: ".$coche->getVelocidad();


echo "<h3>Coche Nuevo</h3>";
$cocheNuevo = new Coche(marca:"Gallardo", color: "Verde");
echo $cocheNuevo->toString();