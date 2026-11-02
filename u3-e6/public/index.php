<?php
// index.php

// Cargamos las clases hijas (cada una ya carga Animal con require_once)
require_once __DIR__ . '/src/Perro.php';
require_once __DIR__ . '/src/Gato.php';
require_once __DIR__ . '/src/Pajaro.php';

// ===== PERRO =====
$labrador = new Perro(20, "labrador", "gris", "Pepe");

echo $labrador->set_nombre("Luna")
    ? "Nombre del perro actualizado correctamente<br>"
    : "Nombre NO modificado. Error: " . $labrador->get_ultimo_error() . "<br>";

// ===== GATO =====
$michi = new Gato(4.5, "persa", "blanco", "Luna");

echo $michi->set_nombre("Michi")
    ? "Nombre del gato actualizado correctamente<br>"
    : "Nombre NO modificado<br>";

// Intento fallido
echo $michi->set_nombre("EsteNombreEsDemasiadoLargoParaUnGato")
    ? "Nombre actualizado<br>"
    : "Error: " . $michi->get_ultimo_error() . "<br>";

// ===== PÁJARO =====
$loro = new Pajaro(0.4, "loro", "verde", "Kiko");

echo $loro->set_color("rojo")
    ? "Color del pájaro actualizado correctamente<br>"
    : "Color no modificado<br>";

echo "<br>----- Estado final -----<br>";
$labrador->mostrar_propiedades(); echo " → " . $labrador->speak() . "<br>";
$michi->mostrar_propiedades();    echo " → " . $michi->speak() . "<br>";
$loro->mostrar_propiedades();     echo " → " . $loro->speak() . "<br>";