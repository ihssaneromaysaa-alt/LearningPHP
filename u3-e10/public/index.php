<?php

require_once __DIR__ . "/src/Persona.php";
require_once __DIR__ . "/autoloader.php";
$persona = new Persona("paca", 20, "grana");
echo $persona->getNombre()."<br>"; 
echo $persona->getEdad()."<br>"; 
echo $persona->getCiudad()."<br>"; 

// echo $persona->getHOLA()."<br>"; 
