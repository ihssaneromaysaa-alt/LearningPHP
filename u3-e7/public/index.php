<?php

//7. Abstracta

include __DIR__."/src/Circulo.php";
include __DIR__."/src/Rectangulo.php";
$circulo=new Circulo(34);
$circulo->mostrarNombre();
echo "<br> area: ".$circulo->calcularArea();
$rectangulo=new Rectangulo(34,23);
$rectangulo->mostrarNombre();
echo "<br> area: ".$rectangulo->calcularArea();

